<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDelete extends Migration
{
    public function __tables()
    {
        return ['farmers', 'crops', 'machine_and_equipment', 'trees', 'livestock_or_poultries'];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->__tables() as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->__tables() as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
}
