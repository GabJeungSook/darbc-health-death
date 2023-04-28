<div>
    <div class="flex justify-between">
        <div>
            <x-button label="ADD NEW" class="font-bold" indigo icon="plus" wire:click="$set('addHealth', true)" />
            <x-button label="INQUIRY" class="font-bold" indigo icon="document-search" wire:click="redirectToInquiry" />
            <x-button label="REPORTS" class="font-bold" indigo icon="document-report" wire:click="redirectToReport"/>
          </div>
          <div>
            <x-button label="MANAGE" class="font-bold" indigo icon="adjustments" wire:click="redirectToHospital"/>
          </div>
    </div>

  <div class="mt-4">
    {{ $this->table }}
  </div>

  <x-modal.card title="Add Health Information" align="center" max-width="4xl" blur wire:model.defer="addHealth">
    <livewire:forms.add-health-form />
</x-modal.card>
</div>
