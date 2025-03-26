<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTraitsToPlushiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('plushies', function (Blueprint $table) {
        $table->json('traits')->after('description');
        $table->text('story')->after('traits');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
public function down()
{
    Schema::table('plushies', function (Blueprint $table) {
        $table->dropColumn(['traits', 'story', 'product_link']);
    });
}
}
