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
def curlget(d):
	"查微信现金订单"
	url = 'http://weixin.clejw.com/we_chat_auth/pay/download_bill_query.php?bill_date='+str(d)
	r = urllib.urlopen(url).read()
	r = json.loads(urllib.urlopen(url).read())
	return r
	#print r

#date = ['20151101','20151102','20151103','20151104','20151105','20151106','20151107','20151108','20151109','20151110','20151111']
date = ['20151122']
try:
	#file_object = open('data.txt', 'w')
	file_object = open('2015-11-22.txt', 'a')
	for val in date:
		r = curlget(val)
		r = r.encode('UTF-8')
		file_object.write(r)
	file_object.close()
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()