@extends('components/basicComponent')
@section('title', 'Minha saúde')

@section('content')
    <div class="containerSistema">
        <div class="flex1 mt-2 mb-20">
            <div class="tamanhoDivHome">
                <img class=" mr-2 w-100 imgInicio" src="{{asset('img/usingComputer.png')}}" alt="logo">
            </div>
            <div  style="margin-top: 50px" class="tamanhoDivHome">
                <span class="titleHome">"Minha Saúde" é um sistema de prontuário de exames online concebido por estudantes ao longo do semestre na disciplina de Sistemas de Informação. Seu propósito fundamental reside em simplificar e organizar o acesso a exames médicos, proporcionando um ambiente seguro e de fácil acessibilidade.</span>
                <div class="flex1 mt-3">
                    <a class="linkAvaliar" href="{{route('HomeSistema')}}">Acessar plataforma</a>
                </div>
            </div>
        </div>
    </div>
@endsection
