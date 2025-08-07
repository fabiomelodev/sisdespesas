<div
class="relative"
x-data="{ modal: false }">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">
            Categorias
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- loop -->
        @foreach($categories as $category)
            <div
            class="rounded-lg flex flex-col bg-gray-800 p-4"
            wire:key="category-{{ $category['id'] }}">

                <p class="font-semibold text-white/80">
                    {{ $category['title'] }}
                </p>

                <p class="text-3xl font-bold text-white">
                    {{ \App\Helpers\FormatCurrency::getFormatCurrency($category['totalExpenses']) }}
                </p>

                <div class="flex justify-end">
                    <button
                    class="w-8 h-8 rounded flex justify-center items-center bg-indigo-600 hover:bg-indigo-400 mt-2"
                    wire:click="updateExpenses('{{ $category['id'] }}')"
                    x-on:click="modal = true">
                        <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M24 56c0-13.3 10.7-24 24-24l32 0c13.3 0 24 10.7 24 24l0 120 16 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l16 0 0-96-8 0C34.7 80 24 69.3 24 56zM86.7 341.2c-6.5-7.4-18.3-6.9-24 1.2L51.5 357.9c-7.7 10.8-22.7 13.3-33.5 5.6s-13.3-22.7-5.6-33.5l11.1-15.6c23.7-33.2 72.3-35.6 99.2-4.9c21.3 24.4 20.8 60.9-1.1 84.7L86.8 432l33.2 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-88 0c-9.5 0-18.2-5.6-22-14.4s-2.1-18.9 4.3-25.9l72-78c5.3-5.8 5.4-14.6 .3-20.5zM224 64l256 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-256 0c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 160l256 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-256 0c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 160l256 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-256 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                    </button>
                </div>
            </div>
        @endforeach
        <!-- end loop -->

        <div
        class="w-full h-screen top-0 left-0 rounded-lg fixed hidden flex-col gap-4 bg-gray-800 p-4"
        x-show="modal"
        x-cloak>

            <div class="grid grid-cols-4 gap-x-32">

                <div class="p-2">
                    <p class="text-xs font-bold text-indigo-600">
                        Despesa
                    </p>
                </div>

                <div class="p-2">
                    <p class="text-xs font-bold text-center text-indigo-600">
                        Mod. Pagamento
                    </p>
                </div>

                <div class="p-2">
                    <p class="text-xs font-bold text-center text-indigo-600">
                        Data
                    </p>
                </div>

                <div class="p-2">
                    <p class="text-xs font-bold text-right text-indigo-600">
                        Valor
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div
    class="w-full h-screen top-0 left-0 fixed flex justify-center items-center bg-black/50 z-50"
    x-show="modal"
    x-cloak>

        <div
        class="w-10 h-10 transition hover:scale-90 top-6 right-6 shadow-lg rounded-full absolute flex justify-center items-center bg-white cursor-pointer"
        x-on:click="modal = false">
            <p class="font-bold text-gray-800">
                x
            </p>
        </div>

        <div class="container flex">

            <div class="w-2/12">

                <div class="w-full shadow-lg rounded-lg border flex flex-col bg-white p-4">

                    @if($expenses)
                        <p class="text-[10px] font-medium text-gray-800 mb-2">
                            Quantidade: {{ $expenses->count()   }}
                        </p>
                    @endif

                    <p class="text-sm font-bold text-gray-800">
                        Total de despesas:
                    </p>

                    <p class="text-xl font-bold text-gray-800">
                        {{ \App\Helpers\FormatCurrency::getFormatCurrency($expensesTotal) }}
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-8/12 pl-4">

                <div class="w-full h-[580px] shadow-lg rounded-lg border flex flex-col gap-2 bg-white p-4">

                    <div class="w-full shadow-lg rounded-lg grid grid-cols-5 bg-gray-800 p-2">

                        <div>
                            <p class="text-xs font-bold text-white">
                                Despesa
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-center text-white">
                                Categoria
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-center text-white">
                                Banco
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-center text-white">
                                Data pago
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-right text-white">
                                Valor
                            </p>
                        </div>
                    </div>

                    <div class="h-[494px] overflow-y-scroll">
                        <!-- loop -->
                        @if($expenses)
                            @foreach($expenses as $expense)
                                <div class="border-b shadow-lg rounded-xl grid grid-cols-5 odd:bg-indigo-600 even:bg-indigo-500 p-2">

                                    <div>
                                        <p class="text-xs font-semibold text-white">
                                            {{ $expense->title }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-center text-white">
                                            {{ $expense->category->title}}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-center text-white">
                                            {{ $expense->bank->title }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-center text-white">
                                            {{ $expense->pay_day->format('d/m/y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-right text-white">
                                            {{ \App\Helpers\FormatCurrency::getFormatCurrency($expense->value) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- end loop -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
