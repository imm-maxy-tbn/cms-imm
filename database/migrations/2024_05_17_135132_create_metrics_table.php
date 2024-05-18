<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('definition');
            $table->text('calculation');
            $table->text('usage_guidance');
            $table->boolean('social');
            $table->boolean('environmental');
            $table->string('section');
            $table->string('subsection');
            $table->integer('level_type')->default(1);
            $table->unsignedBigInteger('related_metrics_id')->nullable();
            $table->string('metric_level');
            $table->string('quantity_type');
            $table->string('reporting_format');
            $table->timestamps();

            $table->foreign('related_metrics_id')->references('id')->on('metrics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metrics');
    }
}
