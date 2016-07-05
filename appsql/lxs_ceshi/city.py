#!/usr/lib64/python2.6
#coding=utf-8
#app xx_area

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
def getcity(name):
	sql = 'SELECT id FROM citys  where Name = "'+name+'"'
	n = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['id']
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='147258369',db='dump_shop',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,name FROM xx_area where parent is not Null'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		city_name = row['name']
		pid = int(getcity(city_name))
		sql = 'UPDATE citys SET SourceId='+str(id)+' where id='+str(pid)
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(id) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()