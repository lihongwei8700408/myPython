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
OpenID = 'JH81f8c5a2e5b2ff903b8b984665560d2b'
key = 'b2184bc697a38ff39d560097672670cf'
def curlget(orderid,key):
	"查充值聚合接口状态值改变更新"
	url = 'http://op.juhe.cn/ofpay/sinopec/ordersta?key='+key+'&orderid='+orderid
	r = json.loads(urllib.urlopen(url).read())
	try:
		s =  r['result']['game_state']
		print s
		return s
	except:
		s = r['error_code']
		return s

sqlm = 'SELECT Id,Price,OilMoney,SellerOrderId,MemberId FROM oil_charge_recode where Id = 21734'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	#print zn
	result = cur.fetchall()
	n = 0
	array = []
	for row in result:
		id = row['Id']
		oid = row['SellerOrderId']
		if oid == '':
			continue
		price = row['Price']
		jifen = row['OilMoney']
		mid = row['MemberId']
		array.append(mid)
		state = curlget(oid,key)
		if state =='1':
			n +=1
			
	#print n	
	#print array
	array = list(set(array))
	for val in array:
		sql = 'SELECT SUM(Money) as count FROM oil_in where MemberId = '+str(val) 
		n1 = cur.execute(sql)
		r = cur.fetchone()
		come = r['count']
		sql = 'SELECT SUM(OilMoney) as count FROM oil_charge_recode where MemberId = '+str(val)+' AND (State = 3 OR State = 4)'
		n1 = cur.execute(sql)
		r = cur.fetchone()
		out = r['count']
		print come
		print out
		oilmoney = come - out
		if oilmoney < 0:
			oilmoney = 0
			print val
		
		sql = 'UPDATE cl_member SET AllIncome = '+str(come)+',AllOut = '+str(out)+',OilMoney = '+str(oilmoney)+' where Id = '+str(val)
		n2 = cur.execute(sql)
		print n2
		exit()
		#sys.stdout = open("stdout.txt", "w")

		
		
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()