<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_classes', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('student_class_id');
			$table->foreign('student_class_id')
				  ->references('id')->on('student_classes');
			$table->unsignedBigInteger('subject_id');
			$table->foreign('subject_id')
				  ->references('id')->on('subjects');
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
        Schema::dropIfExists('subject_classes');
    }
}
