from flask import Flask, render_template, Response
import face_recognition
import cv2
import numpy as np
import mysql.connector
import datetime
import glob
import os
app = Flask(__name__)


# Function to push image of unknown person into dp


def push_to_db(image):
    # establishing connection
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="engage"
    )
    if mydb.is_connected() == True:
        mycursor = mydb.cursor()
        # print("Inserting BLOB into facerecog table")
        sql_insert_blob_query = f"INSERT INTO facerecog (name,budget_slab,contact_number,email,premium_products,average_product,image,additional) VALUES ('-','-','-','-','-','-','{image}','-')"
        mycursor.execute(sql_insert_blob_query)
        mydb.commit()
    if mydb.is_connected():
        mydb.close()

# To get updated value every time code restart


def get_var_value(filename="Components/face_recognition/varstore.dat"):
    with open(filename, "a+") as f:
        f.seek(0)
        val = int(f.read() or 0) + 1
        f.seek(0)
        f.truncate()
        f.write(str(val))
        return val


# start camera
camera = cv2.VideoCapture(0)

# To find encodings and recognise the person


def rest_encoding():
    known_face_encodings = []
    known_face_names = []
    for image in glob.glob("Components/face_recognition/images/*.jpg"):
        # printing serial number of customer
        name = "Customer"+image.split(".")[0].split("\\")[1].split("_")[2]
        img_read = face_recognition.load_image_file(f"{image}")
        face_code = face_recognition.face_encodings(img_read)[0]
        known_face_encodings.append(face_code)
        known_face_names.append(name)
    return known_face_encodings, known_face_names
    

# to post serial number


def find_serialNo(best_match_index):
    save_path = 'Components/face_recognition'
    file_name = "id.txt"
    completeName = os.path.join(save_path, file_name)
    file1 = open(completeName, "w")
    file1.write(str(best_match_index))
    file1.close()

# Initializing some variables


face_locations = []
face_encodings = []
face_names = []
process_this_frame = True


def gen_frames():

    startTime = None
    known_face_encodings, known_face_names = rest_encoding()
    while True:
        success, frame = camera.read()  # read the camera frame
        if not success:
            break
        else:
            # Resize frame of video to 1/4 size for faster face recognition processing

            small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)

            # Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
            rgb_small_frame = small_frame[:, :, ::-1]

            # Find all the faces and face encodings in the current frame of video
            face_locations = face_recognition.face_locations(rgb_small_frame)
            face_encodings = face_recognition.face_encodings(
                rgb_small_frame, face_locations)
            face_names = []
            for face_encoding in face_encodings:

                # See if the face is a match for the known face(s)

                matches = face_recognition.compare_faces(
                    known_face_encodings, face_encoding, tolerance=0.6)

                name = "Unknown"

                # Or instead, use the known face with the smallest distance to the new face
                face_distances = face_recognition.face_distance(
                    known_face_encodings, face_encoding)

                best_match_index = np.argmin(face_distances)

                if matches[best_match_index]: # if face is "known"
                    name = known_face_names[best_match_index]
                    # print(best_match_index)
                    find_serialNo(best_match_index)
                else:  # if face is unknown
                    name = "unknown"
                    if(name == "unknown"):
                        if startTime == None:
                            startTime = datetime.datetime.now()
                        # if camera is recognising "unknown customer" for fore than 6 seconds
                        if(int((datetime.datetime.now()-startTime).total_seconds()) > 6):
                            if(name == "unknown"):
                                _, frame = camera.read()
                                i = get_var_value()
                                # print("clicking picture")
                                # print(i)
                                new_image = f'Components/face_recognition/images/saved_img_{str(i)}.jpg'
                                cv2.imwrite(filename=new_image, img=frame)
                                 #print('/' + new_image)
                                #pushing image to database of unknown customer
                                push_to_db('/'+new_image)

                                #identifying new customer
                                known_face_encodings, known_face_names = rest_encoding() 
                                
                                startTime = None
                                cv2.waitKey(1650)

                face_names.append(name)

            # Display the results
            for (top, right, bottom, left), name in zip(face_locations, face_names):
                # Scale back up face locations since the frame we detected in was scaled to 1/4 size
                top *= 4
                right *= 4
                bottom *= 4
                left *= 4

                # Draw a box around the face
                cv2.rectangle(frame, (left, top),
                              (right, bottom), (0, 0, 255), 2)

                # Draw a label with a name below the face
                cv2.rectangle(frame, (left, bottom - 35),
                              (right, bottom), (0, 0, 255), cv2.FILLED)
                font = cv2.FONT_HERSHEY_DUPLEX
                cv2.putText(frame, name, (left + 6, bottom - 6),
                            font, 1.0, (255, 255, 255), 1)

            ret, buffer = cv2.imencode('.jpg', frame)
            frame = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')


@app.route('/')
def index():
    return render_template('index.html')


@app.route('/video_feed')
def video_feed():
    return Response(gen_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')


if __name__ == '__main__':
    app.run(debug=True)
