#!/usr/bin/python
#coding=utf-8
#计划任务__结束到期置顶推广
#删除推广表中的到期推广信息，将审核表中到期的信息状态改为3，表示已经过期

import MySQLdb
import time

try:
	conn=MySQLdb.connect(host='10.163.13.96',user='home',passwd='allianjieshujuku',db='classinfo',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()


t = int(time.time())
sql_where = 'where Type=1 and EndTime < ' + str(t)	#已经到期的置顶推广
n = cur.execute('select InfoId from fl_spread ' + sql_where)	#将过期的信息权重归零
if n > 0:
	for row in cur.fetchall():
		a = cur.execute('select ClassTable,ClassTableId from fl_info_main where InfoId=' + str(row['InfoId']))
		b = cur.fetchone()
		TableName = b['ClassTable']
		InfoId = str(b['ClassTableId'])
		sql = 'update ' + TableName + ' set IsSpread=0 where InfoId=' + InfoId	#将信息表的权重恢复为0
		m = cur.execute(sql)
n = cur.execute('delete from fl_spread ' + sql_where)						#删除推广表中已经过期的置顶推广
m = cur.execute('update fl_spread_check set Checked=7 ' + sql_where)		#更新审核表置顶推广状态，3表示已经过期

cur.close()
conn.close()