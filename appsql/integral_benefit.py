#!/usr/lib64/python2.6
#coding=utf-8
#app积分天天涨

import MySQLdb
import time
import datetime
import pycurl
import urllib2
import urllib
import StringIO
import json
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))

sqlm = 'SELECT id,integral FROM cl_member  where integral > 0'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		t = z
		integral = row['integral']
		b = float(integral) * (0.15) / 365
		if b < 1:
			b = 1
		b = int(b)
		sql = 'INSERT INTO cl_integral_record(member_id,time,integral,type,use_way,total) VALUES ('+str(id)+','+str(t)+','+str(b)+',5,"积分天天涨",'+str(b)+')'
		try:
			n = cur.execute(sql)
		except:
			continue
		sql = 'UPDATE cl_member SET integral = integral + '+str(b)+' where id = '+str(id)
		try:
			n = cur.execute(sql)
		except:
			continue
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()