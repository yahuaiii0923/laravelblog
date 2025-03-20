<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
   public function up()
   {
       Schema::create('comments', function (Blueprint $table) {
           // ... other columns

           if (Schema::hasTable('posts')) {
               $table->foreignId('post_id')->constrained()->onDelete('cascade');
           }
       });
   }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
