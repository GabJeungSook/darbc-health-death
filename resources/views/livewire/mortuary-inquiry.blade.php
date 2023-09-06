<div x-data x-animate>
    <div>
      <div class="flex justify-between">
      </div>
      <div class="grid grid-cols-4 gap-2 mt-4">
        <div class="border p-1 px-3 rounded">
          <x-checkbox label="MEMBER NAME" wire:model="filters.member_id" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="CONTACT NUMBER" wire:model="filters.contact_number" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="AMOUNT" wire:model="filters.amount" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="HOLLOGRAPHIC" wire:model="filters.hollographic" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="CLAIMANTS FIRST NAME" wire:model="filters.claimants_first_name" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="CLAIMANTS MIDDLE NAME" wire:model="filters.claimants_middle_name" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="CLAIMANTS LAST NAME" wire:model="filters.claimants_last_name" />
        </div>
        <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="CLAIMANTS CONTACT NUMBER" wire:model="filters.claimants_contact_number" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="STATUS" wire:model="filters.status" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="DIAMOND PACKAGE" wire:model="filters.diamond_package" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="VEHICLE" wire:model="filters.vehicle" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="COVERAGE TYPE" wire:model="filters.coverage_type" />
         </div>
      </div>

      <div class="mt-4 relative">
        <div class="p-3 border rounded-lg">
          <div class="flex mb-2 justify-between items-center">
            <div>
              <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToMortuary" />
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
                          CONTACT NUMBER
                        </th>
                        <th
                          class=" whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                          AMOUNT
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          HOLLOGRAPHIC
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          CLAIMANTS FIRST NAME
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          CLAIMANTS MIDDLE NAME
                        </th>
                        <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        CLAIMANTS LAST NAME
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      CLAIMANTS CONTACT NUMBER
                      </th>
                      <th
                       class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                       STATUS
                       </th>
                       <th
                       class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                       DIAMOND PACKAGE
                       </th>
                       <th
                       class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                       VEHICLE
                       </th>
                       <th
                       class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                       COVERAGE TYPE
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
                        @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            CONTACT NUMBER
                          </th>
                        @endif
                        @if ($filters['amount'] != false && $filters['amount'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            AMOUNT
                          </th>
                        @endif
                        @if ($filters['hollographic'] != false && $filters['hollographic'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            HOLLOGRAPHIC
                          </th>
                        @endif
                        @if ($filters['claimants_first_name'] != false && $filters['claimants_first_name'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            CLAIMANTS FIRST NAME
                          </th>
                        @endif
                        @if ($filters['claimants_middle_name'] != false && $filters['claimants_middle_name'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            CLAIMANTS MIDDLE NAME
                          </th>
                        @endif
                        @if ($filters['claimants_last_name'] != false && $filters['claimants_last_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          CLAIMANTS LAST NAME
                        </th>
                      @endif
                      @if ($filters['claimants_contact_number'] != false && $filters['claimants_contact_number'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        CLAIMANTS CONTACT NUMBER
                      </th>
                      @endif
                      @if ($filters['status'] != false && $filters['status'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        STATUS
                      </th>
                      @endif
                      @if ($filters['diamond_package'] != false && $filters['diamond_package'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        DIAMOND PACKAGE
                      </th>
                      @endif
                      @if ($filters['vehicle'] != false && $filters['vehicle'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        VEHICLE
                      </th>
                      @endif
                      @if ($filters['coverage_type'] != false && $filters['coverage_type'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        COVERAGE TYPE
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
                                     $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                                     $response = Http::withOptions(['verify' => false])->get($url);
                                     $member_data = $response->json();


                                     $collection = collect($member_data['data']);
                                     $member_name = strtoupper($collection['user']['surname']) . ' ' .strtoupper($collection['user']['first_name']) . ' '. strtoupper($collection['user']['middle_name']).'.';
                            @endphp
                            {{ $member_name }}</td>
                          <td class="p-4 text-sm text-gray-700 text-left">{{ $record->contact_number }}</td>
                          {{-- <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}
                          </td> --}}
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->amount }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{$record->hollographic}}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->claimants_first_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->claimants_middle_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                           {{ $record->claimants_last_name }}</td>
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->claimants_contact_number }}</td>
                           </td>
                           <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->status }}</td>
                           </td>
                           <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->diamond_package }}
                           </td>
                           </td>
                           <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            @if ($record->vehicle == 1)
                                YES
                            @else
                                NO
                            @endif
                           </td>
                           <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            @if ($record->vehicle == 1)
                                YES
                            @else
                                NO
                            @endif
                           </td>
                           <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            @switch($record->coverage_type)
                                    @case(1)
                                        Accidental Death/ Disablement
                                        @break
                                    @case(2)
                                        Accident Burial Benefit
                                        @break
                                    @case(3)
                                        Unprovoked Murder & Assault
                                        @break
                                    @case(4)
                                        Burial Benefit due to Natural Death
                                        @break
                                    @case(5)
                                        Motorcycling Coverage
                                        @break
                                    @case(6)
                                        Daily Hospital Income Benefit, due to accident and/or illness
                                        @break
                                    @case(7)
                                        Premium inclusive of taxes
                                        @break
                                    @default
                                @endswitch
                           </td>
                        </tr>
                      @elseif($count > 0)
                        <tr class="divide-x divide-gray-200">

                          @if ($filters['member_id'] != false && $filters['member_id'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm font-medium text-gray-900 ">
                                @php
                                $url_2 = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                                $response_2 = Http::withOptions(['verify' => false])->get($url_2);
                                $member_data_2 = $response_2->json();

                                $collection_2 = collect($member_data_2['data']);
                                $member_name_2 = strtoupper($collection_2['user']['surname']) . ' ' .strtoupper($collection_2['user']['first_name']) . ' '. strtoupper($collection_2['user']['middle_name']).'.';
                                @endphp
                              {{ $member_name_2 }}</td>
                          @endif
                          @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}
                            </td>
                          @endif
                          @if ($filters['amount'] != false && $filters['amount'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->amount }}
                            </td>
                          @endif
                          @if ($filters['hollographic'] != false && $filters['hollographic'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->hollographic }}
                            </td>
                          @endif
                          @if ($filters['claimants_first_name'] != false && $filters['claimants_first_name'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->claimants_first_name }}
                            </td>
                          @endif
                          @if ($filters['claimants_middle_name'] != false && $filters['claimants_middle_name'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->claimants_middle_name }}
                            </td>
                          @endif
                          @if ($filters['claimants_last_name'] != false && $filters['claimants_last_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->claimants_last_name }}</td>
                         @endif
                         @if ($filters['claimants_contact_number'] != false && $filters['claimants_contact_number'] != null)
                         <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                           {{ $record->claimants_contact_number }}</td>
                        @endif
                        @if ($filters['status'] != false && $filters['status'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                          {{ $record->status }}</td>
                       @endif
                       @if ($filters['diamond_package'] != false && $filters['diamond_package'] != null)
                       <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                         {{ $record->diamond_package }}</td>
                      @endif
                      @if ($filters['vehicle'] != false && $filters['vehicle'] != null)
                      <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                        @if ($record->vehicle == 1)
                        YES
                        @else
                            NO
                        @endif
                    </td>
                      @endif
                      @if ($filters['coverage_type'] != false && $filters['coverage_type'] != null)
                      <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                        @switch($record->coverage_type)
                        @case(1)
                            Accidental Death/ Disablement
                            @break
                        @case(2)
                            Accident Burial Benefit
                            @break
                        @case(3)
                            Unprovoked Murder & Assault
                            @break
                        @case(4)
                            Burial Benefit due to Natural Death
                            @break
                        @case(5)
                            Motorcycling Coverage
                            @break
                        @case(6)
                            Daily Hospital Income Benefit, due to accident and/or illness
                            @break
                        @case(7)
                            Premium inclusive of taxes
                            @break
                        @default
                    @endswitch
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
