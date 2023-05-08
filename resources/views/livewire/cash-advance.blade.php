<div>
    <div class="flex justify-between">
        <div>
            <x-button label="ADD NEW" class="font-bold" indigo icon="plus" wire:click="$set('addCashAdvance', true)"/>
            <x-button label="INQUIRY" class="font-bold" indigo icon="document-search" wire:click="redirectToInquiry" />
            <x-button label="REPORTS" class="font-bold" indigo icon="document-report" wire:click="redirectToReport"/>

          </div>
    </div>
    <div class="mt-4">
        {{$this->table}}
    </div>
    <x-modal.card hide-close="false" title="Add Cash Advance Information" align="center" max-width="4xl" blur wire:model.defer="addCashAdvance">
        <livewire:forms.add-cash-advance-form />
      </x-modal.card>
</div>
