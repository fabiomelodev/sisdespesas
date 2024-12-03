<x-layout.base>
    <x-slot name="title">
        Despesa - {{ $expense->title }}
    </x-slot>

    <section class="h-screen flex justify-center pt-32">

        <div class="container flex justify-center">

            <div class="w-8/12">

                <div class="w-full rounded-xl shadow-lg bg-white p-8">

                    <form method="POST" action="{{ route('expense.updateExpenseFixed', $expense->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-4 gap-4">

                            <div class="col-span-1 flex flex-col">
                                <label class="font-bold text-gray-600 mb-2" for="bank">
                                    Banco:
                                </label>

                                <select class="border border-gray-600 rounded-xl shadow-lg text-sm font-medium text-gray-600 py-3" name="bank_id" id="bank" required>
                                    <option value="">Selecione</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1 flex flex-col">
                                <label class="font-bold text-gray-600 mb-2" for="pay_day">
                                    Data de pagamento:
                                </label>

                                <input class="border border-gray-600 rounded-xl shadow-lg text-sm font-medium text-gray-600 py-3" type="date" name="pay_day" id="pay_day" required />
                            </div>

                            <div class="col-span-1 flex flex-col">
                                <label class="font-bold text-gray-600 mb-2" for="status">
                                    Status:
                                </label>

                                <select class="border border-gray-600 rounded-xl shadow-lg text-sm font-medium text-gray-600 py-3" name="status" id="status" value="{{ $expense->status }}" required>
                                    <option value="">Selecione</option>
                                    <option value="pendente">Pendente</option>
                                    <option value="pago">Pago</option>
                                </select>
                            </div>

                            <div class="col-span-1 flex items-end">
                                <input class="transition hover:scale-90 rounded-xl shadow-lg inline-block text-sm font-bold text-center text-white bg-green-500 cursor-pointer p-4" type="submit" value="Salvar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout.base>
