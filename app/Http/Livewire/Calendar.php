<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\VehicleSchedule;
use WireUi\Traits\Actions;
use Carbon\Carbon;
use DB;

class Calendar extends Component
{
    use Actions;

    public function mount()
    {
        $this->events = $this->getFormattedEvents();
    }

    private function getFormattedEvents()
    {
        $events = VehicleSchedule::query()->get();
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => strtoupper($event->remarks),
                'start' => Carbon::parse($event->scheduled_date)->utc()->toIso8601String(),
                'end' => Carbon::parse($event->scheduled_date)->utc()->toIso8601String(),
                'id' => $event->id,
            ];
        }
        return $formattedEvents;
    }

    public function redirectToDeath()
    {
        return redirect()->route('death');
    }


    public function render()
    {
        return view('livewire.calendar');
    }
}
