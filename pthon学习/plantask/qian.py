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
def getState(mid):
	sql = 'SELECT State FROM cl_member where MemberId='+str(mid)
	try:
		n = cur.execute(sql)
		r = cur.fetchone()
		s = r['State']
		return s
	except:
		return ''
sqlm = 'SELECT MemberId,MemberName,Provice,CityId,CreatTime,Sex,Tel,LoginTime,Integral,OpenId,HeadImgUrl,State,Swing,IsHaveOil,PrizeAddress,RealName,TurnTime,VerifyCode,Source,Checked FROM cl_member'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	result = cur.fetchall()
	print zn
	for row in result:
		id = row['MemberId']
		oid = row['OpenId']
		state = row['State']
		st = row['CreatTime']
		it = row['LoginTime']
		name = row['MemberName']
		realname = row['RealName']
		img = row['HeadImgUrl']
		pid = row['Provice']
		cid = row['CityId']
		address = row['PrizeAddress']
		swing = row['Swing']
		tel =  row['Tel']
		sex = row['Sex']
		code = row['VerifyCode']
		oilmoney = int(row['Integral']*100)
		lt = row['LoginTime']
		zt = row['TurnTime']
		oil = row['IsHaveOil']
		source = row['Source']
		c = row['Checked']
		print oilmoney
		sql = 'INSERT INTO cl_member_copy(Id,OpenId,State,SubscribeTime,InTime,MemberName,RealName,HeadImgUrl,ProvinceId,CityId,PrizeAddress,Swing,Tel,Sex,Code,OilMoney,AllProfit,AllIncome,AllOut,LoginTime,TurnTime,IsHaveOil,Source,Checked) VALUES ('+str(id)+',"'+oid+'",'+str(state)+','+str(st)+','+str(st)+',"'+name+'","'+realname+'","'+img+'",'+str(pid)+','+str(cid)+',"'+address+'",'+str(swing)+',"'+tel+'",'+str(sex)+',"'+code+'",'+str(oilmoney)+',0,0,0,'+str(lt)+','+str(zt)+','+str(oil)+','+str(source)+','+str(c)+')'
		sql = 'INSERT INTO cl_member_copy(Id,OpenId) VALUES ('+str(id)+',"'+oid+'")'
		#sql = 'INSERT INTO cl_member_copy(Id,OpenId,State,SubscribeTime,InTime,MemberName,RealName,HeadImgUrl,ProvinceId,CityId,PrizeAddress,Swing,Tel,Sex,Code,OilMoney,AllProfit,AllIncome,AllOut,LoginTime,TurnTime,IsHaveOil,Source,Checked) VALUES (3,"123",1,2,2,"123","123","123",12,12,"1233",1,"123",1,"1233",12,0,0,0,12,12,1,1,1)'
		print sql
		try:
			print sql
			n = cur.execute(sql)
			print n
			exit()
		except:
			print 22222	
			exit()
except:
	print "Error: unable to insert data"

# 关闭数据库连接
conn.close()