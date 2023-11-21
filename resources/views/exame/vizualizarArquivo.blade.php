@extends('components.basicComponent')
@section('title', 'Visualizar Arquivo')

@section('content')
    <div class="containerSistema">
        <div class="flex justify-between">
            <a href="{{ url()->previous() }}">Voltar</a>
            <a  href="{{route('HomeSistema')}}">Home</a>
        </div>

        @if($arquivo->st_tipoArquivo === 'pdf')
            <embed class="teste" src="{{ route('recuperarArquivo', ['nomeArquivo'=>$arquivo->fl_arquivo]) }}" type="application/pdf">
        @endif

        @if($arquivo->st_tipoArquivo !== 'pdf')
            <div class="MostrarArquivoDiv">
                <img  src="{{ route('recuperarArquivo', ['nomeArquivo'=>$arquivo->fl_arquivo]) }}" alt="">
            </div>
        @endif
    </div>
@endsection

