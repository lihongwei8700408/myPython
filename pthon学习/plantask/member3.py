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
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))


sqlm = 'SELECT Id,State FROM cl_member'

# 执行SQL语句
AllNum = cur.execute(sqlm)
result = cur.fetchall()
print AllNum
y = 0
for row in result:
	mid = row['Id']
	new = row['State']
	sql = 'UPDATE oil_in SET IsSubscribe = '+str(new)+' where MemberId = '+str(mid)+' and Type=1'
	n2 = cur.execute(sql)

	y += 1
	baifen = (y * 100) / AllNum
	rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(mid) + '\r'
	sys.stdout.write(rrr)
	sys.stdout.flush()
	if y == AllNum:
		print 'All Ok!!!'


# 关闭数据库连接
conn.close()