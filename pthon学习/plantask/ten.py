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
		return s
	except:
		return ''

sqlm = 'SELECT Id,Price,UsePoint,SellerOrderId,MemberId FROM cl_oil_order where OilPayState = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	print zn
	result = cur.fetchall()
	for row in result:
		id = row['Id']
		print id
		oid = row['SellerOrderId']
		print oid
		price = row['Price']
		jifen = row['UsePoint']
		c = price-jifen
		print c
		mid = row['MemberId']
		state = curlget(oid,key)
		if state == '1':
			sql = 'UPDATE cl_oil_order SET OilPayState = 3 ,OrderState = 2 where Id = '+str(id)
			n = cur.execute(sql)
			print n
			if n == 0:
				continue
		if state == '9':
			if price > jifen:
				sql = 'UPDATE cl_oil_order SET OilPayState = 2 ,OrderState = 5 where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
			else:
				sql = 'UPDATE cl_oil_order SET OilPayState = 2 ,OrderState = 4 where Id = '+str(id)
				n = cur.execute(sql)
				sql1 = 'UPDATE cl_member SET Integral = Integral + '+str(jifen)+' where MemberId = '+str(mid)
				n = cur.execute(sql1)
				if n == 0:
					continue
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()