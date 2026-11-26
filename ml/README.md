# Scam signal model

A small text classifier that estimates how much a job posting looks like a fraudulent ad.
It is trained offline in Python. The app itself only reads the exported weights (`resources/ml/scam-model.json`) and does the scoring in PHP (`app/Support/ScamModel.php`), so no Python is needed at runtime.

## Data

- EMSCAD, "Employment Scam Aegean Dataset" (University of the Aegean): 17,880 real job postings from 2012-2014, 866 of them (4.8%) marked as fraudulent.
- Downloaded from a CC0 mirror: https://huggingface.co/datasets/victor/real-or-fake-fake-jobposting-prediction
- Save the file as `ml/data/fake_job_postings.csv`. The folder is in `.gitignore`, the dataset is not part of the repository.

## Important caveat

The labels say "this ad is a scam", not "this vacancy is a ghost vacancy". There is no public dataset with ghost labels.
So this is a separate signal next to the ghost risk, which is still calculated only from user reports.
The postings are English and 10+ years old, so the score is a hint, not a verdict.

## Features and model

- Text = title + description.
- Binary bag of words (`CountVectorizer`): lowercase, English stop words removed, words seen in at least 3 postings, the 5000 most frequent words. A word is either present (1) or not (0).
- Logistic regression (`C=1`, no class weights): probability = sigmoid(intercept + sum of the weights of the words present).

## Results

Stratified 80/20 split, mean ± std over 3 seeds (0, 1, 2). The threshold for F1, precision and recall is 0.5.
PR-AUC of a random classifier would be about 0.048 (the share of fraudulent postings).

| Variant | PR-AUC | ROC-AUC | F1 | Precision | Recall |
|---|---|---|---|---|---|
| title only | 0.550 ± 0.029 | 0.885 ± 0.009 | 0.414 ± 0.054 | 0.889 ± 0.041 | 0.272 ± 0.047 |
| **title + description (used)** | 0.781 ± 0.040 | 0.941 ± 0.011 | 0.759 ± 0.037 | 0.866 ± 0.034 | 0.676 ± 0.040 |
| title + description, balanced class weights | 0.767 ± 0.042 | 0.937 ± 0.011 | 0.692 ± 0.039 | 0.636 ± 0.034 | 0.759 ± 0.056 |

The title alone is not enough, the description carries most of the signal. Balanced class weights raise recall but lower precision and PR-AUC, so the unweighted model is exported.

## From probability to label

The site turns the probability into a label (`ScamModel::label()` in `app/Support/ScamModel.php`). The thresholds come from the same 3 held-out splits:

| Probability | Label | Precision | Recall |
|---|---|---|---|
| ≥ 0.5 | likely scam | 0.866 ± 0.034 | 0.676 ± 0.040 |
| ≥ 0.2 | suspicious or likely scam | 0.707 ± 0.058 | 0.748 ± 0.047 |
| < 0.2 | looks normal | | |

Precision is the share of flagged postings that really were fraudulent; recall is the share of fraudulent postings that were flagged.

## How to retrain

```
pip install pandas scikit-learn
python3 ml/train.py            # prints the table above
python3 ml/train.py --export   # also retrains on all rows and writes the files below
```

- `resources/ml/scam-model.json`: intercept and one weight per word.
- `tests/fixtures/scam-model-examples.json`: a few texts with the probability Python computed. `tests/Feature/ScamModelTest.php` checks that PHP gives the same numbers.
