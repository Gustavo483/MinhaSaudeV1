@extends('components.basicComponent')

@section('title', 'Minha saúde')

@section('content')
    <div style="height: 10vh;" class="flex justify-center">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset('img/Icone_Principal.svg')}}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap logo">Minha Saúde</span>
        </a>
    </div>
    <div style="height: 90vh" class="flex justify-center items-center">
        <div class="">
            <div class="flex justify-center mb-20">
                <p style="font-size: 25px; color: #5CC6BA; font-weight: bolder">LOGIN</p>
            </div>
            <form method="POST" ACTION="{{route('login')}}">
                @csrf
                <div class="flex justify-center">
                    <input class="dark:focus:ring-gray-500 dark:focus:border-gray-500" style="background: #e6e6e6; width: 300px; border-radius: 10px; border: none" placeholder="E-mail" name="email" type="email" required>
                </div>
                <div class=" mt-5">
                    <input class="dark:focus:ring-gray-500 dark:focus:border-gray-500" style="background: #e6e6e6; width: 300px; border-radius: 10px; border: none" placeholder="Senha" name="password" type="password" required>
                </div>
                <div class="errorValidation mt-3">
                    {{ $errors ? $errors->first() : '' }}
                </div>
                <div class="mt-2 mb-10">
                    <a  style="text-decoration: underline 0.5px;" href="#">Esqueci minha senha</a>
                </div>

                <button style="background: #72B5A4; color:white; padding: 10px; width: 100%; border-radius: 10px; font-weight: bolder; font-size: 18px" class="acessar" type="submit">Acessar</button>

                <div class="flex justify-center mt-3">
                    <a href="{{route('register')}}">Registrar-se</a>
                </div>
            </form>
        </div>
    </div>

@endsection
