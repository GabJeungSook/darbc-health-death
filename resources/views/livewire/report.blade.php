<div x-data>
  <div class="select flex space-x-2  items-end">
    <x-native-select label="Report" wire:model="report_get">
      <option selected hidden>Select Report</option>
      <option value="1">Accounting</option>
      <option value="2">Health - Members & Dependent</option>
      <option value="3">To Acctg < 10k</option>
      <option value="4">Done</option>
    </x-native-select>
    <x-button.circle positive icon="refresh" spinner="report_get" />
  </div>
  <div class="mt-5 flex justify-between items-end">
    <div class="mt-5 flex space-x-2 ">
      <x-button label="PRINT" sm dark icon="printer" class="font-bold"
        @click="printOut($refs.printContainer.outerHTML);" />
      <x-button label="EXPORT" sm positive wire:click="exportReport({{ $report_get }})"
        spinner="exportReport({{ $report_get }})" icon="document-text" class="font-bold" />
    </div>
    <div class="flex space-x-2">
      <x-datetime-picker placeholder="Date From" wire:model.defer="normalPicker" />
      <x-datetime-picker placeholder="Date To" wire:model.defer="normalPicker" />
    </div>
  </div>
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(1)
        @include('reports.health')
      @break

      @case(2)
        @include('reports.health')
      @break

      @default
        <h1 class="text-gray-600">Please select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
