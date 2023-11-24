@extends('components.basicComponent')
@section('title', 'Minha saúde')

@section('content')
    @include('components.navBar')
    @include('components.returnSistem')
    <div class="containerSistema">
        <div class="flex justify-center mb-10 pt-10">
            <p style="font-size: 25px; color: #5CC6BA; font-weight: bolder">Adicionar Exame</p>
        </div>
        <div class="displayFlex">
            <form action="{{route('CadastrarConsulta')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-6 mt-10">
                    <label for="st_especialidade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Especialidade</label>
                    <input  value="{{old('st_especialidade')}}" class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema" name="st_especialidade" placeholder="Digite a especialidade" required>
                </div>
                <div class="errorValidation">
                    {{ $errors->has('st_especialidade') ? $errors->first('st_especialidade') : ''}}
                </div>

                <div class="mb-6">
                    <label for="st_nome_medico" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nome Médico</label>
                    <input  value="{{old('st_nome_medico')}}" class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema" name="st_nome_medico" placeholder="Digite o nome do médico" required>
                </div>
                <div class="errorValidation">
                    {{ $errors->has('st_nome_medico') ? $errors->first('st_nome_medico') : '' }}
                </div>

                <div class="mb-6">
                    <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Data:</label>
                    <input style="background:#e6e6e6; border-radius: 10px;" type="date" value="{{old('dt_data')}}" class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema" name="dt_data" required>
                </div>
                <div class="errorValidation">
                    {{ $errors->has('dt_data') ? $errors->first('st_especialidade') : '' }}
                </div>

                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Localização</label>
                    <input  value="{{old('st_localizacao')}}" class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema" name="st_localizacao" placeholder="Escreva a localidade do exame" required>
                </div>
                <div class="errorValidation">
                    {{ $errors->has('st_localizacao') ? $errors->first('st_especialidade') : '' }}
                </div>

                <div class="mb-6">
                    <label for="st_descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descrição do exame</label>
                    <textarea class="dark:focus:ring-gray-500 dark:focus:border-gray-500 inputSistema" name="st_descricao" required></textarea>
                </div>

                <div class="errorValidation">
                    {{ $errors->has('st_descricao') ? $errors->first('st_descricao') : '' }}
                </div>
                <div class="flex items-center justify-center w-full">
                    <label style="background: #e6e6e6" for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:border-gray-600 dark:hover:border-gray-500">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input onchange="mostrarNomeArquivo()"  accept=".pdf, image/*" id="dropzone-file" type="file" class="hidden" name="fl_arquivo[]" multiple  />
                    </label>
                </div>

                <p id="nomesArquivos"></p>
                <div class="flex justify-center p-5">
                    <button style="background: #72B5A4; color:white; padding: 10px; width: 100%; border-radius: 10px; font-weight: bolder; font-size: 18px" class="acessar" type="submit">Cadastrar exame</button>
                </div>
            </form>
        </div>
    </div>

@endsection
