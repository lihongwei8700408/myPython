#!/usr/lib64/python2.6
#coding=utf-8
#app服务油卡充值记录表 zz_oil_order

import MySQLdb
import time
import datetime
import sys
#类型转换方式代号  1 商城订单支付  2积分充值 3:退款退积分4服务订单支付5积分天天涨收益6油卡充值 7任务刮刮乐 8取消订单
def extype(t):
	if t=='1':
		return 2
	if t=='8':
		return 5
	if t=='7':
		return 4
	if t=='2':
		return 7
	if t=='3':
		return 6
	if t=='4':
		return 1
	if t=='2':
		return 7
	if t=='5':
		return 3
	if t=='6':
		return 8
def ishave(member_id):
	sql = 'SELECT id FROM cl_member where source_id ='+str(member_id)
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
def orderstate(s):
	if s=='0':
		return 1
	if s=='1':
		return 3
	if s=='5':
		return 5
def jktype(t):
	if t=='juhe':
		return 1
	if t=='showapi':
		return 2
	if t==None:
		return 0
def dealnone(n):
	if n==None:
		return ''
	else:
		return n
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM zz_oil_order'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		SourceId = row['id']
		MemberId = row['member_id']
		have = ishave(MemberId)
		if have==0:
			y += 1
			continue
		else:
			MemberId = have
		Time = extime(row['last_time'])
		Price = int(row['price']*100)
		Money = int(row['money']*100)
		Integral = row['use_point']
		OilCard = dealnone(row['oil_card_num'])
		SellerOrderId = row['order_id']
		State = orderstate(row['order_state'])
		JkType = jktype(row['tp'])
		sql = 'INSERT INTO oil_charge_recode(source_id,member_id,time,price,oil_money,money,integral,oil_card,state,jk_type,source) VALUES ('+str(SourceId)+','+str(MemberId)+','+str(Time)+','+str(Price)+',0,'+str(Money)+','+str(Integral)+',"'+OilCard+'",'+str(State)+','+str(JkType)+',2)'
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(SourceId) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
		
except:
	print "Error: unable to update data"

# 关闭数据库连接
conn.close()