<div>
    <div>
        <x-button label="ADD NEW" class="font-bold" indigo icon="plus" wire:click="$set('addLog', true)" />
    </div>
    <div class="mt-4">
        {{$this->table}}
    </div>
    <x-modal.card hide-close="false" title="Add Letter Of Guarantee (Log)" align="center" max-width="4xl" blur wire:model.defer="addLog">
        <livewire:forms.add-log />
    </x-modal.card>
</div>
