import cv2, os, sys
import numpy as np
import xml.etree.ElementTree as ET

anno_path = './temp_annotation'

fname = sys.argv[1]

img = cv2.imread(fname)

img_name = os.path.basename(fname)
img_id = os.path.splitext(img_name)[0]

anno_fname = os.path.join(anno_path, '{0}.xml'.format(img_id))

tree = ET.parse(anno_fname)
root = tree.getroot()
objs = root.findall('object')

for obj in objs:
    bndbox = obj.find('bndbox')
    xmin = bndbox.find('xmin').text
    ymin = bndbox.find('ymin').text
    width = bndbox.find('width').text
    height = bndbox.find('height').text
    angle = bndbox.find('angle').text
    bb = [int(x) for x in [xmin, ymin, width, height, angle]]
    label = obj.find('name').text
    truncated_node = obj.find('truncated')
    if truncated_node:
        truncated = truncated_node.text
    else:
        truncated = "unknown"

    rect = ((bb[0], bb[1]),  (bb[2], bb[3]), 360-bb[4])
    box = cv2.cv.BoxPoints(rect)
    box = np.int0(box)
    cv2.drawContours(img,[box],0,(0,0,255),2)

cv2.imshow('img', img)
cv2.waitKey(0)
