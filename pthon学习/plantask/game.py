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
sqlm = 'SELECT MemberId,Time,Type,State,Money FROM cl_game'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	print zn
	for row in result:
		mid = row['MemberId']
		print mid
		t = row['Time']
		print t
		pid = row['Type']
		if (pid==6) or (pid==9):
			s = 2
		else:
			s = row['State']
		print s
		sub = getState(mid)
		print sub
		m = row['Money']*100
		print m
		sql = 'INSERT INTO cl_game_copy(MemberId,Time,PrizeId,State,Money,IsSubscribe) VALUES ('+str(mid)+','+str(t)+','+str(pid)+','+str(s)+','+str(m)+','+str(sub)+')'
		try:
			n = cur.execute(sql)
		except:
			continue	
except:
	print "Error: unable to insert data"

# 关闭数据库连接
conn.close()