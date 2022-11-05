<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_tutorials', function (Blueprint $table) {
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
			$table->unsignedBigInteger('chapter_id');
			$table->foreign('chapter_id')
				  ->references('id')->on('chapters');
			$table->string('class_name')->nullable();
			$table->string('subject_name')->nullable();
			$table->string('teacher_name')->nullable();
			$table->string('video_link')->nullable();
			$table->string('video_embeded_code')->nullable();
			$table->string('video_name')->nullable();
			$table->text('video_description')->nullable();
			$table->string('filepath')->nullable();
			$table->string('filename')->nullable();
			$table->boolean('is_free')->default(0);
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
        Schema::dropIfExists('video_tutorials');
    }
}
