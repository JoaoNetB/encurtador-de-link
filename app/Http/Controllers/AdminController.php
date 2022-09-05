<?php

namespace App\Http\Controllers;

use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    
    public function index()
    {
        $id_user = Auth::user()->id;

        $link_data = Links::where('user_id', $id_user)->get();
        
        return view('admin.panel', [
            'links' => $link_data,
            'code_user' => Auth::user()->code_user
        ]);
    }

    public function create()
    {
        return view('createForm');
    }

    public function insert(Request $request)
    {
        $id_user = Auth::user()->id;
        $permission_to_create = false;

        $link_source = $request->validate([
            'link_source' => ['required', 'url'],
        ], [
            'link_source.required' => 'O link original é obrigatório',
            'link_source.url' => 'Digite uma url válida'
        ]);

        while($permission_to_create == false) {

            $possible_coding = Str::random(3);

            $link = Links::where([['user_id', '=', $id_user], ['code_url', '=', $possible_coding]])->first();

            if(empty($link)) {

                $data_to_save = [
                    'user_id' => $id_user,
                    'source_url' => $link_source['link_source'],
                    'code_url' => $possible_coding,
                    'number_requests' => 0
                ];

                $link = Links::create($data_to_save);
                
                $permission_to_create = true;

                return redirect()->route('panel.index');
            }
        }
    }

    public function delete(Request $request)
    {
        $id_user = Auth::user()->id;

        $link = Links::where([['user_id', '=', $id_user], ['code_url', '=', $request->code_link]])->first();

        if(!empty($link)) {

            $link_delete = Links::where('code_url', $request->code_link)->delete();

            if(!empty($link_delete)) {

                return redirect()->route('panel.index')->with('delete_success', 'Link apagado com sucesso!');
            }
        }

        return redirect()->route('panel.index')->with('delete_error', 'Não foi possível apagar o link!');
    }
}
