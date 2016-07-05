#!/usr/lib64/python2.6
#coding=utf-8
#app会员表导表xx_member

import MySQLdb
import time
import datetime
import sys
def ishave(tel):
	sql = 'SELECT id FROM cl_member where tel ="'+tel+'"'
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
#是否支持积分转换
def islocked(k):
	if k=='yes':
		return 1
	if k=='no':
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
sql = 'SELECT * FROM xx_member'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		Tel = row['mobile']
		SourceId = row['id']
		Checked = islocked(row['is_locked'])
		Integral = dealnones(row['vb'])
		AppPassword = dealnone(row['password'])
		IsApp=1
		AppHeadImg = dealnone(row['head_pic'])
		AppName = dealnone(row['name'])
		AppCreateTime = extime(row['create_date'])
		AppUpdateTime = extime(row['modify_date'])
		AppGglTime = extime(row['near_ggl_time'])
		AppLoginTime = extime(row['login_date'])
		AppProvince = dealnone(row['province'])
		AppCity = dealnone(row['city'])
		AppRefereeTel = dealnone(row['referee_tel'])
		have = ishave(Tel)
		if have!=0:
			sql = 'UPDATE cl_member SET source_id='+str(SourceId)+',checked = '+str(Checked)+',integral = Integral + '+str(Integral)+',app_password="'+AppPassword+'",is_app=1,app_head_img="'+AppHeadImg+'",app_name="'+AppName+'",app_create_time='+str(AppCreateTime)+',app_update_time='+str(AppUpdateTime)+',app_ggl_time='+str(AppGglTime)+',app_login_time='+str(AppLoginTime)+',app_province="'+AppProvince+'",app_city="'+AppCity+'",app_referee_tel="'+AppRefereeTel+'" where Id = '+str(have)
		if have==0:
			sql = 'INSERT INTO cl_member(source_id,Checked,integral,tel,app_password,is_app,app_head_img,app_name,app_create_time,app_update_time,app_ggl_time,app_login_time,app_province,app_city,app_referee_tel) VALUES ('+str(SourceId)+','+str(Checked)+','+str(Integral)+',"'+Tel+'","'+AppPassword+'",1,"'+AppHeadImg+'","'+AppName+'",'+str(AppCreateTime)+','+str(AppUpdateTime)+','+str(AppGglTime)+','+str(AppLoginTime)+',"'+AppProvince+'","'+AppCity+'","'+AppRefereeTel+'")'
		n = cur.execute(sql)
		y += 1
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(SourceId) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
except:
	print "Error: xx_member"

# 关闭数据库连接
conn.close()