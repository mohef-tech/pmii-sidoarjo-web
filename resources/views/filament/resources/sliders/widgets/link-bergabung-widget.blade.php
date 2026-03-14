<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit="save">
            {{ $this->form }}
            <br>
            <x-filament::button type="submit">
                💾 Simpan Link Bergabung
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
