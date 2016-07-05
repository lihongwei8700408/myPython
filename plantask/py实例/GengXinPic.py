#!/usr/bin/python
#coding=utf-8
#更新商城的PIC

import MySQLdb
import time
import os

try:
	conn = MySQLdb.connect(host='10.163.13.96',user='home',passwd='allianjieshujuku',db='mall168',port=3306,charset='utf8')
	cur = conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print e
	exit()
	
	
n = cur.execute('select * from snc_goods_000000')	#取新的产品表中的图片数据
for row in cur.fetchall():
	id = row['goods_id']
	pic = row['goods_image']
	m = cur.execute('update snc_goods set goods_image ="' + pic + '" where goods_id=' + str(id))	#更新数据
print 'goods ok!'

n = cur.execute('select * from snc_goods_common_000000')	#取新的产品表中的图片数据
for row in cur.fetchall():
	id = row['goods_commonid']
	pic = row['goods_image']
	m = cur.execute('update snc_goods_common set goods_image ="' + pic + '" where goods_commonid=' + str(id))	#更新数据
print 'goods_common ok!'

n = cur.execute('select * from snc_goods_images_000000')	#取新的产品表中的图片数据
for row in cur.fetchall():
	id = row['goods_image_id']
	pic = row['goods_image']
	m = cur.execute('update snc_goods_images set goods_image ="' + pic + '" where goods_image_id=' + str(id))	#更新数据
print 'goods_image_id ok!'

cur.close()
conn.close()