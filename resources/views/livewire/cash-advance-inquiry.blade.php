<div x-data x-animate>
    <div>
      <div class="flex justify-between">
      </div>
      <div class="grid grid-cols-4 gap-2 mt-4">
        <div class="border p-1 px-3 rounded">
          <x-checkbox label="MEMBER NAME" wire:model="filters.member_id" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="PURPOSE" wire:model="filters.purpose" />
        </div>
        {{-- <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="CONTACT NUMBER" wire:model="filters.contact_number" />
          </div> --}}
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="ACCOUNT" wire:model="filters.account" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="AMOUNT REQUESTED" wire:model="filters.amount_requested" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="AMOUNT APPROVED" wire:model="filters.amount_approved" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="DATE RECEIVED" wire:model="filters.date_received" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="DATE APPROVED" wire:model="filters.date_approved" />
        </div>
      </div>

      <div class="mt-4 relative">
        <div class="p-3 border rounded-lg">
          <div class="flex mb-2 justify-between items-center">
            <div>
              <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToCashAdvance" />
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
                          MEMBER NAME
                        </th>
                        <th
                          class="whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                          PURPOSE
                        </th>
                        {{-- <th
                        class="whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                        CONTACT NUMBER
                       </th> --}}
                        <th
                          class=" whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                          ACCOUNT
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          AMOUNT REQUESTED
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          AMOUNT APPROVED
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          DATE RECEIVED
                        </th>
                        <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        DATE APPROVED
                      </th>
                      </tr>
                    @elseif($count > 0)
                      <tr class="divide-x divide-gray-200">

                        @if ($filters['member_id'] != false && $filters['member_id'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            MEMBER NAME
                          </th>
                        @endif
                        @if ($filters['purpose'] != false && $filters['purpose'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            PURPOSE
                          </th>
                        @endif
                        {{-- @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          CONTACT NUMBER
                        </th>
                        @endif --}}
                        @if ($filters['account'] != false && $filters['account'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            ACCOUNT
                          </th>
                        @endif
                        @if ($filters['amount_requested'] != false && $filters['amount_requested'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            AMOUNT REQUESTED
                          </th>
                        @endif
                        @if ($filters['amount_approved'] != false && $filters['amount_approved'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            AMOUNT APPROVED
                          </th>
                        @endif
                        @if ($filters['date_received'] != false && $filters['date_received'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            DATE RECEIVED
                          </th>
                        @endif
                        @if ($filters['date_approved'] != false && $filters['date_approved'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DATE APPROVED
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
                                     $url = 'https://darbc.org/api/member-information/'.$record->member_id;
                                     $response = file_get_contents($url);
                                     $member_data = json_decode($response, true);

                                     $collection = collect($member_data['data']);
                                     $member_name = strtoupper($collection['user']['surname']) . ' ' .strtoupper($collection['user']['first_name']) . ' '. strtoupper($collection['user']['middle_name']).'.';
                            @endphp
                            {{ $member_name }}</td>
                          <td class="p-4 text-sm text-gray-700 text-left">{{ $record->purpose }}</td>
                          {{-- <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}
                          </td> --}}
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->account }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->amount_requested }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->amount_approved }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ \Carbon\Carbon::parse($record->date_received)->format('F d, Y') }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                           {{ \Carbon\Carbon::parse($record->date_approved)->format('F d, Y') }}</td>
                          </td>
                        </tr>
                      @elseif($count > 0)
                        <tr class="divide-x divide-gray-200">

                          @if ($filters['member_id'] != false && $filters['member_id'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm font-medium text-gray-900 ">
                                @php
                                $url_2 = 'https://darbc.org/api/member-information/'.$record->member_id;
                                $response_2 = file_get_contents($url_2);
                                $member_data_2 = json_decode($response_2, true);

                                $collection_2 = collect($member_data_2['data']);
                                $member_name_2 = strtoupper($collection_2['user']['surname']) . ' ' .strtoupper($collection_2['user']['first_name']) . ' '. strtoupper($collection_2['user']['middle_name']).'.';
                                @endphp
                              {{ $member_name_2 }}</td>
                          @endif
                          @if ($filters['purpose'] != false && $filters['purpose'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->purpose }}
                            </td>
                          @endif
                          {{-- @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}
                          </td>
                          @endif --}}
                          @if ($filters['account'] != false && $filters['account'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->account }}
                            </td>
                          @endif
                          @if ($filters['amount_requested'] != false && $filters['amount_requested'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->amount_requested }}</td>
                          @endif
                          @if ($filters['amount_approved'] != false && $filters['amount_approved'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->amount_approved }}
                            </td>
                          @endif
                          @if ($filters['date_received'] != false && $filters['date_received'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ \Carbon\Carbon::parse($record->date_received)->format('F d, Y') }}
                            </td>
                          @endif
                          @if ($filters['date_approved'] != false && $filters['date_approved'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ \Carbon\Carbon::parse($record->date_approved)->format('F d, Y') }}</td>
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
