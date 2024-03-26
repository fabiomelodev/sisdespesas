<x-app-layout>
    <x-slot name="header">
        Categorias
    </x-slot>

    <section class="py-6">

        <div class="container mx-auto px-4">

            <div class="w-full">

                <h1 class="text-3xl font-bold text-white">
                    Categorias
                </h1>

                <hr class="w-full h-px bg-gray-100/10 my-6"/>

                <div class="mb-6">
                    <a
                    class="w-28 shadow rounded-3xl flex items-center font-bold text-white bg-blue-500 hover:bg-blue-400 mr-2 py-2 px-6"
                    href="{{ route('categories.index') }}">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>

                        <span class="ml-2">
                            Lista
                        </span>
                    </a>
                </div>

                <form
                method="POST"
                action="{{ route('categories.store') }}">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex flex-col">
                            <label
                            class="font-bold text-white mb-2"
                            for="category">
                                Categoria:
                            </label>

                            <input
                            class="w-full shadow rounded-3xl px-4"
                            type="text"
                            name="title"
                            id="category" />
                        </div>

                        <div class="col-span-2 flex">
                            <button class="shadow rounded-3xl flex items-center font-bold text-white bg-blue-500 hover:bg-blue-400 mr-2 py-2 px-6">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>

                                <span class="ml-2">
                                    Criar
                                </span>
                            </button>

                            <button
                            class="shadow rounded-3xl flex items-center font-bold text-white bg-gray-500 hover:bg-gray-400 py-2 px-6"
                            type="reset">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M566.6 9.4c12.5 12.5 12.5 32.8 0 45.3l-192 192 34.7 34.7c4.2 4.2 6.6 10 6.6 16c0 12.5-10.1 22.6-22.6 22.6H364.3L256 211.7V182.6c0-12.5 10.1-22.6 22.6-22.6c6 0 11.8 2.4 16 6.6l34.7 34.7 192-192c12.5-12.5 32.8-12.5 45.3 0zm-344 225.5L341.1 353.4c3.7 42.7-11.7 85.2-42.3 115.8C271.4 496.6 234.2 512 195.5 512L22.1 512C9.9 512 0 502.1 0 489.9c0-6.3 2.7-12.3 7.3-16.5L133.7 359.7c4.2-3.7-.4-10.4-5.4-7.9L77.2 377.4c-6.1 3-13.2-1.4-13.2-8.2c0-31.5 12.5-61.7 34.8-84l8-8c30.6-30.6 73.1-45.9 115.8-42.3zM464 352a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>

                                <span class="ml-2">
                                    Limpar
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
