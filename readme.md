# Basic Example of Connection to JOA API with PHP

It makes use of "thephppleague/oauth2-client" under Laravel framework.

1. Laravel 5.5
2. thephphpleague/oauth2-client

When you install this project, the above two items have been included.

* It is assumed you are familiar with the following technology:
```
1. Laravel
2. PHP
3. Web Server (Apache or Nginx)
```

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
scope | abc:read, def:read
grant type | grant_type
issuer | https:/<span>/www.a</span>bc.com/auth/realms/abc
authorize Url | https:/<span>/www.a</span>bc.com/auth/realms/abc/protocol/openid-connect/auth
token Url | https:/<span>/www.a</span>bc.com/auth/realms/abc/protocol/openid-connect/token
host | https:/<span>/www.x</span>xxx.com

Update the OAuth Credentials at the end of the file
```
YOOV_CLIENT_ID='abcd-12345'
YOOV_CLIENT_SECRET='123456-abcd-efgh-ijkl-7890abc}'
YOOV_REDIRECT_URI='https://www.xxxx.com/implicit/callback'
YOOV_URL_AUTHORIZE='https://www.abc.com/auth/realms/abc/protocol/openid-connect/auth'
YOOV_URL_ACCESS_TOKEN='https://www.abc.com/auth/realms/abc/protocol/openid-connect/token'
YOOV_URL_RESOURCE_OWNER_DETAILS=''
YOOV_SCOPES='abc:read, def:read'
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


### Update to vhost settings of your web server

Ensure you can reach ther web page via the entry url. (http<span>s://w</span>ww.xxxx.com in this example)

#### Example for Nginx
/etc/nginx/sites-available/joaapidemo
```
server {
    listen 80;
    listen 443 ssl http2;
    server_name www.xxxx.com;
    root "/var/www/joaapidemo/public";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
        if ($request_method = 'OPTIONS') {
                add_header 'Access-Control-Allow-Origin' '*' always;
                add_header 'Access-Control-Allow-Methods' 'GET, POST, DELETE, PUT';
                add_header 'Access-Control-Allow-Headers' 'DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-requested-With,If-Modified-Since,Cache-Control,Content-Type,Authorization,X-Auth-Token,Origin';
                add_header 'Access-Control-Max-Age' 1728000;
                add_header 'Content-Type' 'text/plain charset=UTF-8';
                add_header 'Content-Length' 0;
		return 204;
        }
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/joaapidemo-error.log error;

    sendfile off;

    client_max_body_size 100m;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;


        fastcgi_intercept_errors off;
	fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }

    location ~ /\.ht {
        deny all;
    }

```

### Start

In browser, enter the url:
```
https://www.xxxx.com
```

It will be redirected to YOOV Login Page.

![](https://drive.google.com/uc?export=view&id=1T-hAHtmJK7KNZkCFoQ0VZJQTz5bPkDVS)

 After login, it will be redirected to https://<span></span>www<span>.xxxx.</span>com/implicit/callback.
 
 ![](https://drive.google.com/uc?export=view&id=1i8NhYwDTl3wiu2R_r7QulX3vUs0y3Uwq)
 
 ### Next
 
 Use debugger in Chrome during access to https://joa.yoov.com.
 Check how each API url being used.
 
 In this project, Team access function and Logout function are given as an example. You can study the following files for the operation.:
 ```
 ~/App/Http/Controllers/HomeController.php
 ~/resources/views/home.blade.php
 ~/App/routes/web.php
 ```
 
 
 
------------
