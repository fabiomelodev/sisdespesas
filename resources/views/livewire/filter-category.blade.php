<div class="w-full h-screen top-0 left-0 fixed flex justify-end bg-gray-700 z-50 pt-10">

    <div class="w-full shadow rounded-tl-3xl rounded-tr-3xl bg-gray-600 p-6">

        <!-- filter -->
        <form wire:submit="filterCategory">

            <div class="flex">

                <div class="w-3/12 px-4">

                    <label
                    class="text-lg font-bold text-gray-100 ml-4"
                    for="filterYear">
                        Ano:
                    </label>

                    <select
                    class="w-full shadow rounded-3xl overflow-hidden"
                    wire:model.live="filterYear"
                    id="filterYear">
                        <option>Selecione</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <div class="w-3/12 px-4">

                    <label
                    class="text-lg font-bold text-gray-100 ml-4"
                    for="filterMonth">
                        Mês:
                    </label>

                    <select
                    class="w-full shadow rounded-3xl overflow-hidden"
                    wire:model.live="filterMonth"
                    id="filterMonth">
                        <option>Selecione</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>

                <div class="w-3/12 px-4">

                    <label
                    class="text-lg font-bold text-gray-100 ml-4"
                    for="filterCategory">
                        Categoria:
                    </label>

                    <select
                    class="w-full shadow rounded-3xl overflow-hidden"
                    wire:model.live="filterCategory"
                    id="filterCategory">
                        <option>Selecione</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-2/12 flex items-end px-4">
                    <button
                    class="shadow rounded-3xl flex items-center font-bold text-white bg-blue-500 hover:bg-blue-400 py-2 px-6"
                    type="submit">
                        <svg class="fill-gray-100" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>

                        <span class="ml-2">
                            Filtrar
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <!-- end filter -->
    </div>
</div>
