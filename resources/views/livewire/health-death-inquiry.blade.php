<div x-data x-animate>
  <div>
    <div class="flex justify-between">
    </div>
    <div class="grid grid-cols-4 gap-2 mt-4">
      <div class="border p-1 px-3 rounded">
        <x-checkbox label="DARBC ID" wire:model="filters.darbc_id" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox label="MEMBER" wire:model="filters.member" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox label="HOSPITAL" wire:model="filters.hospital" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-label" label="BATCH NUMBER" wire:model="filters.batch_number" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-label1" label="ENROLLMENT STATUS" wire:model="filters.enrollment_status" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe2" label="FIRST NAME" wire:model="filters.first_name" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe3" label="MIDDLE NAME" wire:model="filters.middle_name" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe4" label="LAST NAME" wire:model="filters.last_name" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe5" label="CONTACT NUMBER" wire:model="filters.contact_number" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe6" label="AGE" wire:model="filters.age" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe7" label="CONFINEMENT DATE FROM" wire:model="filters.confinement_date_from" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-labe8" label="CONFINEMENT DATE TO" wire:model="filters.confinement_date_to" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-label9" label="NUMBER OF DAYS" wire:model="filters.number_of_days" />
      </div>
      <div class="border p-1 px-3 rounded">
        <x-checkbox id="right-label10" label="AMOUNT" wire:model="filters.amount" />
      </div>
    </div>

    <div class="mt-4 relative">
      <div class="p-3 border rounded-lg">
        <div class="flex mb-2 justify-between items-center">
          <div>
            <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToHealth" />
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
          <div>
            <x-button label="PRINT" class="font-bold" icon="printer" dark @click="printOut($refs.printContainer.outerHTML);" />
          </div>
        </div>
        <div x-ref="printContainer" class="flow-root overflow-x-auto" id="print_table">
            @php
            $count = count(
                array_filter($filters, function ($value) {
                    return $value !== null;
                }),
            );
          @endphp
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  @if ($count < 1)
                    <tr class="divide-x divide-gray-200">
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        DARBC ID
                      </th>
                      <th
                        class="whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                        MEMBER
                      </th>
                      <th
                        class=" whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                        HOSPITAL
                      </th>
                      <th
                        class="whitespace-nowrap border-t  py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        BATCH NUMBER
                      </th>
                      <th
                        class=" whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        ENROLLMENT STATUS
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        FIRST NAME
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        MIDDLE NAME
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        LAST NAME
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        CONTACT NUMBER
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        AGE
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        CONFINEMENT DATE FROM
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        CONFINEMENT DATE TO
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        NUMBER OF DAYS
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        AMOUNT
                      </th>
                    </tr>
                  @elseif($count > 0)
                    <tr class="divide-x divide-gray-200">

                      @if ($filters['darbc_id'] != false && $filters['darbc_id'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DARBC ID
                        </th>
                      @endif
                      @if ($filters['member'] != false && $filters['member'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          MEMBER
                        </th>
                      @endif
                      @if ($filters['hospital'] != false && $filters['hospital'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          HOSPITAL
                        </th>
                      @endif
                      @if ($filters['batch_number'] != false && $filters['batch_number'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          BATCH NUMBER
                        </th>
                      @endif
                      @if ($filters['enrollment_status'] != false && $filters['enrollment_status'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          ENROLLMENT STATUS
                        </th>
                      @endif
                      @if ($filters['first_name'] != false && $filters['first_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          FIRST NAME
                        </th>
                      @endif
                      @if ($filters['middle_name'] != false && $filters['middle_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          MIDDLE NAME
                        </th>
                      @endif
                      @if ($filters['last_name'] != false && $filters['last_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          LAST NAME
                        </th>
                      @endif
                      @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          CONTACT NUMBER
                        </th>
                      @endif
                      @if ($filters['age'] != false && $filters['age'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          AGE
                        </th>
                      @endif
                      @if ($filters['confinement_date_from'] != false && $filters['confinement_date_from'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          CONFINEMENT DATE FROM
                        </th>
                      @endif
                      @if ($filters['confinement_date_to'] != false && $filters['confinement_date_to'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          CONFINEMENT DATE FROM
                        </th>
                      @endif
                      @if ($filters['number_of_days'] != false && $filters['number_of_days'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          NUMBER OF DAYS
                        </th>
                      @endif
                      @if ($filters['amount'] != false && $filters['amount'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          AMOUNT
                        </th>
                      @endif
                    </tr>
                  @endif
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  @foreach ($records as $record)
                    @if ($count < 1)
                      <tr class="divide-x divide-gray-200">

                        <td class=" py-4 pl-4 pr-4 text-sm  text-gray-700 ">
                            @php
                            $url = 'https://darbcrelease.org/api/member-information/'.$record->member_id;
                            $response = file_get_contents($url);
                            $member_data = json_decode($response, true);

                            $collection = collect($member_data['data']);
                            $member_name = strtoupper($collection['user']['surname']) . ' ' .strtoupper($collection['user']['first_name']) . ' '. strtoupper($collection['user']['middle_name']);
                            @endphp
                          {{ $record->member_id }}</td>
                        <td class=" p-4 text-sm text-gray-700 text-left"> {{ $member_name }}</td>
                        <td class=" p-4 text-sm text-gray-700 text-left"> {{ $record->hospitals->name }}</td>
                        <td class="p-4 text-sm text-gray-700 text-left">{{ $record->batch_number }}</td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->enrollment_status }}
                        </td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->first_name }}
                        </td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                          {{ $record->middle_name }}</td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->last_name }}
                        </td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}</td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->age }}
                        </td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ \Carbon\Carbon::parse($record->confinement_date_from)->format('F d, Y') }}</td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{  \Carbon\Carbon::parse($record->confinement_date_to)->format('F d, Y') }}
                        </td>
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->number_of_days }}</td>

                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->amount }}
                        </td>
                      </tr>
                    @elseif($count > 0)
                      <tr class="divide-x divide-gray-200">

                        @if ($filters['darbc_id'] != false && $filters['darbc_id'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm font-medium text-gray-900 ">
                            {{ $record->member_id }}</td>
                        @endif

                        @if ($filters['member'] != false && $filters['member'] != null)
                            @php
                            $url = 'https://darbcrelease.org/api/member-information/'.$record->member_id;
                            $response = file_get_contents($url);
                            $member_data = json_decode($response, true);

                            $collection = collect($member_data['data']);
                            $member_name = strtoupper($collection['user']['surname']) . ' ' .strtoupper($collection['user']['first_name']) . ' '. strtoupper($collection['user']['middle_name']);
                            @endphp
                          <td class=" p-4 text-sm text-gray-700 text-left"> {{  $member_name }}</td>
                        @endif
                        @if ($filters['hospital'] != false && $filters['hospital'] != null)
                          <td class="p-4 text-sm text-gray-700 text-left">{{ $record->hospitals->name }}</td>
                        @endif

                        @if ($filters['batch_number'] != false && $filters['batch_number'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->batch_number }}
                          </td>
                        @endif

                        @if ($filters['enrollment_status'] != false && $filters['enrollment_status'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->enrollment_status }}
                          </td>
                        @endif

                        @if ($filters['first_name'] != false && $filters['first_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->first_name }}</td>
                        @endif

                        @if ($filters['middle_name'] != false && $filters['middle_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->middle_name }}
                          </td>
                        @endif

                        @if ($filters['last_name'] != false && $filters['last_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->last_name }}
                          </td>
                        @endif
                        @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->contact_number }}
                          </td>
                        @endif

                        @if ($filters['age'] != false && $filters['age'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->age }}</td>
                        @endif

                        @if ($filters['confinement_date_from'] != false && $filters['confinement_date_from'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ \Carbon\Carbon::parse($record->confinement_date_from)->format('F d, Y') }}
                          </td>
                        @endif
                        @if ($filters['confinement_date_to'] != false && $filters['confinement_date_to'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ \Carbon\Carbon::parse($record->confinement_date_to)->format('F d, Y') }}</td>
                        @endif
                        @if ($filters['number_of_days'] != false && $filters['number_of_days'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->number_of_days }}</td>
                        @endif

                        @if ($filters['amount'] != false && $filters['amount'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->amount }}

                          </td>
                        @endif
                      </tr>
                    @endif
                  @endforeach

                  <!-- More people... -->
                </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
      }
    </script>
  @endpush

</div>
