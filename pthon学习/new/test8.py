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
	return r
sql = 'SELECT * FROM cl_member where  OpenId = "oC1U4t1R2kqNxJhFELuHUFE8Tne8"'
n = cur.execute(sql)
r = cur.fetchone()
print r
# 关闭数据库连接
conn.close()