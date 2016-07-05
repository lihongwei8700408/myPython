#!/usr/lib64/python2.6
#coding=utf-8
#app服务yy_good的service_type 转到service_class

import MySQLdb
import time
import datetime
import sys

def ishave(shop_id):
	sql = 'SELECT service_type FROM xx_seller where id ='+str(shop_id)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return ''
	else:
		return result['service_type']
#服务类型转换
#1路救 2拖车 3洗车 4保养  5维修   7违章 6年检 8换证 9车务代办10代驾
def servicetype(type):
	#保养 洗车  维修 路救 拖车 代办   illegal违章 driverlicence年检  licence办证
	#d = ['upkeep','jzxc','weixiu','waysave','pullcar','daiban']
	if type==None:
		return ''
	type = type.split(',')
	d = ['upkeep','jzxc','weixiu','waysave','pullcar','daiban']
	s = []
	for k in type:
		if k=='waysave':
			s.append(1)
		if k=='pullcar':
			s.append(2)
		if k=='jzxc':
			s.append(3)
		if k=='upkeep':
			s.append(4)
		if k=='weixiu':
			s.append(5)
		if k=='daiban':
			s.append(9)
		if k=='travel':
			s.append(10)
	s = '|'.join(map(str,s))
	newtype = '|' + s +'|'
	return newtype
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,source_id FROM ser_shop where service_type is not Null'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		id = row['id']
		source_id = row['source_id']
		type = ishave(source_id)
		if type=='':
			y += 1
			continue
		type = servicetype(type)
		sql = 'UPDATE ser_shop SET service_class="'+str(type)+'" where id = '+str(id)
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