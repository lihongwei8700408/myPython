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
html = StringIO.StringIO()
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='oilactivity',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sqlm = 'SELECT MemberId FROM cl_member where IsHaveOil = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	#print zn
	result = cur.fetchall()
	num = 0
	for row in result:
		total = 0
		smoney = 0
		lmoney = 0
		jmoney = 0
		omoney = 0
		mid = row['MemberId']
		oilmoney = 6.00
		sql = 'SELECT COUNT(Id) as count FROM cl_sharemoney_record where MemberId = '+str(mid)
		n = cur.execute(sql)
		if n > 0:
			r = cur.fetchone()
			if r['count'] > 0:
				smoney = r['count'] * 2.9
		sql = 'SELECT SUM(Money) as count FROM cl_money_benefit where MemberId = '+str(mid)
		n = cur.execute(sql)
		if n > 0:
			r = cur.fetchone()
			if r['count'] > 0:
				lmoney = r['count']
		sql = 'SELECT COUNT(Id) as count FROM cl_game where MemberId = '+str(mid)+' AND Type = 9'
		n = cur.execute(sql)
		if n > 0:
			r = cur.fetchone()
			if r['count'] > 0:
				jmoney = r['count'] * 3
		total = oilmoney + smoney + float(lmoney) + jmoney
		#print total
		#减掉的钱
		sql = 'SELECT SUM(UsePoint) as jifen FROM cl_oil_order where MemberId = '+str(mid)+' AND (OilPayState=3 OR OilPayState=1 OR (OilPayState=2 AND OrderState=5))'
		n = cur.execute(sql)
		if n > 0:
			r = cur.fetchone()
			if r['jifen'] > 0:
				omoney = r['jifen']
		#print omoney
		money = float(total) - float(omoney)
		#print money
		print mid
		sql = 'UPDATE cl_member SET Integral = '+str(money)+' where MemberId = '+str(mid)
		n = cur.execute(sql)
		
		if n == 0:
			print 'OK'
			num = num + 1
		else:
			continue
		
		
	print num
	
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()