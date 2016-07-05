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
sqlm = 'SELECT Id,MemberId,OrderId,SellerOrderId,Price,OrderState,OilPayState,UsePoint,LastTime,OilCard,JuHeOrder,IsDelete FROM cl_oil_order'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	print zn
	for row in result:
		mid = row['MemberId']
		t = row['LastTime']
		id = row['Id']
		iod = row['OrderId']
		sub = getState(mid)
		price = row['Price']*100
		oilmoney = row['UsePoint']*100
		oilcard = row['OilCard']
		sid = row['SellerOrderId']
		state1 = row['OrderState']
		state2 = row['OilPayState']
		state = 1
		if (state1==2) and (state2==3):
			state = 3
		if (state1==5) and (state2==2):
			state = 4
		if (state1==4) and (state2==2):
			state = 5
		print state
		d = row['IsDelete']
		jk = row['JuHeOrder']
		m = price - oilmoney
		sql = 'INSERT INTO oil_charge_recode(Id,MemberId,Time,Price,OilMoney,Money,OilCard,SellerOrderId,State,IsDelete,JkOrderId,JkType,IsSubscribe) VALUES ('+str(id)+','+str(mid)+','+str(t)+','+str(price)+','+str(oilmoney)+','+str(m)+',"'+oilcard+'","'+sid+'",'+str(state)+','+str(d)+',"'+jk+'",1,'+str(sub)+')'
		try:
			print sql
			n = cur.execute(sql)
		except:
			continue
		
except:
	print "Error: unable to insert data"

# 关闭数据库连接
conn.close()