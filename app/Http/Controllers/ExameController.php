<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdicionarExameRequest;
use App\Models\ArquivoModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExameModel;
use Illuminate\Support\Facades\Auth;

class ExameController extends Controller
{
    public function HomeSistema()
    {
        $usuario = User::where('id', Auth::user()->id)->first();
        $exames = $usuario->exame()->orderBy('created_at')->take(5)->get();
        $total_exames = count($usuario->exame);

        return view('Exames.HomeSistema',[
            'usuario'=>$usuario,
            'exames'=> $exames,
            'total_exames'=> $total_exames
        ]);
    }

    public function AdicionarExame()
    {
        return view('Exames.AdicionarExame');
    }
    public function CadastrarConsulta(AdicionarExameRequest $request)
    {
        $exame = ExameModel::create([
            'st_especialidade'=>$request->st_especialidade,
            'st_descricao'=>$request->st_descricao,
            'st_nome_medico'=>$request->st_nome_medico,
            'st_localizacao'=>$request->st_localizacao,
            'dt_data' => $request->dt_data,
            'id_user'=> Auth::user()->id
        ]);

        if ($request->fl_arquivo){
            foreach ($request->fl_arquivo as $arquivo) {
                $return = $arquivo->storeas('arquivos', $arquivo->getClientOriginalName());
                ArquivoModel::create([
                    'id_exame'=>$exame->id_exame,
                    'fl_arquivo'=>$return
                ]);
            }
        }

        return redirect()->route('HomeSistema')->with('success', 'Exame Cadastrado com sucesso');
    }

    public function VizualizarExame(ExameModel $id_exame)
    {
        dd('Fazer tela de vizualizar um exame.');
    }
}
