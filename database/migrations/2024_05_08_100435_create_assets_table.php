<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('type');
            $table->string('customer_order_number');
            $table->string('serial_number')->nullable();
            $table->string('mac_address');
            $table->string('brand');
            $table->string('model');
            $table->string('sku');
            $table->string('qa_video_url')->nullable();
            $table->timestamp('manufacture_date')->nullable();
            $table->string('warranty_period');
            $table->timestamp('warranty_started_date')->nullable();
            $table->timestamp('warranty_expiry_date')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->json('component_ids');
            $table->tinyInteger('is_csv_import')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->tinyInteger('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
