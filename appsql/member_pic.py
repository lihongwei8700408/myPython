#!/usr/lib64/python2.6
#coding=utf-8
#app shop_logo

import MySQLdb
import time
import datetime
import sys
import urllib2
import urllib

def grabpic(url,savePath,file):
	#参数检查，现忽略 
	try: 
		urlopen=urllib.URLopener() 
		fp = urlopen.open(url) 
		data = fp.read()
		fp.close() 
		file=open(savePath + file,'w+b')
		file.write(data) 
		file.close() 
	except IOError, error: 
		print "DOWNLOAD %s ERROR!==>>%s" % (url, error) 
	except Exception, e: 
		print "Exception==>>" + e
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,app_head_img FROM cl_member where app_head_img!=""'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		head_img = row['app_head_img']
		savePath = '/var/www/html/pic/head_img/'
		file = str(row['id']) + '.jpg'
		if head_img!='':
			try:grabpic(head_img,savePath,file)
			except:continue
		imgdate = 'head_img/' + file
		sql = 'UPDATE cl_member SET app_head_img="'+imgdate+'" where id='+str(id)
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(id) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()