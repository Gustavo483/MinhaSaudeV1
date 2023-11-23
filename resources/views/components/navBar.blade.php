<nav class="border-gray-200 bgNavBar ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset('img/Icone_Principal.svg')}}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap logo">Minha Saúde</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden buttonHover focus:outline-none focus:ring-2 focus:ring-gray-200 buttonHover dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Abrir menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4  rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 bgNavBar">
                <li>
                    <a href="{{route('HomeSistema')}}" class="block py-2 px-3 linkNavbar text-center">Home</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 linkNavbar text-center">Perfil</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 linkNavbar text-center">Termos de uso</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 linkNavbar text-center">Ajuda</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="flex justify-center">
                            <button type="submit" class=" py-2 px-3 linkNavbar">
                                Sair do aplicativo
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
