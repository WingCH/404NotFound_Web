<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('description');
            $table->string('step');
            $table->string('image_id');
            $table->string('user_id');
            $table->string('project_id');
            $table->string('status')->default('Processing');
            $table->timestamps();
        });
        //想加多一項
        // php artisan make:migration add_fire_to_bug_table --table="bugs"
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bug');
    }
}
