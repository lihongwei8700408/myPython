#!/usr/lib64/python2.6
#coding=utf-8
#app服务yy_good

import MySQLdb
import time
import datetime
import sys

def ishave(shop_id):
	sql = 'SELECT id FROM ser_shop where source_id ='+str(shop_id)
	zn = cur.execute(sql)
	result = cur.fetchone()
	if result==None:
		return 0
	else:
		return result['id']
#服务类型转换
#1路救 2拖车 3洗车 4保养  5维修   6违章 7年检 8换证 9车务代办
def servicetype(type):
	#保养 洗车  维修 路救 拖车 代办   illegal违章 driverlicence年检  licence办证
	#d = ['upkeep','jzxc','weixiu','waysave','pullcar','daiban']
	if type=='upkeep':
		return 4
	if type=='jzxc':
		return 3
	if type=='weixiu':
		return 5
	if type=='waysave':
		return 1
	if type=='pullcar':
		return 2
	if type=='daiban':
		return 9
	if type=='illegal':
		return 6
	if type=='driverlicence':
		return 7
	if type=='licence':
		return 8
	if type=='travel':
		return 10
	if type==None:
		return 0
	if type=='':
		return 0
	
#是否上架转换
def isstate(k):
	if k=='yes':
		return 2
	if k=='no':
		return 1
#是否支持积分转换
def isyes(k):
	if k=='yes':
		return 1
	if k=='no':
		return 0
	if k==None:
		return 1
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
def dealnone(n):
	if n==None:
		return ''
	else:
		return str(n)
def dealnones(n):
	if n==None:
		return 0
	else:
		return n
def daynight(d):
	if d==None or d=='day' or d=='null':
		return 1
	if d=='night':
		return 2
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM yy_good'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		title = row['good_name']
		price_old = getprice(row['price'])
		price_new = getprice(row['cheap_price'])
		shop_id = row['seller_id']
		have = ishave(shop_id)
		if have==0:
			y += 1
			continue
		else:
			shop_id = have
		sale_num = row['sales_num']
		service_type = servicetype(row['service_type'])
		status = isstate(row['is_marketable'])
		create_time = extime(row['create_date'])
		update_time = extime(row['modify_date'])
		start_time = dealnone(row['begin_time'])
		end_time = dealnone(row['end_time'])
		content = dealnone(row['good_pic'])
		is_integral = isyes(row['is_vb'])
		is_delete = isyes(row['isdelete'])
		checked = isyes(row['check_type'])
		daiban_type = servicetype(row['daiban_type'])
		specialserver = dealnone(row['specialserver'])
		getrange = dealnone(row['getrange'])
		begin_price = getprice(row['begin_price'])
		end_price = getprice(row['end_price'])
		requiredtime = dealnones(row['requiredtime'])
		week = dealnone(row['week'])
		day = daynight(row['day_or_night'])
		sql = 'INSERT INTO ser_service(source_id,title,price_old,price_new,shop_id,sale_num,service_type,status,create_time,update_time,start_time,end_time,content,is_integral,is_delete,checked,daiban_type,specialserver,getrange,begin_price,end_price,requiredtime,week,day_night) VALUES ('+str(source_id)+',"'+title+'",'+str(price_old)+','+str(price_new)+','+str(shop_id)+','+str(sale_num)+','+str(service_type)+','+str(status)+','+str(create_time)+','+str(update_time)+',"'+start_time+'","'+end_time+'","'+content+'",'+str(is_integral)+','+str(is_delete)+','+str(checked)+','+str(daiban_type)+',"'+specialserver+'","'+getrange+'",'+str(begin_price)+','+str(end_price)+','+str(requiredtime)+',"'+week+'",'+str(day)+')'
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