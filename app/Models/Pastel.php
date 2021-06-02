<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    protected $table = 'pastels';

    protected $fillable = [
        'id',
        'nome',
        'preco',
        'media',
        'status'
     
    ];

    public function fullpatch(){
        return URL::to('/').$this->media;
    }
}
