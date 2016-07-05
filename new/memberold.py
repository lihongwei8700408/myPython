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
	#conn=MySQLdb.connect(host='10.251.195.45',user='web',passwd='CLwebFWQ2015nKS',db='activity_new',port=43306,charset='utf8')
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='axtivity_new',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()

def curlget(acess,next):
	"查微信粉丝接口状态值改变更新"
	first = 'oC1U4tzCJABvVsmiIbljV2ds-2Tw'
	url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='+acess+'&next_openid='+next
	r = json.loads(urllib.urlopen(url).read())
	next1 = r['next_openid']
	print next1
	openid =  r['data']['openid']
	for val in openid:	
		sql = 'INSERT INTO cl_fans(OpenId) VALUES ("'+val+'")'
		try:
			n = cur.execute(sql)
		except:
			print "Error: unable to insert data"
	if next1!='oC1U4t_HMvH0qqNBYFuHK2FCSR1Q':
		curlget(acess,next1)
	else:
		print 111
def updatemember(mid,strs,state):
	"更新会员边状态及更新各交易表状态"
	sql = 'UPDATE cl_member SET '+strs+' where Id = '+str(mid)
	try:
		n = cur.execute(sql)
		sql1 = 'UPDATE cl_game SET IsSubscribe = '+str(state)+' where MemberId = '+str(mid)
		n1 = cur.execute(sql1)
		sql2 = 'UPDATE oil_charge_recode SET IsSubscribe = '+str(state)+' where MemberId = '+str(mid)
		n2 = cur.execute(sql2)
		sql3 = 'UPDATE oil_in SET IsSubscribe = '+str(state)+' where MemberId = '+str(mid)
		n3 = cur.execute(sql3)
		sql4 = 'UPDATE oil_out SET IsSubscribe = '+str(state)+' where MemberId = '+str(mid)
		n4 = cur.execute(sql4)
		sql5 = 'UPDATE pay_log SET IsSubscribe = '+str(state)+' where MemberId = '+str(mid)
		n5 = cur.execute(sql5)
	except:
			print "error"
		
acess = 'nyorpe60Qr0XB0lJZwZzz5-Z_9ROWyHdnUOx4kKnXA83AnwBAAoJZdhZEZ4N5KoE3ZPr_M2nK2GfNKvmSo7JT9koUOWsJFpwgi9aKCCBb1kFUXiAIATIL'
next = ''
curlget(acess,next)
'''
#循环会员表
sql = 'SELECT Id,OpenId FROM cl_member'
y = 0
try:
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		mid = row['Id']
		oid = row['OpenId']
		sql = 'SELECT Id  FROM cl_fans where OpenId="'+oid+'"'
		n = cur.execute(sql)
		if n > 0:
			state = 1
			strs = 'State = 1'
		else:
			state = 2
			strs = 'State = 2,OilMoney=0,AllProfit=0,AllIncome=0,AllOut=0'
		updatemember(mid,strs,state)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(mid) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
except:
	print "error"

'''
# 关闭数据库连接
conn.close()