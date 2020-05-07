<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblProjeto extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_projeto', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->string('url');
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
        Schema::drop('tbl_projeto');
    }
}
