<x-layout.single-base>
    <x-slot name="title">
        Relatório Geral | {{ $dateCurrent }}
    </x-slot>

    <!-- banks -->
    <livewire:report-general-banks :reportGeneral="$reportGeneral" />
    <!-- end banks -->

    <!-- expenses fixed -->
    <livewire:report-general-expenses-fixed :reportGeneral="$reportGeneral" />
    <!-- end expenses -->

    <!-- credits -->
    <livewire:report-general-credits :reportGeneral="$reportGeneral" />
    <!-- end credits -->

    <!-- categories -->
    <livewire:report-general-categories :reportGeneral="$reportGeneral" />
    <!-- end categories -->

    <!-- metas -->
    <livewire:report-general-metas :reportGeneral="$reportGeneral" />
    <!-- end metas -->
</x-layout.single-base>
