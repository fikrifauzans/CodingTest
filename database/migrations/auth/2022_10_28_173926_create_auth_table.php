<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('master_menus');
        Schema::dropIfExists('menu_details');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_access');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('espresences');

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->integer('npp')->nullable();
            $table->integer('supervisor_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('permission_access', function (Blueprint $table) {
            $table->id();
            $table->integer('permission_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->boolean('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('master_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->tinyInteger('status')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('menu_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('parent_id')->nullable()->default(null);
            $table->tinyInteger('menu_id')->nullable()->default(null);
            $table->tinyInteger('master_menu_id')->nullable()->default(null);
            $table->tinyInteger('sort')->nullable()->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('master_menu_id')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('status')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('espresences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('is_aprove')->nullable();
            $table->timestamp('date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('master_menus');
        Schema::dropIfExists('menu_details');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_access');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('espresences');
    }
};
