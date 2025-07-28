import streamlit as st
from ultralytics import YOLO
import cv2
from PIL import Image
import numpy as np
import os
from datetime import datetime
import torch
import logging

# Configure logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Environment settings
os.environ["KMP_DUPLICATE_LIB_OK"] = "TRUE"

# Set page configuration
st.set_page_config(
    page_title="Retinal Heart Risk Analysis",
    page_icon="👁️",
    layout="wide"
)

# Custom CSS for better styling
st.markdown("""
    <style>
    .main {
        padding: 2rem;
    }
    .stAlert {
        padding: 1rem;
        border-radius: 0.5rem;
    }
    .report-box {
        padding: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid #ddd;
        margin: 1rem 0;
    }
    </style>
""", unsafe_allow_html=True)


# Initialize session state
def init_session_state():
    if 'page' not in st.session_state:
        st.session_state.page = 'main'
    if 'risk_level' not in st.session_state:
        st.session_state.risk_level = None
    if 'confidence' not in st.session_state:
        st.session_state.confidence = None
    if 'analyzed_image' not in st.session_state:
        st.session_state.analyzed_image = None
    if 'original_image' not in st.session_state:
        st.session_state.original_image = None
    if 'model' not in st.session_state:
        st.session_state.model = None


# Load YOLOv8 model with error handling
@st.cache_resource
def load_model():
    try:
        logger.info("Loading YOLO model...")
        model = YOLO('best.pt')
        logger.info("Model loaded successfully")
        return model
    except Exception as e:
        logger.error(f"Error loading model: {str(e)}")
        st.error(f"Failed to load model: {str(e)}")
        return None


def get_risk_level(confidence):
    if confidence < 0.5:
        return "Mild", "✅"
    elif confidence < 0.7:
        return "Moderate", "⚠️"
    else:
        return "Severe", "🚨"


def predict_image(image, model):
    try:
        results = model(image, stream=True)
        result = next(results)

        # Extract the raw image without bounding boxes
        image_no_box = result.orig_img  # Original image without boxes

        return result, image_no_box
    except Exception as e:
        logger.error(f"Prediction error: {str(e)}")
        st.error(f"Error during image analysis: {str(e)}")
        return None, None


def show_results_page():
    st.session_state.page = 'results'
    st.rerun()


def show_main_page():
    st.session_state.page = 'main'
    st.rerun()


def get_recommendations(risk_level):
    recommendations = {
        "Mild": {
            "medical": [
                "Schedule annual cardiovascular check-up",
                "Regular blood pressure monitoring (monthly)",
                "Basic lipid profile test annually",
                "Document family history of heart disease"
            ],
            "lifestyle": [
                "Maintain balanced diet",
                "30 minutes of moderate exercise daily",
                "Regular sleep schedule",
                "Stress management techniques"
            ],
            "followup": [
                "Annual check-up",
                "Monthly blood pressure monitoring",
                "Regular exercise log"
            ]
        },
        "Moderate": {
            "medical": [
                "Schedule cardiology consultation within 1 month",
                "Weekly blood pressure monitoring",
                "Comprehensive cardiovascular screening",
                "Review current medications with doctor",
                "Consider stress test evaluation"
            ],
            "lifestyle": [
                "Strict low-sodium diet",
                "Supervised exercise program",
                "Stress reduction program",
                "Sleep hygiene improvement"
            ],
            "followup": [
                "Quarterly cardiac check-ups",
                "Weekly vital signs monitoring",
                "Monthly progress review"
            ]
        },
        "Severe": {
            "medical": [
                "🚨 Immediate medical consultation required",
                "Daily blood pressure monitoring",
                "Emergency contact numbers readily available",
                "Comprehensive cardiac evaluation",
                "Medication review and adjustment"
            ],
            "lifestyle": [
                "Medically supervised diet plan",
                "Limited physical activity as prescribed",
                "Stress avoidance",
                "Regular rest periods"
            ],
            "followup": [
                "Weekly medical check-ups",
                "Daily health monitoring",
                "24/7 emergency preparedness"
            ]
        }
    }
    return recommendations.get(risk_level, {})


def process_uploaded_image(uploaded_file):
    try:
        image = Image.open(uploaded_file)
        img_array = np.array(image.convert('RGB'))
        return image, img_array
    except Exception as e:
        logger.error(f"Image processing error: {str(e)}")
        st.error(f"Error processing uploaded image: {str(e)}")
        return None, None


def display_results():
    st.markdown("# 📊 Detailed Analysis & Recommendations")

    if st.button("← Back to Analysis"):
        show_main_page()

    st.markdown("### 🎯 Risk Assessment Summary")
    col1, col2 = st.columns([2, 1])

    with col1:
        risk_icon = "✅" if st.session_state.risk_level == "Mild" else "⚠️" if st.session_state.risk_level == "Moderate" else "🚨"
        st.markdown(f"""
        #### Results Overview
        - **Assessment Date**: {datetime.now().strftime('%B %d, %Y')}
        - **Risk Level**: {risk_icon} {st.session_state.risk_level}
        - **Confidence Score**: {st.session_state.confidence:.2%}
        """)

    with col2:
        if st.session_state.analyzed_image is not None:
            st.image(st.session_state.analyzed_image, caption="Analysis Result", use_container_width=True)

    recommendations = get_recommendations(st.session_state.risk_level)

    st.markdown("### 💡 Personalized Recommendations")
    tabs = st.tabs(["🏥 Medical Actions", "🎯 Lifestyle Changes", "📅 Follow-up Plan"])

    with tabs[0]:
        st.markdown("#### Recommended Medical Actions")
        for action in recommendations["medical"]:
            st.markdown(f"- {action}")

    with tabs[1]:
        st.markdown("#### Lifestyle Modifications")
        for change in recommendations["lifestyle"]:
            st.markdown(f"- {change}")

    with tabs[2]:
        st.markdown("#### Follow-up Schedule")
        for item in recommendations["followup"]:
            st.markdown(f"- {item}")

    st.markdown("### 📚 Additional Resources")
    st.markdown("""
    ⚠️ **Medical Disclaimer**: This analysis and recommendations are for informational purposes only. 
    Please consult with healthcare professionals for medical advice.

    🔒 **Privacy Note**: Your health information and images are processed securely and not stored.
    """)


def main():
    # Initialize session state
    init_session_state()

    if st.session_state.page == 'results':
        display_results()
        return

    st.markdown("# 👁️ Heart Attack Risk Prediction 💓")
    st.markdown("### Retinal Image Analysis System 🔍")

    st.markdown("""
    🎯 **Purpose**: Early detection of heart attack risk through retinal image analysis  
    🔬 **Technology**: Powered by YOLOv8  
    🏥 **Medical Disclaimer**: This tool is for screening purposes only
    """)

    # Load model if not already loaded
    if st.session_state.model is None:
        st.session_state.model = load_model()

    if st.session_state.model is None:
        st.error("Unable to load the analysis model. Please try again later.")
        return

    st.markdown("### 📤 Upload Image")
    uploaded_file = st.file_uploader("Choose a retinal image...", type=["jpg", "jpeg", "png"])

    if uploaded_file is not None:
        image, img_array = process_uploaded_image(uploaded_file)

        if image is not None and img_array is not None:
            col1, col2 = st.columns(2)

            with col1:
                st.markdown("### 📸 Original Image")
                st.image(image, caption="Uploaded Retinal Image", use_container_width=True)
                st.session_state.original_image = image

            with st.spinner('🔄 Analyzing retinal image...'):
                results, image_no_box = predict_image(img_array, st.session_state.model)

                if results is not None:
                    confidence = float(results.boxes.conf[0])
                    risk_level, risk_icon = get_risk_level(confidence)

                    st.session_state.risk_level = risk_level
                    st.session_state.confidence = confidence
                    st.session_state.analyzed_image = image_no_box  # Display image without bounding boxes

                    with col2:
                        st.markdown("### 🎯 Analysis Visualization")
                        st.image(st.session_state.analyzed_image, caption="Analysed Retinal Image",
                                 use_container_width=True)

                    st.markdown("### 📊 Initial Risk Assessment")
                    st.markdown(f"#### Risk Level: {risk_icon} {risk_level}")
                    st.markdown(f"**Confidence Score:**")
                    st.progress(confidence)
                    st.markdown(f"*{confidence:.2%}*")

                    st.markdown("### 📋 Detailed Analysis")
                    if st.button("View Detailed Analysis and Recommendations"):
                        show_results_page()
                else:
                    st.warning("⚠️ No features detected. Please upload a clear retinal image.")

    st.markdown("---")
    st.markdown("""
    👨‍⚕️ **Medical Disclaimer**: This tool is for screening purposes only. Always consult with healthcare professionals.  
    🔒 **Privacy Note**: Images are processed securely and not stored.
    """)


if __name__ == '__main__':
    try:
        main()
    except Exception as e:
        logger.error(f"Application error: {str(e)}")
        st.error("An unexpected error occurred. Please try again or contact support.")