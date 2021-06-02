<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoPastel;

class PedidosController extends Controller
{
    public function index()
    {
        return Pedido::where('status','active')->all();
    }

    public function store(Request $request)
    {   
        $data = $request->all();
        $data['status'] = 'active';
        $pasteis = $data['pastel'];
        unset($data['pastel']);
        // dd($data);
        Pedido::create($data);
        // dd($pasteis);
        $i = Pedido::where('cliente_id',$data['cliente_id'])->orderBy('id','desc')->first();
        $id = $i['id'];
        foreach ($pasteis as $pastel) {
            PedidoPastel::create([
                'pedido_id'=>$id,
                'pastel_id'=>$pastel
            ]);
        }
    }
    
    public function show($id)
    {
        return Pedido::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        Pedido::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->update([
            'status'=>'removed'
        ]);
    }
}