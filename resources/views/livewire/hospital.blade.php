<div>
    <div class="flex justify-between">
        <div>
            <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToHealth" />
          </div>
          <div>
            <x-button label="Add Hospital" class="font-bold" icon="plus" primary  wire:click="$set('addHospital', true)" />
          </div>
    </div>
    <div class="mt-4">
        {{$this->table}}
    </div>

    <x-modal.card title="Add Hospital" align="center" blur wire:model.defer="addHospital">
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
            <x-input label="Name" wire:model.defer="name"/>
            <x-textarea label="Address"  wire:model.defer="address" />
        </div>

        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <div class=""></div>
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="save" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
</div>
