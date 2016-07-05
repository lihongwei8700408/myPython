#!/usr/lib64/python2.6
#coding=utf-8
#app服务店铺xx_seller

import MySQLdb
import time
import datetime
import sys
#服务类型转换
#1路救 2拖车 3洗车 4保养  5维修   6违章 7年检 8换证 9车务代办10代驾
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
	
#是否营业转换
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
def getcity(area):
	if area==None:
		return 0
	c = area.split(',')
	return int(c[1])

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

def dealcont(c):
	if c==None:
		return ''
	return c.replace('"','')
def getaddress(add):
	if add==None:
		return ''
	return add.replace('"','')
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT * FROM xx_seller'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		source_id = row['id']
		login_name = row['login_name']
		login_pwd = row['login_pwd']
		shop_name = dealnone(row['shop_name'])
		email = dealnone(row['email'])
		shop_logo = dealnone(row['shop_logo'])
		address = getaddress(row['shop_addr'])
		legal_person = dealnone(row['name'])
		service_tel = dealnone(row['telone']) +'|' +dealnone(row['teltwo'])+'|'+dealnone(row['telthree'])
		idcard = dealnone(row['sfz'])
		busilice = dealnone(row['busilice'])
		content = dealcont(row['introduce'])
		alipay = dealnone(row['zfb'])
		lng = int(float(dealnones(row['lon']))*1000000)
		lat = int(float(dealnones(row['lat']))*1000000)
		checked = ischeck(row['check_state'])
		check_time = extime(row['check_time'])
		create_time = extime(row['create_date'])
		update_time = extime(row['modify_date'])
		sell_num = dealnones(row['seller_number'])
		is_open = isyes(row['is_open'])
		is_pay = isyes(row['is_pay'])
		money = getprice(row['money'])
		bank_open = dealnone(row['bank_open'])
		bank_card = dealnone(row['bank_card'])
		legal_tel = dealnone(row['tel'])
		service_type = servicetype(row['service_type'])
		seller_area = int(dealnones(row['seller_area']))
		province = getcity(row['treepath'])
		city = int(dealnones(row['seller_area']))
		small_logo = dealnone(row['small_logo'])
		bank_name = dealnone(row['bank_name'])
		zfb_name = dealnone(row['zfb_name'])
		bank_addr = dealnone(row['bank_addr'])
		bank_detail = dealnone(row['bank_detail'])
		sql = 'INSERT INTO ser_shop(source_id,name,shop_logo,small_logo,money,province_id,city_id,area_id,address,service_type,content,lng,lat,checked,service_tel,is_open,is_pay,sell_num,average,skill,environment,attitude)VALUES('+str(source_id)+',"'+shop_name+'","'+shop_logo+'","'+small_logo+'",'+str(money)+','+str(province)+','+str(city)+','+str(seller_area)+',"'+address+'","'+service_type+'","'+content+'",'+str(lng)+','+str(lat)+','+str(checked)+',"'+service_tel+'",'+str(is_open)+','+str(is_pay)+','+str(sell_num)+',500,500,500,500)'
		n = cur.execute(sql)
		shop_id = int(cur.lastrowid)
		sql1 = 'INSERT INTO ser_shop_sub(source_id,shop_id,email,legal_id_card_pic,legal_person,legal_tel,business_pic,create_time,update_time,checked_time,alipay,alipay_name,bank_name,bank_open,bank_detail,bank_address,bank_card)VALUES('+str(source_id)+','+str(shop_id)+',"'+email+'","'+idcard+'","'+legal_person+'","'+legal_tel+'","'+busilice+'",'+str(create_time)+','+str(update_time)+','+str(check_time)+',"'+alipay+'","'+zfb_name+'","'+bank_name+'","'+bank_open+'","'+bank_detail+'","'+bank_addr+'","'+bank_card+'")'
		n1 = cur.execute(sql1)
		sql = 'INSERT INTO cl_seller(source_id,user_name,password,service_shop_id,create_time)VALUES('+str(source_id)+',"'+login_name+'","'+login_pwd+'",'+str(shop_id)+','+str(create_time)+')'
		n2 = cur.execute(sql)
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