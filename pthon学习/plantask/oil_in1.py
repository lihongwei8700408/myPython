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
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='oilactivity',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))
def getState(mid):
	sql = 'SELECT State FROM cl_member where MemberId='+str(mid)
	try:
		n = cur.execute(sql)
		r = cur.fetchone()
		s = r['State']
		return s
	except:
		return ''
sqlm = 'SELECT MemberId,OilBagTime FROM cl_member  where IsHaveOil = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	print zn
	for row in result:
		id = row['MemberId']
		print id
		t = row['OilBagTime']
		print t
		sub = getState(id)
		print sub
		sql = 'INSERT INTO oil_in(MemberId,AddTime,Money,Type,RelationId,IsSubscribe) VALUES ('+str(id)+','+str(t)+',600,2,0,'+str(sub)+')'
		try:
			n = cur.execute(sql)
		except:
			continue	
except:
	print "Error: unable to insert data"

# 关闭数据库连接
conn.close()