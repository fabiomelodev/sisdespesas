<x-layout.base>
    <x-slot name="title">
        Metas
    </x-slot>

    <section class="bg-gray-800 py-8">

        <div class="container flex flex-wrap mx-auto px-4">

            <div class="w-full">

                <div class="rounded-3xl bg-gray-700 p-4">

                    <h1 class="text-3xl font-bold text-gray-100 mb-4">
                        Metas
                    </h1>

                    <div class="grid grid-cols-3 gap-4">
                        <!-- loop -->
                        @foreach($expensesMetas as $expense)
                            <div class="rounded-2xl bg-gray-600 p-4">
                                <p class="text-gray-100">
                                    <strong>Categoria:</strong> {{ $expense->title }} <br />
                                    <strong>Valor total: </strong> R$ {{ $expense->total }} <br />
                                    <strong>Meta:</strong> R$ {{ $expense->meta_value }} <br />
                                    <strong>Status:</strong> {{ $expense->total > $expense->meta_value ? 'Péssimo' : 'OK' }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
