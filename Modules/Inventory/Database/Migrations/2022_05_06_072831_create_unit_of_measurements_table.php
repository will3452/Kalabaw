<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Inventory\Entities\UnitOfMeasurement;

class CreateUnitOfMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_measurements', function (Blueprint $table) {
            $table->id();
            $columns = UnitOfMeasurement::_COLUMNS;
            foreach ($columns as $value) {
                $table->string($value)->nullable();
            }
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
        Schema::dropIfExists('unit_of_measurements');
    }
}
