<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPlushieFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::table('plushies')
               ->whereRaw("JSON_TYPE(JSON_EXTRACT(traits, '$.features')) != 'ARRAY'")
               ->orderBy('id')
               ->chunk(100, function ($plushies) {
                   foreach ($plushies as $plushie) {
                       $traits = json_decode($plushie->traits, true);
                       $features = $traits['features'] ?? [];

                       // Convert to array if string
                       if (is_string($features)) {
                           $features = json_decode($features, true) ?? [$features];
                       }

                       // Replace long-floppy-ears
                       $features = array_map(function ($item) {
                           return str_replace('long-floppy-ears', 'floppy-ears', $item);
                       }, $features);

                       // Update the record
                       DB::table('plushies')
                           ->where('id', $plushie->id)
                           ->update([
                               'traits->features' => $features
                           ]);
                   }
               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
