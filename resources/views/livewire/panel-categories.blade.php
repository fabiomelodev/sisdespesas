<div>
    <div class="mb-6">
        <form>
            <div class="flex">
                <div class="w-6/12 pr-4">
                    <input
                    class="w-full rounded-xl text-sm font-bold text-center text-gray-100 placeholder:text-gray-100 bg-gray-600 py-2"
                    type="text"
                    wire:model.live="search"
                    placeholder="Pesquise por categorias..." />
                </div>

                <div class="w-3/12 pr-4">
                    <select
                    class="w-full h-full rounded-xl text-gray-100 bg-gray-600 px-4"
                    wire:model.live="month">
                        <option value="">Selecione</option>
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}">
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-3/12 pr-4">
                    <select
                    class="w-full h-full rounded-xl text-gray-100 bg-gray-600 px-4"
                    wire:model.live="year">
                        <option value="">Selecione</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div>
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-xl font-bold text-gray-100">
                {{ $monthCurrent }}
            </h4>

            <p class="font-medium text-gray-100">
                {{ $categories_count }} categoria(s) encontrada(s)
            </p>
        </div>

        <div>
            <!-- loop -->
            @foreach($expensesCategories as $expenseCategory)
                <div class="w-full rounded-3xl flex justify-between bg-gray-600 mb-4 last:mb-0 py-2 px-6">
                    <p class="font-medium text-gray-100">
                        {{ $expenseCategory->title }}
                    </p>

                    <p class="font-medium text-gray-100">
                        R$ {{ number_format($expenseCategory->total, 2, ',', '.') }}
                    </p>

                    <a class="rounded-lg shadow-lg text-sm font-bold text-center text-white bg-blue-500 hover:bg-blue-600 py-1 px-4" href="{{ route('category.show', $expenseCategory->category_id) }}">
                        Ver
                    </a>
                </div>
            @endforeach
            <!-- end loop -->
        </div>
    </div>
</div>
