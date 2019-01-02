# Laravel User types - Admin/User

This package create user types like Simple user, Admin and Super Admin.

## Installation

You can install the package via composer:

``` bash
composer require mohit/usertype
php artisan vendor:publish --provider="mohit\usertype\UsertypeProvider"
php artisan migrate
```
## Create Admin User

``` bash
php artisan create:admin
```
It will ask you to enter name, email and password. Then you can login with entered email and password.

## Create Super Admin User

Super Admin user have roles of accessing admin pages as well as user pages.

``` bash
php artisan create:super
```
It will ask you to enter name, email and password. Then you can login with entered email and password.

## Usage
This package creates and registeres new middleware which you can use in routes file. You can assign middleware to either group of routes or individual routes.

For admin,

```php
Route::group(['middleware' => 'authorize:admin'], function(){
    //
});
```
For user,

```php
Route::group(['middleware' => 'authorize:user'], function(){
    //
});
```
For super admin,

```php
Route::group(['middleware' => 'authorize:admin|user'], function(){
    //
});
```

## Using In Blades

```php
@if(auth()->user()->type == 'admin')
  //
@endif
```

## Styling Unauthorized page

When any user try to access page for which he is not authorized then it will redirect him to unauthorized page. This page follow bootstrap structure. You can style this page by creating new css file under 'public/css/unauthorized.css'.