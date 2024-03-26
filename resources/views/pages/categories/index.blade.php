<x-app-layout>
    <x-slot name="header">
        Categorias
    </x-slot>

    <section class="pt-6 pb-20">

        <div class="container mx-auto lg:px-4">

            <div class="w-full">

                <h1 class="text-3xl font-bold text-white">
                    Categorias
                </h1>

                <hr class="w-full h-px bg-gray-100/10 my-6"/>

                <div class="flex justify-between px-2 lg:px-0">

                    <a
                    class="transition shadow rounded-3xl flex items-center font-bold text-white bg-blue-600 hover:bg-blue-500 py-2 px-4"
                    href="{{ route('dashboard') }}">
                        <svg class="fill-gray-100" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>

                        <span class="ml-2">
                            Início
                        </span>
                    </a>

                    <a
                    class="transition shadow rounded-3xl font-bold text-white bg-blue-600 hover:bg-blue-500 py-2 px-4"
                    href="{{ route('categories.create') }}">
                        Criar categoria
                    </a>
                </div>

                <!-- table -->
                @livewire('category-table')
                <!-- end table -->
            </div>
        </div>
    </section>

    <!-- modal category filter -->
    {{-- @livewire('filter-category') --}}
    <!-- end modal category filter -->
</x-app-layout>
