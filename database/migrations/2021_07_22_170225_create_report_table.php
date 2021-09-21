<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('signature_id');
            $table->date('date');
            $table->unsignedInteger('overall_rating')->default(0);
            $table->text('supervisor_comment')->nullable();
            $table->text('site_admin_comment')->nullable();
            $table->text('creator_comment')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('site')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('signature_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
