<div
x-data="{ boxDueDate: false, toggleStatus: false, textStatus: 'Pendente' }">
    <section class="pt-6 pb-12">

        <div class="container mx-auto px-4">

            <div class="w-full">

                <div class="flex justify-between">
                    <h1 class="text-3xl font-bold text-gray-100">
                        Criar Despesa
                    </h1>

                    <a
                    class="transition shadow rounded-3xl flex items-center font-bold text-white bg-blue-600 hover:bg-blue-500 py-2 px-4"
                    href="{{ route('expenses.index') }}">
                        <svg class="fill-gray-100" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>

                        <span class="ml-2">
                            Despesas
                        </span>
                    </a>
                </div>

                <hr class="w-full h-px border border-gray-100/10 my-6"/>
            </div>
        </div>

        <form wire:submit="expense">

            <div class="shadow rounded-tl-3xl rounded-tr-3xl bg-gray-700 p-6">

                <div class="border-b border-gray-100/10 flex flex-col pb-4">

                    <label
                    class="text-2xl font-bold text-gray-100 mb-2"
                    for="title">
                        Título
                    </label>

                    <input
                    class="border-0 rounded-3xl text-xl font-bold text-gray-100 bg-transparent"
                    type="text"
                    wire:model="title"
                    id="title"
                    placeholder="Título" />
                </div>

                <div class="border-b border-gray-100/10 flex py-4">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="w-5 h-5 fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                    </div>

                    <div class="w-9/12 px-4">

                        <div class="flex">

                            <div class="">
                                <input
                                class="hidden"
                                type="radio"
                                wire:model="type"
                                id="typeFickle"
                                value="inconstante"
                                checked />

                                <label
                                class="options-type"
                                for="typeFickle"
                                x-on:click="boxDueDate = false">
                                    Inconstante
                                </label>
                            </div>

                            <div>
                                <input
                                class="hidden"
                                type="radio"
                                wire:model="type"
                                id="typeFixed"
                                value="fixo" />

                                <label
                                class="options-type"
                                for="typeFixed"
                                x-on:click="boxDueDate = true">
                                    Fixo
                                </label>
                            </div>

                            <div>
                                <input
                                class="hidden"
                                type="radio"
                                wire:model="type"
                                id="typeCredit"
                                value="credito" />

                                <label
                                class="options-type"
                                for="typeCredit"
                                x-on:click="boxDueDate = true">
                                    Crédito
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-100/10 flex py-4">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="w-6 h-6 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/></svg>
                    </div>

                    <div class="w-9/12 px-4">
                        <p class="font-bold text-white">
                            <span x-text="textStatus"></span>
                        </p>
                    </div>

                    <div class="w-2/12 flex justify-end items-center px-4">
                        <input
                        class="hidden"
                        type="checkbox"
                        wire:model="status"
                        id="status" />

                        <label
                        class="toggle-status"
                        for="status"
                        x-on:click="toggleStatus = !toggleStatus; toggleStatus ? textStatus = 'Pago' : textStatus = 'Pendente'">
                            Status
                        </label>
                    </div>
                </div>

                <div
                class="border-b border-gray-100/10 flex py-4"
                    x-show="boxDueDate"
                    x-cloak
                    x-transition:enter="transition duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="fill-gray-500 w-5 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>
                    </div>

                    <div class="w-9/12 flex flex-col px-4">
                        <label
                        class="text-xs font-semibold text-gray-100"
                        for="due_date">
                            Data de vencimento
                        </label>

                        <input
                        class="w-56 border-0 font-bold text-white bg-gray-700 pl-0"
                        type="date"
                        id="due_date"
                        wire:model="due_date" />
                    </div>
                </div>

                <div class="border-b border-gray-100/10 flex py-4">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="fill-gray-500 w-5 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>
                    </div>

                    <div class="w-9/12 flex flex-col px-4">
                        <label
                        class="text-xs font-semibold text-gray-100"
                        for="pay_day">
                            Data de pagamento
                        </label>

                        <input
                        class="w-56 border-0 font-bold text-white bg-gray-700 pl-0"
                        type="date"
                        id="pay_day"
                        wire:model="pay_day" />
                    </div>
                </div>

                <div class="border-b border-gray-100/10 flex py-4">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"/></svg>
                    </div>

                    <div class="w-9/12 flex items-center px-4">
                        <p class="font-bold text-gray-500 mr-2">
                            R$
                        </p>

                        <input
                        class="w-full border-0 rounded-full font-medium text-gray-500 bg-gray-700"
                        type="text"
                        wire:model="value"
                        placeholder="00,00" />
                    </div>
                </div>

                <!-- category -->
                <div
                class="transition duration-300 border-b border-gray-100/10 flex hover:bg-gray-600 cursor-pointer py-4"
                x-on:click="modalCategories = true">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"/></svg>
                    </div>

                    <div class="w-9/12 px-4">
                        <p class="border border-blue-500 rounded-full inline-block font-bold text-blue-500 py-2 px-6 js-category">
                            {{ $categoryCurrent['title'] }}
                        </p>
                    </div>

                    <div class="w-2/12 flex justify-end items-center px-4">
                        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                    </div>
                </div>
                <!-- end category -->

                <!-- bank -->
                <div
                class="transition duration-300 border-b border-gray-100/10 flex hover:bg-gray-600 cursor-pointer py-4"
                x-on:click="modalBanks = true">

                    <div class="w-1/12 flex items-center px-4">
                        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"/></svg>
                    </div>

                    <div class="w-9/12 px-4">
                        <p class="border border-blue-500 rounded-full inline-block font-bold text-blue-500 py-2 px-6">
                            {{ $bankCurrent['title'] }}
                        </p>
                    </div>

                    <div class="w-2/12 flex justify-end items-center px-4">
                        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                    </div>
                </div>
                <!-- end bank -->

                <div class="flex mt-6">

                    <button
                    class="transition shadow rounded-full font-medium text-center uppercase text-white bg-blue-500 hover:bg-blue-400 py-2 px-6"
                    type="submit">
                        Concluído
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- modal categories -->
    <div
    class="w-full h-screen top-0 left-0 fixed flex items-end bg-gray-800/80 pt-12 z-50"
    x-show="modalCategories"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

        <div class="inset-0 absolute"
        x-on:click="modalCategories = false"></div>

        <div class="w-full rounded-tl-[100px] rounded-tr-[100px] overflow-hidden relative bg-gray-700 pt-6 px-6">

            <!-- search -->
            <div class="border-b border-gray-100/10 flex py-4 pl-4">
                <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </div>

                <form>
                    <div class="flex-1 ml-4">
                        <input
                        class="w-full border-0 rounded-3xl font-medium text-gray-400 bg-gray-700"
                        type="text"
                        wire:model.live="searchCategory"
                        placeholder="Pesquisar categoria" />
                    </div>
                </form>
            </div>
            <!-- end search -->

            <!-- categories -->
            <div class="h-[400px] overflow-y-scroll bg-yellow-  500">

                <div>
                    <!-- loop -->
                    @foreach($categories as $category)
                        <label
                        class="transition duration-300 border-b last:border-0 border-gray-100/10 flex items-center hover:bg-gray-600 cursor-pointer py-4 pl-4"
                        for="{{ $category->slug }}"
                        x-on:click="modalCategories = false">
                            <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                                <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/></svg>
                            </div>

                            <div class="flex-1 pl-4">
                                <input
                                class="hidden"
                                type="radio"
                                wire:model.live="category_id"
                                id="{{ $category->slug }}"
                                value="{{ $category->id }}" />

                                <p class="font-medium text-gray-300 js-modal-item-category">
                                    {{ $category->title }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                    <!-- end loop -->

                    <div
                    class="transition duration-300 border-b last:border-0 border-gray-100/10 flex items-center hover:bg-gray-600 cursor-pointer py-4 pl-4"
                    x-on:click="modalCategories = false; modalCreateCategory = true;">
                        <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                            <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                        </div>

                        <div class="flex-1 pl-4">
                            <p class="font-medium text-gray-300 js-modal-item-category">
                                Criar nova categoria
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end categories -->
        </div>
    </div>
    <!-- end modal categories -->

    <!-- modal create category -->
    <div
    class="w-full h-screen top-0 left-0 fixed flex items-end bg-gray-800/80 z-50"
    x-show="modalCreateCategory"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

        <div class="w-full shadow rounded-tl-3xl rounded-tr-3xl overflow-hidden bg-gray-700 p-6">

            <form wire:submit="createCategory">

                <div class="flex flex-col">
                    <label
                    class="text-xl font-bold text-gray-100 mb-2 pl-2"
                    for="category">
                        Criar nova categoria
                    </label>

                    <input
                    class="border-0 rounded-3xl text-lg font-bold text-gray-100 bg-transparent"
                    type="text"
                    wire:model="category"
                    id="category"
                    placeholder="Categoria" />
                </div>

                <div class="flex mt-6">

                    <button
                    class="transition shadow border border-blue-500 rounded-full font-medium text-center uppercase text-blue-500 hover:text-white hover:bg-blue-500 mr-4 py-2 px-6"
                    type="button"
                    x-on:click="modalCreateCategory = false">
                        Cancelar
                    </button>

                    <button
                    class="transition shadow rounded-full font-medium text-center uppercase text-white bg-blue-500 hover:bg-blue-400 py-2 px-6"
                    x-on:click="modalCreateCategory = false; modalCategories = true">
                        Concluído
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal create category -->

    <!-- modal banks -->
    <div
    class="w-full h-screen top-0 left-0 fixed flex items-end bg-gray-800/80 pt-12 z-50"
    x-show="modalBanks"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

        <div class="inset-0 absolute"
        x-on:click="modalBanks = false"></div>

        <div class="w-full rounded-tl-[100px] rounded-tr-[100px] overflow-hidden relative bg-gray-700 pt-6 px-6">

            <!-- search -->
            <div class="border-b border-gray-100/10 flex py-4 pl-4">
                <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </div>

                <form>
                    <div class="flex-1 ml-4">
                        <input
                        class="w-full border-0 rounded-3xl font-medium text-gray-400 bg-gray-700"
                        type="text"
                        wire:model.live="searchBank"
                        placeholder="Pesquisar banco" />
                    </div>
                </form>
            </div>
            <!-- end search -->

            <!-- banks -->
            <div class="h-[400px] overflow-y-scroll bg-yellow-  500">

                <div>

                    <!-- loop -->
                    @foreach($banks as $bank)
                        <label
                        class="transition duration-300 border-b last:border-0 border-gray-100/10 flex items-center hover:bg-gray-600 cursor-pointer py-4 pl-4"
                        for="{{ $bank->slug }}"
                        x-on:click="modalBanks = false">
                            <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                                <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/></svg>
                            </div>

                            <div class="flex-1 pl-4">
                                <input
                                class="hidden"
                                type="radio"
                                wire:model.live="bank_id"
                                id="{{ $bank->slug }}"
                                value="{{ $bank->id }}" />

                                <p class="font-medium text-gray-300 js-modal-item-category">
                                    {{ $bank->title }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                    <!-- end loop -->

                    <div
                    class="transition duration-300 border-b last:border-0 border-gray-100/10 flex items-center hover:bg-gray-600 cursor-pointer py-4 pl-4"
                    x-on:click="modalBanks = false; modalCreateBank = true;">
                        <div class="w-8 h-8 rounded-full flex justify-center items-center bg-gray-800">
                            <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                        </div>

                        <div class="flex-1 pl-4">
                            <p class="font-medium text-gray-300 js-modal-item-category">
                                Criar novo banco
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end banks -->
        </div>
    </div>
    <!-- end modal banks -->

    <!-- modal create bank -->
    <div
    class="w-full h-screen top-0 left-0 fixed flex items-end bg-gray-800/80 z-50"
    x-show="modalCreateBank"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

        <div class="w-full shadow rounded-tl-3xl rounded-tr-3xl overflow-hidden bg-gray-700 p-6">

            <form wire:submit="createBank">

                <div class="flex flex-col">
                    <label
                    class="text-xl font-bold text-gray-100 mb-2 pl-2"
                    for="bank">
                        Criar novo banco
                    </label>

                    <input
                    class="border-0 rounded-3xl text-lg font-bold text-gray-100 bg-transparent"
                    type="text"
                    wire:model="bank"
                    id="bank"
                    placeholder="Banco" />
                </div>

                <div class="flex mt-6">

                    <button
                    class="transition shadow border border-blue-500 rounded-full font-medium text-center uppercase text-blue-500 hover:text-white hover:bg-blue-500 mr-4 py-2 px-6"
                    type="button"
                    x-on:click="modalCreateBank = false">
                        Cancelar
                    </button>

                    <button
                    class="transition shadow rounded-full font-medium text-center uppercase text-white bg-blue-500 hover:bg-blue-400 py-2 px-6"
                    x-on:click="modalCreateBank = false; modalBanks = true">
                        Concluído
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end modal create bank -->
</div>
