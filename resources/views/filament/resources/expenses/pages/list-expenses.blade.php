<x-filament-panels::page>
    @php
        // $query = $this->getEloquentQuery();

        dump($this->table->getRecords()->sum('valor'));
    @endphp

    <div>
        <p>
            R$ 00,000
        </p>
    </div>

    {{ $this->table }}
</x-filament-panels::page>
