<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->increments('cod');
            $table->char('matricula', 20);
            $table->string('nome', 150);
            $table->string('cargo', 10);
            $table->decimal('bruto', 9,2);
            $table->tinyInteger('bonificado');
            $table->rememberToken();
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
        Schema::dropIfExists('funcionario');
    }
}
