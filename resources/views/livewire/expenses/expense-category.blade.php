<div
class="transition duration-300 border-b border-gray-100/10 flex hover:bg-gray-600 cursor-pointer py-4"
x-on:click="modalCategories = true">

    <div class="w-1/12 flex items-center px-4">
        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"/></svg>
    </div>

    <div class="w-9/12 px-4">
        <p class="border border-blue-500 rounded-full inline-block font-bold text-blue-500 py-2 px-6 js-category">
            {{-- {{ $categoryCurrent['title'] }} --}}
            {{ $expense->category->title }}
        </p>
    </div>

    <div class="w-2/12 flex justify-end items-center px-4">
        <svg class="w-5 h-7 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    </div>

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
                        x-on:click="modalCategories = false"
                        wire:click="$emitUp('updateCategory')">
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
</div>
