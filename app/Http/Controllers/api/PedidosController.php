<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoPastel;
use App\Models\Pastel;
use App\Models\Cliente;
use Mail;

class PedidosController extends Controller
{
    public function index()
    {
        return Pedido::where('status','active')->get();
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
        $cliente = Cliente::where('id',$data['cliente_id'])->first();
        $pedidoFinal = $this->show($id);
        $pedidoFinal['nome'] = $cliente['nome'];
        $pedidoFinal['email'] = $cliente['email'];
        $pedidoFinal['telefone'] = $cliente['telefone'];

        // dd($pedidoFinal);
        Mail::send('email', $pedidoFinal, function ($m) use ($cliente) {
            $m->from('pastelaria@gmail.com', 'Pastelaria WexArk');
            $m->to($cliente['email'], 'Pastelaria WexArk')->subject('Pedido Efetuado');
        });
    }
    
    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pdd = new PedidoPastel();
        $linkPasteis = PedidoPastel::where('pedido_id',$id)->get();
        $nomePasteis = [];
        $valores = [];
        foreach ($linkPasteis as $link){
            $pastel = Pastel::where('id',$link['pastel_id'])->first();
            array_push($nomePasteis, $pastel['nome']);
            array_push($valores, $pastel['preco']);
            $valorTotal = array_sum($valores);
        }
        $totalPasteis = array_count_values($nomePasteis);
        $pedidoFinal = [
            'cliente_id'=> $pedido['cliente_id'],
            'itens'=> $totalPasteis,
            'valor_final'=>number_format($valorTotal, 2),
            'data_pedido'=>$pedido['data_criacao']
        ];
        return $pedidoFinal;
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['status'] = 'active';
        PedidoPastel::where('pedido_id',$id)->delete();
        
        $pasteis = $data['pastel'];
        unset($data['pastel']);
        $p = Pedido::where('id',$id)->first();
        Pedido::findOrFail($id)->update($request->all());
        foreach ($pasteis as $pastel) {
            PedidoPastel::create([
                'pedido_id'=>$id,
                'pastel_id'=>$pastel
            ]);
        }

        $data['cliente_id'] = $p['cliente_id'];
        $cliente = Cliente::where('id',$data['cliente_id'])->first();
        $pedidoFinal = $this->show($id);
        $pedidoFinal['nome'] = $cliente['nome'];
        $pedidoFinal['email'] = $cliente['email'];
        $pedidoFinal['telefone'] = $cliente['telefone'];
        Mail::send('email', $pedidoFinal, function ($m) use ($cliente) {
            $m->from('pastelaria@gmail.com', 'Pastelaria WexArk');
            $m->to($cliente['email'], 'Pastelaria WexArk')->subject('Pedido Efetuado');
        });
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->update([
            'status'=>'removed'
        ]);
    }
}