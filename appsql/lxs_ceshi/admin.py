#!/usr/lib64/python2.6
#coding=utf-8
#app后台登录人员xx_admin

import MySQLdb
import time
import datetime
import sys

def extime(t):
	if t==None:
		return 0
	d = datetime.datetime.strptime(str(t), "%Y-%m-%d %H:%M:%S")
	t = d.timetuple()  
	timeStamp = int(time.mktime(t))  
	timeStamp = float(str(timeStamp) + str("%06d" % d.microsecond))/1000000   
	nt = int(timeStamp)
	return nt
def getcity(area):
	if area==None:
		return 0
	c = area.split(',')
	return int(c[1])
def dealnone(n):
	if n==None:
		return ''
	else:
		return n
def dealnones(n):
	if n==None:
		return 0
	else:
		return n
def dealbit(b):
	b = ord(b)
	if b==1:
		return 1
	else:
		return 0
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM xx_admin'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		user_name = dealnone(row['username'])
		user_password = dealnone(row['password'])
		real_name = dealnone(row['name'])
		tel = dealnone(row['tel'])
		province_id = getcity(row['treepath'])
		city_id = int(dealnones(row['admin_area']))
		department = dealnone(row['department'])
		create_time = extime(row['create_date'])
		update_time = extime(row['modify_date'])
		parent_id = dealnones(row['parent'])
		is_locked = 0
		is_enabled = dealbit(row['is_enabled'])
		locked_time = extime(row['locked_date'])
		level = 1
		sql = 'INSERT INTO cl_user(source_id,user_name,password,name,tel,province_id,city_id,department,create_time,update_time,parent_id,is_locked,locked_time,level,is_enabled) VALUES ('+str(source_id)+',"'+user_name+'","'+user_password+'","'+real_name+'","'+tel+'",'+str(province_id)+','+str(city_id)+',"'+department+'",'+str(create_time)+','+str(update_time)+','+str(parent_id)+','+str(is_locked)+','+str(locked_time)+','+str(level)+','+str(is_enabled)+')'
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(source_id) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()