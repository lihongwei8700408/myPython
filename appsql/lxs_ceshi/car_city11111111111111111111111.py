#!/usr/bin/python
# -*- coding: utf-8 -*-
import json, urllib
from urllib import urlencode
 
#----------------------------------
# ȫ������Υ�µ���ʾ������ �� �ۺ�����
# ���߽ӿ��ĵ���http://www.juhe.cn/docs/36
#----------------------------------
 
def main():
 
    #�����������APPKey
    appkey = "d89a44539c5ef9c0097f060004c4f39b"
 
    #1.��ȡ֧�ֳ��в����ӿ�
    request1(appkey,"GET")
 
    #2.����Υ�²�ѯ�ӿ�
    #request2(appkey,"GET")
 
    #3.�ӿ�ʣ�����������ѯ
    #request3(appkey,"GET")
 
 
 
#��ȡ֧�ֳ��в����ӿ�
def request1(appkey, m="GET"):
    url = "http://v.juhe.cn/wz/citys"
    params = {
        "province" : "", #Ĭ��ȫ����ʡ�ݼ�д���磺ZJ��JS
        "dtype" : "", #�������ݸ�ʽ��json��xml��jsonp,Ĭ��json
        "format" : "", #��ʽѡ��1��2��Ĭ��1
        "callback" : "", #���ظ�ʽѡ��jsonpʱ�����봫��
        "key" : appkey, #�������key
 
    }
    params = urlencode(params)
    if m =="GET":
        f = urllib.urlopen("%s?%s" % (url, params))
    else:
        f = urllib.urlopen(url, params)
 
    content = f.read()
    res = json.loads(content)
    if res:
        error_code = res["error_code"]
        if error_code == 0:
            #�ɹ�����
			json.dump(res['result'], open('carcity.py', 'a'))
        else:
            print "%s:%s" % (res["error_code"],res["reason"])
    else:
        print "request api error"
 
#����Υ�²�ѯ�ӿ�
def request2(appkey, m="GET"):
    url = "http://v.juhe.cn/wz/query"
    params = {
        "dtype" : "", #�������ݸ�ʽ��json��xml��jsonp,Ĭ��json
        "callback" : "", #���ظ�ʽѡ��jsonpʱ�����봫��
        "key" : appkey, #�������key
        "city" : "", #���д��� *
        "hphm" : "", #���ƺ��� ����7λ ,��Ҫutf8 urlencode*
        "hpzl" : "", #�������ͣ�Ĭ��02
        "engineno" : "", #�������� (���ݳ��нӿ��еĲ�����д)
        "classno" : "", #���ܺ� (���ݳ��нӿ��еĲ�����д)
 
    }
    params = urlencode(params)
    if m =="GET":
        f = urllib.urlopen("%s?%s" % (url, params))
    else:
        f = urllib.urlopen(url, params)
 
    content = f.read()
    res = json.loads(content)
    if res:
        error_code = res["error_code"]
        if error_code == 0:
            #�ɹ�����
            print res["result"]
        else:
            print "%s:%s" % (res["error_code"],res["reason"])
    else:
        print "request api error"
 
#�ӿ�ʣ�����������ѯ
def request3(appkey, m="GET"):
    url = "http://v.juhe.cn/wz/status"
    params = {
        "key" : appkey, #Ӧ��APPKEY(Ӧ����ϸҳ��ѯ)
        "dtype" : "", #�������ݵĸ�ʽ,xml��json��Ĭ��json
 
    }
    params = urlencode(params)
    if m =="GET":
        f = urllib.urlopen("%s?%s" % (url, params))
    else:
        f = urllib.urlopen(url, params)
 
    content = f.read()
    res = json.loads(content)
    if res:
        error_code = res["error_code"]
        if error_code == 0:
            #�ɹ�����
            print res["result"]
        else:
            print "%s:%s" % (res["error_code"],res["reason"])
    else:
        print "request api error"
 
 
 
if __name__ == '__main__':
    main()