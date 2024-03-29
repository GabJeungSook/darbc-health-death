<div x-data x-animate>
    <div class="flex justify-between">
        <div>
            <div>
                <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToLog" />
              </div>
          </div>
        <div class="select flex space-x-2 items-end">
            <x-native-select label="Report" wire:model="report_get">
              <option selected hidden>Select Report</option>
              <option value="1">Letter Of Guarantee</option>
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
      <div class="flex space-x-2">
        <x-datetime-picker label="Encoded Date" placeholder="Select Date" without-time wire:model="encoded_date" />
        <x-datetime-picker label="Received Date From" placeholder="Select Date" without-time wire:model="date_from" />
        <x-datetime-picker label="Received Date To" placeholder="Select Date" without-time wire:model="date_to" />
        <x-select label="Enrollment Status" placeholder="All" wire:model="enrollment_status_selected">
            <x-select.option label="Member" value="member" />
            <x-select.option label="Dependent" value="dependent" />
        </x-select>
      </div>
    </div>

  @endif
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(1)
        @include('reports.log')
      @break
      @default
        <h1 class="text-gray-600">Select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
