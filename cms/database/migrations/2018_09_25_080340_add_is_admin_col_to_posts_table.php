<?php

// php artisan make:migration add_is_admin_col_to_posts_table --table="posts"
// php artisan migrate:rollback
// php artisan migrate

// check info at https://laravel.com/docs/5.7/migrations

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminColToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->integer('is_admin')->unsigned()->default(0); // unsigned means it can be negative
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->dropColumn('is_admin');
        });
    }
}
