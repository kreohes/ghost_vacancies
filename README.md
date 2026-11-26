# Ghost Vacancies

Job seekers spend hours applying to vacancies where nobody is actually being hired.
Ghost Vacancies lets applicants report what happened after they applied (silence, a reply or an interview)
and turns these reports into a **ghost-risk label** for every vacancy and a **"no answer" rate** for every company.

Built with Laravel 13, Blade, Tailwind and SQLite for the course *Modern Web Application 1: From Idea to MVP*.

## Run it locally

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```

Open the site in Herd (`http://ghost-vacancies.test`) or with `php artisan serve`.

Seeded accounts (password `password` for all):

| Email | Role |
|---|---|
| admin@admin.com | admin, has own vacancies and reports |
| test@example.com | normal user |

## Data model

| Model | Fields | Relationships |
|---|---|---|
| User | name, email, password, is_admin | has many vacancies (added), has many reports |
| Company | name, website | has many vacancies, has many reports through vacancies |
| Vacancy | title, url, posted_at, company_id, user_id | belongs to company, belongs to user, has many reports |
| Report | status, applied_at, comment, vacancy_id, user_id | belongs to vacancy, belongs to user |

A user can leave one report per vacancy (unique `vacancy_id` + `user_id`).

## How the risk is calculated

- Risk of a vacancy = share of its reports with status `silence`.
- A silence report only counts when the application is older than 14 days.
- With fewer than 3 counted reports the label is "not enough data".
- high: 60% or more, medium: 30% to 60%, low: below 30%.
- The company "no answer" rate uses the same rule over all its vacancies.

The rule lives in `app/Models/Report.php` (`countsForRisk`, `silenceShare`) and is tested in `tests/Feature/GhostRiskTest.php`.

## Scam signal (machine learning)

Next to the ghost risk, a vacancy with a description gets a **scam signal**: the probability that its text looks like a fraudulent job ad.

- Model: logistic regression on a binary bag of words (title + description), trained in `ml/train.py` on the public EMSCAD dataset (17,880 postings from 2012-2014, 866 fraudulent, CC0).
- Quality on a held-out 20% (3 seeds): PR-AUC 0.78 ± 0.04, ROC-AUC 0.94 ± 0.01. Details in `ml/README.md`.
- The weights are exported to `resources/ml/scam-model.json`; `app/Support/ScamModel.php` adds up the weights of the words in the text and applies the sigmoid, so no Python is needed at runtime.
- Caveat: the labels mean *fraud*, not *ghost vacancy*. It is a hint, not a verdict.

## Pages

| Area | Pages |
|---|---|
| Public | home, about, risk explanation, vacancies list + page, companies list + page |
| User zone (`/user`, login required) | dashboard, my reports (full CRUD), my vacancies (add, edit, delete), add a company |
| Admin (`/admin`, `is_admin` only) | reports moderation, manage vacancies, manage companies |

## Where to find things

| What | Where |
|---|---|
| All routes | `routes/web.php` |
| Public pages | `app/Http/Controllers/{Welcome,Page,Vacancy,Company}Controller.php` |
| User zone | `app/Http/Controllers/Userzone/` |
| Admin zone | `app/Http/Controllers/Admin/` + `app/Http/Middleware/EnsureUserIsAdmin.php` |
| Menu (header and footer) | `app/View/Components/AppLayout.php` |
| Form fields, status picker, badges | `resources/views/components/` |

Run the tests with `php artisan test`.
