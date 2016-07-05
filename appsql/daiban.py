#!/usr/lib64/python2.6
#coding=utf-8
#app ser_service ser_shop 处理service_type

import MySQLdb
import time
import datetime
import sys
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,shop_id,daiban_type FROM ser_service where daiban_type!=0'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	error = []
	for row in result:
		id = row['id']
		shop_id = row['shop_id']
		service_type = row['daiban_type']
		sql = 'UPDATE ser_service SET service_type='+str(service_type)+' where id = '+str(id)
		n = cur.execute(sql)
		sql = 'SELECT service_type FROM ser_shop where id='+str(shop_id)
		n = cur.execute(sql)
		result = cur.fetchone()
		if result==None:
			error.append(shop_id)
			y += 1
			continue
		else:
			new  = str(service_type)+'|'
			if new in result['service_type']:
				y += 1
				continue
			else:
				stype = result['service_type'] + new
			sql = 'UPDATE ser_shop SET service_type="'+stype+'" where id = '+str(shop_id)
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