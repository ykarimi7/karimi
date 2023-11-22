<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_activities',

            function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->timestamp('online_at')->nullable();
                $table->timestamp('full_time_onlined')->nullable();
                $table->timestamp('offline_at')->nullable();
                $table->timestamps();

                $table
                    ->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}