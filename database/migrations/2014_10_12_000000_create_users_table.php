<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();  // Thêm trường avatar
            $table->enum('gender', ['male', 'female', 'other'])->default('other'); // Thêm trường giới tính
            $table->text('address')->nullable();  // Thêm trường địa chỉ
            $table->string('phone', 20)->nullable()->unique(); // Thêm trường số điện thoại
            $table->tinyInteger('status')->default(1); // Trạng thái
            $table->tinyInteger('role')->default(0);  // Vai trò (0 = user, 1 = admin)
            $table->timestamps();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}