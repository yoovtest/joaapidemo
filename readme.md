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
Install required packages using Composer
```
/www/joaapidemo$ composer install
```
Make a copy of .env from .env.example
```
/www/joaapidemo$ copy .env.example .env
```
Edit ~/.env:
```
/www/joaapidemo$ vi .env
```
Update the OAuth Credentials at the end of the .env
```
YOOV_CLIENT_ID='abcd-1234'
YOOV_CLIENT_SECRET='123456-abcd-efgh-ijkl-7890abc'
YOOV_REDIRECT_URI='https://www.xxxx.com/implicit/callback'
YOOV_URL_AUTHORIZE='https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/auth'
YOOV_URL_ACCESS_TOKEN='https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/token'
YOOV_URL_RESOURCE_OWNER_DETAILS=''
YOOV_SCOPES='oa:team:read, oa:employee:read'
```
Assume your OAuth credentials provided by API provider as below:
client_id | abcd-1234
--------- | ---------
secret | 123456-abcd-efgh-ijkl-7890abc
scope | oa:team:read, oa:employee:read
grant type | authorization code
issuer | https//passport.yoov.com/auth/realms/yoov
authorize Url | https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/auth
token Url | https://passport.yoov.com/auth/realms/yoov/protocol/openid-connect/token
host | https://www.xxxx.com

It is important to note that the host used in YOOV_REDIRECT_URI must be exactly the same as that provided.
Then you can give it by appending the route you wnat to use:
```
https://www.xxxx.com/callback
https://www.xxxx.com/implicit/callback
https://www.xxxx.com/myroute
...
```
Edit ~/App/Routes:

Edit App/Http/Controllers/HomeController
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
