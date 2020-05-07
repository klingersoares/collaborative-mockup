<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model {
    protected $table = 'tbl_projeto';
    protected $fillable = [
        'nome', 'url',
    ];
}
