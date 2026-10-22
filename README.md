
# 🛒 Online Shopping Purchase Prediction Using Machine Learning

## 📌 Project Overview

Online Shopping Purchase Prediction is a machine learning web application that predicts whether an online shopping visitor is likely to make a purchase based on their browsing session activities.

The system analyzes information such as the number of pages visited, time spent on product pages, bounce rate, exit rate, visitor type, and other session details.

The application combines a Python machine learning model, FastAPI, and a PHP-based web interface to generate predictions and display the results.

## 🎯 Objectives

- Analyze online shopping visitor behavior.
- Predict whether a visitor is likely to purchase a product.
- Train a machine learning classification model using historical data.
- Build a user-friendly web interface using HTML, CSS, and PHP.
- Integrate the machine learning model with the web application using FastAPI.
- Display purchase statistics and charts through a dashboard.

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| Python | Machine learning and data processing |
| Pandas | Dataset manipulation |
| Scikit-learn | Model training and preprocessing |
| Joblib | Saving and loading the trained model |
| FastAPI | Providing the prediction API |
| Uvicorn | Running the API server |
| PHP | Form processing and API communication |
| HTML | Web page structure |
| CSS | Web page styling |
| Chart.js | Dashboard charts |
| XAMPP | Running the PHP application locally |
| Jupyter Notebook | Data exploration and model training |

## 📂 Project Structure

```text
OnlineShoppingPrediction/
│
├── index.php
├── predict.php
├── dashboard.php
├── api.py
├── purchase_prediction_model.pkl
├── purchase_threshold.pkl
├── online_shoppers_intention.csv
└── model_training.ipynb
```

**Note:** The dataset and notebook filenames above are examples. Keep the actual filenames used in your project.

## 📊 Dataset Description

The project uses an Online Shoppers Purchasing Intention dataset containing **12,330 shopping sessions**.

The target variable is `Revenue`:

- `True` — The session resulted in a purchase.
- `False` — The session did not result in a purchase.

### Dataset Distribution

- Total sessions: 12,330
- Purchase sessions: 1,908
- Non-purchase sessions: 10,422
- Purchase rate: Approximately 15.47%

### Input Features

The model uses 16 input features:

1. Administrative
2. Administrative_Duration
3. Informational
4. Informational_Duration
5. ProductRelated
6. ProductRelated_Duration
7. BounceRates
8. ExitRates
9. SpecialDay
10. Month
11. OperatingSystems
12. Browser
13. Region
14. TrafficType
15. VisitorType
16. Weekend

The `Revenue` column is the target and is not used as an input feature.

## ⚙️ Machine Learning Workflow

1. Load and explore the dataset.
2. Prepare the selected input features and target variable.
3. Preprocess numerical and categorical features.
4. Train a classification model.
5. Evaluate model performance.
6. Save the trained model and decision threshold.
7. Load the saved model through FastAPI.
8. Connect the PHP form to the API.
9. Display the prediction and estimated purchase probability.

## 🌐 Application Features

### 1. Prediction Form

Users enter shopping session details through a styled PHP form.

### 2. Machine Learning Prediction

The Python API processes the input and predicts one of the following:

- Purchase
- No Purchase

### 3. Purchase Probability

The application displays the model's estimated purchase probability as a percentage.

### 4. Dashboard

The dashboard displays dataset statistics, including total sessions, purchase sessions, non-purchase sessions, purchase rate, and charts.

## 🚀 How to Run the Project

### Prerequisites

Install or configure:

- Python
- XAMPP
- A web browser
- Required Python libraries

### Step 1: Open the Project Folder

Place the project inside:

```text
C:\xampp\htdocs\OnlineShoppingPrediction
```

Open this folder in VS Code.

### Step 2: Install Python Dependencies

Open the VS Code terminal in the project folder and run:

```bash
pip install pandas scikit-learn joblib fastapi uvicorn
```

If your project uses a virtual environment, activate it before installing the dependencies.

### Step 3: Start the Python API

Run:

```bash
python -m uvicorn api:app --reload
```

The API will be available at:

```text
http://127.0.0.1:8000
```

Open the interactive API documentation at:

```text
http://127.0.0.1:8000/docs
```

Keep the API terminal running while using the prediction form.

### Step 4: Start XAMPP

1. Open the XAMPP Control Panel.
2. Start Apache.
3. Ensure that the project files are inside the `htdocs` directory.

### Step 5: Open the Dashboard

Visit:

```text
http://localhost/OnlineShoppingPrediction/dashboard.php
```

### Step 6: Open the Prediction Form

Visit:

```text
http://localhost/OnlineShoppingPrediction/index.php
```

Enter the required shopping session details and click **Predict Purchase**.

The application sends the input values to the Python API and displays the prediction result.

## 📈 Model Performance

The recorded model evaluation results are:

- Accuracy: 61.48%
- Purchase precision: 0.25
- Purchase recall: 0.74
- Purchase F1-score: 0.37

The model identified a substantial portion of actual purchase sessions in the recorded evaluation. However, the purchase precision indicates that many sessions predicted as purchases were not actual purchases.

Therefore, the prediction should be treated as an estimate rather than a guarantee.

## 🔮 Future Enhancements

- Improve model performance through hyperparameter tuning.
- Compare multiple classification algorithms.
- Add more interactive dashboard visualizations.
- Improve input validation and error handling.
- Integrate real-time shopping session data.
- Deploy the application to a secure hosting environment.

## 🎓 Conclusion

This project demonstrates how machine learning can be integrated into a web application to estimate online shopping purchase behavior.

It combines data preprocessing, classification, API development, PHP integration, and dashboard visualization in a single application.

The project provides practical experience in machine learning and full-stack application development.

