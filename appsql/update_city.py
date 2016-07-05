#!/usr/lib64/python2.6
#coding=utf-8
#app ser_service 替换shop_id

import MySQLdb
import time
import datetime
import sys

def province(id):
	sql = 'SELECT id FROM citys where SourceId ='+str(id)
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
sql = 'SELECT id,province_id,city_id FROM ser_shop'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		province_id = province(row['province_id'])
		city_id = province(row['city_id'])
		sql = 'UPDATE ser_shop SET province_id='+str(province_id)+',city_id='+str(city_id)+' where id = '+str(id)
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