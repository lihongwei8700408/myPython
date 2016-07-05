#!/usr/lib64/python2.6
#coding=utf-8
#红包加油卡计划任务

import MySQLdb
import time
import datetime
import math
import pycurl
import urllib2
import urllib
import StringIO
import json
import sys

try:
	conn=MySQLdb.connect(host='10.251.195.45',user='web',passwd='CLwebFWQ2015nKS',db='activity_new',port=43306,charset='utf8')
	#conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='axtivity_new',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))


sqlm = 'SELECT Id FROM cl_member where State = 1'
y = 0

# 执行SQL语句
AllNum = cur.execute(sqlm)
result = cur.fetchall()
print AllNum
for row in result:
	mid = row['Id']
	sql = 'SELECT SUM(Money) as count FROM oil_in where MemberId = '+str(mid)+' AND (Type = 1 OR Type = 3 OR Type = 5)'
	n1 = cur.execute(sql)
	r = cur.fetchone()
	profit = r['count']
	if profit == None:
		profit = 0
	try:
		sql = 'UPDATE cl_member SET AllProfit = '+str(profit)+' where Id = '+str(mid)
		n2 = cur.execute(sql)
	except:
		print 'error update'
	y += 1
	baifen = (y * 100) / AllNum
	rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(mid) + '\r'
	sys.stdout.write(rrr)
	sys.stdout.flush()
	if y == AllNum:
		print 'All Ok!!!'


# 关闭数据库连接
conn.close()