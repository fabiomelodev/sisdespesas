<x-layout.base>
    <x-slot name="title">
        Uber
    </x-slot>

    <section class="bg-gray-800 pt-10 pb-20">

        <div class="container grid grid-cols-3 gap-4 mx-auto">

            <div class="rounded-xl shadow-lg bg-gray-700 p-4">
                <h4 class="text-xl font-bold text-white mb-4">
                    Não urgente
                </h4>

                <!-- loop -->
                @foreach($expensesUnnecessary as $expenseUnnecessary)
                    <div class="rounded-xl shadow-lg flex justify-between items-center bg-gray-600 mb-4 last:mb-0 p-4">
                        <p class="font-bold text-gray-100">
                            {{ $expenseUnnecessary->title }}
                        </p>

                        <p class="font-bold text-gray-100">
                            R$ {{ $expenseUnnecessary->value }}
                        </p>
                    </div>
                @endforeach
                <!-- end loop -->
            </div>

            <div class="rounded-xl shadow-lg bg-gray-700 p-4">
                <h4 class="text-xl font-bold text-white mb-4">
                    Necessários
                </h4>

                <!-- loop -->
                @foreach($expensesNecessary as $expenseNecessary)
                    <div class="rounded-xl shadow-lg flex justify-between items-center bg-gray-600 mb-4 last:mb-0 p-4">
                        <p class="font-bold text-gray-100">
                            {{ $expenseNecessary->title }}
                        </p>

                        <p class="font-bold text-gray-100">
                            R$ {{ $expenseNecessary->value }}
                        </p>
                    </div>
                @endforeach
                <!-- end loop -->
            </div>
        </div>
    </section>
</x-layout.base>
