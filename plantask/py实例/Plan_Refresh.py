#!/usr/bin/python
#coding=utf-8
#计划任务__自动刷新

import MySQLdb
import time

try:
	conn=MySQLdb.connect(host='10.163.13.96',user='home',passwd='allianjieshujuku',db='classinfo',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()

t = str(int(time.time()))								#当前时间
tz = t[0:8] + '00'										#当前时间只取0，30分

a = time.localtime()
NoticeTitle = u'信息预约刷新成功'
NoticeContent = u'信息预约刷新成功'
OutUserName = u'系统'

#执行具体刷新和扣费及发送通知
def refresh(InfoId,MemberId):
	n = cur.execute('select MemberName from fl_member where MemberId=' + MemberId)
	if n > 0:
		MemberName = cur.fetchone()['MemberName']
		#查询信息主表得到信息表名、信息ID及标题
		n = cur.execute('select ClassTable,ClassTableId,Title from fl_info_main where InfoId=' + InfoId)
		if n > 0:
			b = cur.fetchone()
			TableName = b['ClassTable']
			ClassTableId = str(b['ClassTableId'])
			Title = b['Title']
			#刷新信息表的更新时间
			m = cur.execute('update ' + TableName + ' set UpdateTime=' + t + ' where InfoId=' + ClassTableId)
			#刷新信息主表的更新时间
			m = cur.execute('update fl_info_main set UpdateTime=' + t + ' where InfoId=' + InfoId)
			#给会员发送通知
			ziduan = 'NoticeTitle,NoticeContent,OutUserId,OutUserName,BlacklistTime,InId,InName'
			shuzhi = '"' + NoticeTitle + '","' + Title + ' ' + NoticeContent + '",1,"' + OutUserName +'",' + t + ',' + MemberId + ',"' + MemberName + '"'
			m = cur.execute('insert into fl_notice (' + ziduan + ') values(' + shuzhi + ')')
			NoticeId = str(conn.insert_id())
			m = cur.execute('insert into fl_member_notice(MemberId,NoticeId,IsRead) values(' + MemberId + ',' + NoticeId + ',0)')


#批量更新模式为指定日期刷新的信息
n = cur.execute('select InfoId,MemberId from fl_refresh_check where RefreshTime <= ' + t)
if n > 0:
	for row in cur.fetchall():
		InfoId = str(row['InfoId'])
		MemberId = str(row['MemberId'])
		refresh(InfoId,MemberId)

#删除已经过期的刷新计划
n = cur.execute('delete from fl_refresh_check where RefreshTime <= ' + t)

cur.close()
conn.close()