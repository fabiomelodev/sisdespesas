<x-app-layout>
    <x-slot name="header">
        Categorias - Editar
    </x-slot>

    <section class="pt-6 pb-20">

        <div class="container mx-auto px-4">

            <div class="w-full">

                <h1 class="text-3xl font-bold text-gray-100">
                    Editar Categoria
                </h1>

                <hr class="w-full h-px border border-gray-100/10 my-6"/>

                <div class="mb-6">
                    <a
                    class="w-28 shadow rounded-3xl flex items-center font-bold text-white bg-blue-500 hover:bg-blue-400 mr-2 py-2 px-6"
                    href="{{ route('categories.index') }}">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>

                        <span class="ml-2">
                            Lista
                        </span>
                    </a>
                </div>

                <form
                method="POST"
                action="{{ route('categories.update', $category->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex flex-col">
                            <label
                            class="font-bold text-white mb-2"
                            for="category">
                                Categoria:
                            </label>

                            <input
                            class="w-full shadow rounded-3xl px-4"
                            type="text"
                            name="title"
                            id="category"
                            value="{{ $category->title }}"/>
                        </div>

                        <div class="col-span-2 flex">
                            <button class="shadow rounded-3xl flex items-center font-bold text-white bg-blue-500 hover:bg-blue-400 mr-3 py-2 px-6">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>

                                <span class="ml-2">
                                    Salvar
                                </span>
                            </button>

                            <a
                            class="shadow rounded-3xl flex items-center font-bold text-white bg-red-500 hover:bg-red-400 py-2 px-6"
                            href="{{ route('categories.destroy', $category) }}">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>

                                <span class="ml-2">
                                    Excluir
                                </span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-full mt-8">

                <h3 class="text-xl font-bold text-gray-100">
                    Gastos do mês atual
                </h3>

                <hr class="w-full h-px border border-gray-100/10 my-6"/>

                <p class="text-lg font-bold text-gray-100">
                    R$ {{ $expenses_sum_values }}
                </p>

                <!-- table -->
                @if(!$expenses->isEmpty())
                    <div class="shadow rounded-3xl bg-gray-600 mt-6 p-6">

                        <!-- loop -->
                        @foreach($expenses as $key => $value)
                            <div class="border-b last:border-0 border-gray-100/10 py-4">

                                <div class="flex justify-between">
                                    <p class="text-sm font-bold text-gray-100">
                                        {{ ++$key . '. ' . $value->title }}
                                    </p>

                                    <p class="text-sm font-bold text-gray-100">
                                        {{ $value->created_at->format('d/m/Y') }}
                                    </p>
                                </div>

                                <p class="text-xs font-bold text-gray-100">
                                    R$ {{ $value->value }}
                                </p>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                @endif
                <!-- end table -->
            </div>
        </div>
    </section>
</x-app-layout>
