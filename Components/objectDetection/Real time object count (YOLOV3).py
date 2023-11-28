from flask import Flask, render_template, Response
import cv2
import numpy as np
import mysql.connector
import os
template_dir=os.path.abspath('Components/objectDetection/templatesOb')
app = Flask(__name__,template_folder=template_dir)
net=cv2.dnn.readNet(r"Components/objectDetection/yolov3.weights",r"Components/objectDetection/yolov3.cfg")
# establishing connection with database
mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="engage"
    )

# update count of product in database  
def update_count(text,label):
    if mydb.is_connected() == True:
        mycursor = mydb.cursor()     
        # print(text,label)
        # sql_update=f"UPDATE objects SET count = 0 WHERE name IN ('cell phone', 'chair', 'bottle');";
        # print(sql_update)
        #mycursor.execute(sql_update)
        sql_update= f"UPDATE objects SET count = ' {text} ' WHERE name = '{label}';";
        # print(sql_update)
        mycursor.execute(sql_update)
        mydb.commit()
    
    
    
classes=[]


with open('Components/objectDetection//coco.names','r') as f:
    classes=f.read().splitlines()


# counting object
def countobject(whole_track_list,index_of_track):
    count=0
    for p in whole_track_list:
        
            
            if(p==index_of_track):
                
                count+=1
    return count


def numOfsameIndex(whole_redundant_list,item_id):
    count1=0
    for q in whole_redundant_list:
        if(q==item_id):
            count1+=1
    return count1

#  opening camera          
cap=cv2.VideoCapture(0)    
def gen_frames():
    def videowrite(receivedsize):
        
        i=0
        x=20
        y=30
        while i<receivedsize:
            label=str(classes[redundant[i]])
            
            cv2.putText(img,label,(x,y),cv2.FONT_HERSHEY_SIMPLEX,1,(255,0,0),1)
            x+=180
            text=":{}".format(countlists[i])
            cv2.putText(img,text,(x,y),cv2.FONT_HERSHEY_SIMPLEX,1,(0,0,255),1)
            i+=1
            x=x-180
            y+=30
            update_count(text,label)
  
    while True:
        ret,img=cap.read()
        #print("ret value",ret)
        #print("frmae value",img)
        fps=cap.get(cv2.CAP_PROP_FPS)
        #print("fps:{}".format(fps))
        
        
        
        raw_height,raw_width, _ =img.shape
        blob=cv2.dnn.blobFromImage(img,1/255,(416,416),(0,0,0),swapRB=True,crop=False)
        net.setInput(blob)
        
        output_layers_names=net.getUnconnectedOutLayersNames()
        finaloutputs=net.forward(output_layers_names)
        boxes_no=[]
        confidences_score=[]
        class_ids=[]
        for outputs in finaloutputs:
            for detect in outputs:
                scores=detect[5:]
                class_id=np.argmax(scores)
                confidence=scores[class_id]
                if confidence > 0.7:
                    x_center=int(detect[0]*raw_width)
                    y_center=int(detect[1]*raw_height)
                    w=int(detect[2]*raw_width)
                    h=int(detect[3]*raw_height)
                    x=int(x_center-w/2)
                    y=int(y_center-h/2)
                    boxes_no.append([x,y,w,h])
                    confidences_score.append((float(confidence)))
                    class_ids.append(class_id)
            
        #print(len(boxes_no))   
        index=cv2.dnn.NMSBoxes(boxes_no,confidences_score,0.7,0.4)
        
        colors=np.random.uniform(0,255,size=(len(boxes_no),3))
        track=[]
        if len(index)>0: 
            
            for l in index.flatten():
                
            
                x,y,w,h=boxes_no[l]
                label=str(classes[class_ids[l]])
                #print(class_ids[i])
                track.append(class_ids[l])
                confidence=str(round(confidences_score[l],2))
                color=colors[l]
                cv2.rectangle(img,(x,y),(x+w,y+h),color,2)
                cv2.putText(img,label+" "+confidence,(x,y+10),cv2.FONT_HERSHEY_SIMPLEX,1,(255,0,255),1)
        
        redundant=[]
        countlists=[]
        size=len(track)
        i=0
        while i<size:
            redundantsize=len(redundant)
            if (redundantsize==0): 
                totalobject=countobject(track,track[i])
                # print("lenth of redundant array",redundantsize)
                # print("value",redundant)
                redundant.append(track[i])
                countlists.append(totalobject)
                i+=1
            
            else:
                rslt=numOfsameIndex(redundant,track[i])
            
                if(rslt==0):
                    totalobject=countobject(track,track[i])
                    # print("lenth of redundant array",redundantsize)
                    # print("value",redundant)
                    redundant.append(track[i])
                    countlists.append(totalobject)
                    i+=1
                else:
                    i+=1
    
        loopsize=len(countlists)
    
        videowrite(loopsize)           
        ret, img = cv2.imencode('.jpg', img)
        img = img.tobytes()
        yield (b'--img\r\n'
                b'Content-Type: image/jpeg\r\n\r\n' + img + b'\r\n')
@app.route('/')
def index():
    return render_template('indexObject.html')


@app.route('/video_feed')
def video_feed():
    return Response(gen_frames(), mimetype='multipart/x-mixed-replace; boundary=img')


if __name__ == '__main__':
    app.run(debug=True)
