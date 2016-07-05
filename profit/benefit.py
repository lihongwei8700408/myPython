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
def getState(mid):
	sql = 'SELECT State FROM cl_member where Id='+str(mid)
	try:
		n = cur.execute(sql)
		r = cur.fetchone()
		s = r['State']
		return s
	except:
		return ''
sqlm = 'SELECT Id,OilMoney FROM cl_member  where OilMoney > 0'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	for row in result:
		id = row['Id']
		print id
		t = time.time()
		t = int(t)
		print t
		money = row['OilMoney']
		print money
		b = float(money) * (0.15) / 365
		if b < 1:
			b = 1
		print b
		b = int(b)
		print b
		sub = getState(id)
		print sub
		sql = 'INSERT INTO oil_in(MemberId,AddTime,Money,Type,IsSubscribe) VALUES ('+str(id)+','+str(t)+','+str(b)+',1,'+str(sub)+')'
		try:
			n = cur.execute(sql)
		except:
			continue
		sql = 'UPDATE cl_member SET OilMoney = OilMoney + '+str(b)+',AllProfit = AllProfit + '+str(b)+',AllIncome = AllIncome + '+str(b)+'  where Id = '+str(id)
		try:
			n = cur.execute(sql)
		except:
			continue
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()