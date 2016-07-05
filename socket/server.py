#!/usr/lib64/python2.6
#coding=utf-8
from socket import *
from time import ctime

HOST = ''
PORT = 21568
BUFSIZ = 1024
ADDR = (HOST, PORT)

tcpSerSock = socket(AF_INET, SOCK_STREAM)
tcpSerSock.bind(ADDR)
tcpSerSock.listen(5)

while True:
	print 'waiting for connection...'
	tcpCliSock, addr = tcpSerSock.accept() 
	print '...connected from:', addr

	while True:
		try:
			data = tcpCliSock.recv(BUFSIZ) 
			print '<', data
			tcpCliSock.send('[%s] %s' % (ctime(), data)) 
		except:
			print 'disconnect from:', addr
			tcpCliSock.close() 
			break
tcpSerSock.close()