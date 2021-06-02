<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'data_criacao',
        'status'
      
    ];

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}
