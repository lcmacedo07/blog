<header class="w-full container mx-auto">
    <div class="flex flex-col items-center md:flex-row md:justify-between py-12">
        <div class="flex flex-col items-center md:items-start">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="/">
                Minimal Blog
            </a>
            <p class="text-lg text-gray-600">
                Lorem Ipsum Dolor Sit Amet
            </p>
        </div>
        <form action="{{ route('search') }}" method="GET" class="flex">
            <input type="text" name="query" placeholder="Digite sua pesquisa..."
                class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md ml-2">Pesquisar</button>
        </form>
    </div>
</header>

<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open">
            Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <ul
            class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('category.posts', $category->slug) }}"
                        class="hover:bg-gray-400 rounded py-2 px-4 mx-2 mb-2">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
        @if (Route::has('login'))
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>


<style>
    form {
        display: flex;
        align-items: center;
    }

    input[type="text"] {
        width: 300px;
    }

    button[type="submit"] {
        background-color: #3490dc;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
    }

    /* Estilos para os resultados da pesquisa */
    .bg-white {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 16px;
        margin-bottom: 16px;
    }

    .text-blue-700 {
        color: #3182ce;
    }

    .text-3xl {
        font-size: 1.875rem;
        line-height: 2.25rem;
    }

    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .text-gray-800 {
        color: #2d3748;
    }

    .uppercase {
        text-transform: uppercase;
    }

    .hover:text-black:hover {
        color: black;
    }

    /* Estilos para as categorias */
    ul {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    li {
        margin-right: 0.5rem;
    }

    @media (min-width: 640px) {
        li {
            margin-right: 1rem;
        }
    }
</style>
