<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('student_class_id');
			$table->foreign('student_class_id')
				  ->references('id')->on('student_classes');
			$table->unsignedBigInteger('subject_id');
			$table->foreign('subject_id')
				  ->references('id')->on('subjects');
			$table->unsignedBigInteger('teacher_id');
			$table->foreign('teacher_id')
				  ->references('id')->on('teachers');
			$table->string('chapter_name');
			$table->softDeletes();
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
        Schema::dropIfExists('chapters');
    }
}
