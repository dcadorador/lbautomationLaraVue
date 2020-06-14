<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfusionsoftLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infusionsoft_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('infusionsoft_account_id')->nullable();
            $table->string('app_name')->nullable();
            $table->string('auth_key')->nullable();
            $table->text('data')->nullable();
            $table->string('infusionsoft_results')->nullable();
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
        Schema::dropIfExists('infusionsoft_logs');
    }
}
