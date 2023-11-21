@extends('components.basicComponent')
@section('title', 'Minha saúde')

@section('content')
    <div class="containerSistema">
        <h1 class="mt-2 center ">Exames</h1>
        <h1 class="mt-2 center">total exames {{$total_exames}}</h1>

        <div class="flex justify-center mt-5">
            <a  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href={{route('AdicionarExame')}}>Adicionar</a>
        </div>

        @foreach($exames as $exame)
            <a href="{{route('VizualizarExame', ['id_exame'=>$exame->id_exame])}}" class="flex justify-center">
                <div class="divExames">
                    <div class="flex justify-between">
                        {{$exame->st_especialidade}}
                        {{$exame->dt_data}}
                    </div>
                    <div>
                        {{$exame->st_descricao}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
