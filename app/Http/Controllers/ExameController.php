<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdicionarExameRequest;
use App\Http\Requests\CriarNotaRequest;
use App\Models\ArquivoModel;
use App\Models\NotaExameModel;
use App\Models\User;
use App\Models\ExameModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExameController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function homeSistema()
    {
        try {
            $usuario = User::where('id', Auth::user()->id)->first();
            $exames = $usuario->exame()->orderBy('dt_data', 'desc')->take(5)->get();
            $total_exames = count($usuario->exame);

            if (!$usuario){
                throw new \Exception('Nenhum usuário encontrato.');
            }

            return view('exame.homeSistema',[
                'usuario'=>$usuario,
                'exames'=> $exames,
                'total_exames'=> $total_exames
            ]);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function adicionarExame()
    {
        try {
            return view('exame.adicionarExame');

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param AdicionarExameRequest $request
     * @return RedirectResponse
     */
    public function cadastrarConsulta(AdicionarExameRequest $request)
    {
        try {
            \DB::beginTransaction();

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
                    $name = strval($exame->id_exame) .'_id_'. $arquivo->getClientOriginalName();
                    $return = $arquivo->storeas('arquivos', $name);
                    $nome = explode('/',$return);

                    $tipoArquivo = explode('.', $return);
                    ArquivoModel::create([
                        'id_exame'=>$exame->id_exame,
                        'fl_arquivo'=>$nome[1],
                        'st_tipoArquivo'=>$tipoArquivo[1]
                    ]);
                }
            }
            \DB::commit();

            return redirect()->route('VisualizarExame',['id_exame'=>$exame->id_exame])->with('success', 'Exame Cadastrado com sucesso');

        }catch (\Exception $exception){
            \DB::rollback();

            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ExameModel $id_exame
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function visualizarExame(ExameModel $id_exame)
    {
        try {
            return view('exame.visualizarExame', ['exame'=>$id_exame]);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ArquivoModel $id_arquivo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function visualiarArquivo(ArquivoModel $id_arquivo)
    {
        try {
            return view('exame.visualizarArquivo', ['arquivo'=>$id_arquivo]);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ArquivoModel $id_arquivo
     * @return \Illuminate\Http\RedirectResponse|BinaryFileResponse
     */
    public function baixarArquivo(ArquivoModel $id_arquivo)
    {
        try {
            $path = storage_path("app/arquivos/{$id_arquivo->fl_arquivo}");

            if ($id_arquivo->st_tipoArquivo === 'pdf'){
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
            }else{
                $headers = [
                    'Content-Type' => 'image/*',
                ];
            }

            $nameArquivo = explode("_id_", $id_arquivo->fl_arquivo)[1] ?? $id_arquivo->fl_arquivo;
            return response()->download($path,$nameArquivo, $headers);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param string $nomeArquivo
     * @return \Illuminate\Http\RedirectResponse|BinaryFileResponse
     */
    public function recuperarArquivo(string $nomeArquivo)
    {
        try {
            $path = storage_path("app/public/arquivos/{$nomeArquivo}");
            return response()->file($path);

        }catch (\Exception $exception){
            return back()->with('error', 'Erro ao baixar o arquivo, favor entrar em contato com o suporte.');

        }
    }

    /**
     * @param ArquivoModel $id_arquivo
     * @return RedirectResponse
     */
    public function excluirArquivo(ArquivoModel $id_arquivo)
    {
        try {
            $path = storage_path("app/arquivos/$id_arquivo->fl_arquivo");

            if (file_exists($path)) {
                unlink($path);
            }

            $id_arquivo->delete();

            return back()->with('success', 'Arquivo excluído com sucesso.');
        }catch (\Exception $exception){

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param ExameModel $id_exame
     * @return RedirectResponse
     */
    public function excluirExame(ExameModel $id_exame)
    {
        try {
            \DB::beginTransaction();
            $arquivos = ArquivoModel::where('id_exame', $id_exame->id_exame)->get();

            $arquivos->delete();
            $id_exame->delete();

            \DB::commit();

            return redirect()->route('HomeSistema')->with('success', 'Exame Excluído com sucesso.');

        }catch (\Exception $exception){
            \DB::rollback();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param ExameModel $id_exame
     * @param CriarNotaRequest $request
     * @return RedirectResponse
     */
    public function criarNota(ExameModel $id_exame, CriarNotaRequest $request)
    {
        try {
            \DB::beginTransaction();

            NotaExameModel::create([
                'st_nomeNota'=>$request->st_nomeNota,
                'st_descricao'=>$request->st_descricao,
                'id_exame'=>$id_exame->id_exame,
            ]);

            \DB::commit();
            return back()->with('success', 'Nota cadastrada com sucesso');

        }catch (\Exception $exception){
            \DB::rollback();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param ExameModel $id_exame
     * @param CriarNotaRequest $request
     * @return RedirectResponse
     */
    public function editarNota(ExameModel $id_exame,CriarNotaRequest $request)
    {
        try {
            \DB::beginTransaction();

            if($id_exame->id_user !== Auth::user()->id){
                throw new \Exception('Você não tem permissão para editar o exame');
            }

            $nota = NotaExameModel::where('id_notaExame', $request->id_notaExame)->first();

            $nota->update([
                'st_nomeNota'=>$request->st_nomeNota,
                'st_descricao'=>$request->st_descricao,
            ]);

            \DB::commit();

            return  back()->with('success', 'Nota editada com sucesso.');

        }catch (\Exception $exception){
            \DB::rollback();
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param NotaExameModel $id_notaExame
     * @return RedirectResponse
     */
    public function excluirNota(NotaExameModel $id_notaExame)
    {
        try {
            \DB::beginTransaction();

            $id_notaExame->delete();

            \DB::commit();

            return back()->with('success', 'Nota excluída com sucesso.');

        }catch (\Exception $exception){

            \DB::rollback();
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ExameModel $id_exame
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function editarExame(ExameModel $id_exame)
    {
        return view('exame.editarExame',['exame'=>$id_exame]);
    }

    /**
     * @param ExameModel $id_exame
     * @param AdicionarExameRequest $request
     * @return RedirectResponse
     */
    public function updateExame(ExameModel $id_exame, AdicionarExameRequest $request)
    {
        try {
            \DB::beginTransaction();

            if($id_exame->id_user !== Auth::user()->id){
                throw new \Exception('Você não tem permissão para editar o exame');
            }
            $id_exame->update([
                'st_especialidade'=>$request->st_especialidade,
                'st_descricao'=>$request->st_descricao,
                'st_nome_medico'=>$request->st_nome_medico,
                'st_localizacao'=>$request->st_localizacao,
                'dt_data' => $request->dt_data,
            ]);

            if ($request->fl_arquivo){
                foreach ($request->fl_arquivo as $arquivo) {
                    $name = strval($id_exame->id_exame) .'_id_'. $arquivo->getClientOriginalName();
                    $return = $arquivo->storeas('arquivos', $name);
                    $nome = explode('/',$return);

                    $tipoArquivo = explode('.', $return);
                    ArquivoModel::create([
                        'id_exame'=>$id_exame->id_exame,
                        'fl_arquivo'=>$nome[1],
                        'st_tipoArquivo'=>$tipoArquivo[1]
                    ]);
                }
            }
            \DB::commit();

            return redirect()->route('VisualizarExame', ['id_exame'=>$id_exame->id_exame])->with('success', 'Exame atualizado com sucesso');

        }catch (\Exception $exception){
            \DB::rollback();

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function pesqusarExame()
    {
        try {
            $exames = ExameModel::where('id_user', Auth::user()->id)->paginate(5);
            return view('exame.pesquisarExame',['exames'=>$exames]);
        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function pesqusarExamePost(Request $request)
    {
        try {
            $exames = ExameModel::where('id_user', Auth::user()->id)
                ->where(function ($query) use ($request) {
                    $query->where('st_especialidade', 'like', '%' . $request->st_palabraChave . '%')
                        ->orWhere('st_descricao', 'like', '%' . $request->st_palabraChave . '%')
                        ->orWhere('st_nome_medico', 'like', '%' . $request->st_palabraChave . '%')
                        ->orWhere('st_localizacao', 'like', '%' . $request->st_palabraChave . '%');
                })
                ->paginate(5);

            return view('exame.pesquisarExame', ['exames'=> $exames, 'pesquisa'=> $request->all()]);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function deletarExame(ExameModel $id_exame)
    {

        try {
            \DB::beginTransaction();

            $auth = User::where('id', Auth::user()->id)->first();

            if ($auth->id !== $id_exame->id_user){
                throw new \Exception('Você não tem permissão para excluir esse exame.');
            }

            $id_exame->arquivos()->delete();
            $id_exame->notas()->delete();
            $id_exame->delete();

            \DB::commit();

            return redirect()->route('HomeSistema')->with('success','Exame excluído com sucesso.');

        }catch (\Exception $exception){
            \DB::rollback();
            return back()->with('error', $exception->getMessage());
        }
    }

}
