# Basic Example of Connection to JOA API with PHP

It makes use of "thephppleague / oauth2-client" under Laravel framework.

1. Laravel 5.5
2. thephphpleague / oauth2-client

## Install
Clone the project using Git:
```
/www$ git clone https://github.com/yoovtest/joaapidemo
/www$ cd joaapidemo
/www/joaapidemo$
```
Install required packages using [Composer](https://getcomposer.org/)
   
    /www/joaapidemo$ composer install
   
Make a copy of .env from .env.example

    /www/joaapidemo$ cp .env.example .env
	
Edit ~/.env:
```
/www/joaapidemo$ vi .env
```

Assume your OAuth credentials provided by API provider as below:

Field | Value
--- | ---
client_id | abcd-12345
secret | 123456-abcd-efgh-ijkl-7890abc
scope | oa:team:read, oa:employee:read
grant type | authorization code
issuer | [https://passport.yoov.com/auth/realms/yoov]()
authorize Url | https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/auth
token Url | https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/token
host | https://www.xxxx.com

Update the OAuth Credentials at the end of the file
```
YOOV_CLIENT_ID='**abcd-12345**'
YOOV_CLIENT_SECRET='123456-abcd-efgh-ijkl-7890abc'
YOOV_REDIRECT_URI='https://www.xxxx.com/implicit/callback'
YOOV_URL_AUTHORIZE='https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/auth'
YOOV_URL_ACCESS_TOKEN='https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/token'
YOOV_URL_RESOURCE_OWNER_DETAILS=''
YOOV_SCOPES='oa:team:read, oa:employee:read'
```
It is important to note that the credentials is binded with host. It must be exactly as that confirmed by provider.

Generate application key:
It is a key required for each Laravel application.

```
/www/joaapidemo$ php artisan key:generate
```

Output:
```
Application key [base64:0AKzB3gQo5sw6QQ2aEFZ7bVMtFk7aTRJhpwTwLRoLwc=] set successfully.
```

### Routes

```
~/App/routes/web.php
```

Route | Description
--- | ---
https://www.xxxx.com/ | Entry url to connect with authorization server
https://www.xxxx.com/implicit/callback | Passive route to receive token from authorization server
https://www.xxxx.com/teams | Route to display team list. (It is the destination of redirection after token is received)

### Start

In browser, enter the url:
```
https://www.xxxx.com
```

It will be redirected to YOOV Login Page.

![](https://drive.google.com/uc?export=view&id=1T-hAHtmJK7KNZkCFoQ0VZJQTz5bPkDVS)

 After login, it will be redirected to https://www.xxxx.com/implicit/callback.
 
 ![](https://drive.google.com/uc?export=view&id=1MlWtud5lduqX6dO3wqiuvmylGwE_rS0z)
 
------------
