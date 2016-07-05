#!/usr/lib64/python2.6
#coding=utf-8
#app服务会员消息记录表 yy_refund

import MySQLdb
import time
import datetime
import sys
#退款状态1待审核2审核通过3拒绝退款4退款成功5退款失败
def exstate(t):
	if t=='1' or t=='2':
		return 9
	if t=='4':
		return 10
	if t=='5' or t=='3':
		return 11
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
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='147258369',db='dump_shop',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM yy_message_member'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		order_id = row['order_id']
		order_price= int(row['total_money']*100)
		pay_money= int(row['refund_reality_money']*100)
		integral = row['refund_vb']
		status = exstate(row['refund_state'])
		create_time = extime(create_date)
		sql = 'INSERT INTO ser_refund(source_id,order_id,order_price,pay_money,integral,status,create_time) VALUES ('+str(source_id)+','+str(order_id)+','+str(order_price)+','+str(pay_money)+',0,'+str(integral)+','+str(status)+','+str(create_time)+')'
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