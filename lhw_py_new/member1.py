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


sqlm = 'SELECT Id FROM cl_member where State = 1'
y = 0

# 执行SQL语句
AllNum = cur.execute(sqlm)
result = cur.fetchall()
print AllNum
for row in result:
	mid = row['Id']
	sql = 'SELECT SUM(Money) as count FROM oil_in where MemberId = '+str(mid)
	n1 = cur.execute(sql)
	r = cur.fetchone()
	allincome = r['count']
	if allincome == None:
		allincome = 0
		
	sql2 = 'SELECT SUM(Money) as count FROM oil_in where MemberId = '+str(mid)+' AND Type = 1'
	n2 = cur.execute(sql2)
	r2 = cur.fetchone()
	profit = r2['count']
	if profit == None:
		profit = 0
		
	sql3 = 'SELECT SUM(UsePoint) as count FROM cl_oil_order where MemberId = '+str(mid)+' AND UsePoint > 0 AND (OilPayState=3 OR OilPayState=1 OR (OilPayState=2 AND OrderState=5))'
	n3 = cur.execute(sql3)
	r3 = cur.fetchone()
	allout = r3['count']
	if allout == None:
		allout = 0
	allout = allout * 100	
	sql4 = 'SELECT COUNT(Id) as count FROM oil_bond where MemberId = '+str(mid)
	n4 = cur.execute(sql4)
	r4 = cur.fetchone()
	bondnum = r4['count']
	if bondnum == None:
		bondnum = 0
		
	sql5 = 'SELECT SUM(Money) as count FROM oil_bond where MemberId = '+str(mid)
	n5 = cur.execute(sql5)
	r5 = cur.fetchone()
	bondmoney = r5['count']
	if bondmoney == None:
		bondmoney = 0
	oilmoney = allincome - allout
	try:
		sql = 'UPDATE cl_member SET AllIncome = '+str(allincome)+',OilMoney = '+str(oilmoney)+',AllProfit = '+str(profit)+',AllOut = '+str(allout)+',BondNum = '+str(bondnum)+',BondMoney = '+str(bondmoney)+' where Id = '+str(mid)
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