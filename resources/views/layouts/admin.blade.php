<x-app-layout>

    <div class="relative max-h-screen md:flex">

        {{-- Sidebar --}}
        <div id="sidebar" class="z-50 bg-white w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">

            {{-- Header --}}
            <div class="w-100 flex-none bg-white border-b-2 border-b-grey-200 flex flex-row p-5 pr-0 justify-between items-center h-20 ">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="mx-auto">

                    <img class="h-16" src="{{ asset('storage/img/logo2.png') }}" alt="Logo">

                </a>

                {{-- Side Menu hide button --}}
                <button  type="button" title="Cerrar Menú" id="sidebar-menu-button" class="md:hidden mr-2 inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            {{-- Nav --}}
            <nav class="p-4 text-rojo overflow-y-auto h-menu" x-data="{openRoles:true, openArticles:true}">

                <p class="uppercase text-md text-rojo mb-4 tracking-wider">Administración</p>


                <a href="{{ route('pago_sat_irycem') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg"  class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                    </svg>

                    IRYCEM
                </a>

                <a href="{{ route('pago_sat_finanzas') }}" class="mb-3 capitalize font-medium text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Finanzas
                </a>

            </nav>

        </div>

        {{-- Content --}}
        <div class="flex-1 flex-col flex max-h-screen overflow-x-auto min-h-screen">

            {{-- Header --}}
            <div class="w-100  bg-white border-b-2 border-b-grey-200 flex-none flex flex-row p-5 justify-between items-center h-20">

                <!-- Mobile menu button-->
                <div class="flex items-center">

                    <button  type="button" title="Abrir Menú" id="mobile-menu-button" class="md:hidden inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                    </button>

                </div>

                {{-- Logo --}}
                <p x-show.transition.in.duration.1000ms.out.duration.200msw="!open_side_menu"  class="font-semibold text-2xl text-rojo">SAT WS</p>

                <!-- Profile dropdown -->
                @auth

                    <div class="ml-3 relative z-50" x-data="{ open_drop_down:false }">

                        <div>

                            <button x-on:click="open_drop_down=true" type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">

                                <span class="sr-only">Abrir menú de usuario</span>

                                <img class="h-10 w-10 rounded-full" src="{{Auth::user()->profile_photo_url}}" alt="{{ Auth::user()->name }}" id="nav-profile">

                            </button>

                        </div>

                        <div x-show="open_drop_down" x-on:click.away="open_drop_down=false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mi Perfil</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none" role="menuitem">Cerrar Sesión</button>

                            </form>

                        </div>

                    </div>
                @else

                    <div></div>

                @endauth


            </div>

            <div class="bg-gray-100 p-3 flex-1 overflow-y-auto  md:border-l-2 border-l-grey-200">

                @yield('content')

            </div>

        </div>

    </div>

    <script>

        const btn_close = document.getElementById('sidebar-menu-button');
        const btn_open = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        btn_open.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        btn_close.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        /* Change nav profile image */
        window.addEventListener('nav-profile-img', event => {

            document.getElementById('nav-profile').setAttribute('src', event.detail.img);

        });

    </script>

</x-app-layout>
