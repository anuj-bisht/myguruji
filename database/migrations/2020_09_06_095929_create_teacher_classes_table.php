<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_classes', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('teacher_id');
			$table->foreign('teacher_id')
				  ->references('id')->on('teachers')->onDelete('cascade');
			$table->unsignedBigInteger('student_class_id');
			$table->foreign('student_class_id')
				  ->references('id')->on('student_classes');
			$table->string('class_name')->nullable();
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
        Schema::dropIfExists('teacher_classes');
    }
}
