<div>
    <div class="flex justify-between">
        <div>
            <x-button label="ADD NEW" class="font-bold" indigo icon="plus" wire:click="$set('addDeath', true)"/>
            <x-button label="INQUIRY" class="font-bold" indigo icon="document-search" wire:click="redirectToInquiry" />
            <x-button label="REPORTS" class="font-bold" indigo icon="document-report" />

        </div>
        <div>
            <x-button label="Calendar" class="font-bold" indigo icon="calendar" wire:click="redirectToCalendar"/>
            <x-button label="Records" class="font-bold" indigo icon="document" wire:click="$set('showRecord', true)"/>
        </div>
    </div>

    <x-modal.card title="Vehicle Schedules" max-width="4xl" align="center" blur wire:model.defer="showRecord">
       <div class="p-4">
        <livewire:forms.show-records />
       </div>
    </x-modal.card>


    <div class="mt-4">
      {{ $this->table }}
    </div>
    <x-modal.card hide-close="false" title="Add Death Information" align="center" max-width="4xl" blur wire:model.defer="addDeath">
        <livewire:forms.add-death-form />
      </x-modal.card>
    <x-modal.card hide-close="false" title="Add Vehicle Schedule" align="center" max-width="4xl" blur wire:model.defer="showVehicleModal">
        <livewire:forms.add-vehicle-schedule />
      </x-modal.card>
  </div>
