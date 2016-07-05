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
OpenID = 'JH81f8c5a2e5b2ff903b8b984665560d2b'
key = 'b2184bc697a38ff39d560097672670cf'
def curlget(no):
	"查充值聚合接口状态值改变更新"
	url = 'http://weixin.clejw.com/we_chat_auth/pay/order_query_search.php?out_trade_no='+str(no)
	r = json.loads(urllib.urlopen(url).read())
	#print r
	try:
		s = r['out_trade_no']
		if s == no:
			if r['trade_state'] =='SUCCESS':
				return 1
			else:
				return 0
	except:
		return 0
	
key = 'b2184bc697a38ff39d560097672670cf'
def curloilget(orderid,key):
	"查充值聚合接口状态值改变更新"
	url = 'http://op.juhe.cn/ofpay/sinopec/ordersta?key='+key+'&orderid='+orderid
	r = json.loads(urllib.urlopen(url).read())
	#s = json.dumps(r, ensure_ascii=False)
	try:
		e = r['error_code']
		print e
		if e =='0':
			s =  r['result']['game_state']
		elif e > 200000:
			s = '9'
		
		return s
	except:
		return ''	
sql = 'SELECT Id,SellerOrderId,MemberId,Money,Time FROM oil_charge_recode where  Money > 0 AND State = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sql)
	result = cur.fetchall()
	array = []
	y = 0
	for row in result:
		id = row['Id']
		oid = 'a' +str(id)
		sid = row['SellerOrderId']
		mid = row['MemberId']
		m = row['Money']
		t = row['Time']
		s = curlget(oid)
		if s > 0:
			y = y + 1
			array.append(id)
			sql = 'SELECT Id FROM pay_log where OrderToWe ="'+oid+'"'
			n = cur.execute(sql)
			print n
			cun = 0
			no = 0
			if n > 0:
				print '1234'
				juhe = curloilget(sid,key)
				print juhe
				cun = cun + 1
				if juhe =='0':
					sql = 'UPDATE oil_charge_recode SET State = 2 where Id = '+str(id)
					n = cur.execute(sql)
				if juhe =='1':
					sql = 'UPDATE oil_charge_recode SET State = 3 where Id = '+str(id)
					n = cur.execute(sql)
				if juhe =='9':
					sql = 'UPDATE oil_charge_recode SET State = 4 where Id = '+str(id)
					n = cur.execute(sql)
				if juhe =='':
					sql = 'UPDATE oil_charge_recode SET State = 4 where Id = '+str(id)
					n = cur.execute(sql)
				
			else:
				
				sql = 'INSERT INTO pay_log(MemberId,Money,Type,OrderId,OrderToWe,PayType,Time,State,IsSubscribe) VALUES ('+str(mid)+','+str(m)+',2,'+str(id)+',"'+oid+'",1,'+str(t)+',2,1)'
				n = cur.execute(sql)
				juhe = curloilget(sid,key)
				print juhe
				if juhe =='0':
					sql = 'UPDATE oil_charge_recode SET State = 2 where Id = '+str(id)
					n = cur.execute(sql)
				if juhe =='1':
					sql = 'UPDATE oil_charge_recode SET State = 3 where Id = '+str(id)
					n = cur.execute(sql)
				if juhe =='9':
					sql = 'UPDATE oil_charge_recode SET State = 4 where Id = '+str(id)
					n = cur.execute(sql)
					print n
				if juhe =='':
					sql = 'UPDATE oil_charge_recode SET State = 4 where Id = '+str(id)
					n = cur.execute(sql)
				
				
		
		
	print y
	print array
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()