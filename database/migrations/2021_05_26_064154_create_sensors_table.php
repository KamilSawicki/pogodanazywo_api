<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('city');
            $table->text('zip_code');
            $table->text('api_key');
            $table->integer('above_see');
            $table->foreignUuid('created_by')->nullable()->references('id')->on('users');
            $table->foreignUuid('updated_by')->nullable()->references('id')->on('users');
            $table->foreignUuid('delete_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors');
    }
}
