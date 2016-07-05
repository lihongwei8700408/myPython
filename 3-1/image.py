#!/usr/lib64/python2.6
#coding=utf-8
#app shop_logo

import MySQLdb
import time
import datetime
import sys
import urllib2
import urllib

import Image as image
import glob,os  
def timage():
	y=0
	for files in glob.glob('/var/www/html/pic/service_logo/logo/*.jpg'):
		filepath,filename = os.path.split(files)  
		filterame,exts = os.path.splitext(filename)   
		opfile = r'/var/www/html/pic/service_logo/logonew/'   
		if (os.path.isdir(opfile)==False):  
			os.mkdir(opfile)  
		im = image.open(files)  
		w = im.size[0]
		if w>400:
			width = 400
			ratio = float(width)/im.size[0]
			height = int(im.size[1]*ratio)
			nim = im.resize( (width, height))
			nim.save(opfile+filterame+'.jpg')
			y+=1
			print y
timage()