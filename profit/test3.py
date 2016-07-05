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
	print r
	#s = json.dumps(r, ensure_ascii=False)
	try:
		s =  r['result']['game_state']
		return s
	except:
		return ''
orderid = '18693cl1446692538'
curlget(orderid,key)
exit()
sqlm = 'SELECT SUM(Price) as count FROM oil_charge_recode where State = 3 AND Time > 1447689600 '
y = 0
n = 0
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	
	r = cur.fetchone()
	print r
	exit()
	'''
	for row in result:
		id = row['Id']
		try:
			oid = row['SellerOrderId']
		except:
			continue
		price = row['Price']
		jifen = row['OilMoney']
		mid = row['MemberId']
		state = curlget(oid,key)
		n = n + 1
		if price > jifen:
			y = y + 1
			print id
			
		
		
		
		if state =='1':
			sql = 'UPDATE oil_charge_recode SET State = 3 where Id = '+str(id)
			n = cur.execute(sql)
			print n
			if n == 0:
				continue
			if n == 1:
				zheng = zheng + 1
		if state =='9':
			cuo = cuo + 1
			if price > jifen:
				sql = 'UPDATE oil_charge_recode SET State = 4 where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
				if n == 1:
					qian = qian + 1
			else:
				sql = 'UPDATE oil_charge_recode SET State = 5 where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
				if n == 1:
					j = j + 1
			
		'''	
	
	
	
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()