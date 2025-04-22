<x-layout.single-base>
    <x-slot name="title">
        Single Report General
    </x-slot>

    <div class="w-full h-8 top-0 left-0 shadow fixed flex justify-center items-center bg-indigo-600">
        <p class="font-bold text-center text-white">
            {{ $dateCurrent }}
        </p>
    </div>

    <section class="flex flex-wrap">

        <div class="w-2/12 bg-black  px-4">

            <div class="top-0 sticky flex flex-col gap-4 pt-10">
                @foreach($warnings as $warning)
                    <div class="shadow-lg rounded-lg flex flex-col gap-2 bg-gray-800 p-4">
                        <p class="text-sm text-white">
                            {{ $warning->text }}
                        </p>

                        <p class="text-xs text-white">
                            {{ $warning->date_current->format('d/m/y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-10/12">

            <!-- banks -->
            <div class="py-10 px-4">

                <div class="grid grid-cols-4 gap-4">

                    @foreach($banks as $bank)
                        <div class="shadow rounded-lg flex flex-col gap-2 bg-red-500 p-4" style="background-color: {{ $bank['color'] }}">

                            <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center bg-white/50 p-2">
                                <img src="{{ Storage::url($bank['icon']) }}" alt="{{ $bank['title'] }}" />
                            </div>

                            <div>
                                <p class="text-3xl font-bold text-white">
                                    {{ $bank['remaining'] }}
                                </p>
                            </div>

                            <div class="flex justify-between gap-2">
                                <p class="text-xs font-medium text-white/50">
                                    Entrada <br />
                                    <span class="text-sm font-bold text-white">
                                        {{ $bank['deposits']}}
                                    </span>
                                </p>

                                <p class="text-xs font-medium text-white/50">
                                    Saída <br />
                                    <span class="text-sm font-bold text-white">
                                        {{ $bank['expenses'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end banks -->

            <!-- expenses fixed -->
            <div class="py-10 px-4">
                <div class="mb-16">
                    <h2 class="text-6xl font-bold text-center uppercase text-indigo-600">
                        Despesas fixas
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div class="flex flex-col gap-y-2">

                        <div class="w-full flex justify-between items-center">

                            <h4 class="text-lg font-bold uppercase text-red-500">
                                Precisa ser pagos
                            </h4>

                            <p class="text-lg font-bold text-red-500">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expensesFixedPedingTotalValues) }}
                            </p>
                        </div>

                        <!-- loop -->
                        @foreach($expensesFixedPeding as $expenseFixedPeding)
                            <div class="flex gap-2">

                                <div class="w-10 h-full shadow border border-gray rounded-md bg-white p-2">
                                    <svg class="w-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                                </div>

                                <div class="flex-1 shadow border border-gray rounded-md flex justify-between bg-white p-2">
                                    <p class="font-semibold text-black/50">
                                        {{ $expenseFixedPeding->title }}
                                    </p>

                                    <p class="font-semibold text-black/50">
                                        {{ $expenseFixedPeding->due_date->format('d/m/Y') }}
                                    </p>
                                </div>

                                <div class="w-3/12 shadow rounded-md border border-gray bg-white p-2">
                                    <p class="font-semibold text-center text-black/50">
                                        {{ \App\Helpers\FormatCurrency::getFormatCurrency($expenseFixedPeding->value) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>

                    <div class="flex flex-col gap-y-2">

                        <div class="w-full flex justify-between items-center">

                            <h4 class="text-lg font-bold uppercase text-green-500">
                                Pagos
                            </h4>

                            <p class="text-lg font-bold text-green-500">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expensesFixedPaidTotalValues) }}
                            </p>
                        </div>

                        <!-- loop -->
                        @foreach($expensesFixedPaid as $expenseFixedPaid)
                            <div class="flex gap-2">

                                <div class="w-10 h-full shadow border border-gray rounded-md bg-white p-2">
                                    <svg class="w-6 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                </div>

                                <div class="flex-1 shadow border border-gray rounded-md flex justify-between bg-white p-2">
                                    <p class="font-semibold text-black/50">
                                        {{ $expenseFixedPaid->title }}
                                    </p>

                                    <p class="font-semibold text-black/50">
                                        {{ $expenseFixedPaid->due_date->format('d/m/y') }} | {{ $expenseFixedPaid->pay_day->format('d/m/y') }}
                                    </p>
                                </div>

                                <div class="w-3/12 shadow rounded-md border border-gray bg-white p-2">
                                    <p class="font-semibold text-center text-black/50">
                                        {{ \App\Helpers\FormatCurrency::getFormatCurrency($expenseFixedPaid->value) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>
            </div>
            <!-- end expenses -->

            <!-- categories -->
            <div class="bg-indigo-600 py-10 px-4">
                <div class="w-full mb-16 py-6">
                    <h2 class="text-6xl font-bold text-center uppercase text-white">
                        Categorias
                    </h2>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <!-- loop -->
                    @foreach($expensesCategories as $expenseCategory)
                        <div class="rounded-lg flex flex-col bg-white p-4">

                            <p class="font-semibold text-black/50">
                                {{ $expenseCategory->title }}
                            </p>

                            <p class="text-3xl font-bold text-indigo-600">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expenseCategory->total) }}
                            </p>
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
            <!-- end categories -->

            <!-- metas -->
            <div class="py-10 px-4">
                <div class="mb-16 py-6">
                    <h2 class="text-6xl font-bold text-center uppercase text-indigo-600">
                        Metas
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <!-- loop -->
                    @foreach($metas as $meta)
                        <div>
                            <div class="mb-2">
                                <h3 class="text-4xl font-bold">
                                    {{ $meta['title'] }}
                                </h3>
                            </div>

                            <div class="mb-2">
                                <p class="text-2xl font-bold">
                                    {{ $meta['value'] }} / {{ $meta['meta'] }}
                                </p>
                            </div>

                            <div class="w-96 h-6 border-2 border-indigo-600 rounded-lg overflow-hidden flex bg-indigo-400 mb-1">
                                <div class="rounded-md flex items-center bg-indigo-600 p-1" style="width:{{ $meta['percentage'] }}%">
                                    <p class="text-xs font-bold text-white">
                                        {{ $meta['percentage'] }}%
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs font-medium">
                                    Está quase passando o limite da meta!!!
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
            <!-- end metas -->

            <!-- uber -->
            <div class="bg-black py-10 px-4">
                <div class="mb-16">
                    <h2 class="text-6xl font-bold text-center uppercase text-white">
                        Uber
                    </h2>
                </div>

                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-3 border-2 border-white/50 rounded-lg shadow-lg flex gap-x-2 bg-black py-6 px-2">
                        <img class="w-10 h-10" style="filter: invert(1)" src="{{ Vite::asset('resources/images/icon-calendar.png')}}" alt="Ícone calendário - SIS Despesas" />

                        <div>
                            <p class="text-sm font-semibold text-white/50">
                                Ano
                            </p>

                            <p class="text-3xl font-black text-white">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($ubersYearCurrentTotalValue) }}
                            </p>

                            <p class="text-xs font-medium text-white/50">
                                Qtde: {{ $ubersYearCurrentQty }}
                            </p>
                        </div>
                    </div>

                    <div class="col-span-3 border-2 border-white/50 rounded-lg shadow-lg flex gap-x-2 bg-black py-6 px-2">
                        <img class="w-10 h-10" style="filter: invert(1)" src="{{ Vite::asset('resources/images/icon-calendar.png')}}" alt="Ícone calendário - SIS Despesas" />

                        <div>
                            <p class="text-sm font-semibold text-white/50">
                                Mês
                            </p>

                            <p class="text-3xl font-black text-white">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($ubersMonthCurrentTotalValue) }}
                            </p>

                            <p class="text-xs font-medium text-white/50">
                                Qtde: {{ $ubersMonthCurrentQty }}
                            </p>
                        </div>
                    </div>

                    <div class="col-span-3 border-2 border-white/50 rounded-lg shadow-lg flex gap-x-2 bg-black py-6 px-2">
                        <img class="w-12 h-12" style="filter: invert(1)" src="{{ Vite::asset('resources/images/icon-car.png')}}" alt="Ícone carro - SIS Despesas" />

                        <div>
                            <p class="text-sm font-semibold text-white/50">
                                Carro
                            </p>

                            <p class="text-3xl font-black text-white">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($ubersCarTotalValues) }}
                            </p>

                            <p class="text-xs font-medium text-white/50">
                                Qtde: {{ $ubersCarQty }}
                            </p>
                        </div>
                    </div>

                    <div class="col-span-3 border-2 border-white/50 rounded-lg shadow-lg flex gap-x-2 bg-black py-6 px-2">
                        <img class="w-12 h-12" style="filter: invert(1)" src="{{ Vite::asset('resources/images/icon-car.png')}}" alt="Ícone carro - SIS Despesas" />

                        <div>
                            <p class="text-sm font-semibold text-white/50">
                                Moto
                            </p>

                            <p class="text-3xl font-black text-white">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($ubersMotorcycleTotalValues) }}
                            </p>

                            <p class="text-xs font-medium text-white/50">
                                Qtde: {{ $ubersMotorcycleQty }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="py-8">
                    <div class="mb-6">
                        <h3 class="text-4xl font-bold text-white">
                            Meta
                        </h3>
                    </div>

                    <div class="mb-2">
                        <p class="text-2xl font-bold text-white">
                            {{ \App\Helpers\FormatCurrency::getFormatCurrency($ubersMonthCurrentTotalValue) }} / {{ \App\Helpers\FormatCurrency::getFormatCurrency($uberMeta->value) }}
                        </p>
                    </div>

                    <div class="w-96 h-6 border-2 border-white rounded-lg overflow-hidden flex bg-white mb-2">
                        <div class="rounded-md flex items-center {{ $uberMetaPercentage > 90 ? 'bg-red-500' : 'bg-indigo-600' }} p-1" style="width:{{ $uberMetaPercentage >= 100 ? '100' : $uberMetaPercentage }}%">
                            <p class="text-xs font-bold text-white">
                                {{ $uberMetaPercentage >= '100' ? '100' : $uberMetaPercentage }}%
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-white/50">
                            Está quase passando o limite da meta!!!
                        </p>
                    </div>
                </div>
            </div>
            <!-- end uber -->
        </div>

    </section>
</x-layout.single-base>
