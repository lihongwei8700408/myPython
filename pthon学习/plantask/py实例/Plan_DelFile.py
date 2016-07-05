#!/usr/bin/python
#coding=utf-8
#计划任务__删除html文件
#删除fl_delete_files表中Status字段>0的记录的文件，如果删除文件成功，则删除该记录；若删除失败，修改该条记录Status=-1。
#Status字段>0时代表城市ID

import MySQLdb
import time
import os

try:
	conn = MySQLdb.connect(host='10.163.13.96',user='home',passwd='allianjieshujuku',db='classinfo',port=3306,charset='utf8')
	cur = conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print e
	exit()
	
	
server = '1'							#本机分服务器代号
basePath = '/var/www/html/fenlei168'		#文件基本路径
t = int(time.time())
n = cur.execute('select * from fl_delete_files where Server='+str(server)+' and Status=0')	#取出本服务器上未执行过删除的记录
if n > 0:
	for row in cur.fetchall():
		id = row['ID']
		#n = cur.execute('select * from fl_city where CityId=' + str(row['Status']))
		#city = cur.fetchone()['Mark']	#得到城市拼音
		fileName = row['FileName']
		path = basePath + fileName	#字符串截取连接
		result = 0
		try:
			os.remove(path)			#删除文件
		except:
			result = -1
		
		if result == 0:
			n = cur.execute('delete from fl_delete_files where ID=' + str(id))				#删除文件成功则删除这条记录
		else:
			n = cur.execute('update fl_delete_files set Status = -1 where ID=' + str(id))	#删除失败将状态改为-1
		

cur.close()
conn.close()