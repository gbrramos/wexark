<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientesController extends Controller
{
 
    public function index()
    {
        return Cliente::where('status','active')->all();
    }

    public function store(Request $request)
    {   
        $data = $request->all();
        $data['status'] = 'active';
        Cliente::create($data);
    }
    
    public function show($id)
    {
        return Cliente::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        Cliente::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        Cliente::findOrFail($id)->update([
            'status'=>'removed'
        ]);
    }
}
