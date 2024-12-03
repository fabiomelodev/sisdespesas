<header
class="h-14 relative flex items-center bg-gray-900 px-4"
x-data="{ asideMenu: false }">

    <button
    class="w-10 h-10 rounded-lg flex justify-center items-center hover:bg-gray-800 cursor-pointer"
    x-on:click="asideMenu = true">
        <svg class="w-6 h-6 fill-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
    </button>

    <nav
    class="w-72 h-screen top-0 left-0 fixed flex flex-col justify-between bg-gray-700 z-50 p-6"
    x-show="asideMenu"
    x-cloak
    x-transition:enter="transition duration-500"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition duration-500"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">

        <button
        class="w-12 h-12 top-0 left-full absolute flex justify-center items-center bg-gray-700 hover:bg-gray-800"
        x-on:click="asideMenu = false">
            <svg class="w-4 h-4 fill-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
        </button>

        <div>
            <a
            class="text-3xl block font-bold text-gray-100 mb-10"
            href="{{ route('dashboard.index') }}">
                SIS Despesas
            </a>

            <ul>
                <li class="mb-4 last:mb-0">
                    <a
                    class="w-full rounded-xl flex items-center font-bold text-gray-100 bg-blue-600 hover:bg-blue-500 py-2 px-6"
                    href="{{ route('filament.admin.pages.dashboard') }}">
                        <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm64 64V416H224V160H64zm384 0H288V416H448V160z"/></svg>

                        <span class="ml-4">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="mb-4 last:mb-0">
                    <a
                    class="w-full rounded-xl flex items-center font-bold text-gray-100 bg-gray-600 hover:bg-gray-500 py-2 px-6"
                    href="{{ route('goals.index') }}">
                        <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M160 80c0-26.5 21.5-48 48-48h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V80zM0 272c0-26.5 21.5-48 48-48H80c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272zM368 96h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H368c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48z"/></svg>

                        <span class="ml-4">
                            Estimativas
                        </span>
                    </a>
                </li>

                <li class="mb-4 last:mb-0">
                    <a
                    class="w-full rounded-xl flex items-center font-bold text-gray-100 bg-gray-600 hover:bg-gray-500 py-2 px-6"
                    href="{{ route('goals.index') }}">
                        <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z"/></svg>

                        <span class="ml-4">
                            Metas
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <a
            class="w-full rounded-xl flex items-center font-bold text-gray-100 bg-red-500 hover:bg-red-400 py-2 px-6"
            href="#">
                <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>

                <span class="ml-4">
                    Sair
                </span>
            </a>
        </div>
    </nav>
</header>
