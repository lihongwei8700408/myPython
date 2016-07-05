#!/usr/lib64/python2.6
#coding=utf-8
#app ser_shop_sub 表图片

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
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='147258369',db='dump_shop',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,shop_id,legal_id_card_pic,business_pic FROM ser_shop_sub where legal_id_card_pic!="" or business_pic!=""'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		shop_id = row['shop_id']
		card_pic = row['legal_id_card_pic']
		business_pic = row['business_pic']
		savePath = '/var/www/html/pic/service_idcard/'
		savePaths = '/var/www/html/pic/service_business/'
		file = str(row['shop_id']) + '.jpg'
		if card_pic!='':
			grabpic(card_pic,savePath,file)
		if business_pic!='':
			grabpic(business_pic,savePaths,file)
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