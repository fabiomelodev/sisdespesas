<x-app-layout>
    <x-slot name="header">
        Despesas
    </x-slot>

    @livewire('expense')

    <script>
        if(document.querySelector('.js-field-category')) {
            const fieldCategory = document.querySelector('.js-field-category');
            const category = document.querySelector('.js-category');
            const itemsCategories = document.querySelectorAll('.js-modal-item-category');

            itemsCategories.forEach(element => {
                element.addEventListener('click', function() {
                    console.log(fieldCategory.value);
                    fieldCategory.value = this.dataset.id;
                    category.innerText = this.dataset.category;
                });
            });
        }
    </script>
</x-app-layout>
