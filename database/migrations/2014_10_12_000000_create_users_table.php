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
            $table->string('password')->nullable();

            $table->string('google_id')->nullable();
            $table->integer('todoist_id')->nullable();

            $table->text('google_access_token')->nullable();
            $table->text('google_refresh_token')->nullable();
            $table->timestamp('google_access_token_expires_at')->nullable();

            $table->string('todoist_access_token')->nullable();

            $table->boolean('sync_enabled')->default(0);
            $table->string('timezone')->nullable();

            $table->boolean('todoist_disable_reminders')->default(0);
            $table->string('google_reminders')->default(\App\Enums\GoogleRemoveSetting::IMMEDIATE);

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
