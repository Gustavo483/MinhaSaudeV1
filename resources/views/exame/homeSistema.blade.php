@extends('components.basicComponent')
@section('title', 'Minha saúde')

@section('content')
    @include('components.navBar')
    @include('components.returnSistem')
    <div class="containerSistema">

        <h1 class="mt-5 mb-3 TitlePage">EXAMES</h1>
        <h1 class=" totalExames">total de {{$total_exames}} exames</h1>

        <div class="flex justify-center mt-5">
            <a  class=" block BuscarExame" href="{{route('PesqusarExame')}}">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#595757" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                    <p class="ps-2">
                        Pesquisar por um exame
                    </p>
                </div>
            </a>
        </div>

        <div class="flex justify-center mt-3">
            <a class="block AdicionarExame" href={{route('AdicionarExame')}}>
                <div class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="mb-20">
            @foreach($exames as $exame)
                <div class="flex justify-center">
                    <a href="{{route('VizualizarExame', ['id_exame'=>$exame->id_exame])}}" class="divExames">
                        <div class="flex justify-between">
                            <p class="font-bold">
                                {{$exame->st_especialidade}}
                            </p>
                            <p class="font-bold">
                                {{ \Carbon\Carbon::parse($exame->dt_data)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="mt-3">
                            <p> {{substr($exame->st_descricao, 0, 70)}}...</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="bottonExame">
            <div class="containerSistema">
                <div style="height: 70px;" class="flex justify-between items-center">
                    <div class="pages flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#5CC6BA" class="bi bi-bandaid" viewBox="0 0 16 16">
                            <path d="M14.121 1.879a3 3 0 0 0-4.242 0L8.733 3.026l4.261 4.26 1.127-1.165a3 3 0 0 0 0-4.242ZM12.293 8 8.027 3.734 3.738 8.031 8 12.293zm-5.006 4.994L3.03 8.737 1.879 9.88a3 3 0 0 0 4.241 4.24l.006-.006 1.16-1.121ZM2.679 7.676l6.492-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492.001-.002Z"/>
                            <path d="M5.56 7.646a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708Zm1.415-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707M8.39 4.818a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707Zm0 5.657a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707ZM9.803 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707Zm1.414-1.414a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708ZM6.975 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707ZM8.39 7.646a.5.5 0 1 1-.708.708.5.5 0 0 1 .707-.708Zm1.413-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707"/>
                        </svg>
                    </div>
                    <div class="pages flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#5CC6BA" class="bi bi-backpack2" viewBox="0 0 16 16">
                            <path d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14"/>
                            <path fill-rule="evenodd" d="M4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10z"/>
                            <path d="M6 2.341V2a2 2 0 1 1 4 0v.341c2.33.824 4 3.047 4 5.659v1.191l1.17.585a1.5 1.5 0 0 1 .83 1.342V13.5a1.5 1.5 0 0 1-1.5 1.5h-1c-.456.607-1.182 1-2 1h-7a2.497 2.497 0 0 1-2-1h-1A1.5 1.5 0 0 1 0 13.5v-2.382a1.5 1.5 0 0 1 .83-1.342L2 9.191V8a6.002 6.002 0 0 1 4-5.659M7 2v.083a6.04 6.04 0 0 1 2 0V2a1 1 0 0 0-2 0M3 13.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8A5 5 0 0 0 3 8zm-1-3.19-.724.362a.5.5 0 0 0-.276.447V13.5a.5.5 0 0 0 .5.5H2v-3.691Zm12 0V14h.5a.5.5 0 0 0 .5-.5v-2.382a.5.5 0 0 0-.276-.447L14 10.309Z"/>
                        </svg>
                    </div>
                    <div class="pages flex justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#5CC6BA"  class="bi bi-award" viewBox="0 0 16 16">
                            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z"/>
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
