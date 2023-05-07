<div>
    <div class="ml-4">
        <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToDeath" />
        {{-- <div class="border rounded-lg flex items-center  px-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-gray-500">
              <path fill="none" d="M0 0h24v24H0z" />
              <path
                d="M11 2c4.968 0 9 4.032 9 9s-4.032 9-9 9-9-4.032-9-9 4.032-9 9-9zm0 16c3.867 0 7-3.133 7-7 0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7zm8.485.071l2.829 2.828-1.415 1.415-2.828-2.829 1.414-1.414z" />
            </svg>
            <input type="text" wire:model="search" class="border-0 outline-none focus:ring-0"
              placeholder="Search">
          </div> --}}
      </div>
    <div wire:ignore class="p-5">
      <div id="calendar"></div>
    </div>

    {{-- <x-modal align="center" wire:model.defer="eventModal" max-width="lg">
      <x-card title="Create Event">
        <div class="space-y-3">
          <x-input label="Name" placeholder="Event Name" wire:model.defer="event_name" />
          <x-textarea label="Description" placeholder="Event Description" wire:model.defer="event_desc" />
        </div>

        <div class="grid grid-cols-2 gap-x-3 mt-4">
          <div class="col-span-1">
            <x-datetime-picker without-time max="{{ $end_date }}" label="Start Date" placeholder="Start Date"
              wire:model="start_date" />
          </div>
          <div class="col-span-1">
            <x-datetime-picker without-time min="{{ $start_date }}" label="End Date" placeholder="End Date"
              wire:model="end_date" />
          </div>
        </div>

        <x-slot name="footer">
          <div class="flex justify-end gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />
            <x-button indigo right-icon="arrow-right" spinner="addEvent" label="Submit" wire:click="addEvent" />
          </div>
        </x-slot>
      </x-card>
    </x-modal> --}}

    {{-- <x-modal align="center" wire:model.defer="updateModal">
      <x-card title="Update Event">
        <div class="space-y-3">
          <x-input label="Name" placeholder="Event Name" wire:model.defer="update_event_name" />
          <x-textarea label="Description" placeholder="Event Description" wire:model.defer="update_event_desc" />
        </div>

        <div class="grid grid-cols-2 gap-x-3 mt-4">
          <div class="col-span-1">
            <x-datetime-picker without-time max="{{ $update_end_date }}" label="Start Date" placeholder="Start Date"
              wire:model="update_start_date" />
          </div>
          <div class="col-span-1">
            <x-datetime-picker without-time min="{{ $update_start_date }}" label="End Date" placeholder="End Date"
              wire:model="update_end_date" />
          </div>
        </div>

        <x-slot name="footer">
          <div class="flex justify-between">
            <div class="flex justify-start">
              <x-button negative label="Delete"
                x-on:confirm="{
                              title: 'Are you sure you want to delete this event?',
                              icon: 'question',
                              method: 'deleteEvent',
                          }" />
            </div>
            <div class="flex justify-end gap-x-4">
              <x-button flat label="Cancel" x-on:click="close" />
              <x-button primary label="Submit"
                x-on:confirm="{
                              title: 'Are you sure you want to update this event?',
                              icon: 'question',
                              method: 'updateEvent',
                          }" />
            </div>
          </div>

        </x-slot>
      </x-card>
    </x-modal> --}}

    @push('scripts')
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            displayEventTime: false,
            eventDisplay: 'block',
            events: {!! json_encode($events) !!},
            eventClick: function(info) {
              Livewire.emit('calendarEventClicked', info.event.id);
            },
          });
          calendar.render();
          window.addEventListener('refreshCalendar', event => {
            console.log(event.detail);
            calendar.batchRendering(() => {
              calendar.getEvents().forEach(event => event.remove());
              calendar.addEventSource(event.detail.events);
            });
          });

        });
      </script>
    @endpush
  </div>
