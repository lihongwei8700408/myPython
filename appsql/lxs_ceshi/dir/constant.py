#定义常量
class ConstError(Exception): pass

class _const(object):
    def __setattr__(self, k, v): 
        if k in self.__dict__:
            raise ConstError
        else:
            self.__dict__[k] = v 

const = _const()

const.HOST="127.0.0.1"
const.USER="root"
const.PASSWD="123456"
const.DB="apps_data"
const.CHARSET="utf8"
# const.TOKEN="weixin"
# const.APPID="wxa53f3f90c64f4d87"
# const.APPSECRET="62c421de3451dccc25b73aa3b7229c47"
# const.ACCESS_TOKEN_FILE= "/var/www/html/text/ce/access_token.json"
# const.DOMAIN="weixin.clejw.com"
# const.ACCESS_TOKEN_REQUIRE='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='+(const.APPID)+'&secret='+(const.APPSECRET)

# print(name)
# const.OLD_FANS_INFO_GET='https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN'
# const.AUTH_GET='https://api.weixin.qq.com/sns/oauth2/access_token?appid='+(const.APPID)+'&secret='+(const.APPSECRET)+'&code=%s&grant_type=authorization_code'
# const.AUTH_INFO_GET='https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN'
