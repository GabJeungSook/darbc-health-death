<div x-data x-animate>
    <div class="flex justify-between">
        <div>
            <div>
                <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToHealth" />
              </div>
          </div>
        <div class="select flex space-x-2 items-end">
            <x-native-select label="Report" wire:model="report_get">
              <option selected hidden>Select Report</option>
              @foreach ($reports as $report)
              <option value={{$report->id}}>{{$report->report_name}}</option>
              @endforeach
              {{-- <option value="2">Health - Members & Dependent</option>
              <option value="3">Transmitted Report</option> --}}
              {{-- <option value="3">Masterlist</option> --}}
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
      @if ($report_get == 1)
      <div class="">

      </div>
        <div class="flex space-x-2">
          <x-datetime-picker label="Encoded Date From" placeholder="Select Date" without-time wire:model="encoded_date_from" />
          <x-datetime-picker label="Encoded Date To" placeholder="Select Date" without-time wire:model="encoded_date_to" />
          <x-datetime-picker label="Confinement From" placeholder="Select Date" without-time wire:model="date_from" />
          <x-datetime-picker label="Confinement To" placeholder="Select Date" without-time wire:model="date_to" />
            <x-select label="Select Status" multiselect placeholder="All" wire:model="status">
                <x-select.option label="Encoded" value="ENCODED" />
                <x-select.option label="Transmitted" value="TRANSMITTED" />
                <x-select.option label="Paid" value="PAID" />
                <x-select.option label="Unpaid" value="UNPAID" />
            </x-select>
            <x-select label="Enrollment Status" multiselect placeholder="All" wire:model="enrollment_status">
                <x-select.option label="Member" value="member" />
                <x-select.option label="Dependent" value="dependent" />
            </x-select>
        </div>
        @elseif ($report_get == 2)
        <div class="flex space-x-2">
            <x-datetime-picker label="Transmitted Date" placeholder="Select Date" without-time wire:model="transmitted_date" />
            <x-datetime-picker label="Confinement From" placeholder="Select Date" without-time wire:model="transmittal_date_from" />
            <x-datetime-picker label="Confinement To" placeholder="Select Date" without-time wire:model="transmittal_date_to" />
              <x-select label="Select Status" multiselect placeholder="All" wire:model="transmittal_status">
                  <x-select.option label="Encoded" value="ENCODED" />
                  <x-select.option label="Transmitted" value="TRANSMITTED" />
                  <x-select.option label="Paid" value="PAID" />
                  <x-select.option label="Unpaid" value="UNPAID" />
              </x-select>
              <x-select label="Enrollment Status" multiselect placeholder="All" wire:model="enrollment_status">
                <x-select.option label="Member" value="member" />
                <x-select.option label="Dependent" value="dependent" />
            </x-select>
          </div>
      @elseif ($report_get == 7 ||  $report_get == 8 || $report_get == 29)
      <div class="flex space-x-2">
        <x-datetime-picker label="Encoded Date From" placeholder="Select Date" without-time wire:model="encoded_date_from" />
        <x-datetime-picker label="Encoded Date To" placeholder="Select Date" without-time wire:model="encoded_date_to" />
        <x-datetime-picker label="Confinement From" placeholder="Select Date" without-time wire:model="transmittal_date_from" />
        <x-datetime-picker label="Confinement To" placeholder="Select Date" without-time wire:model="transmittal_date_to" />
          <x-select label="Select Status" multiselect placeholder="All" wire:model="transmittal_status">
              <x-select.option label="Encoded" value="ENCODED" />
              <x-select.option label="Transmitted" value="TRANSMITTED" />
              <x-select.option label="Paid" value="PAID" />
              <x-select.option label="Unpaid" value="UNPAID" />
          </x-select>
          <x-select label="Enrollment Status" multiselect placeholder="All" wire:model="enrollment_status">
            <x-select.option label="Member" value="member" />
            <x-select.option label="Dependent" value="dependent" />
        </x-select>
      </div>
      @endif
    </div>
  @endif
  <div class="mt-5 border rounded-lg p-4" x-ref="printContainer">
    @switch($report_get)
      @case(1)
        @include('reports.health')
      @break
      @case(2)
        @include('reports.transmittals')
      @break
      @case(7)
        @include('reports.paid')
      @break
      @case(8)
      @include('reports.encoded')
      @break
      @case(9)
      @include('reports.belowten')
      @break
      @case(28)
      @include('reports.aboveten')
      @break
      @case(29)
      @include('reports.in-house')
      @break
      @default
        <h1 class="text-gray-600">Select report to generate.</h1>
      @break
    @endswitch
  </div>
</div>
