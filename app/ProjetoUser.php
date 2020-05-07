<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjetoUser extends Model {
    protected $table = 'tbl_projeto_user';
    protected $fillable = [
        'idProjeto', 'idUser','tipo'
    ];
}
