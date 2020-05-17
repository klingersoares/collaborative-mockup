<?php

namespace App\MongoModels;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Log extends MongoModel
{
    protected $connection = 'mongodb';
    protected $guarded = [];
}
