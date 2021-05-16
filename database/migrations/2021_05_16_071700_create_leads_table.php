<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('step')->comment('Passo que o usuário está.');
            $table->string('identifier', 100)->comment('Coluna de identificação do usuário (cookie salvo no browser)');
            $table->string('full_name', 50)->comment('Nome completo do lead');
            $table->string('birth_date', 50)->comment('Data de nascimento do lead');
            $table->unsignedInteger('cep')->comment('CEP do lead')->nullable();
            $table->string('state', 50)->comment('Estado do lead')->nullable();
            $table->string('city', 50)->comment('Cidade do lead')->nullable();
            $table->string('street', 50)->comment('Rua do lead')->nullable();
            $table->unsignedInteger('number')->comment('Número residencial do lead')->nullable();
            $table->unsignedBigInteger('phone')->comment('Telefone do lead')->nullable();
            $table->unsignedBigInteger('cellphone')->comment('Celular do lead')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
