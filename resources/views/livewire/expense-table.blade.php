<div
class="overflow-hidden shadow rounded-3xl bg-gray-700 mt-6 p-2 lg:p-4"
x-data="{ notification: true }">

    <!-- search -->
    <div
    class="shadow rounded-3xl flex justify-end bg-gray-600 p-3"
    x-data="{ boxFilter: false }">

        <div class="w-4/12">

            <div class="relative">

                <div class="top-1/2 left-4 -translate-y-1/2 absolute">
                    <svg class="fill-gray-100" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </div>

                <input
                class="w-full shadow rounded-3xl text-sm font-medium text-gray-100 bg-gray-800 pl-10"
                type="text"
                wire:model.live="searchCategory"
                placeholder="Pesquise por...">
            </div>
        </div>

        <div class="w-4/12 relative flex justify-end">

            <button
            class="transition shadow rounded-3xl flex items-center font-bold text-white bg-blue-600 hover:bg-blue-500 py-2 px-4"
            type="button"
            x-on:click="boxFilter = !boxFilter">
            <svg class="w-4 h-4 fill-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/></svg>

                <span class="ml-2">
                    Filtro
                </span>
            </button>

            <!-- modal filter -->
            <div
            class="w-72 top-full right-0 translate-y-4 shadow-xl rounded-xl absolute bg-gray-700 z-20 p-4"
            x-show="boxFilter"
            x-transition:enter="transition duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

                <!-- categories -->
                <div class="flex flex-col">
                    <label
                    class="text-sm font-bold text-white"
                    for="filterCategory">
                        Categoria:
                    </label>

                    <select
                    class="transition shadow-lg rounded-xl text-white bg-gray-500 hover:bg-gray-300 cursor-pointer mt-1"
                    wire:model.live="categoryFilter"
                    id="filterCategory">
                        <option>Selecionar</option>
                        @foreach($categoriesFilter as $category)
                            <option value="{{ $category->slug }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- end categories -->

                <!-- pay day start -->
                <div class="flex flex-col mt-4">
                    <label
                    class="text-sm font-bold text-white"
                    for="payDayStartFilter">
                        Pagamento de início:
                    </label>

                    <input
                    class="transition shadow-lg rounded-xl text-white bg-gray-500 hover:bg-gray-300 cursor-pointer mt-1"
                    type="date"
                    wire:model.live="payDayStartFilter"
                    id="payDayStartFilter" />
                </div>
                <!-- end pay day start -->

                <!-- pay day end -->
                <div class="flex flex-col mt-4">
                    <label
                    class="text-sm font-bold text-white"
                    for="payDayEndFilter">
                        Pagamento de termíno:
                    </label>

                    <input
                    class="transition shadow-lg rounded-xl text-white bg-gray-500 hover:bg-gray-300 cursor-pointer mt-1"
                    type="date"
                    wire:model.live="payDayEndFilter"
                    id="payDayEndFilter" />
                </div>
                <!-- end pay day end -->

                <!-- button clear -->
                <div class="mt-4">
                    <button
                    class="w-full rounded-xl font-bold text-center text-white bg-red-500 hover:bg-red-400 py-2"
                    wire:click="filterClear">
                        Limpar
                    </button>
                </div>
                <!-- end button clear -->
            </div>
            <!-- end modal filter -->
        </div>
    </div>
    <!-- end search -->

    <!-- head -->
    <div class="shadow rounded-3xl flex bg-gray-600 mt-4 p-3">

        <div class="w-3/12 pl-4 pr-1">
            <h5 class="text-sm font-bold text-white">
                Despesa
            </h5>
        </div>

        <div class="w-7/12 lg:w-2/12 px-1">
            <h5 class="text-sm font-bold text-white">
                Categoria
            </h5>
        </div>

        <div class="w-1/12 hidden lg:block px-1">
            <h5 class="text-sm font-bold text-white">
                Valor
            </h5>
        </div>

        <div class="w-1/12 hidden lg:block px-1">
            <h5 class="text-sm font-bold text-white">
                Vencimento
            </h5>
        </div>

        <div class="w-1/12 hidden lg:block px-1">
            <h5 class="text-sm font-bold text-white">
                Pagamento
            </h5>
        </div>

        <div class="w-1/12 hidden lg:block px-1">
            <h5 class="text-sm font-bold text-white">
                Status
            </h5>
        </div>

        <div class="w-3/12">
        </div>
    </div>
    <!-- end head -->

    <!-- body -->
    <div class="shadow rounded-3xl bg-gray-600 mt-4 p-2 lg:py-4 lg:px-0">

        <div class="pt-4 px-6">
            @if(isset($expenses_month_current_sum_values))
                <p class="text-gray-100">
                    <strong>Total neste mês:</strong> R$ {{ number_format($expenses_month_current_sum_values, 2, ',', '.') }}
                </p>
            @endif

            <p class="text-gray-100">
                <strong>Total:</strong> R$ {{ number_format($expenses_sum_values, 2, ',', '.') }}
            </p>
        </div>

        <!-- loop -->
        @if(!$expenses->isEmpty())

            @foreach($expenses as $expense)

                <div class="border-b border-gray-100/10 last:border-0 flex py-2 px-3">

                    <div class="w-3/12 pl-4 pr-1">
                        <p class="text-sm text-white">
                            {{ Illuminate\Support\Str::limit($expense->title, 16) }}
                        </p>
                    </div>

                    <div class="w-2/12 px-1">
                        <p class="text-sm text-white">
                            {{ Illuminate\Support\Str::limit($expense->category->title, 16) }}
                        </p>
                    </div>

                    <div class="w-1/12 hidden lg:block px-1">
                        <p class="text-sm text-white">
                            R$ {{ $expense->value }}
                        </p>
                    </div>

                    <div class="w-3/12 lg:w-1/12 px-1">
                        <p class="text-sm text-white">
                            {{ $expense->due_date ? $expense->due_date->format('d/m/y') : '--/--/--' }}
                        </p>
                    </div>

                    <div class="w-3/12 lg:w-1/12 px-1">
                        <p class="text-sm text-white">
                            {{ $expense->pay_day ? $expense->pay_day->format('d/m/y') : '--/--/--' }}
                        </p>
                    </div>

                    <div class="w-1/12 px-1">
                        @php
                            $iconStatus = match($expense->status) {
                                'pendente' => '<svg class="w-6 h-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>',
                                'pago'     => '<svg class="w-6 h-6 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>'
                            }
                        @endphp

                        {!! $iconStatus !!}
                    </div>

                    <div class="flex-1 pl-1 pr-4">

                        <div class="flex justify-end">

                            <a
                            class="transition rounded-3xl flex items-center hover:bg-blue-500 py-2 px-4"
                            href="{{ route('expenses.edit', $expense->id) }}">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>

                                {{-- <span class="hidden lg:block text-xs font-bold text-white ml-2">
                                    Editar
                                </span> --}}
                            </a>

                            <button
                            class="transition rounded-3xl flex items-center hover:bg-red-500 lg:ml-3 py-2 pl-4 lg:px-4"
                            wire:click="delete({{ $expense->id }})">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>

                                {{-- <span class="hidden lg:block text-xs font-bold text-white ml-2">
                                    Excluir
                                </span> --}}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex justify-center my-8">
                <div class="w-96 shadow rounded-3xl flex flex-col justify-center items-center bg-gray-500 p-6">
                    <svg class="w-10 h-10 fill-gray-100 "xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg>

                    <p class="text-lg font-bold text-center text-gray-100 mt-4">
                        Nenhuma categoria encontrada!
                    </p>
                </div>
            </div>
        @endif
        <!-- end loop -->
    </div>
    <!-- end body -->

    {{-- <div
    class="w-full h-screen top-0 left-0 fixed flex justify-center items-center bg-gray-800"
    x-show="modalDelete"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

        <div class="container flex justify-center">

            <div class="w-8/12">

                <div class="w-full shadow border border-gray/50 rounded-3xl bg-white p-6">

                    <p class="text-xl font-semibold text-center">
                        Deseja excluir esse item?
                    </p>

                    <div class="flex justify-center mt-6">

                        <button
                        class="w-36 transition hover:scale-110 shadow rounded-3xl font-bold text-xl text-center text-white bg-red-500 mr-4 py-3"
                        wire:click="delete($id)"
                        x-on:click="modalDelete = false">
                            Excluir
                        </button>

                        <button
                        class="w-36 transition hover:scale-110 shadow rounded-3xl font-bold text-xl text-center text-white bg-gray-500 ml-4 py-3"
                        x-on:click="modalDelete = false">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- notification delete -->
    @if(session()->has('message'))
        <div
        class="w-64 bottom-4 right-4 shdow-lg rounded-3xl fixed flex items-center bg-white z-50 py-3 px-4"
        x-init="setTimeout(() => notification = false, 5000)"
        x-show="notification"
        x-transition:leave="transition duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
            <svg class="w-6 h-6 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>

            <p class="font-bold text-gray-800 ml-3">
                {{ session('message') }}
            </p>
        </div>
    @endif
    <!-- end notification delete -->
</div>
