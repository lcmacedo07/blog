<header>
    <nav class="bg-gray-500">
        <div class="container">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">

                    <div class="flex flex-shrink-0 items-center">
                        {{-- <a href="{{ route('categories.index') }}">
                            <img  class="block h-10 w-auto lg:hidden"
                            src="https://www.supera.com.br/wp-content/uploads/2020/11/nova-logo-supera-branca.svg"
                            alt="Desafio Supera">
                            <img class="hidden h-10 w-auto lg:block"
                            src="https://www.supera.com.br/wp-content/uploads/2020/11/nova-logo-supera-branca.svg"
                            alt="Desafio Supera">
                        </a> --}}
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            @auth
                                @if(Request::is('admin*'))
                                    <a href="{{ route('categories.index') }}"
                                        class="text-gray-300 hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Categorias</a>
                                    <a href="{{ route('tags.index') }}"
                                        class="text-gray-300 hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Tags</a>
                                    <a href="{{ route('posts.index') }}"
                                        class="text-gray-300
                                    hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Posts</a>
                                    <a href="{{ route('admin.settings') }}"
                                        class="text-gray-300
                                    hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Usuarios</a> 
                                @endif
                                @if(Request::is('author*'))
                                    <a href="{{ route('posts.index') }}"
                                        class="text-gray-300
                                    hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Posts</a>
                                    <a href="{{ route('author.settings') }}"
                                        class="text-gray-300
                                    hover:bg-gray-700
                                    hover:text-white
                                    px-3
                                    py-2
                                    rounded-md
                                    text-sm
                                    font-medium">Usuarios</a> 
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    @if (Route::has('login'))
                        <div class="flex w-full">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Sair</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>