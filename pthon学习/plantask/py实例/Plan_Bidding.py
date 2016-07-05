#!/usr/bin/python
#coding=utf-8
#计划任务__竞价排名加精
#删除推广表中的精准推广信息，将审核表中每个类别状态为1、5并EndTime没过期的信息按Bid字段排序取5名
#状态值：1：竞拍成功；4：竞拍失败；5：竞拍中；2：暂停；3：过期

import MySQLdb
import time

try:
	conn=MySQLdb.connect(host='10.163.13.96',user='home',passwd='allianjieshujuku',db='classinfo',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()

t = int(time.time())

OK = '1'	#竞拍成功
NO = '4'	#竞拍失败
WAIT = '5'	#竞拍中
STOP = '2'	#暂停
OVER = '3'	#过期
SPREAD = OK + ',' + NO + ',' + WAIT										#参加竞拍的状态集合
SPREADTYPE = '8'														#精准推广的类型ID
BIDTYPE = '1'															#精准推广的竞价类型ID
SQL_TYPE = 'SpreadTypeId=' + SPREADTYPE + ' and BidType=' + BIDTYPE		#精准推广类型条件
SQL_WAIT = 'Checked in(' + SPREAD + ') and EndTime>' + str(t)			#参加竞拍的状态条件
SQL_OVER = 'Checked in(' + SPREAD + ') and EndTime<' + str(t)			#已过期的状态条件

TopNum = 5	#每个栏目精准推广的数量

SpendItemId = '127'
n = cur.execute('select OperationName from fl_integral_set where OperationId=' + SpendItemId)
if n > 0:
	OperationName = cur.fetchone()['OperationName']
else:
	OperationName = '精准推广扣费'

ziduan = 'SpreadId,SpreadPos,SpreadName,SpreadTypeId,InfoId,Title,HtmlPath,MemberId,Checked,UpdateTime,\
Auditorer,CheckedTime,TitlePic,IsPic,ShowNum,ClickNum,Days,IsSpread,BidType,Bid,ConsumerPrice,SpreadPosition,\
ClassId,CityId,DistrictId,ClassTable,ClassTableId,Price,MemberName,InfoClassId,StartTime,EndTime,InfoText'#复制字段

#查询推广表所有正在精准推广的信息，将信息表的权重恢复为0
n = cur.execute('select ClassTable,ClassTableId from fl_spread where ' + SQL_TYPE)
if n > 0:
	for row in cur.fetchall():
		TableName = row['ClassTable'].replace('FlInfo','fl_info_')
		TableName = TableName.lower()	#转换为小写
		InfoId = str(row['ClassTableId'])
		sql = 'update ' + TableName + ' set IsSpread=0 where InfoId=' + InfoId	#将信息表的权重恢复为0
		m = cur.execute(sql)

#先将审核表中的过期待竞拍信息全改为过期
n = cur.execute('update fl_spread_check set Checked=' + OVER + ' where ' + SQL_TYPE + ' and ' + SQL_OVER)

#先将审核表中的待竞拍信息批改为竞拍失败
n = cur.execute('update fl_spread_check set Checked=' + NO + ' where ' + SQL_TYPE + ' and ' + SQL_WAIT)

#删除推广表中的精准推广
n = cur.execute('delete from fl_spread where ' + SQL_TYPE)

#查询待竞价的城市，返回城市条数
sql_no = 'where ' + SQL_TYPE + ' and Checked=' + NO
n = cur.execute('select CityId from fl_spread_check ' + sql_no + ' group by CityId')
if n > 0:
	for row_city in cur.fetchall():
		CityId = str(row_city['CityId'])

		#查询待竞价的类别，返回类别条数
		n = cur.execute('select ClassId from fl_spread_check ' + sql_no + ' and CityId=' + CityId + ' group by ClassId')
		if n > 0:
			for row_class in cur.fetchall():
				ClassId = str(row_class['ClassId'])
				
				#取每个城市每个类别的前5个批量修改状态为状态1，并将展现天数加1
				n = cur.execute('select SpreadId,MemberId,Bid from fl_spread_check ' + sql_no + ' and CityId=' + CityId + ' and ClassId=' + ClassId + ' order by Bid desc')
				if n > 0:
					i = 0
					for row_spread in cur.fetchall():
						SpreadId = str(row_spread['SpreadId'])
						MemberId = str(row_spread['MemberId'])
						Bid = row_spread['Bid']
						#查询该用户分类币是否足额，否则返回0
						n = cur.execute('select ClassCoin from fl_member_sub where MemberId=' + MemberId + ' and ClassCoin>=' + str(Bid))
						if n > 0:
							ClassCoin = cur.fetchone()['ClassCoin'] - Bid
							#更新会员副表，减去相应的分类币
							n = cur.execute('update fl_member_sub set ClassCoin=' + str(ClassCoin) + ' where MemberId=' + MemberId)
							#在消费记录表里增加一条消费记录
							n = cur.execute('INSERT INTO fl_member_spending (MemberId,SpendItemId,SpendingSum,CheckTime,Auditor,SpenddMode,Type) VALUES(' + MemberId + ',' + SpendItemId + ',-' + str(Bid) + ',' + str(t) + ',0,"' + OperationName + '",1)')
							#更新推广审核表状态为成功和增加一天
							n = cur.execute('update fl_spread_check set Checked=' + OK + ',Days=Days+1 where SpreadId=' + SpreadId)
							i += 1
							if i >= TopNum:
								break

	#将审核表中状态为1的精准推广，在信息表中的修改权重
	sql = 'select IsSpread,ClassTable,ClassTableId from fl_spread_check where ' + SQL_TYPE + ' and Checked=' + OK
	n = cur.execute(sql)
	for row in cur.fetchall():
		TableName = row['ClassTable'].replace('FlInfo','fl_info_')
		TableName = TableName.lower()	#转换为小写
		IsSpread = str(row['IsSpread'])
		InfoId = str(row['ClassTableId'])
		sql = 'update ' + TableName + ' set IsSpread=' + IsSpread + ' where InfoId=' + InfoId
		m = cur.execute(sql)
	
	#将所有状态为1的精准推广复制到推广表中
	sql = 'insert into fl_spread(' + ziduan + ') select ' + ziduan + ' from fl_spread_check where ' + SQL_TYPE + ' and Checked=' + OK
	n = cur.execute(sql)

cur.close()
conn.close()