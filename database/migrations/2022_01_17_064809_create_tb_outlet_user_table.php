<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOutletUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_outlet_user', function (Blueprint $table) {
            $table->foreignId('id_user')->unique()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_outlet')->unique()->constrained('tb_outlet')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_outlet_user');
    }
}
