<div x-data x-animate>
    <div class="flex justify-between">
        <div>
            <div>
                <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToCashAdvance" />
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
      @if ($report_get == 5)
        <div class="flex space-x-2">
          <x-datetime-picker label="From" placeholder="Select Date" without-time wire:model="date_from" />
          <x-datetime-picker label="To" placeholder="Select Date" without-time wire:model="date_to" />
          <x-select label="Status" multiselect placeholder="All" wire:model="status">
            <x-select.option label="Approved" value="Approved" />
            <x-select.option label="Pending" value="Pending" />
            </x-select>
        </div>
      @endif
    </div>
  @endif
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(5)
        @include('reports.cash-advance')
      @break
      @default
        <h1 class="text-gray-600">Select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
