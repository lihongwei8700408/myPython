#!/usr/lib64/python2.6
#coding=utf-8
#app服务订单yy_order

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
#订单状态0未支付 1已支付2已服务完成 4已取消 5退款
def orderstate(k):
	if k=='0':
		return 1
	if k=='1':
		return 2
	if k=='2':
		return 5
	if k=='4':
		return 7
	if k=='5':
		return 9
#审核状态
def ischeck(k):
	if k=='wait':
		return 0
	if k=='yes':
		return 1
	if k=='no':
		return 2
def extime(t):
	if t==None:
		return 0
	d = datetime.datetime.strptime(str(t), "%Y-%m-%d %H:%M:%S")  
	t = d.timetuple()  
	timeStamp = int(time.mktime(t))  
	timeStamp = float(str(timeStamp) + str("%06d" % d.microsecond))/1000000   
	nt = int(timeStamp)
	return nt
def getprice(p):
	if p==None:
		return 0
	else:
		return int(p*100)
#是否删除
def isdelete(k):
	if k=='yes':
		return 1
	if k==None:
		return 0
def paytype(p):
	#支付宝 通联支付 微信 建行
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
def ordersource(s):
	#1微信2客户端3pc
	return 2
def isreduce(i):
	if i==None or i=='no':
		return 0
	if i=='yes':
		return 1
	
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
sql = 'SELECT * FROM yy_order'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		shop_id = row['seller_id']
		member_id = row['member_id']
		have = ishave(member_id)
		if have==0:
			y += 1
			continue
		else:
			member_id = have
		order_number = row['order_id']
		order_uuid = row['order_uuid']
		order_price = int(dealnones(row['order_price'])*100)
		pay_money = int(dealnones(row['pay_money'])*100)
		pay_type = paytype(row['paymode'])
		integral = dealnones(row['use_point'])
		coupon_discount = int(dealnones(row['coupon_discount'])*100)
		status = orderstate(row['order_state'])
		create_time = extime(row['create_date'])
		update_time = extime(row['near_date'])
		order_source = ordersource(row['order_source'])
		is_delete = isdelete(row['memberdel'])
		seller_delete = isdelete(row['sellerdel'])
		is_stat = row['is_stat']
		coupon_id = dealnones(row['coupon_id'])
		coupon_name = dealnone(row['coupon_name'])
		coupon_desc = dealnone(row['coupon_desc'])
		coupon_isdeduction = isreduce(row['coupon_isdeduction'])
		voucher_id = dealnones(row['voucher_id'])
		voucher_money = int(dealnones(row['voucher_money'])*100)
		good_id = dealnones(row['good_id'])
		good_name = dealnone(row['good_name'])
		sql = 'INSERT INTO ser_order(source_id,shop_id,member_id,order_number,order_uuid,order_price,pay_money,integral,coupon_discount,coupon_id,coupon_name,coupon_desc,coupon_isdeduction,voucher_id,voucher_money,status,create_time,update_time,order_source,pay_type,is_delete,seller_delete,is_stat)VALUES('+str(source_id)+','+str(shop_id)+','+str(member_id)+',"'+order_number+'","'+order_uuid+'",'+str(order_price)+','+str(pay_money)+','+str(integral)+','+str(coupon_discount)+','+str(coupon_id)+',"'+coupon_name+'","'+coupon_desc+'",'+str(coupon_isdeduction)+','+str(voucher_id)+','+str(voucher_money)+','+str(status)+','+str(create_time)+','+str(update_time)+','+str(order_source)+','+str(pay_type)+','+str(is_delete)+','+str(seller_delete)+','+str(is_stat)+')'
		n = cur.execute(sql)
		order_id = int(cur.lastrowid)
		sql1 = 'INSERT INTO ser_order_sub(source_id,order_id,service_id,title,status,price,num)VALUES('+str(source_id)+','+str(order_id)+','+str(good_id)+',"'+good_name+'",0,'+str(order_price)+',1)'
		n1 = cur.execute(sql1)
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