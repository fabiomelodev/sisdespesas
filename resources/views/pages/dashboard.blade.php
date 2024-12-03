<x-layout.base>
    <x-slot name="title">
        home
    </x-slot>

    <section class="bg-gray-800 py-8">
        <div class="container flex flex-wrap mx-auto px-4">

            <div class="w-3/12 px-4">

                <div class="top-0 rounded-3xl sticky bg-gray-700 p-4">
                    <h4 class="text-lg font-bold uppercase text-center text-gray-100 mb-2">
                        Despesas fixas
                    </h4>

                    <hr class="bg-gray-100">

                    <div class="mt-4">
                        <h6 class="text-xs font-bold uppercase text-center text-gray-100 mb-4">
                            Pagos
                        </h6>

                        <div class="rounded-xl flex justify-between bg-green-500 mb-4 p-2">
                            <p class="text-xs font-bold uppercase text-gray-100">
                                Total pago
                            </p>

                            <p class="text-xs font-bold text-gray-100">
                                {{ $totalFixedExpensesPaid }}
                            </p>
                        </div>

                        <div>
                            <!-- loop -->
                            @foreach($expensesFixed['expenses_paid'] as $expensePaid)
                                <div class="border-t-2 border-green-500 rounded-3xl bg-gray-600 mb-4 last:mb-0 p-4">
                                    <p class="font-bold text-gray-100">
                                        {{ $expensePaid->title }}
                                    </p>

                                    <p class="font-bold text-gray-100">
                                        {{ App\Helpers\FormatCurrency::getFormatCurrency($expensePaid->value) }}
                                    </p>

                                    <p class="text-xs font-bold text-gray-100">
                                        Vencimento: {{ $expensePaid->due_date->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endforeach
                            <!-- end loop -->
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6 class="text-xs font-bold uppercase text-center text-gray-100 mb-4">
                            Pendente
                        </h6>

                        <div class="rounded-xl flex justify-between bg-red-500 mb-4 p-2">
                            <p class="text-xs font-bold uppercase text-gray-100">
                                Total a pagar
                            </p>

                            <p class="text-xs font-bold text-gray-100">
                                {{ $totalFixedExpensesPeding }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <!-- loop -->
                            @foreach($expensesFixed['expenses_peding'] as $expensePeding)
                                <div class="border-t-2 border-red-500 rounded-3xl relative bg-gray-600 mb-4 last:mb-0 p-4">
                                    <p class="font-bold text-gray-100">
                                        {{ $expensePeding->title }}
                                    </p>

                                    <p class="font-bold text-gray-100">
                                        {{ App\Helpers\FormatCurrency::getFormatCurrency($expensePeding->value) }}
                                    </p>

                                    <p class="text-xs font-bold text-gray-100 mb-2">
                                        Vencimento: {{ $expensePeding->due_date->format('d/m/Y') }}
                                    </p>

                                    <a class="transition hover:scale-90 rounded-md inline-block text-xs font-medium text-white bg-red-500 py-1 px-3" href="{{ route('expense.showExpenseFixed', $expensePeding->id) }}">
                                        Pagar agora
                                    </a>
                                </div>
                            @endforeach
                            <!-- end loop -->
                        </div>

                        <div class="rounded-xl flex justify-between bg-red-500 mb-4 p-2">
                            <p class="text-xs font-bold uppercase text-gray-100">
                                Valor atrasado
                            </p>

                            <p class="text-xs font-bold text-gray-100">
                                {{ $fixedExpensesTotalArrears }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-6/12 px-4">

                <div class="grid grid-cols-2 gap-4 mb-10">

                    <div class="col-span-full">

                        @if(isset($creditPrimaryCurrent) && isset($creditSecondaryCurrent))
                            <div class="shadow-lg rounded-2xl flex justify-between bg-gray-700 py-2 px-8">
                                <p class="text-sm font-bold text-gray-100">
                                    {{ $creditPrimaryCurrent->title }} <br />
                                    {{ App\Helpers\FormatCurrency::getFormatCurrency($creditPrimarySumValues) }}
                                </p>

                                <p class="text-sm font-bold text-gray-100">
                                    {{ $creditSecondaryCurrent->title }} <br />
                                    {{ App\Helpers\FormatCurrency::getFormatCurrency($creditSecondarySumValues) }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="col-span-2 shadow-lg rounded-3xl bg-yellow-500 py-6 px-4">
                        <p class="text-xl font-bold text-gray-100">
                            Restante:
                        </p>

                        @if(isset($balance['remaining_values']))
                            <p class="text-2xl font-bold text-gray-100">
                                {{ $balance['remaining_values'] }}
                            </p>
                        @endif
                    </div>

                    <div class="col-span-1 shadow-lg rounded-3xl bg-green-500 py-6 px-4">
                        <p class="text-xl font-bold text-gray-100">
                            Entrada:
                        </p>

                        @if(isset($balance['deposit']))
                            <p class="text-2xl font-bold text-gray-100">
                                {{ $balance['deposit'] }}
                            </p>
                        @endif
                    </div>

                    <div class="col-span-1 shadow-lg rounded-3xl bg-red-500 py-6 px-4">
                        <p class="text-xl font-bold text-gray-100">
                            Despesas:
                        </p>

                        @if(isset($balance['expense']))
                            <p class="text-2xl font-bold text-gray-100">
                                {{ $balance['expense'] }}
                            </p>
                        @endif
                    </div>
                </div>

                @livewire('panel-categories')
            </div>

            <div class="w-3/12 px-4">

                <div class="rounded-3xl bg-gray-700 mb-4 p-4">
                    <h4 class="text-lg font-bold uppercase text-center text-gray-100 mb-2">
                        Avisos
                    </h4>

                    <hr class="bg-gray-100">

                    <div class="mt-4">
                        <!-- loop -->
                        @foreach($warnings as $warning)
                            <div class="rounded-3xl border-t-2 border-blue-500 bg-gray-600 mb-4 last:mb-0 p-4">
                                <p class="border-b border-gray-100 text-sm font-bold text-gray-100 mb-2 pb-2">
                                    {{ $warning->text }}
                                </p>

                                <p class="text-sm font-bold text-gray-100">
                                    {{ $warning->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>

                <div class="rounded-3xl bg-gray-700 p-4">
                    <h4 class="text-lg font-bold uppercase text-center text-gray-100 mb-2">
                        Metas
                    </h4>

                    <hr class="bg-gray-100">

                    @if(!$categoriesMetas->isEmpty())
                        <div class="mt-4">
                            <!-- loop -->
                            @foreach($categoriesMetas as $categoryMeta)
                                <div class="rounded-3xl border-t-2 {{ $categoryMeta->meta_value > $categoryMeta->total ? 'border-blue-500' : 'border-red-500' }} relative bg-gray-600 mb-4 last:mb-0 p-4">
                                    <p class="border-b border-gray-100 text-sm font-bold text-gray-100 mb-2 pb-2">
                                        {{ $categoryMeta->title . ' - ' . App\Helpers\MonthHelper::getMonth($categoryMeta->meta_month) }}
                                    </p>

                                    <p class="text-sm font-bold text-gray-100">
                                        {{ App\Helpers\FormatCurrency::getFormatCurrency($categoryMeta->meta_value) . ' | ' . App\Helpers\FormatCurrency::getFormatCurrency($categoryMeta->total) }}
                                    </p>

                                    @if($categoryMeta->total > $categoryMeta->meta_value)
                                        <span class="rounded-full shadow-lg inline-block text-[10px] font-semibold text-center text-white bg-red-500 py-1 px-2">
                                            Ultrapassou
                                        </span>
                                    @else
                                        <span class="rounded-full shadow-lg inline-block text-[10px] font-semibold text-center text-white bg-green-500 py-1 px-2">
                                            Bom
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                            <!-- end loop -->
                        </div>
                    @else
                        <p class="text-sm font-bold text-center text-white mt-2">
                            Nenhuma meta encontrada!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
