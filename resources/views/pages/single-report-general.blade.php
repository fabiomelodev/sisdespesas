<x-layout.single-base>
    <x-slot name="title">
        Single Report General
    </x-slot>

    {{-- <div class="w-full h-8 top-0 left-0 shadow fixed flex justify-center items-center bg-indigo-600">
        <p class="font-bold text-center text-white">
            {{ $dateCurrent }}
        </p>
    </div> --}}

    <!-- banks -->
    <section class="pt-6">

        <div class="container">

            <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white">
                        Bancos
                    </h2>
                </div>

                <div class="grid grid-cols-4 gap-4">

                    <!-- loop -->
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
                    <!-- end loop -->
                </div>
            </div>
        </div>
    </section>
    <!-- end banks -->

    <!-- expenses fixed -->
    <section class="pt-6">

        <div class="container">
               <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white">
                        Despesas fixas
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div class="flex flex-col gap-y-2">

                        <div class="w-full flex justify-between items-center">

                            <h4 class="text-lg font-bold text-white/80">
                                Pendentes
                            </h4>

                            <p class="text-lg font-bold text-white/80">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expensesFixedPedingTotalValues) }}
                            </p>
                        </div>

                        <!-- loop -->
                        @foreach($expensesFixedPeding as $expenseFixedPeding)
                            <div class="w-full shadow-lg rounded-lg grid grid-cols-4 gap-2 bg-white p-2">
                                <p class="text-xs font-semibold">
                                    {{ Illuminate\Support\Str::limit($expenseFixedPeding->title, 25) }}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $expenseFixedPeding->category->title}}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $expenseFixedPeding->due_date->format('d/m/Y') }}
                                </p>

                                <p class="text-xs font-semibold text-right">
                                    {{ \App\Helpers\FormatCurrency::getFormatCurrency($expenseFixedPeding->value) }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>

                    <div class="flex flex-col gap-y-2">

                        <div class="w-full flex justify-between items-center">

                            <h4 class="text-lg font-bold text-white/80">
                                Pagos
                            </h4>

                            <p class="text-lg font-bold text-white/80">
                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($expensesFixedPaidTotalValues) }}
                            </p>
                        </div>

                        <!-- loop -->
                        @foreach($expensesFixedPaid as $expenseFixedPaid)
                            <div class="w-full shadow-lg rounded-lg grid grid-cols-4 gap-2 bg-white p-2">
                                <p class="text-xs font-semibold">
                                    {{ Illuminate\Support\Str::limit($expenseFixedPaid->title, 25) }}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $expenseFixedPaid->category->title}}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $expenseFixedPaid->pay_day->format('d/m/Y') }}
                                </p>

                                <p class="text-xs font-semibold text-right">
                                    {{ \App\Helpers\FormatCurrency::getFormatCurrency($expenseFixedPaid->value) }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end expenses -->

    <!-- credits -->
    <section class="pt-6">

        <div class="container">

            <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white">
                        Cartões de crédito
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <!-- loop -->
                    @foreach($cardCredits as $cardCredit)
                        <div class="flex flex-wrap border-b-2 last:border-0 border-white/10 pb-4">

                            <div class="w-1/3 pr-4">
                                <div
                                    class="shadow-lg rounded-lg  p-6"
                                    style="background-color: {{ $cardCredit['bank_color'] }}">
                                    <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center bg-white/50 p-2">
                                        <img
                                            src="{{ Storage::url($cardCredit['bank_icon']) }}"
                                            alt="{{ $cardCredit['title'] }}" />
                                    </div>

                                    <h4 class="text-2xl font-bold text-white mt-2">
                                        {{ $cardCredit['title'] }}
                                    </h4>

                                    <p class="shadow-lg rounded-lg inline-block text-[10px] font-bold text-center capitalize text-white {{ $cardCredit['status'] == 'pago' ? 'bg-green-500' : 'bg-red-500' }} py-1 px-2">
                                        {{ $cardCredit['status'] }}
                                    </p>

                                    <div class="flex justify-between gap-2 mt-4">
                                        <p class="text-xs font-medium text-white/50">
                                            Limite <br />
                                            <span class="text-sm font-bold text-white">
                                                {{ $cardCredit['limit'] }}
                                            </span>
                                        </p>

                                        <p class="text-xs font-medium text-white/50">
                                            Gasto <br />
                                            <span class="text-sm font-bold text-white">
                                            {{ $cardCredit['creditsTotal'] }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-2/3 pl-4">

                                <div class="flex flex-wrap gap-2">
                                    <!-- loop -->
                                    @foreach($cardCredit['credits'] as $credit)
                                        <div class="w-full shadow-lg rounded-lg grid grid-cols-4 gap-2 bg-white p-2">
                                            <p class="text-xs font-semibold">
                                                {{ Illuminate\Support\Str::limit($credit->title, 25) }}
                                            </p>

                                            <p class="text-xs font-semibold text-center">
                                                {{ $credit->category->title}}
                                            </p>

                                            <p class="text-xs font-semibold text-center">
                                                {{ $credit->pay_day->format('d/m/Y') }}
                                            </p>

                                            <p class="text-xs font-semibold text-right">
                                                {{ \App\Helpers\FormatCurrency::getFormatCurrency($credit->value) }}
                                            </p>
                                        </div>
                                    @endforeach
                                    <!-- end loop -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
        </div>
    </section>
    <!-- end credits -->

    <section class="flex">

        <div class="w-full">

            <!-- categories -->
            <livewire:report-categories year="{{ $reportGeneral->year }}" month="{{ $reportGeneral->month }}" />
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
                        <img class="w-10 h-10" style="filter: invert(1)" src="{{ asset('images/icon-calendar.png')}}" alt="Ícone calendário - SIS Despesas" />

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
                        <img class="w-10 h-10" style="filter: invert(1)" src="{{ asset('images/icon-calendar.png')}}" alt="Ícone calendário - SIS Despesas" />

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
                        <img class="w-12 h-12" style="filter: invert(1)" src="{{ asset('images/icon-car.png')}}" alt="Ícone carro - SIS Despesas" />

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
                        <img class="w-12 h-12" style="filter: invert(1)" src="{{ asset('images/icon-car.png')}}" alt="Ícone carro - SIS Despesas" />

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
