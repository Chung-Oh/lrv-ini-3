<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('document_number')->unique(); // cpf ou cnpj
            $table->string('email');
            $table->string('phone');
            $table->boolean('defaulter'); // inadimplente
            $table->date('date_birth')->nullable();
            $table->char('sex', 10)->nullable();
            $table->enum('marital_status', array_keys(App\Models\Client::MARITAL_STATUS))->nullable(); // estado civil
            $table->string('physical_desability')->nullable(); // deficiência física
            $table->string('company_name')->nullable();
            $table->string('client_type')->default('individual');
            $table->integer('soccer_team_id')->unsigned();
            $table->foreign('soccer_team_id')->references('id')->on('soccer_teams');
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
        Schema::dropIfExists('clients');
    }
}
