from tkinter import image_names
from fastapi import FastAPI, UploadFile, File
import numpy as np
import uvicorn
from PIL import Image
from io import BytesIO
import cv2
import glob
import tensorflow as tf
import json

app=FastAPI()

MODEL=tf.keras.models.load_model("/Volumes/DipeshDocuments/Major Project/poacece/api/Model/poacece_disease_vgg_finetuning_3.h5")
MODELNUTRIENT=tf.keras.models.load_model("/Volumes/DipeshDocuments/Major Project/poacece/api/Model/vgg16_nutrient_fine_tuning_2.h5")
class_disease=['Corn_Common_Rust','Corn_Gray_Leaf_Spot','Corn__Healthy','Corn_Leaf_Blight','Rice_Bacterial_Leaf','Rice_Brown_Spot','Rice_Healthy','Rice_Leaf_Blast','Wheat_Healthy','Wheat_Stripe_Rust']
class_nutrient=['Rice_Nitrogen','Rice_Phosphorous','Rice_Potassium']

def read_file_as_image(data) -> np.ndarray:
    image=np.array(Image.open(BytesIO(data)))
    return image

@app.get("/predictdisease/{image_path}")
async def predictdisease(image_path):
    imagename="/Volumes/DipeshDocuments/Major Project/poacece/poacece code/photos/"
    imagename +=image_path
    for imag in glob.glob(imagename):
        image= cv2.imread(imag)
    img = cv2.resize(image, (224, 224))
    np_image_lists = np.array(img, dtype=np.float16) / 255.0
    image_batch=np.expand_dims(np_image_lists, 0)
    prediction=MODEL.predict(image_batch)
    predicted_class=class_disease[np.argmax(prediction[0])]
    file=open("disease_cure.json")
    data=json.load(file)
    for i in data[predicted_class]:
        data=i
    file.close()
    return {
        'class':predicted_class,
        'cure':data
    }

@app.get("/predictnutrient/{image_path}")
async def predictnutrient(image_path):
    imagename="/Volumes/DipeshDocuments/Major Project/poacece/poacece code/photos/Nutrient/"
    imagename +=image_path
    for imag in glob.glob(imagename):
        image= cv2.imread(imag)
    img = cv2.resize(image, (224, 224))
    np_image_lists = np.array(img, dtype=np.float16) / 255.0
    image_batch=np.expand_dims(np_image_lists, 0)
    prediction=MODELNUTRIENT.predict(image_batch)
    predicted_class=class_nutrient[np.argmax(prediction[0])]
    return predicted_class
    

if __name__=="__main__":
    uvicorn.run(app,host='localhost',port=8003)