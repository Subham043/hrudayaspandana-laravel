<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_videos', function (Blueprint $table) {
            $table->id();
            $table->text('video')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });
        DB::table('banner_videos')->insert(array('video' => 'test','image' => 'test'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_videos');
    }
};
