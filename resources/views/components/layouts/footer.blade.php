<!-- widget -->
<div class="w-full h-12 bottom-0 left-0 border-t border-gray-100/10 fixed bg-gray-700 z-40">

    <div
    class="w-14 h-14 bottom-2 left-1/2 -translate-x-1/2 transition hover:scale-110 border border-gray-100/10 shadow rounded-full absolute flex justify-center items-center bg-gray-800 cursor-pointer"
    x-on:click="modalMain = !modalMain"
    :class="modalMain ? 'rotate-45' : 'rotate-0'">
        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
    </div>
</div>
<!-- end widget -->

<!-- modal main -->
<div
class="w-full h-screen top-0 left-0 fixed flex justify-center items-center bg-gray-800 z-30"
x-show="modalMain"
x-cloak
x-transition:enter="transition duration-500"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition duration-500"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0">

    <div class="container mx-auto">

        <div class="w-full shadow rounded-3xl bg-gray-700 p-6">

            <h3 class="text-2xl font-bold text-gray-400">
                Adicionar
            </h3>

            <div class="grid grid-cols-2 gap-4 mt-2">

                <!-- loop -->
                @php
                    $actions = [
                        'categories' => [
                            'title' => 'Categorias',
                            'route' => 'categories.index'
                        ],

                        'banks' => [
                            'title' => 'Bancos',
                            'route' =>  '#'
                        ],

                        'estimates' => [
                            'title' => 'Estimativas',
                            'route' => '#'
                        ],

                        'warnings' => [
                            'title' => 'Avisos',
                            'route' => '#'
                        ]
                    ];
                @endphp

                @foreach($actions as $action)
                    <a
                    class="shadow rounded-3xl flex justify-center items-center font-bold text-white bg-gray-600 hover:bg-gray-500 py-4"
                    href="{{ $action['route'] != '#' ? route($action['route']) : '#' }}">
                        {{ $action['title'] }}
                    </a>
                @endforeach
                <!-- loop -->
            </div>

            <hr class="w-full opacity-10 bg-gray-800 my-8" />

            <h3 class="text-2xl font-bold text-gray-400 mt-4">
                Principal
            </h3>

            <div class="grid grid-cols-2 gap-4 mt-2">

                <!-- loop -->
                @php
                    $actionsMain = [
                        'deposits' => [
                            'title' => 'Nova Entrada',
                            'link' => '#'
                        ],

                        'expenses' => [
                            'title' => 'Nova Despesa',
                            'link'  => 'expenses.create'
                        ]
                    ];
                @endphp

                @foreach($actionsMain as $actionMain)
                    <a
                    class="shadow rounded-3xl flex justify-center items-center font-bold text-white bg-gray-600 {{ $actionMain == 'Entradas' ? 'hover:bg-green-500' : 'hover:bg-red-500' }} py-4"
                    href="{{ $actionMain['link'] != '#' ? route($actionMain['link']) : '#' }}">
                        {{ $actionMain['title'] }}
                    </a>
                @endforeach
                <!-- loop -->
            </div>
        </div>
    </div>
</div>
<!-- end modal main -->

<!-- modal delete -->

<!-- end modal delete -->
