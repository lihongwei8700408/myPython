#!/usr/lib64/python2.6
#coding=utf-8
#app服务积分充值记录表 yy_member_topup

import MySQLdb
import time
import datetime
import sys

def ishave(member_id):
	sql = 'SELECT id FROM cl_member where source_id ='+str(member_id)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['id']
def paystate(s):
	if s=='0':
		return 1
	if s=='2':
		return 2
	
def paytype(p):
	#3支付宝 2通联支付 1微信 4建行
	if p=='alipay':
		return 3
	if p=='allinpay':
		return 2
	if p=='wxpay':
		return 1
	if p=='CCBpay':
		return 4
	if p==None:
		return 0
def extime(t):
	if t==None:
		return 0
	d = datetime.datetime.strptime(str(t), "%Y-%m-%d %H:%M:%S")
	t = d.timetuple()  
	timeStamp = int(time.mktime(t))  
	timeStamp = float(str(timeStamp) + str("%06d" % d.microsecond))/1000000   
	nt = int(timeStamp)
	return nt

try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM yy_member_topup'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		integral = row['vb']
		create_date = extime(row['create_date'])
		pay_type = 2
		pay_way = paytype(row['paymode'])
		sate = paystate(row['pay_state'])
		member_id = row['member_id']
		have = ishave(member_id)
		if have==0:
			y += 1
			continue
		else:
			member_id = have
		is_stat = int(row['is_stat'])
		sql = 'INSERT INTO cl_integral_charge(source_id,integral,time,pay_type,pay_way,sate,member_id,is_stat) VALUES ('+str(source_id)+','+str(integral)+','+str(create_date)+','+str(pay_type)+','+str(pay_way)+','+str(sate)+','+str(member_id)+','+str(is_stat)+')'
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