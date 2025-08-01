
Detect Heart Attack - v1 2024-11-11 6:30pm
==============================

This dataset was exported via roboflow.com on November 13, 2024 at 7:23 PM GMT

Roboflow is an end-to-end computer vision platform that helps you
* collaborate with your team on computer vision projects
* collect & organize images
* understand and search unstructured image data
* annotate, and create datasets
* export, train, and deploy computer vision models
* use active learning to improve your dataset over time

For state of the art Computer Vision training notebooks you can use with this dataset,
visit https://github.com/roboflow/notebooks

To find over 100k other datasets and pre-trained models, visit https://universe.roboflow.com

The dataset includes 10865 images.
Retinal-Image are annotated in YOLOv8 format.

The following pre-processing was applied to each image:
* Auto-orientation of pixel data (with EXIF-orientation stripping)
* Resize to 700x504 (Stretch)

The following augmentation was applied to create 3 versions of each source image:
* 50% probability of horizontal flip
* 50% probability of vertical flip
* Randomly crop between 0 and 5 percent of the image
* Random rotation of between -10 and +10 degrees
* Random brigthness adjustment of between -15 and +15 percent
* Random exposure adjustment of between -9 and +9 percent


