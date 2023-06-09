<div x-data x-animate>
    <div class="flex justify-between">
        <div>
            <div>
                <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToDeath" />
              </div>
          </div>
        <div class="select flex space-x-2 items-end">
            <x-native-select label="Report" wire:model="report_get">
              <option selected hidden>Select Report</option>
              @foreach ($reports as $report)
              <option value={{$report->id}}>{{$report->report_name}}</option>
              @endforeach
            </x-native-select>
            <x-button.circle positive icon="refresh" spinner="report_get" />
          </div>
    </div>

  @if ($report_get)
    <div class="mt-5 flex justify-between items-end">
      <div class="mt-5 flex space-x-2 ">
        <x-button label="PRINT" sm dark icon="printer" class="font-bold"
          @click="printOut($refs.printContainer.outerHTML);" />
        <x-button label="EXPORT" sm positive wire:click="exportReport({{ $report_get }})"
          spinner="exportReport({{ $report_get }})" icon="document-text" class="font-bold" />
      </div>
      @if ($report_get == 3)
      <div class="flex space-x-2">
        <x-datetime-picker label="From" placeholder="Select Date" without-time wire:model="date_from" />
        <x-datetime-picker label="To" placeholder="Select Date" without-time wire:model="date_to" />
          <x-select label="Vehicle" multiselect placeholder="All" wire:model="vehicle">
              <x-select.option label="Yes" value="Yes" />
              <x-select.option label="No" value="No" />
          </x-select>
          <x-select label="Diamond Package" multiselect placeholder="All" wire:model="diamond_package">
            <x-select.option label="Yes" value="Yes" />
            <x-select.option label="No" value="No" />
            <x-select.option label="Islam" value="Islam" />
            <x-select.option label="Distant" value="Distant" />
        </x-select>
        <x-select label="Coverage Type" multiselect placeholder="All" wire:model="coverage_type">
            <x-select.option label="Accidental Death/ Disablement" value="1" />
            <x-select.option label="Accident Burial Benefit" value="2" />
            <x-select.option label="Unprovoked Murder & Assault" value="3" />
            <x-select.option label="Burial Benefit due to Natural Death" value="4" />
            <x-select.option label="Motorcycling Coverage" value="5" />
            <x-select.option label="Daily Hospital Income Benefit, due to accident and/or illness" value="6" />
            <x-select.option label="Premium inclusive of taxes" value="7" />
        </x-select>
      </div>
      @endif
    </div>
  @endif
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(3)
        @include('reports.death')
      @break
      @default
        <h1 class="text-gray-600">Select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
