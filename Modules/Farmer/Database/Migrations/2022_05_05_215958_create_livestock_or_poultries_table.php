<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Farmer\Entities\LivestockOrPoultry;

class CreateLivestockOrPoultriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livestock_or_poultries', function (Blueprint $table) {
            $table->id();
            $columns = LivestockOrPoultry::_COLUMNS;
            foreach ($columns as $value) {
                $table->string($value)->nullable();
            }
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
        Schema::dropIfExists('livestock_or_poultries');
    }
}
