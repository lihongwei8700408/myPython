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

def curlpost(acess,openid):
	url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='+acess
	data = '{"touser":"'+str(openid)+'","msgtype":"news","news":{"articles":[{"title":"加油送券，储油补贴！","description":"","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1e3b3a3f6aab0ebf&redirect_uri=http://weixin.clejw.com/we_chat_auth/fans_info.php&response_type=code&scope=snsapi_userinfo&state=B1002B1001#wechat_redirect","picurl":"http://weixin.clejw.com/activitys/oil_subsidy/html/images/red_open_big.jpg"},{"title":"开心转盘,每天都有机会！","description":"","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1e3b3a3f6aab0ebf&redirect_uri=http://weixin.clejw.com/we_chat_auth/fans_info.php&response_type=code&scope=snsapi_userinfo&state=B1002B1002#wechat_redirect","picurl":"http://weixin.clejw.com/activitys/oil_subsidy/html/images/turntable.jpg"},{"title":"油卡充值,真方便！","description":"","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1e3b3a3f6aab0ebf&redirect_uri=http://weixin.clejw.com/we_chat_auth/fans_info.php&response_type=code&scope=snsapi_userinfo&state=B1002B1003#wechat_redirect","picurl":"http://weixin.clejw.com/activitys/oil_subsidy/html/images/oil.jpg"},{"title":"储油有补贴了！","description":"","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1e3b3a3f6aab0ebf&redirect_uri=http://weixin.clejw.com/we_chat_auth/fans_info.php&response_type=code&scope=snsapi_userinfo&state=B1002B1006#wechat_redirect","picurl":"http://weixin.clejw.com/activitys/oil_subsidy/html/images/chuyou.jpg"}]}}'	
	urllib2.urlopen(url, data)
	
acess = '_i9hsQyF5vg54sPn7ISXpEYDczKVw4fVhmluOCcEjbxXXudh05DnIyHJ8O3Jwj_0Iis4wQSaIufmnBmsaoFz-I4sCDAZPPltfyJdAt9FsHQNOXgAFAYZI'
sql = 'SELECT Id,OpenId FROM cl_member where State = 1  ORDER BY Id ASC LIMIT 70001,30000'
y = 0
AllNum = cur.execute(sql)
result = cur.fetchall()
print AllNum
for row in result:
	mid = row['Id']
	oid = row['OpenId']
	try:
		curlpost(acess,oid)
	except:
		continue
	y += 1
	baifen = (y * 100) / AllNum
	rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(mid) + '\r'
	sys.stdout.write(rrr)
	sys.stdout.flush()
	if y == AllNum:
		print 'All Ok!!!'
	
# 关闭数据库连接
conn.close()