#!/usr/lib64/python2.6
#coding=utf-8
#app服务积分记录表 yy_member_vb

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
#类型转换方式代号  1 商城订单支付  2积分充值 3:退款退积分4服务订单支付5积分天天涨收益6油卡充值 7任务刮刮乐 8取消订单9活动服务完成返还积分
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
	if t=='4' or t=='11':
		return 1
	if t=='2':
		return 7
	if t=='5':
		return 3
	if t=='6':
		return 8
	if t=='9':
		return 9
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

def integralrecord(start,end):
	sql = 'SELECT * FROM yy_member_vb limit '+str(start)+','+str(end)
	try:
		# 执行SQL语句
		y = 0
		AllNum = cur.execute(sql)
		result = cur.fetchall()
		for row in result:
			source_id = row['id']
			integral = row['vb']
			create_date = extime(row['create_date'])
			use_way = dealnone(row['depict'])
			type = extype(row['vb_type'])
			total = row['vb']
			member_id = row['member_id']
			have = ishave(member_id)
			if have==0:
				y += 1
				continue
			else:
				member_id = have
			sql = 'INSERT INTO cl_integral_record(source_id,integral,time,use_way,type,total,member_id) VALUES ('+str(source_id)+','+str(integral)+','+str(create_date)+',"'+use_way+'",'+str(type)+','+str(integral)+','+str(member_id)+')'
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

sql = 'SELECT COUNT(id) as count FROM yy_member_vb'
n = cur.execute(sql)
result = cur.fetchone()
count = result['count']
rn = count/10000 + 1
for i in range(rn):
	j=i*10000
	integralrecord(j,10000)
 
# 关闭数据库连接
conn.close()