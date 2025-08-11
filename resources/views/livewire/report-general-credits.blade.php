<section class="pt-6">

    <div class="container">

        <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">
                    Cartões de crédito
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <!-- loop -->
                    @foreach($cardCredits as $cardCredit)
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
                    @endforeach
                    <!-- end loop -->
                </div>

                <div>
                    <h2 class="text-xl font-bold text-white">
                        Faturas do próximo mês
                    </h2>

                    <div class="flex flex-col gap-2 mt-4">
                        <!-- loop -->
                        @foreach($invoicesNextMonth as $invoice)
                            <div class="w-full shadow-lg rounded-lg grid grid-cols-4 gap-2 bg-white p-2">
                                <p class="text-xs font-semibold">
                                    {{ $invoice->title }}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $invoice->cardCredit->title }}
                                </p>

                                <p class="text-xs font-semibold text-center">
                                    {{ $invoice->due_date->format('d/m/y') }}
                                </p>

                                <p class="text-xs font-semibold text-right">
                                    {{ \App\Helpers\FormatCurrency::getFormatCurrency($invoice->value) }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
