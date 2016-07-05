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
def curlget(key,page):
	"查充值聚合接口状态值改变更新"
	url = 'http://op.juhe.cn/ofpay/sinopec/orderlist?key='+key+'&&page='+str(page)+'&&pagesize=100&&starttime=2015-10-31 00:00:00&&endtime=2015-11-22 00:00:00'
	r = json.loads(urllib.urlopen(url).read())
	r =  r['result']['data']
	for val in r:
		crash = val['uordercash']
		state = val['game_state']
		sid = val['sporder_id']
		oid = val['uorderid']
		cname = val['cardname']
		t = val['addtime']
		cnum = val['cardnum']
		cid = val['cardid']
		oilcard = val['game_userid']
		timeArray = time.strptime(t, "%Y-%m-%d %H:%M:%S")
		t = int(time.mktime(timeArray))
		sql = 'INSERT INTO juhe_order(OrderId,SporderId,OilCard,CardNum,Crash,CardName,State,Time) VALUES ("'+oid+'","'+sid+'","'+oilcard+'",'+str(cnum)+',"'+crash+'","'+cname+'",'+str(state)+','+str(t)+')'
		n = cur.execute(sql)
	
for i in range(1,68):
	print i
	try:
		curlget(key,i)
	except:
		continue
	
# 关闭数据库连接
conn.close()