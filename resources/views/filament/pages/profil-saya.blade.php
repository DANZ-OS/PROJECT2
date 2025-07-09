<x-filament::page>
    <form wire:submit.prevent="updateProfil" class="space-y-4">
        {{ $this->form }}
        <x-filament::button type="submit">
            Simpan Perubahan
        </x-filament::button>
    </form>
</x-filament::page>