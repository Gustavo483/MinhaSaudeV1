<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExameController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::get('/dfdf', function () {return view('dashboard');})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ExameController::class)->group(function () {
        Route::get('/home-sistema', 'homeSistema')->name('HomeSistema');
        Route::get('/adicionar-exame', 'adicionarExame')->name('AdicionarExame');
        Route::post('/cadastrar-consulta', 'cadastrarConsulta')->name('CadastrarConsulta');
        Route::get('/visualizar-exame/{id_exame}', 'visualizarExame')->name('VisualizarExame');
        Route::get('/visualiar-arquivo/{id_arquivo}', 'visualiarArquivo')->name('VisualiarArquivo');
        Route::get('/baixar-arquivo/{id_arquivo}', 'baixarArquivo')->name('BaixarArquivo');
        Route::get('/recuperar-arquivo/{nomeArquivo}', 'recuperarArquivo')->name('recuperarArquivo');
        Route::get('/excluir-arquivo/{id_arquivo}', 'ExcluirArquivo')->name('ExcluirArquivo');
        Route::post('/criar-nota/{id_exame}', 'criarNota')->name('CriarNota');
        Route::post('/editar-nota/{id_exame}', 'editarNota')->name('EditarNota');
        Route::get('/excluir-nota/{id_notaExame}', 'excluirNota')->name('ExcluirNota');
        Route::get('/editar-exame/{id_exame}', 'editarExame')->name('EditarExame');
        Route::post('/update-exame/{id_exame}', 'updateExame')->name('UpdateExame');
        Route::get('/pesqusar-exame', 'pesqusarExame')->name('PesqusarExame');
        Route::post('/pesqusar-exame', 'pesqusarExamePost')->name('PesqusarExame');
        Route::get('/deletar-exame/{id_exame}', 'deletarExame')->name('DeletarExame');

    });
});
Route::get('/sobre', function () {return view('sobre');});

require __DIR__.'/auth.php';
