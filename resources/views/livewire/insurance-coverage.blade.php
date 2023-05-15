<div>
    <div class="flex justify-between">
          <div>
            <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToHealth" />
            <x-button label="HISTORY" class="font-bold" indigo icon="search" wire:click="$set('viewHistory', true)"/>
          </div>
    </div>

  <div class="mt-4">
    {{ $this->table }}
  </div>

  <x-modal.card title="Insurance Coverage History" align="center" max-width="4xl" blur wire:model.defer="viewHistory">
    <livewire:forms.view-coverage-history />
  </x-modal.card>
</div>
