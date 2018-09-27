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


// Route::get('/post/{id}', 'PostController@index');

Route::resource('/posts', 'PostController');
/* ---------------------------------------
+--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
| Domain | Method    | URI               | Name          | Action                                      | Middleware  |
+--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
|        | GET|HEAD  | /                 |               | Closure                                     | web  |
|        | GET|HEAD  | api/user          |               | Closure                                     | api,auth:api |
|        | GET|HEAD  | posts             | posts.index   | App\Http\Controllers\PostController@index   | web  |
|        | POST      | posts             | posts.store   | App\Http\Controllers\PostController@store   | web  |
|        | GET|HEAD  | posts/create      | posts.create  | App\Http\Controllers\PostController@create  | web  |
|        | GET|HEAD  | posts/{post}      | posts.show    | App\Http\Controllers\PostController@show    | web  |
|        | PUT|PATCH | posts/{post}      | posts.update  | App\Http\Controllers\PostController@update  | web  |
|        | DELETE    | posts/{post}      | posts.destroy | App\Http\Controllers\PostController@destroy | web  |
|        | GET|HEAD  | posts/{post}/edit | posts.edit    | App\Http\Controllers\PostController@edit    | web  |
+--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
--------------------------------------- */

Route::get('/post/{id?}/{name?}', 'PostController@showPost');


/* ---------------------------------------

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

--------------------------------------- */

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


/*
|--------------------------------------------------------------------------
| Database Raw SQL queries
|--------------------------------------------------------------------------
|
|
*/

Route::get('/insert', function(){
  DB::insert('insert into posts(title, content) values(?, ?)', ['PHP with laravel', 'Laravel is the best thing that happens to PHP']);
});

Route::get('/read', function(){
  $posts = DB::select('select * from posts where id=?', [1]);
  print_r($posts);
  foreach($posts as $post) {
    return $post->title;
  }
});

Route::get('/update', function(){
  $updated = DB::update('update posts set title ="updated title" where id=?', [1]);

  return $updated;
});

Route::get('/delete', function(){
  $deleted = DB::delete('delete from posts where id=?', [1]);

  return $deleted;
});