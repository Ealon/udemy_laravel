<?php
// php artisan make:model Post -m  // -m would create a migration
// php artisan make:model Post
namespace App;

use Illuminate\Database\Eloquent\Model; // ctrl+click 'Model' to check out
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  
  // protected $table = 'posts';
  // protected $primaryKey = 'post_id';

  protected $fillable = [
    'title',
    'content'
  ];

}
