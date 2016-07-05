#!/usr/lib64/python2.6
#coding=utf-8
#app ser_order_sub 替换service_id

import MySQLdb
import time
import datetime
import sys

def ishave(good_id):
	sql = 'SELECT id FROM ser_service where source_id ='+str(good_id)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['id']
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,service_id FROM ser_order_sub'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	error = []
	for row in result:
		id = row['id']
		service_id = row['service_id']
		if service_id==0:
			y += 1
			continue
		have = ishave(service_id)
		if have==0:
			y += 1
			continue
		sql = 'UPDATE ser_order_sub SET service_id='+str(have)+' where id = '+str(id)
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(id) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
	print error
except:
	print "Error: xx_member"

# 关闭数据库连接
conn.close()