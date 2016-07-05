#!/usr/lib64/python2.6
#coding=utf-8
#app测试lxs_test
import MySQLdb
import time
import datetime
import sys
import dir.constant
print dir.constant.const.HOST
try:
	conn=MySQLdb.connect(host=dir.constant.const.HOST,user=dir.constant.const.USER,passwd=dir.constant.const.PASSWD,db=dir.constant.const.DB,charset=dir.constant.const.CHARSET)
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
sql = 'SELECT COUNT(id) AS total FROM lxs_test'
try:
	cur.execute(sql)
	result = cur.fetchone()
	print result.total
except:
	print "Error: unable to select count data"