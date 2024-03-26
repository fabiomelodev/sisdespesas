<div class="mb-10 py-6 px-4">

    <h3 class="text-2xl font-bold text-gray-400">
        Despesas fixas
    </h3>

    <div class="overflow-hidden rounded-3xl flex flex-wrap bg-gray-700 mt-4 p-6">

        <div class="w-full flex flex-wrap">

            <!-- paid out -->
            <div class="w-6/12 pr-4">

                <h5 class="font-semibold text-gray-300">
                    Pagos
                </h5>

                <div class="h-96 overflow-y-scroll overflow-x-hidden rounded-3xl relative bg-gray-400 p-2 mt-4">

                    <!-- loop -->
                    @foreach($expenses_paid as $expense_paid)
                        <div
                        class="w-full overflow-hidden shadow border-t-2 border-green-500 rounded-3xl relative bg-gray-300 p-4 mb-4"
                        x-data="{ boxActions: false, boxDelete: false }"
                        x-on:mouseover="boxActions = true"
                        x-on:mouseout="boxActions = false">

                            <p class="text-xs font-bold text-gray-800">
                                {{ $expense_paid->title }}
                            </p>

                            <p class="text-xs font-bold text-green-500">
                                R$ {{ $expense_paid->value }}
                            </p>

                            <p class="text-xs text-gray-800">
                                <span class="font-bold">Vencimento:</span> {{ \Carbon\Carbon::parse($expense_paid->due_date)->format('d/m/Y') }}
                            </p>

                            <div class="w-8 h-8 top-2 right-2 shadow rounded-full absolute flex justify-center items-center bg-green-500">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                            </div>

                            <!-- actions -->
                            <div
                            class="w-24 h-full top-0 right-0 rounded-xl overflow-hidden absolute flex flex-wrap"
                            x-show="boxActions"
                            x-cloak
                            x-transition:enter="transition duration-500"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition duration-500"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full">

                                <a
                                class="w-full h-1/2 bg-blue-500 hover:bg-blue-400 flex items-center cursor-pointer pl-4"
                                href="{{ route('expenses.edit', $expense_paid->id) }}">
                                    <span class="mr-2">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                    </span>

                                    <p class="text-xs font-bold text-white">
                                        Editar
                                    </p>
                                </a>

                                <div
                                class="w-full h-1/2 bg-red-500 hover:bg-red-400 flex items-center cursor-pointer pl-4"
                                x-on:click="boxDelete = true">
                                    <span class="mr-2">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                    </span>

                                    <p class="text-xs font-bold text-white">
                                        Excluir
                                    </p>
                                </div>
                            </div>
                            <!-- end actions -->

                            <!-- delete -->
                            <div
                            class="w-full h-full top-0 left-0 absolute flex flex-col justify-center items-center bg-red-500 z-50"
                            x-show="boxDelete"
                            x-transition:enter="transition duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0">

                                <h6 class="text-sm font-bold text-white">
                                    Realmente deseja excluir?
                                </h6>

                                <div class="mt-1">
                                    <button
                                    class="transition hover:scale-110 rounded-full font-bold text-center text-red-500 bg-white mr-2 py-2 px-6"
                                    type="button"
                                    wire:click="delete({{ $expense_paid->id }})"
                                    x-on:click="boxDelete = false">
                                        Excluir
                                    </button>

                                    <button
                                    class="transition hover:scale-110 rounded-full font-bold text-center text-gray-500 bg-white ml-2 py-2 px-6"
                                    type="button"
                                    x-on:click="boxDelete = false">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                            <!-- end delete -->
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
            <!-- end paid out -->

            <!-- pending -->
            <div class="w-6/12 pl-4">

                <div class="flex justify-between">
                    <h5 class="font-semibold text-gray-300">
                        Pendentes / Atrasados
                    </h5>

                    <p class="font-semibold text-gray-300">
                        <span class="text-xs">
                            Total a pagar
                        </span>

                        R$ 0.000,00
                    </p>
                </div>

                <div class="h-96 overflow-y-scroll overflow-x-hidden rounded-3xl relative bg-gray-400 p-2 mt-4">

                    <!-- loop -->
                    @for($i = 0; $i < 10; $i++)
                        <div class="w-full overflow-hidden shadow border-t-2 border-red-500 rounded-3xl relative bg-gray-300 p-4 mb-4">

                            <p class="text-xs font-bold text-gray-800">
                                Despesa
                            </p>

                            <p class="text-xs font-bold text-red-500">
                                R$ 0.000,00
                            </p>

                            <p class="text-xs text-gray-800">
                                <span class="font-bold">Vencimento:</span> 00/00/0000
                            </p>

                            <div class="w-8 h-8 top-2 right-2 shadow rounded-full absolute flex justify-center items-center bg-red-500">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                            </div>
                        </div>
                    @endfor
                    <!-- end loop -->
                </div>
            </div>
            <!-- end pending -->
        </div>
    </div>
</div>
