<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- header -->
    <header class="w-full h-8 flex bg-red-500">

        <div class="w-2/12">
            <button>
                menu
            </button>
        </div>

        <div class="w-8/12">
            mês
        </div>

        <div class="w-2/12"></div>

        <!-- aside -->
        <div class="w-72 h-screen top-0 left-0 fixed hidden bg-gray-900 z-50 p-4">

            <div class="w-full h-full">

                <div class="w-full h-12 flex items-center text-3xl font-bold text-white mb-4">
                    SIS Despesas
                </div>

                <h3 class="text-lg font-bold text-gray-100">
                    Menu
                </h3>

                <ul class="mt-2">
                    @for($i = 0; $i < 8; $i++)
                        <li class="mb-2">
                            <a
                            class="transition border-b border-gray-800 block font-medium text-gray-100 hover:bg-gray-700 py-1 px-2"
                            href="#">
                                Despesas
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
        <!-- end aside -->
    </header>
    <!-- end header -->

    <!-- account -->
    <div class="overflow-hidden rounded-bl-3xl rounded-br-3xl bg-gray-700 py-6">

        <div class="flex flex-col items-center">
            <p class="text-lg font-semibold text-center text-gray-400">
                Saldo em contas
            </p>

            <div class="w-72 relative">
                <p class="text-3xl font-bold text-center text-gray-300">
                    R$ 0.000,00
                </p>

                <div
                class="w-full h-full top-0 left-0 shadow rounded-3xl absolute bg-gray-300"
                x-show="showBalance"
                x-transition:enter="transition duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>
            </div>
        </div>

        <div
        class="flex justify-center cursor-pointer mt-4"
        x-on:click="showBalance = !showBalance">

            <div
            x-show="!showBalance"
            x-clock>
                <svg class="fill-gray-400" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
            </div>

            <div
            x-show="showBalance"
            x-cloak>
                <svg class="fill-gray-400" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
            </div>
        </div>

        <div class="flex justify-around mt-8">
            @for($i = 0; $i < 2; $i++)
                <div class="flex">
                    <div class="w-10 h-10 rounded-full flex justify-center items-center {{ $i % 2 == 0 ? 'bg-green-500' : 'bg-red-500' }}">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>
                    </div>

                    <div class="pl-4">
                        <p class="font-semibold text-gray-400">
                            {{ $i % 2 == 0 ? 'Receitas' : 'Despesas' }}
                        </p>

                        <div class="relative">
                            <p class="font-bold {{ $i % 2 == 0 ? 'text-green-500' : 'text-red-500' }}">
                                R$ 0.000,00
                            </p>

                            <div
                            class="w-full h-full top-0 left-0 shadow rounded-3xl absolute bg-gray-300"
                            x-show="showBalance"
                            x-transition:enter="transition duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition duration-300"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!-- end account -->

    <!-- banks -->
    <div class="py-6 px-4">

        <h3 class="text-2xl font-bold text-gray-400">
            Contas
        </h3>

        <div class="overflow-hidden rounded-3xl flex flex-wrap bg-gray-700 mt-4 p-6">

            <div class="w-full">

                <div class="flex flex-wrap">

                    <!-- loop -->
                    @for($i = 0; $i < 8; $i++)
                        <div class="w-3/12 flex mb-6">

                            <div class="w-14 h-14 overflow-hidden rounded-full flex justify-center items-center bg-purple-800">
                                <img
                                class="w-8 h-6"
                                src="data:image/png;base64,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"
                                alt="Nome do banco - Banco" />
                            </div>

                            <div class="flex flex-col justify-center pl-4">
                                <p class="text-sm font-bold text-white">
                                    Nome do banco
                                </p>

                                <p class="text-sm font-bold">
                                    <span class="text-green-500 mr-2">
                                        + R$ 0.000,00
                                    </span>

                                    <span class="text-red-500">
                                        - R$ 0.000,00
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endfor
                    <!-- end loop -->
                </div>
            </div>

            <hr class="w-full opacity-10 bg-gray-800 mb-4" />

            <div class="w-full flex justify-between">
                <p class="text-lg font-bold text-gray-100">
                    Total
                </p>

                <p class="text-lg font-bold text-gray-100">
                    R$ 0.000,00
                </p>
            </div>
        </div>
    </div>
    <!-- end banks -->

    <!-- expenses fixed -->
    @livewire('expenses-status')
    <!-- end expenses fixed -->
</x-app-layout>
