<section class="py-6">

    <div class="container">

        <div class="shadow-lg rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 p-4">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">
                    Metas
                </h2>
            </div>

            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4">
                    <!-- loop -->
                    @foreach($metas as $meta)
                        <div>
                            <div class="mb-2">
                                <h3 class="text-4xl font-bold text-white">
                                    {{ $meta['title'] }}
                                </h3>
                            </div>

                            <div class="mb-2">
                                <p class="text-2xl font-bold text-white">
                                    {{ $meta['value'] }} / {{ $meta['meta'] }}
                                </p>
                            </div>

                            <div class="w-full lg:w-96 h-6 border-2 border-indigo-600 rounded-lg overflow-hidden flex bg-indigo-400 mb-1">
                                <div class="rounded-md flex items-center bg-indigo-600 p-1" style="width:{{ $meta['percentage'] }}%">
                                    <p class="text-xs font-bold text-white">
                                        {{ $meta['percentage'] }}%
                                    </p>
                                </div>
                            </div>

                            {{-- <div>
                                <p class="text-xs font-medium text-white">
                                    Está quase passando o limite da meta!!!
                                </p>
                            </div> --}}
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
        </div>
    </div>
</section>
