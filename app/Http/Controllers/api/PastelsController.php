<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pastel;

class PastelsController extends Controller
{
    public function index()
    {
        return Pastel::where('status','active')->get();
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        if($data['media'] ) {
            $image = $data['media'];
            $fileName = $image->getClientOriginalName();
            $image->move('uploads/img/', $fileName);
            $data['media'] = 'uploads/img/'.$fileName;
        }

        $data['status'] = 'active';
        Pastel::create($data);
    }
    
    public function show($id)
    {
        return Pastel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $pastel = Pastel::where('id',$id)->first();
        if($data['media']) {

            $image = $data['media'];
            $fileName = $image->getClientOriginalName();
            $image->move('uploads/img/', $fileName);
            $data['media'] = 'uploads/img/'.$fileName;
        }else{
            unset($data['media']);
        }

        if(is_null($data['nome'])){
            unset($data['nome']);
        }

        if(is_null($data['preco'])){
            unset($data['nome']);
        }


        Pastel::findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        Pastel::findOrFail($id)->update([
            'status'=>'removed'
        ]);
    }
}
