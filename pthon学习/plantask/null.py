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
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))


sqlm = 'SELECT Id,AllIncome,AllOut FROM cl_member where OilMoney=0'
# 执行SQL语句
AllNum = cur.execute(sqlm)
result = cur.fetchall()
print AllNum
y = 0
for row in result:
	mid = row['Id']
	allincome = row['AllIncome']
	allout = row['AllOut']
	money = row['AllIncome'] - row['AllOut']
	print money
	if money > 0:
		y = y + 1
	
	'''
	sql = 'UPDATE cl_member SET OilMoney = '+str(money)+' where MemberId = '+str(mid)
	try:
		n = cur.execute(sql)
		print 'ok'
	except:
		print mid
		print 'error'
	'''
print y


# 关闭数据库连接
conn.close()