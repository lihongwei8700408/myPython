#!/usr/lib64/python2.6
#coding=utf-8
#app服务违章车辆添加 xx_member_car

import MySQLdb
import time
import datetime
import sys
def ishave(mid):
	sql = 'SELECT id FROM cl_member where source_id='+str(mid)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['id']
def extime(t):
	if t==None:
		return 0
	d = datetime.datetime.strptime(str(t), "%Y-%m-%d %H:%M:%S")
	t = d.timetuple()  
	timeStamp = int(time.mktime(t))  
	timeStamp = float(str(timeStamp) + str("%06d" % d.microsecond))/1000000   
	nt = int(timeStamp)
	return nt
def dealnone(n):
	if n==None:
		return ''
	else:
		return n
def cartype(t):
	if t=='01':
		return 2
	if t=='02':
		return 1
	if t=='03':
		return 3
	if t=='04':
		return 4
	if t=='05':
		return 5
	if t=='06':
		return 6
def getpro(n):
	if n==None:
		return ''
	else:
		return n[0]
def getnum(n):
	if n==None:
		return ''
	else:
		return n[1:8]

try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='147258369',db='dump_shop',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM xx_member_car where member_id>0'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		member_id = row['member_id']
		have = ishave(member_id)
		if have==0:
			y += 1
			continue
		else:
			member_id = have
		car_type = cartype(row['car_type']) 
		province = getpro(row['car_num'])
		car_number = getnum(row['car_num'])
		frame_number = dealnone(row['car_sn'])
		engine_number = dealnone(row['car_eng'])
		search_time = extime(row['create_time'])
		sql = 'INSERT INTO ser_car_info(source_id,member_id,car_type,province,car_number,frame_number,engine_number,search_time) VALUES ('+str(source_id)+','+str(member_id)+','+str(car_type)+',"'+province+'","'+car_number+'","'+frame_number+'","'+engine_number+'",'+str(search_time)+')'
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