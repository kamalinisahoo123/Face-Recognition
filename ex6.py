#!C:/Users/admin/AppData/Local/Programs/Python/Python36/python.exe
import os
import io
import json
from azure.cognitiveservices.vision.face import FaceClient
from msrest.authentication import CognitiveServicesCredentials
import requests
from PIL import Image, ImageDraw, ImageFont
import cgi, cgitb

"""
Example 4. Detect if a face shows up in other photos/images
"""

''' credential = json.load(open('AzureCloudKeys.json'))
API_KEY = credential['API_KEY']
ENDPOINT = credential['ENDPOINT'] '''

API_KEY = '7df052d18b7d46ff9a08650147d4ae08'
ENDPOINT = 'https://engage-face-api.cognitiveservices.azure.com/'
face_client = FaceClient(ENDPOINT, CognitiveServicesCredentials(API_KEY))

form = cgi.FieldStorage() 

path = "C:/wamp64/www/FaceRecognition/uploads/"

path2 = form.getvalue('path')

# list files in img directory
files = os.listdir(path)
#print('Files in img :',files)
print("content-type: text/html\n\n" ) 

for file in files:
    # make sure file is an image
    if file.endswith(('.jpg', '.png', 'jpeg', '.JPG')):
        img_path = path + file
        #print(img_path)

        ''' response_detected_faces = face_client.face.detect_with_stream(
            image=open(r'C:/Python_apps/Face recognition/img/group1.jpeg', 'rb'),
            detection_model='detection_01',
            recognition_model='recognition_04',  
            return_face_attributes=['age', 'emotion'],
        )
        face_ids = [face.face_id for face in response_detected_faces] '''

        
        response_detected_faces = face_client.face.detect_with_stream(
            image=open(path2, 'rb'),
            detection_model='detection_03',
            recognition_model='recognition_04'    
        )
        face_ids = response_detected_faces[0].face_id

        img_source = open(img_path, 'rb')
        response_face_source = face_client.face.detect_with_stream(
            image=img_source,
            detection_model='detection_03',
            recognition_model='recognition_04'    
        )
        face_id_source = response_face_source[0].face_id
        #print('face_ids :',face_ids)
        #print('face_id_source :',face_id_source)

        ''' matched_faces = face_client.face.find_similar(
            face_id=face_id_source,
            face_ids=face_ids
        ) '''

        face_verified = face_client.face.verify_face_to_face(
            face_id1=face_id_source,
            face_id2=face_ids
        )
        #print(face_verified.is_identical)
        if face_verified.is_identical:
            print("Match Found",img_path)
            exit()
print("Match not Found")
#print('\n\n Match : ',matched_faces[0].face_id)

