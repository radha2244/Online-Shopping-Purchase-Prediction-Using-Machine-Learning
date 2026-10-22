
from fastapi import FastAPI
from pydantic import BaseModel
import pandas as pd
import joblib

app = FastAPI()

# Load the trained model and threshold
model = joblib.load("purchase_prediction_model.pkl")
threshold = joblib.load("purchase_threshold.pkl")


class ShoppingSession(BaseModel):
    Administrative: int
    Administrative_Duration: float
    Informational: int
    Informational_Duration: float
    ProductRelated: int
    ProductRelated_Duration: float
    BounceRates: float
    ExitRates: float
    SpecialDay: float
    Month: str
    OperatingSystems: int
    Browser: int
    Region: int
    TrafficType: int
    VisitorType: str
    Weekend: bool


@app.get("/")
def home():
    return {"message": "Online Shopping Prediction API is running"}


@app.post("/predict")
def predict(session: ShoppingSession):
    data = pd.DataFrame([session.model_dump()])

    # Match the input columns used during training
    data = data[model.feature_names_in_]

    probability = float(model.predict_proba(data)[0][1])
    prediction = int(probability >= threshold)

    return {
        "prediction": "Purchase" if prediction == 1 else "No Purchase",
        "purchase_probability": round(probability, 4)
    }
