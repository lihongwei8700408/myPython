#!/usr/lib64/python2.6
#coding=utf-8
#app cl_integral_charge 替换member_id

import MySQLdb
import time
import datetime
import sys

def ishave(member_id):
	sql = 'SELECT Id FROM cl_member where SourceId ='+str(member_id)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['Id']
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='147258369',db='dump_shop',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,member_id FROM cl_integral_charge'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	error = []
	for row in result:
		id = row['id']
		member_id = row['member_id']
		new_mid = ishave(member_id)
		sql = 'UPDATE cl_integral_charge SET member_id='+str(new_mid)+' where id = '+str(id)
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