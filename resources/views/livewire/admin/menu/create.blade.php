<div>
    <div class="flex items-center justify-center">
        <x-button wire:click="$toggle('modal')">Add menu item</x-button>
    </div>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">New menu item</x-slot>
        <x-slot name="content">
            <div class="">
                <x-label for="label" value="Label" />
                <x-input id="label" type="text" wire:model="label" class="mt-1 w-full" />
                <x-input-error for="label" />
            </div>
            @if ($selector == 'footer')
                <div class="mt-4">
                    <x-label for="column" value="Select footer column"/>
                    <select wire:model="column" id="column"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 w-full"
                    >
                        <option value="">Select an option</option>
                        <option value="1">Column 1</option>
                        <option value="2">Column 2</option>
                        <option value="3">Column 3</option>
                    </select>
                    <x-input-error for="column" />
                </div>
            @else
                <div class="mt-4">
                    <x-label for="type" value="Type"/>
                    <select wire:model="type" id="type"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 w-full"
                    >
                        <option value="">Select an option</option>
                        <option value="link">Link</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="megamenu">Mega menu</option>
                    </select>
                    <x-input-error for="type" />
                </div>
            @endif


            @if ($type == 'link')
                <div class="mt-4">
                    <x-label for="url" value="Url" />
                    <x-input id="url" type="text" wire:model="url" class="mt-1 w-full" />
                    <x-input-error for="url" />
                </div>
                <div class="mt-4">
                    <label for="opens_in_new_tab">
                        <x-input id="opens_in_new_tab" type="checkbox" wire:model="opens_in_new_tab" />
                        <span>Open link in new tab</span>
                    </label>
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="save">Add item</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
