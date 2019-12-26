<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/** @var \Illuminate\Support\Facades\Route $router */

$router->post('/register', 'UserController@store');

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/establishments[/{relationships}]', [
        'as' => 'establishments.index', 'uses' => 'EstablishmentController@index']);

    $router->get('/establishment/{id}[/{relationships}]', [
        'as' => 'establishments.show', 'uses' => 'EstablishmentController@show']);

    $router->post('/establishment', [
        'as' => 'establishments.create', 'uses' => 'EstablishmentController@store']);

    $router->delete('/establishment/{id}', [
        'as' => 'establishments.delete', 'uses' => 'EstablishmentController@destroy']);

    $router->put('/establishment/{id}', [
        'as' => 'establishments.update', 'uses' => 'EstablishmentController@update']);

    $router->get('/users[/{relationships}]', [
        'as' => 'users.index', 'uses' => 'UserController@index']);

    $router->get('/user/{id}[/{relationships}]', [
        'as' => 'users.show', 'uses' => 'UserController@show']);

    $router->post('/users', [
        'as' => 'users.create', 'uses' => 'UserController@store']);

    $router->delete('/user/{id}', [
        'as' => 'users.delete', 'uses' => 'UserController@destroy']);

    $router->put('/user/{id}', [
        'as' => 'users.update', 'uses' => 'UserController@update']);

    $router->get('/orders[/{relationships}]', [
        'as' => 'orders.index', 'uses' => 'OrderController@index']);

    $router->get('/order/{id}[/{relationships}]', [
        'as' => 'orders.show', 'uses' => 'OrderController@show']);

    $router->post('/order', [
        'as' => 'orders.create', 'uses' => 'OrderController@store']);

    $router->delete('/order/{id}', [
        'as' => 'orders.delete', 'uses' => 'OrderController@destroy']);

    $router->put('/order/{id}', [
        'as' => 'orders.update', 'uses' => 'OrderController@update']);

    $router->get('/products[/{relationships}]', [
        'as' => 'products.index', 'uses' => 'ProductController@index']);

    $router->get('/product/{id}[/{relationships}]', [
        'as' => 'products.show', 'uses' => 'ProductController@show']);

    $router->post('/product', [
        'as' => 'products.create', 'uses' => 'ProductController@store']);

    $router->delete('/product/{id}', [
        'as' => 'products.delete', 'uses' => 'ProductController@destroy']);

    $router->put('/product/{id}', [
        'as' => 'products.update', 'uses' => 'ProductController@update']);

    $router->get('/coupons[/{relationships}]', [
        'as' => 'coupons.index', 'uses' => 'CouponController@index']);

    $router->get('/coupon/{id}[/{relationships}]', [
        'as' => 'coupons.show', 'uses' => 'CouponController@show']);

    $router->post('/coupon', [
        'as' => 'coupons.create', 'uses' => 'CouponController@store']);

    $router->delete('/coupon/{id}', [
        'as' => 'coupons.delete', 'uses' => 'CouponController@destroy']);

    $router->put('/coupon/{id}', [
        'as' => 'coupons.update', 'uses' => 'CouponController@update']);

    $router->get('/categories[/{relationships}]', [
        'as' => 'categories.index', 'uses' => 'CategoryController@index']);

    $router->get('/category/{id}[/{relationships}]', [
        'as' => 'categories.show', 'uses' => 'CategoryController@show']);

    $router->post('/category', [
        'as' => 'categories.create', 'uses' => 'CategoryController@store']);

    $router->delete('/category/{id}', [
        'as' => 'categories.delete', 'uses' => 'CategoryController@destroy']);

    $router->put('/category/{id}', [
        'as' => 'categories.update', 'uses' => 'CategoryController@update']);

    $router->get('/addresses[/{relationships}]', [
        'as' => 'addresses.index', 'uses' => 'AddressController@index']);

    $router->get('/address/{id}[/{relationships}]', [
        'as' => 'addresses.show', 'uses' => 'AddressController@show']);

    $router->post('/address', [
        'as' => 'addresses.create', 'uses' => 'AddressController@store']);

    $router->delete('/address/{id}', [
        'as' => 'addresses.delete', 'uses' => 'AddressController@destroy']);

    $router->put('/address/{id}', [
        'as' => 'addresses.update', 'uses' => 'AddressController@update']);

});
