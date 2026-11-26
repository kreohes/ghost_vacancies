import json
import sys
from pathlib import Path

import numpy as np
import pandas as pd
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import average_precision_score, f1_score, precision_score, recall_score, roc_auc_score
from sklearn.model_selection import train_test_split

ML_DIR = Path(__file__).resolve().parent
DATA = ML_DIR / "data" / "fake_job_postings.csv"
MODEL_OUT = ML_DIR.parent / "resources" / "ml" / "scam-model.json"
EXAMPLES_OUT = ML_DIR.parent / "tests" / "fixtures" / "scam-model-examples.json"
SEEDS = [0, 1, 2]
VOCAB_SIZE = 5000


def make_vectorizer():
    return CountVectorizer(binary=True, lowercase=True, stop_words="english", min_df=3, max_features=VOCAB_SIZE)


def make_model(class_weight):
    return LogisticRegression(C=1.0, class_weight=class_weight, max_iter=3000)


def evaluate(texts, labels, class_weight):
    rows = []
    for seed in SEEDS:
        x_train, x_test, y_train, y_test = train_test_split(texts, labels, test_size=0.2, stratify=labels, random_state=seed)
        vectorizer = make_vectorizer()
        model = make_model(class_weight).fit(vectorizer.fit_transform(x_train), y_train)
        proba = model.predict_proba(vectorizer.transform(x_test))[:, 1]
        predicted = (proba >= 0.5).astype(int)
        rows.append({
            "pr_auc": average_precision_score(y_test, proba),
            "roc_auc": roc_auc_score(y_test, proba),
            "f1": f1_score(y_test, predicted),
            "precision": precision_score(y_test, predicted, zero_division=0),
            "recall": recall_score(y_test, predicted),
        })
    table = pd.DataFrame(rows)
    return {metric: (table[metric].mean(), table[metric].std()) for metric in table.columns}


def main():
    df = pd.read_csv(DATA)
    labels = df["fraudulent"].to_numpy()
    title_only = df["title"].fillna("")
    title_and_description = df["title"].fillna("") + " " + df["description"].fillna("")

    print(f"rows={len(df)} fraudulent={labels.sum()} ({labels.mean():.1%})")
    experiments = {
        "title only, unweighted": (title_only, None),
        "title + description, unweighted": (title_and_description, None),
        "title + description, balanced": (title_and_description, "balanced"),
    }
    for name, (texts, class_weight) in experiments.items():
        scores = evaluate(texts, labels, class_weight)
        line = "  ".join(f"{metric} {mean:.3f}±{std:.3f}" for metric, (mean, std) in scores.items())
        print(f"{name:34s} {line}")

    if "--export" not in sys.argv:
        return

    vectorizer = make_vectorizer()
    model = make_model(None).fit(vectorizer.fit_transform(title_and_description), labels)
    words = vectorizer.get_feature_names_out()
    weights = {word: round(float(weight), 8) for word, weight in zip(words, model.coef_[0])}

    example_texts = [title_and_description.iloc[index] for index in [0, 1, 2]]
    example_texts += [title_and_description.iloc[index] for index in np.flatnonzero(labels == 1)[:2]]
    example_texts += [df["title"].iloc[0] + " ", "Data entry clerk, work from home, earn money daily, no experience"]
    probabilities = model.predict_proba(vectorizer.transform(example_texts))[:, 1]
    examples = [{"text": text, "probability": float(probability)} for text, probability in zip(example_texts, probabilities)]

    MODEL_OUT.parent.mkdir(parents=True, exist_ok=True)
    MODEL_OUT.write_text(json.dumps({
        "source": "EMSCAD fake job postings (University of the Aegean), CC0 mirror on Hugging Face",
        "label": "fraudulent job ad (not ghost vacancy)",
        "features": "binary bag of words over title + description, lowercase, english stop words removed",
        "intercept": round(float(model.intercept_[0]), 8),
        "weights": weights,
    }, indent=1) + "\n")
    EXAMPLES_OUT.parent.mkdir(parents=True, exist_ok=True)
    EXAMPLES_OUT.write_text(json.dumps(examples, indent=1) + "\n")
    print(f"exported {len(weights)} word weights to {MODEL_OUT} and {len(examples)} examples to {EXAMPLES_OUT}")


if __name__ == "__main__":
    main()
