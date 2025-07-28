# Heart Attack Risk Prediction Using Retinal Eye Images

## Overview
This project implements a non-invasive heart attack risk screening system based on retinal eye images using deep learning. It utilizes a YOLOv8 model within a Streamlit-based application to assess the risk levels—Mild, Moderate, or Severe—based on patterns identified in retinal scans. The system aims to assist in the early detection of cardiovascular conditions, supported by medical and lifestyle recommendations.

## Key Features

- Web-based application using Streamlit for user interaction

- Real-time image analysis powered by YOLOv8

- Automatic classification of heart attack risk levels:

Mild

Moderate

Severe

- Detailed, risk-specific medical advice, lifestyle recommendations, and follow-up plans

- Error-handling and logging for production reliability

- Integrated session management and progress visualization

- Privacy-focused design (no storage of images or personal data)

## Uniqueness of the Project

Retinal-based Cardiac Risk Detection: Unlike conventional ECG or blood tests, this system explores an emerging diagnostic technique using retinal imaging, which is minimally invasive and quicker.

YOLOv8 for Medical Imaging: Applying YOLOv8 to subtle medical features in eye scans is a novel direction, requiring domain-specific optimization and confidence interpretation.

Multi-Level Risk Classification: Rather than binary prediction, the model classifies the user into three actionable risk tiers, each with tailored medical and lifestyle plans.

Dynamic Interface with Interpretability: Combines interactive visual outputs with confidence scores and actionable insights for transparency and usability.

Deployable Web Interface: Streamlit integration allows this model to be deployed as a browser-based tool, requiring no installations or local environment setup.

## Challenges Faced
Medical Dataset Availability: Limited publicly available datasets directly linking retinal images to cardiovascular outcomes made model training and validation difficult.

YOLO Adaptation for Retinal Analysis: YOLO is designed for object detection, so adapting it for medical grading required careful tuning and interpretation of confidence scores.

Image Variability: Variation in image quality and clarity led to frequent prediction errors, necessitating robust preprocessing and error feedback.

User Trust and Medical Reliability: Since this system provides medical suggestions, it had to be built with disclaimers, security measures, and transparency about the model’s limitations.

Streamlit Session State Management: Ensuring a smooth user experience with session persistence and dynamic rendering posed UI-level technical challenges.

## Tech Stack
Frontend: Streamlit (Python-based)

Backend/Model: YOLOv8 (Ultralytics), OpenCV, Pillow

Image Handling: NumPy, PIL

Logging: Python logging module

Language: Python 3.8+

Installation
Prerequisites
Ensure the following are installed:

Python 3.8+

pip

PyTorch-compatible GPU (optional for faster inference)

Clone the Repository
bash
Copy
Edit
git clone https://github.com/yourusername/retinal-heart-risk.git
cd retinal-heart-risk
Install Dependencies
bash
Copy
Edit
pip install -r requirements.txt
Ensure the best.pt YOLOv8 model (trained for retinal risk classification) is placed in the root directory.

Running the Application
bash
Copy
Edit
streamlit run app.py
Then, open the browser at the suggested local URL (typically http://localhost:8501)

Model
Base Model: YOLOv8

Task: Custom object detection / classification

Input: Retinal image (JPG, PNG)

Output: Risk confidence score (0.0 – 1.0)

# Risk levels:

< 0.5: Mild Risk

0.5 – 0.7: Moderate Risk

> 0.7: Severe Risk

# Contributors

- Likhitha UH 
- Rishal Tauro
- Nikitha Nandi
- Pratheeksha Devadiga



