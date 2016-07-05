#!/usr/lib64/python2.6
#coding=utf-8
#app店铺更新service_type字段

import MySQLdb
import time
import datetime
import sys
#将字符串分割为数组并且排空
def explodeStringToArray(str):
	arr = str.split('|')
	arr = [ int( arr ) for arr in arr if arr ]
	return arr

def hasThisService(shopId,ids):
	sql = 'SELECT COUNT(id) AS total FROM ser_service where shop_id = '+str(shopId)+' and service_type='+str(ids)+' and is_delete=0 and status=2'
	try:
		cur.execute(sql)
		result = cur.fetchone()
		return result['total']
	except:
		return 0

def updShopServiceType(shopId,serviceType):
	sql = 'UPDATE ser_shop SET service_type="'+serviceType+'" where id = '+str(shopId)
	try:
		cur.execute(sql)
	except:
		return 0

try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='apps_data',charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT id,service_type FROM ser_shop'
try:
	# 执行SQL语句
	y = 0
	AllNum = cur.execute(sql)
	result = cur.fetchall()
	for row in result:
		serviceArr = explodeStringToArray(row['service_type'])
		ret=''
		for types in serviceArr:

			if types==10:
				continue
			else:
				hasOne = hasThisService(row['id'],types)
				if hasOne>0:
					ret+=str('|'+str(types))
		if ret.strip()!='':
			ret+=str('|')
			updShopServiceType(row['id'],ret)	
		y += 1		
		baifen = (y * 100) / AllNum
		rrr = 'jinDu: ' + str(y) + '/' + str(AllNum) + '   bili: ' + str(baifen) + '/100   InfoId: ' + str(row['id']) + '\r'
		sys.stdout.write(rrr)
		sys.stdout.flush()
		if y == AllNum:
			print 'All Ok!!!'
except:
	print "Error: 店铺更新service_type字段"

# 关闭数据库连接
conn.close()