<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('class_level');
            $table->string('room_number');
            $table->string('floor_number')->nullable();
            $table->string('group_name');
            $table->string('section');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};



// php artisan tinker
// \App\Models\ClassRoom::create([
//     'class_level'  => '6',
//     'room_number'  => '216',
//     'floor_number' => '2',
//     'group_name'   => 'Commerce',
//     'section'      => 'B',
// ]);
