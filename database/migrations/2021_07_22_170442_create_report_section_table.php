<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('report_section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('site_section_id')->nullable();
            $table->string('section_name');
            $table->tinyInteger('rating')->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('report')->onDelete('cascade');
            $table->foreign('site_section_id')->references('id')->on('site_section')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_section');
    }
}
