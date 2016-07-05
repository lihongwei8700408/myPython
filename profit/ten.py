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
	return r
sqlm = 'SELECT Id,Price,OilMoney,SellerOrderId,MemberId FROM oil_charge_recode where State = 2'
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
		if oid == '':
			continue
		price = row['Price']
		jifen = row['OilMoney']
		mid = row['MemberId']
		res = curlget(oid,key)
		print res
		error = res['error_code']
		if error == 0:
			state = res['result']['game_state']
			sid = res['result']['sporder_id']
		else:
			state = '9'
			sid = ''
		if state == '1':
			sql = 'UPDATE oil_charge_recode SET State = 3,JkOrderId = "'+sid+'" where Id = '+str(id)
			n = cur.execute(sql)
			print n
			if n == 0:
				continue
		elif state == '9':
			if price > jifen:
				sql = 'UPDATE oil_charge_recode SET State = 4,JkOrderId = "'+sid+'" where Id = '+str(id)
				n = cur.execute(sql)
				if n == 0:
					continue
			elif price == jifen:
				sql = 'UPDATE oil_charge_recode SET State = 5,JkOrderId = "'+sid+'" where Id = '+str(id)
				n = cur.execute(sql)
				sql1 = 'UPDATE cl_member SET OilMoney = OilMoney + '+str(jifen)+', AllOut = AllOut - '+str(jifen)+' where Id = '+str(mid)
				n = cur.execute(sql1)
				if n == 0:
					continue
		
		
	
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()