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
	return r
sql = 'SELECT Id,OrderToWe,Money FROM pay_log WHERE State = 2 AND Time >= 1446652800 AND Time < 1447603200'
z = 0
y = 0
m = 0
r = 0
fe = 0
n = 0
nopay = 0
try:
	# 执行SQL语句
	zn = cur.execute(sql)
	print zn
	result = cur.fetchall()
	for row in result:
		id = row['Id']
		oid = row['OrderToWe']
		money = row['Money']
		s = curlget(oid)
		try:
			trade_state = s['trade_state']
		except:
			continue
		if trade_state == 'SUCCESS':
			y = y + 1
			m = m + money
			'''
			sql = 'UPDATE pay_log SET State = 2 where Id = '+str(id)
			n = cur.execute(sql)
			'''
		if trade_state == 'NOTPAY':
			n = n + 1
			nopay = nopay + money
			'''
			sql = 'UPDATE pay_log SET State = 1 where Id = '+str(id)
			n = cur.execute(sql)
			'''
		if trade_state == 'REFUND':
			r = r + 1
			fe = fe + money
			'''
			sql = 'UPDATE pay_log SET State = 3 where Id = '+str(id)
			n = cur.execute(sql)
			'''
		z += 1
		baifen = (z * 100) / zn
		rrr = 'jinDu: ' + str(z) + '/' + str(zn) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(id) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if z == zn:
			print 'All Ok!!!'
	print y
	print m
	print r
	print fe
	print n
	print nopay
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()