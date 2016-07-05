#!/usr/lib64/python2.6
#coding=utf-8
#app会员油卡导表zz_member_oilcard

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
def ishaves(mid,type):
	sql = 'SELECT id FROM oil_card where member_id='+str(mid)+' and oil_type='+str(type)
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
def oiltype(t):
	if t=='0':
		return 1
	if t=='1':
		return 2
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
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT member_id,tel FROM zz_member_oilcard where isdelete="no" and oil_tp="0" group by tel'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	list = []
	for row in result:
		member_id = row['member_id']
		tel = row['tel']
		list.append(member_id)
	for i in list:
		sql = 'SELECT * FROM zz_member_oilcard where isdelete="no" and oil_tp="0" and member_id='+str(i)+' order by last_time desc limit 1'
		n = cur.execute(sql)
		result = cur.fetchone()
		id = result['id']
		mid = result['member_id']
		have = ishave(mid)
		card = result['oil_card_num']
		last_time = extime(result['last_time'])
		type = 1
		if have>0:
			h = ishaves(have,type)
			if h>0:
				sql = 'UPDATE oil_card SET AppOilCard="'+str(card)+'",SourceMid ='+str(mid)+',Time='+str(last_time)+',SourceId='+str(id)+' where Id = '+str(h)
			if h==0:
				sql = 'INSERT INTO oil_card(oil_card,member_id,is_show,oil_type,time,source_id) VALUES ("'+card+'",'+str(have)+',0,1,'+str(last_time)+','+str(id)+')'
				n = cur.execute(sql)
				y += 1
				baifen = (y * 100) / AllNum
				rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(id) + '\r'
				sys.stdout.write(rrr)
				sys.stdout.flush()
				if y == AllNum:
					print 'All Ok!!!'
		else:
			print 'cl_member error'
		
except:
	print "Error: xx_member"

# 关闭数据库连接
conn.close()