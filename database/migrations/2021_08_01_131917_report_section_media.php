<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportSectionMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_section_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_section_id');
            $table->unsignedBigInteger('media_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('report_section_id')->references('id')->on('report_section')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_section_media');
    }
}
