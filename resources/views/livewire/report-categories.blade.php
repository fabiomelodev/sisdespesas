<div
class="relative bg-indigo-600 py-10 px-4"
x-data="{ modal: false }">
    <div class="w-full mb-16 py-6">
        <h2 class="text-6xl font-bold text-center uppercase text-white">
            Categorias
        </h2>
    </div>

    <div class="grid grid-cols-4 gap-4">
        <!-- loop -->
        @foreach($categories as $category)
            <div
            class="rounded-lg flex flex-col bg-white p-4"
            wire:key="category-{{ $category['id'] }}">

                <p class="font-semibold text-black/50">
                    {{ $category['title'] }}
                </p>

                <p class="text-3xl font-bold text-indigo-600">
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
        class="col-span-full rounded-lg flex flex-col gap-4 bg-white p-4"
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

            <!-- loop -->
            @if($expenses)
                @foreach($expenses as $expense)
                    <div
                    class="border-b shadow-lg rounded-xl grid grid-cols-4 bg-indigo-600 p-4"
                    wire:key="expense-{{ $expense->id }}">

                        <div>
                            <p class="text-sm font-semibold text-white">
                                {{ $expense->title }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-semibold  text-center text-white">
                                {{ $expense->meanPayment->title }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-center text-white">
                                {{ $expense->pay_day->format('d/m/y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-right text-white">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expense->value) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- end loop -->

            <div>
                @if($expensesTotal)
                    <p>
                        Total: {{ $expensesTotal }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
