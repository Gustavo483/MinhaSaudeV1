@extends('components/basicComponent')
@section('title', 'Minha saúde')

@section('content')
    <div class="containerSistema">
        <div class="flex1 mt-2">
            <div class="tamanhoDivHome">
                <img class=" mr-2 w-100 imgInicio" src="{{asset('img/usingComputer.png')}}" alt="logo">
            </div>
            <div class="tamanhoDivHome">
                <span class="titleHome">Anexe seus exames em um só lugar e tenha tudo na palma da mão.</span>
                <div class="flex1 mt-3">
                    <a class="linkAvaliar" href="{{route('HomeSistema')}}">Acessar plataforma</a>
                </div>
            </div>
        </div>
    </div>
@endsection
