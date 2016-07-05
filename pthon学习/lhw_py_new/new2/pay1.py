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
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='beifen',port=3306,charset='utf8')
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
	#s = json.dumps(r, ensure_ascii=False)
	try:
		s =  r['result']['game_state']
		print  r['result']['sporder_id']
		return s
	except:
		return ''

sqlm = 'SELECT Id,Price,UsePoint,SellerOrderId,MemberId FROM cl_oil_order where OilPayState = 0 AND OrderState = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	print zn
	result = cur.fetchall()
	jishu = 0
	zheng = 0
	cuo = 0
	qian = 0
	j = 0
	for row in result:
		id = row['Id']
		jishu = jishu + 1
		print id
		oid = row['SellerOrderId']
		print oid
		price = row['Price']
		jifen = row['UsePoint']
		c = price-jifen
		mid = row['MemberId']
		state = curlget(oid,key)
		print state
		if state =='1':
			sql = 'UPDATE cl_oil_order SET OilPayState = 3 ,OrderState = 2 where Id = '+str(id)
			n = cur.execute(sql)
			print n
			if n == 0:
				continue
			if n == 1:
				zheng = zheng + 1
		if state =='9':
			cuo = cuo + 1
			if price > jifen:
				sql = 'UPDATE cl_oil_order SET OilPayState = 2 ,OrderState = 5 where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
				if n == 1:
					qian = qian + 1
			else:
				sql = 'UPDATE cl_oil_order SET OilPayState = 2 ,OrderState = 4 where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
				if n == 1:
					j = j + 1
			
			
	print jishu
	print zheng
	print cuo
	print qian
	print j
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()