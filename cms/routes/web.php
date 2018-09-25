<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
  return 'about page';
});

Route::get('/contact', function () {
  return 'contact page';
});

// route with parameter
Route::get('/post/{id}', function ($id) {
  return 'post ID: '. $id;
});

// route with multiple parameter
Route::get('/post/{id}/author/{name}', function ($id, $name) {
  return 'post ID: '. $id.', author name: '. $name;
});


// use nickname
Route::get('/it/is/a/very/long/url', array('as'=>'url.instead', function () {
  $url = route('url.instead');
  return 'The Url is: '. $url;
}));
// go to http://127.0.0.1:8000/it/is/a/very/long/url to check out



/*

~/code/udemy/laravel/cms$ php artisan route:list
+--------+----------+-------------------------+-------------+---------+--------------+
| Domain | Method   | URI                     | Name        | Action  | Middleware   |
+--------+----------+-------------------------+-------------+---------+--------------+
|        | GET|HEAD | /                       |             | Closure | web          |
|        | GET|HEAD | about                   |             | Closure | web          |
|        | GET|HEAD | api/user                |             | Closure | api,auth:api |
|        | GET|HEAD | contact                 |             | Closure | web          |
|        | GET|HEAD | it/is/a/very/long/url   | url.instead | Closure | web          |
|        | GET|HEAD | post/{id}               |             | Closure | web          |
|        | GET|HEAD | post/{id}/author/{name} |             | Closure | web          |
+--------+----------+-------------------------+-------------+---------+--------------+

*/