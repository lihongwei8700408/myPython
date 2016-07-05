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
	#conn=MySQLdb.connect(host='10.251.195.45',user='web',passwd='CLwebFWQ2015nKS',db='activity_new',port=43306,charset='utf8')
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='axtivity_new',port=3306,charset='utf8')
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
sql = 'SELECT Id,OrderId FROM oil_out'
y = 0
d = 0
try:
	# 执行SQL语句
	zn = cur.execute(sql)
	print zn
	result = cur.fetchall()
	for row in result:
		id = row['Id']
		oid = row['OrderId']
		sql = 'SELECT State FROM oil_charge_recode where Id = '+str(oid)
		n = cur.execute(sql)
		r = cur.fetchone()
		if r['State'] == 5:
			y = y + 1
			'''
			sql = 'DELETE FROM oil_out where Id = '+str(id)
			n = cur.execute(sql)
			if n > 0:
				d = d + 1
			'''
	print y	
	print d
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()