<x-layout.base>
    <x-slot name="title">
        Categoria - {{ $category->title }}
    </x-slot>

    <section class="bg-gray-800 pt-10 pb-20">

        <div class="container flex justify-center items-end">

            <div class="w-10/12">

                <div class="flex justify-between mb-8">
                    <h1 class="text-4xl font-bold text-gray-100">
                        {{ $category->title }}
                    </h1>

                    <div class="flex items-end">
                        <p class="text-lg font-bold text-gray-100">
                            Contém {{ $expenses->count() }} despesa(s)
                        </p>
                    </div>
                </div>

                <!-- loop -->
                @foreach($expenses as $expense)
                    <div class="rounded-3xl grid grid-cols-3 justify-between items-center bg-gray-700 mb-4 last:mb-0 py-2 px-6">
                        <div>
                            <p class="font-bold text-gray-100">
                                {{ $expense->title }}
                            </p>
                        </div>

                        <div class="flex justify-center">
                            <p class="font-bold text-center text-gray-100">
                                {{ $expense->pay_day->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <p class="font-bold text-gray-100">
                                {{ App\Helpers\FormatCurrency::getFormatCurrency($expense->value) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <!-- end loop -->
            </div>
        </div>
    </section>
</x-layout.base>
