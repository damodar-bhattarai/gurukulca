<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutineClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->foreignId('routine_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users','id')->onDelete('cascade');
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
        Schema::dropIfExists('routine_classes');
    }
}
