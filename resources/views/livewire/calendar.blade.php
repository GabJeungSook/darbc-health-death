<div>
    <div class="ml-4">
        <div class="flex space-x-2">
        <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToDeath" />
        <x-button label="Records" class="font-bold" indigo icon="document" wire:click="$set('showRecord', true)"/>
        </div>

      </div>
    <div wire:ignore class="p-5">
      <div id="calendar"></div>
    </div>
    <x-modal.card title="Vehicle Schedules" max-width="4xl" align="center" blur wire:model.defer="showRecord">
        <div class="p-4">
         <livewire:forms.show-records />
        </div>
     </x-modal.card>

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
