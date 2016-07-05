#!/usr/lib64/python2.6
#coding=utf-8
#红包加油卡计划任务

import MySQLdb
import time
import datetime
import pycurl
import urllib2
import urllib
import StringIO
import json
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='oilactivity_new',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))

sqlm = 'SELECT MemberId,Integral FROM cl_member  where Integral > 0'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	for row in result:
		id = row['MemberId']
		print id
		t = time.time()
		t = int(t)
		print t
		money = row['Integral']
		print money
		b = float(money) * 100 * (0.15) / 365
		if b < 1:
			b = 1
		print b
		b = int(b)
		print b
		j = round(float(b)/100,2)
		print j
		
		sql = 'INSERT INTO oil_in(MemberId,AddTime,Money,Type) VALUES ('+str(id)+','+str(t)+','+str(b)+',1)'
		try:
			n = cur.execute(sql)
		except:
			continue
		sql = 'UPDATE cl_member SET Integral = Integral - '+str(j)+' where MemberId = '+str(id)
		try:
			n = cur.execute(sql)
		except:
			continue
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()