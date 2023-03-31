<div x-data x-animate>
  <div class="select flex space-x-2  items-end">
    <x-native-select label="Report" wire:model="report_get">
      <option selected hidden>Select Report</option>
      <option value="1">Accounting</option>
      <option value="2">Health - Members & Dependent</option>
      <option value="3">Masterlist</option>
      <option value="4">To Acctg < 10k</option>
      <option value="5">Death - Members & Dependent</option>
    </x-native-select>
    <x-button.circle positive icon="refresh" spinner="report_get" />
  </div>
  @if ($report_get)
    <div class="mt-5 flex justify-between items-end">
      <div class="mt-5 flex space-x-2 ">
        <x-button label="PRINT" sm dark icon="printer" class="font-bold"
          @click="printOut($refs.printContainer.outerHTML);" />
        <x-button label="EXPORT" sm positive wire:click="exportReport({{ $report_get }})"
          spinner="exportReport({{ $report_get }})" icon="document-text" class="font-bold" />
      </div>
      @if ($report_get == 1)
        <div class="flex space-x-2">
          <x-datetime-picker placeholder="Select Date" without-time wire:model="date_from" />
        </div>
      @endif
    </div>
  @endif
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(1)
        @include('reports.accounting')
      @break

      @case(2)
        @include('reports.health')
      @break

      @case(3)
        @include('reports.masterlist')
      @break

      @case(5)
        @include('reports.death')
      @break

      @default
        <h1 class="text-gray-600">Select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
