<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblProjetoUser extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_projeto_user', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idProjeto');
            $table->integer('idUser');
            $table->enum('tipo', ['P', 'C'])->notNull()->comment('P = Proprietário; C = Colaborador');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->notNull();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tbl_projeto_user');
    }
}
