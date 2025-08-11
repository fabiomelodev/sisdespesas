<section
class="pt-6"
x-data="{ layout: 'grid' }">

    <div class="container">

        <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">
                    Bancos
                </h2>

                <div class="shadow-lg rounded-full flex items-center gap-2 bg-gray-800 py-2 px-4">
                    <p class="text-sm font-medium capitalize text-white" x-text="layout"></p>

                    <div class="flex items-center gap-2 p-1">

                        <div
                        class="w-7 h-7 shadow-lg rounded-full flex justify-center items-center"
                        :class="{ 'bg-gray-600': layout === 'grid' }">
                            <button x-on:click="layout = 'grid'">
                                <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152 160C174.1 160 192 177.9 192 200L192 248C192 270.1 174.1 288 152 288L104 288C81.9 288 64 270.1 64 248L64 200C64 177.9 81.9 160 104 160L152 160zM344 288L296 288C273.9 288 256 270.1 256 248L256 200C256 177.9 273.9 160 296 160L344 160C366.1 160 384 177.9 384 200L384 248C384 270.1 366.1 288 344 288zM536 288L488 288C465.9 288 448 270.1 448 248L448 200C448 177.9 465.9 160 488 160L536 160C558.1 160 576 177.9 576 200L576 248C576 270.1 558.1 288 536 288zM536 480L488 480C465.9 480 448 462.1 448 440L448 392C448 369.9 465.9 352 488 352L536 352C558.1 352 576 369.9 576 392L576 440C576 462.1 558.1 480 536 480zM344 352C366.1 352 384 369.9 384 392L384 440C384 462.1 366.1 480 344 480L296 480C273.9 480 256 462.1 256 440L256 392C256 369.9 273.9 352 296 352L344 352zM152 480L104 480C81.9 480 64 462.1 64 440L64 392C64 369.9 81.9 352 104 352L152 352C174.1 352 192 369.9 192 392L192 440C192 462.1 174.1 480 152 480z"/></svg>
                            </button>
                        </div>

                        <div
                        class="w-7 h-7 shadow-lg rounded-full flex justify-center items-center"
                        :class="{ 'bg-gray-600': layout === 'swiper' }">
                            <button x-on:click="layout = 'swiper'">
                                <svg class="w-4 h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M286.7 96.1C291.7 113 282.1 130.9 265.2 135.9C185.9 159.5 128.1 233 128.1 320C128.1 426 214.1 512 320.1 512C426.1 512 512.1 426 512.1 320C512.1 233.1 454.3 159.6 375 135.9C358.1 130.9 348.4 113 353.5 96.1C358.6 79.2 376.4 69.5 393.3 74.6C498.9 106.1 576 204 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 204 141.1 106.1 246.9 74.6C263.8 69.6 281.7 79.2 286.7 96.1z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- grid -->
            <div
            class="grid grid-cols-1 lg:grid-cols-4 gap-4"
            x-show="layout === 'grid'"
            x-cloak>

                <!-- loop -->
                @foreach($banks as $bank)
                    <div class="shadow rounded-lg flex flex-col gap-2 bg-red-500 p-4" style="background-color: {{ $bank['color'] }}">

                        <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center bg-white/50 p-2">
                            <img src="{{ Storage::url($bank['icon']) }}" alt="{{ $bank['title'] }}" />
                        </div>

                        <div>
                            <p class="text-3xl font-bold text-white">
                                {{ $bank['remaining'] }}
                            </p>
                        </div>

                        <div class="flex justify-between gap-2">
                            <p class="text-xs font-medium text-white/50">
                                Entrada <br />
                                <span class="text-sm font-bold text-white">
                                    {{ $bank['deposits']}}
                                </span>
                            </p>

                            <p class="text-xs font-medium text-white/50">
                                Saída <br />
                                <span class="text-sm font-bold text-white">
                                    {{ $bank['expenses'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
                <!-- end loop -->
            </div>
            <!-- end grid -->

            <!-- swiper -->
            <div
            x-show="layout === 'swiper'"
            x-cloak>

                <!-- swiper -->
                <div class="swiper js-swiper-report-general-banks">

                    <div class="swiper-wrapper">

                        <!-- loop -->
                        @foreach($banks as $bank)
                            <div class="swiper-slide">

                                <div class="shadow rounded-lg flex flex-col gap-2 bg-red-500 p-4" style="background-color: {{ $bank['color'] }}">

                                    <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center bg-white/50 p-2">
                                        <img src="{{ Storage::url($bank['icon']) }}" alt="{{ $bank['title'] }}" />
                                    </div>

                                    <div>
                                        <p class="text-3xl font-bold text-white">
                                            {{ $bank['remaining'] }}
                                        </p>
                                    </div>

                                    <div class="flex justify-between gap-2">
                                        <p class="text-xs font-medium text-white/50">
                                            Entrada <br />
                                            <span class="text-sm font-bold text-white">
                                                {{ $bank['deposits']}}
                                            </span>
                                        </p>

                                        <p class="text-xs font-medium text-white/50">
                                            Saída <br />
                                            <span class="text-sm font-bold text-white">
                                                {{ $bank['expenses'] }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- end loop -->
                    </div>
                </div>
                <!-- end swiper -->
            </div>
            <!-- end swiper -->
        </div>
    </div>
</section>
