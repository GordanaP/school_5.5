<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('teacher_id')->index();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedInteger('subject_id')->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->string('classroom');
            $table->timestamps();

            $table->unique(['teacher_id', 'subject_id', 'classroom']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_teacher');
    }
}
