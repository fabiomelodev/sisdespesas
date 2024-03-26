<div class="overflow-hidden shadow rounded-3xl bg-gray-700 mt-6 p-2 lg:p-4">

    <!-- search -->
    <div class="shadow rounded-3xl flex justify-center bg-gray-600 p-3">

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
    </div>
    <!-- end search -->

    <!-- head -->
    <div class="shadow rounded-3xl flex bg-gray-600 mt-4 py-3">

        <div class="flex-1 px-8">
            <h5 class="text-sm lg:text-base font-bold text-white">
                Categoria
            </h5>
        </div>

        <div class="w-3/12 px-4">
        </div>
    </div>
    <!-- end head -->

    <!-- body -->
    <div class="shadow rounded-3xl bg-gray-600 mt-4 p-2 lg:p-4">

        <!-- loop -->
        @if(!$categories->isEmpty())
            @foreach($categories as $category)
                <div class="border-b border-gray-100/10 last:border-0 flex py-2">

                    <div class="flex-1 px-4">
                        <p class="text-sm text-white">
                            {{ $category->title }}
                        </p>
                    </div>

                    <div class="w-4/12 lg:w-3/12 px-4">

                        <div class="flex justify-end">

                            <a
                            class="transition rounded-3xl flex items-center hover:bg-blue-500 py-2 px-4"
                            href="{{ route('categories.edit', $category->id) }}"
                            title="Editar">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>

                                <span class="hidden text-xs font-bold text-white ml-2">
                                    Editar
                                </span>
                            </a>

                            <button
                            class="transition rounded-3xl flex items-center hover:bg-red-500 lg:ml-3 py-2 pl-4 lg:px-4"
                            x-on:click="modalDelete = true"
                            title="Excluir">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>

                                <span class="hidden text-xs font-bold text-white ml-2">
                                    Excluir
                                </span>
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
</div>
