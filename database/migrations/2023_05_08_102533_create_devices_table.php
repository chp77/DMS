<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->longText('uuid');
            $table->string('token');
            $table->integer('user_id');
            $table->integer('group_id')->nullable();
            $table->string('name');
            $table->json('tags')->nullable();
            $table->string('serial_number');
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_online')->default(0);
            $table->string('modal_brand');
            $table->string('os');
            $table->string('os_version');
            $table->string('firmware_version');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
