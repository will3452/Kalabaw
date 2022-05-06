<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Farmer\Entities\MachineAndEquipment;

class CreateMachineAndEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_and_equipment', function (Blueprint $table) {
            $table->id();

            $columns = MachineAndEquipment::_COLUMNS;
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
        Schema::dropIfExists('machine_and_equipment');
    }
}
