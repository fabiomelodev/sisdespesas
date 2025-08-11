<section class="pt-6">

    <div class="container">

        <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">
                    Despesas fixas
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

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
