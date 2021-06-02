<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoPastel extends Model
{
    protected $table = 'pedido_pastels';

    protected $fillable = [
        'id',
        'pedido_id',
        'pastel_id',
    ];

    public function pasteis(){
        return $this->hasOne(Pastel::class, 'id', 'pastel_id');
    }
}