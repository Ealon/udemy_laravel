<?php

use App\Post;

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


Route::get('/insert2/{title}/{content}', function($title, $content){
  DB::insert('insert into posts(title, content) values(?, ?)', [$title, $content]);
});


/*
|--------------------------------------------------------------------------
| Eloquent ORM
|--------------------------------------------------------------------------
*/


Route::get('/read1', function(){
  // $posts = App\Post;
  $posts = Post::all();
  // return $posts;
  foreach($posts as $post) {
    return $post->title;
  }

});

Route::get('/read2', function(){
  // $posts = App\Post;
  $post = Post::find(2);
  return $post->title;

});

Route::get('/find/{id}', function($id){
  // $post = Post::where('id', $id)->orderBy('id', 'desc')->take(1)->get();
  $post = Post::where('id', $id)->orderBy('id', 'desc')->get();
  return $post;
});

Route::get('/find2/{id}', function($id){
  // $posts = Post::findOrFail($id);
  // return $posts;

  // $posts = Post::where('user_count', '<', 50)->fistOrFail();

});

Route::get('/basic-insert/{title?}/{content?}', function($title='default title', $content='default content'){
  $post = new Post;
  $post->title = $title;
  $post->content = $content;

  $post->save();
});

/** ------------------------------
 * "create" accepts array, but the model needs to be configured by setting $fillable
 */
Route::get('/create', function(){
  Post::create([
    'title'=>'title create',
    'content'=>'content create'
    ]);
});

/**
 * update data
 */
Route::get('/update/{id}/{content?}', function($id, $content='here is the new content updated.'){
  Post::where('id', $id)->where('is_admin', 0)->update(['content'=>$content]);
});

/**
 * delete data
 */
Route::get('/delete/{id}', function($id){
  $post = Post::find($id);

  $post->delete();
});

/**
 * destroy data(accepts array)
 */
Route::get('/destroy', function(){
  // Post::destroy(3);
  Post::destroy([3,5]);
});

/**
 * sotf delete
 */
Route::get('/softdelete/{id}', function($id){
  Post::find($id)->delete();

});

/**
 * read those soft-deleted data
 */
Route::get('/readsoftdelete/{id}', function($id){
  // $post = Post::withTrashed()->where('id', $id)->get();
  /**
   * returns an array
   * 
   * [
   *   {"id": 2,
   *    "title": "title123",
   *    "content": "heyyoyoyoyo",
   *    "created_at": null,
   *    "updated_at": "2018-09-29 09:00:19",
   *    "is_admin": 0,
   *    "deleted_at": "2018-09-29 09:00:19"
   *   }
   * ]
   */
  // $post = Post::withTrashed()->find($id);
  /**
   * returns the object
   *   {"id": 2,
   *    "title": "title123",
   *    "content": "heyyoyoyoyo",
   *    "created_at": null,
   *    "updated_at": "2018-09-29 09:00:19",
   *    "is_admin": 0,
   *    "deleted_at": "2018-09-29 09:00:19"
   *   }
   */

  $post = Post::onlyTrashed()->where('is_admin', 0)->get();

  return $post;
});
