@extends('components.basicComponent')
@section('title', 'Minha saúde')

@section('content')
    @include('components.navBar')
    @include('components.returnSistem')
    <div class="containerSistema">

        <h1 class="mt-5 mb-3 TitlePage">Pesquisar por um exame</h1>

        <div style="margin-top: 50px" class="displayFlex">
            <form action="{{route('PesqusarExame')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-center items-center flex-wrap">
                    <div class="me-2">
                        <label for="st_palabraChave" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Palavra chave</label>
                        <input  value="{{isset($pesquisa) && $pesquisa['st_palabraChave'] ? $pesquisa['st_palabraChave']  : old('st_palabraChave')}}" class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema2" name="st_palabraChave" placeholder="Digite a especialidade">
                    </div>
                </div>

                <div class="flex justify-center p-5">
                    <button style="background: #72B5A4; color:white; padding: 10px; border-radius: 10px; font-weight: bolder; font-size: 18px" class="acessar" type="submit">Buscar exames</button>
                </div>
            </form>
        </div>

        <div>
            @foreach($exames as $exame)
                <div class="flex justify-center">
                    <a href="{{route('VizualizarExame', ['id_exame'=>$exame->id_exame])}}" class="divExames">
                        <div class="flex justify-between">
                            <p class="font-bold">
                                {{$exame->st_especialidade}}
                            </p>
                            <p class="font-bold">
                                {{$exame->dt_data}}
                            </p>
                        </div>
                        <div class="mt-3">
                            <p> {{substr($exame->st_descricao, 0, 70)}}...</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-10 mb-20">
            {{ $exames->links()}}
        </div>
    </div>

@endsection
