#!/usr/lib64/python2.6
#coding=utf-8
#红包加油卡计划任务

import MySQLdb
import time
import datetime
import pycurl
import urllib2
import urllib
try:
	conn=MySQLdb.connect(host='127.0.0.1',user='root',passwd='123456',db='oilactivity',port=3306,charset='utf8')
	cur=conn.cursor(cursorclass=MySQLdb.cursors.DictCursor)
except MySQLdb.Error,e:
	print 'Mysql connect error.'
	exit()
d = datetime.date.today() - datetime.timedelta(days=1)
y = datetime.date.today() - datetime.timedelta(days=2)
q = int(time.mktime(y.timetuple()))
z = int(time.mktime(d.timetuple()))
j = int(time.mktime(datetime.date.today().timetuple()))

def curlget(tel,vb):
	"同步积分给江西"
	url = 'http://tapi.clejw.com/weixin/modifyUserPoint.do?content={"tel":"'+str(tel)+'","vb":"'+str(vb)+'","op":"add","tp":"profit"}'
	c = pycurl.Curl()
	c.setopt(c.URL, url)
	d = c.perform()

def pageaverag(page):
	"页面停留时间"
	sqlpage = 'SELECT * FROM cl_page_logintime where PageName = "'+page+'" AND LoginTime between '+str(z)+' AND '+str(j)
	pn = cur.execute(sqlpage)
	if pn >0:
		resultpage = cur.fetchall()
		stay = 0
		for row in resultpage:
			pagein = row['LoginTime']
			pageout = row['LogoutTime']
			staytime = pagein - pageout
			stay += staytime
		#单位是分钟
		avertime = stay/pn/1000/60
	else:
		avertime = 0
	return avertime	
def peopletimes(page):
	"页面停留访问人次"
	sqlpage = 'SELECT COUNT(Id) as count FROM cl_page_logintime where PageName = "'+page+'" AND LoginTime >= '+str(z)+' AND LoginTime < '+str(j)
	pn = cur.execute(sqlpage)
	if pn >0:
		result = cur.fetchone()
		print result['count']
		return result['count']
	else:
		return 0
# 查询访问活动总人数
sql = 'SELECT COUNT(DISTINCT MemberId) as count FROM cl_page_logintime where LoginTime >= '+str(z)+' AND LoginTime < '+str(j)
try:
	# 执行SQL语句
	cur.execute(sql)
	# 获取所有记录列表
	result1 = cur.fetchone()
	#print results
	num = result1['count']
	# 打印结果
	print num
except:
	print "Error: unable to fecth data"

# 查询立即充油人数
sql1 = 'SELECT MemberId FROM cl_member where CreatTime >= '+str(z)+' AND CreatTime < '+str(j)+' AND State = 1' 
try:
	# 执行SQL语句
	zn = cur.execute(sql1)
	print zn
	# 获取所有记录列表
	buynum = 0
	buyrate = '0%'
	if zn > 0:
		result2 = cur.fetchall()
		for row in result2:
			mid = row['MemberId']
			sql11 = 'SELECT COUNT(Id) as count FROM cl_oil_order where MemberId ='+str(mid)+' AND LastTime >= '+str(z)+' AND LastTime < '+str(j)
			cur.execute(sql11)
			result11 = cur.fetchone()
			cn = result11['count']
			if cn > 1:
				buynum +=1
		print buynum
		if num == 0:
			buyrate = '0%'
		else:
			buyrate = format(float(buynum)/num, '.2%')
		print buyrate
except:
	print "Error: unable to fecth data"

# 插入立即购统计表
sql2 = 'INSERT INTO cl_timelybug_static(Time,VisitNum,ChargeNum,Rate) VALUES ('+str(z)+','+str(num)+','+str(buynum)+',"'+buyrate+'")'
try:
	cur.execute(sql2)
except:
	print "Error: unable to insert cl_timelybug_static"
#立即充油统计结束

#统计关注人数
sql3 = 'SELECT COUNT(MemberId) as count FROM cl_member where CreatTime >= '+str(z)+' AND CreatTime < '+str(j)+' AND State = 1'
try:
	# 执行SQL语句
	cur.execute(sql3)
	# 获取所有记录列表
	result3 = cur.fetchone()
	#print results
	fannum = result3['count']
	# 打印结果
	print fannum
	if num == 0:
		fanrate = '0%'
	else:
		fanrate =  format(float(fannum)/num, '.2%')
	print fanrate  
except:
	print "Error: unable to fecth data"
#入表粉丝统计表
sql4 = 'INSERT INTO cl_fannum_static(Time,VisitNum,FanNum,Rate) VALUES ('+str(z)+','+str(num)+','+str(fannum)+',"'+fanrate+'")'
try:
	cur.execute(sql4)
   
except:
	print "Error: unable to insert cl_fannum_static"

# 查询微信访问总人数
sqlw = 'SELECT COUNT(DISTINCT MemberId) as count FROM cl_page_logintime where LoginTime >= '+str(z)+' AND LoginTime < '+str(j)+' AND PageName !="activityIndex" AND PageName !="activityReSuccess"'
try:
	# 执行SQL语句
	cur.execute(sqlw)
	# 获取所有记录列表
	resultw = cur.fetchone()
	#print results
	numwin = resultw['count']
	# 打印结果
	print numwin
except:
	print "Error: unable to fecth data"

#微信访问人数统计
#入表cl_weixin_static操作
sql5 = 'INSERT INTO cl_weixin_static(Time,VisitNum) VALUES ('+str(z)+','+str(numwin)+')'
try:
	cur.execute(sql5)
except:
	print "Error: unable to insert cl_weixin_static"

#第二天活跃人数统计要在第二天开放此计划任务
#前一天注册总人数
sql6 = 'SELECT COUNT(MemberId) as count FROM cl_member where CreatTime >= '+str(q)+' AND CreatTime < '+str(z)+' AND State = 1'
try:
	# 执行SQL语句
	cur.execute(sql6)
	# 获取所有记录列表
	result6 = cur.fetchone()
	#print results
	fannums = result6['count']
	sql = 'SELECT MemberId FROM cl_member where CreatTime > '+str(q)+' AND CreatTime < '+str(z)+' AND State = 1'
	sn = cur.execute(sql)
	result = cur.fetchall()
	if sn >0:
		smid='('
		for row in result:
			smid = smid + str(row['MemberId']) + ','
		smid = smid[:-1]
		smid = smid + ')'
	else:
		smid = '(0001)'
	# 打印结果
	print fannums
except:
	print "Error: unable to fecth data"
#页面访问人次统计
try:
	l = ['turntablePage','activityIndex','rechargeRecord','activityReSuccess','scratchCardProfit','gold','oilCardRecharge']
	for val in l:
		p = peopletimes(val)
		print p
		#入表cl_page_peopletimes_static
		sql = 'INSERT INTO cl_page_peopletimes_static(Time,PageName,PeopleTimes) VALUES ('+str(z)+',"'+val+'",'+str(p)+')'
		try:
			n = cur.execute(sql)
		except:
			continue
		
except:
	print "Error: unable to do pagetime"
#注册后第二天活跃总人数
sql7 = 'SELECT COUNT(DISTINCT MemberId) as count FROM cl_page_logintime where LoginTime >= '+str(z)+' AND LoginTime < '+str(j)+' AND MemberId IN '+smid
try:
	# 执行SQL语句
	cur.execute(sql7)
	# 获取所有记录列表
	result7 = cur.fetchone()
	#print results
	secondnum = result7['count']
	# 打印结果
	print secondnum
	if fannums == 0:
		secondrate = '0%'
	else:
		secondrate = format(float(secondnum)/fannums, '.2%')
	print secondrate
 
except:
	print "Error: unable to fecth data"

#入表cl_secondday_rate_static统计表
sql8 = 'INSERT INTO cl_secondday_rate_static(Time,RegisteNum,AgainNum,Rate) VALUES ('+str(z)+','+str(fannums)+','+str(secondnum)+',"'+secondrate+'")'
try:
	cur.execute(sql8)
except:
	print "Error: unable to insert cl_secondday_rate_static"

#一周活跃率统计
sqlw = 'SELECT COUNT(Id) as count FROM cl_secondday_rate_static'
try:
	n = cur.execute(sqlw)
	result = cur.fetchone()
	c = result['count']
	if c == 7:
		sql = 'SELECT SUM(RegisteNum) as count1 FROM cl_secondday_rate_static'
		n = cur.execute(sql)
		result = cur.fetchone()
		sum1 = result['count1']
		print sum1
		sqls = 'SELECT SUM(AgainNum) as count2 FROM cl_secondday_rate_static'
		ns = cur.execute(sqls)
		results = cur.fetchone()
		sum2 = results['count2']
		print sum2
		if sum1 == 0:
			r = '0%'
		else:
			r = format(float(sum2)/float(sum1), '.2%')
		sqlm = 'INSERT INTO cl_lastweek_static(Week,RegisteNum,AgainNum,Rate) VALUES ("第一周",'+str(sum1)+','+str(sum2)+',"'+r+'")'
		x = cur.execute(sqlm)
		print x
except:
	print "Error: unable to static week"
#更新登录天数
sqlday = 'SELECT MemberId FROM cl_member where CreatTime >= '+str(z)+' AND CreatTime < '+str(j)+' AND State = 1'
try:
	# 执行SQL语句
	zn = cur.execute(sqlday)
	print zn
	# 获取所有记录列表
	if zn > 0:
		result2 = cur.fetchall()
		for row in result2:
			mid = row['MemberId']
			sql11 = 'SELECT COUNT(Id) as count FROM cl_page_logintime where MemberId ='+str(mid)+' AND LoginTime >= '+str(z)+' AND LoginTime < '+str(j)
			cur.execute(sql11)
			result11 = cur.fetchone()
			cn = result11['count']
			if cn >= 1:
				sql2 = 'UPDATE cl_member SET LoginDay = LoginDay + 1 where MemberId = '+str(mid)
				n = cur.execute(sql2)
				if n <= 0:
					continue
				
		
except:
	print "Error: unable to update data"
#加油金额统计
#总金额
sqlm = 'SELECT SUM(Price) as sum FROM cl_oil_order where OrderState = 2 AND (OilPayState = 1 OR OilPayState = 3) AND LastTime >= '+str(z)+' AND LastTime < '+str(j)
try:
	# 执行SQL语句
	zn = cur.execute(sqlm)
	print zn
	r = cur.fetchone()
	money = r['sum']
	print money
	if money > 0:
		sql = 'SELECT SUM(UsePoint) as sum FROM cl_oil_order where OrderState = 2 AND (OilPayState = 1 OR OilPayState = 3) AND LastTime >= '+str(z)+' AND LastTime < '+str(j)
		n = cur.execute(sql)
		r = cur.fetchone()
		jifen = r['sum']
		print jifen
		sql = 'SELECT COUNT(DISTINCT MemberId) as count FROM cl_oil_order where OrderState = 2 AND (OilPayState = 1 OR OilPayState = 3) AND LastTime >= '+str(z)+' AND LastTime < '+str(j)
		n = cur.execute(sql)
		r = cur.fetchone()
		pn = r['count']
		print pn
		onlymoney = money - jifen
		print onlymoney
		sql = 'INSERT INTO cl_oilcharge_static(Time,Money,PeopleNum,OilMoney,TotalMoney) VALUES ('+str(z)+','+str(onlymoney)+','+str(pn)+','+str(jifen)+','+str(money)+')'
		cur.execute(sql)
except:
	print "Error: unable to update data"
# 关闭数据库连接
conn.close()

