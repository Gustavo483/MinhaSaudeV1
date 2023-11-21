<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdicionarExameRequest;
use App\Http\Requests\CriarNotaRequest;
use App\Models\ArquivoModel;
use App\Models\NotaExameModel;
use App\Models\User;
use App\Models\ExameModel;
use http\Env\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function Symfony\Component\String\s;

class ExameController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function homeSistema()
    {
        try {
            $usuario = User::where('id', Auth::user()->id)->first();
            $exames = $usuario->exame()->orderBy('created_at')->take(5)->get();
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
                    $return = $arquivo->storeas('arquivos', $arquivo->getClientOriginalName());
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

            return redirect()->route('HomeSistema')->with('success', 'Exame Cadastrado com sucesso');

        }catch (\Exception $exception){
            \DB::rollback();

            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ExameModel $id_exame
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function vizualizarExame(ExameModel $id_exame)
    {
        try {
            return view('exame.vizualizarExame', ['exame'=>$id_exame]);

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * @param ArquivoModel $id_arquivo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function vizualiarArquivo(ArquivoModel $id_arquivo)
    {
        try {
            return view('exame.vizualizarArquivo', ['arquivo'=>$id_arquivo]);

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
            $path = storage_path("app/public/arquivos/{$id_arquivo->fl_arquivo}");

            if ($id_arquivo->st_tipoArquivo === 'pdf'){
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
            }else{
                $headers = [
                    'Content-Type' => 'image/*',
                ];
            }

            return response()->download($path, $id_arquivo->fl_arquivo, $headers);

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
    public function excluirArquivo(ArquivoModel $id_arquivo)
    {
        try {
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

}
