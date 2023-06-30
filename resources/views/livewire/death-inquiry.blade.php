<div x-data x-animate>
    <div>
      <div class="flex justify-between">
      </div>
      <div class="grid grid-cols-4 gap-2 mt-4">
        <div class="border p-1 px-3 rounded">
          <x-checkbox label="DARBC ID" wire:model="filters.member_id" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="BATCH NUMBER" wire:model="filters.batch_number" />
        </div>
        <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="DATE" wire:model="filters.date" />
          </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="ENROLLMENT STATUS" wire:model="filters.enrollment_status" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="FIRST NAME" wire:model="filters.first_name" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="MIDDLE NAME" wire:model="filters.middle_name" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="LAST NAME" wire:model="filters.last_name" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="DEPENDENT FIRST NAME" wire:model="filters.dependents_first_name" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="DEPENDENT MIDDLE NAME" wire:model="filters.dependents_middle_name" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="DEPENDENT LAST NAME" wire:model="filters.dependents_last_name" />
        </div>
        <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="DEPENDENT TYPE" wire:model="filters.dependent_type" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="HAS DIAMOND PACKAGE" wire:model="filters.has_diamond_package" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="BIRTHDAY" wire:model="filters.birthday" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="AGE" wire:model="filters.age" />
          </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="CONTACT NUMBER" wire:model="filters.contact_number" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="DATE OF DEATH" wire:model="filters.date_of_death" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="PLACE OF DEATH" wire:model="filters.place_of_death" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="COVERAGE TYPE" wire:model="filters.coverage_type" />
        </div>
        <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="HAS VEHICLE" wire:model="filters.has_vehicle" />
          </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="AMOUNT" wire:model="filters.amount" />
        </div>
      </div>

      <div class="mt-4 relative">
        <div class="p-3 border rounded-lg">
          <div class="flex mb-2 justify-between items-center">
            <div>
              <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToDeath" />
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
                          BATCH NUMBER
                        </th>
                        <th
                        class="whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                        DATE
                       </th>
                        <th
                          class=" whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
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
                        DEPENDENT FIRST NAME
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        DEPENDENT MIDDLE NAME
                      </th>
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        DEPENDENT LAST NAME
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      DEPENDENT TYPE
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      HAS DIAMOND PACKAGE
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                     BIRTHDAY
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      AGE
                      </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          CONTACT NUMBER
                        </th>

                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          DATE OF DEATH
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          PLACE OF DEATH
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          COVERAGE TYPE
                        </th>
                        <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          HAS VEHICLE
                       </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          AMOUNT
                        </th>
                      </tr>
                    @elseif($count > 0)
                      <tr class="divide-x divide-gray-200">

                        @if ($filters['member_id'] != false && $filters['member_id'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            DARBC ID
                          </th>
                        @endif
                        @if ($filters['batch_number'] != false && $filters['batch_number'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            BATCH NUMBER
                          </th>
                        @endif
                        @if ($filters['date'] != false && $filters['date'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DATE
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
                        @if ($filters['dependents_first_name'] != false && $filters['dependents_first_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DEPENDENT FIRST NAME
                        </th>
                      @endif
                      @if ($filters['dependents_middle_name'] != false && $filters['dependents_middle_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DEPENDENT MIDDLE NAME
                        </th>
                      @endif
                      @if ($filters['dependents_last_name'] != false && $filters['dependents_last_name'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          DEPENDENT LAST NAME
                        </th>
                      @endif
                      @if ($filters['dependent_type'] != false && $filters['dependent_type'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        DEPENDENT TYPE
                      </th>
                      @endif
                      @if ($filters['has_diamond_package'] != false && $filters['has_diamond_package'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        HAS DIAMOND PACKAGE
                      </th>
                      @endif
                      @if ($filters['birthday'] != false && $filters['birthday'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        BIRTHDAY
                      </th>
                      @endif
                      @if ($filters['age'] != false && $filters['age'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        AGE
                      </th>
                      @endif
                      @if ($filters['age'] != false && $filters['age'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        AGE
                      </th>
                      @endif
                        @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            CONTACT NUMBER
                          </th>
                        @endif
                        @if ($filters['date_of_death'] != false && $filters['date_of_death'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            DATE OF DEATH
                          </th>
                        @endif
                        @if ($filters['place_of_death'] != false && $filters['place_of_death'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            PLACE OF DEATH
                          </th>
                        @endif
                        @if ($filters['coverage_type'] != false && $filters['coverage_type'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          COVERAGE TYPE
                        </th>
                      @endif
                      @if ($filters['has_vehicle'] != false && $filters['has_vehicle'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        HAS VEHICLE
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
                            {{ $record->member_id }}</td>
                          <td class="p-4 text-sm text-gray-700 text-left">{{ $record->batch_number }}</td>
                          <td class="p-4 text-sm text-gray-700 text-left">{{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->enrollment_status }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->first_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->middle_name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->last_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->dependents_first_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                           {{ $record->dependents_middle_name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->dependents_last_name }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->dependent_type }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->mortuary->diamond_package }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->birthday }}
                          </td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->age }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ \Carbon\Carbon::parse($record->date_of_death)->format('F d, Y') }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{  $record->place_of_death }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->coverage_type }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->mortuary->vehicle }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->amount }}
                          </td>
                        </tr>
                      @elseif($count > 0)
                        <tr class="divide-x divide-gray-200">

                          @if ($filters['member_id'] != false && $filters['member_id'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm font-medium text-gray-900 ">
                              {{ $record->member_id }}</td>
                          @endif
                          @if ($filters['batch_number'] != false && $filters['batch_number'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->batch_number }}
                            </td>
                          @endif
                          @if ($filters['date'] != false && $filters['date'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->date }}
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
                          @if ($filters['dependents_first_name'] != false && $filters['dependents_first_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->dependents_first_name }}</td>
                         @endif
                         @if ($filters['dependents_middle_name'] != false && $filters['dependents_middle_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->dependents_middle_name }}
                          </td>
                         @endif
                         @if ($filters['dependents_last_name'] != false && $filters['dependents_last_name'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->dependents_last_name }}
                          </td>
                        @endif
                        @if ($filters['dependent_type'] != false && $filters['dependent_type'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->dependent_type }}
                        </td>
                        @endif
                        @if ($filters['has_diamond_package'] != false && $filters['has_diamond_package'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->mortuary->diamond_package }}
                        </td>
                        @endif
                        @if ($filters['birthday'] != false && $filters['birthday'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->birthday }}
                        </td>
                        @endif
                        @if ($filters['age'] != false && $filters['age'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->age }}</td>
                       @endif
                          @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->contact_number }}
                            </td>
                          @endif
                          @if ($filters['date_of_death'] != false && $filters['date_of_death'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ \Carbon\Carbon::parse($record->date_of_death)->format('F d, Y') }}
                            </td>
                          @endif
                          @if ($filters['place_of_death'] != false && $filters['place_of_death'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->place_of_death }}</td>
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
                          @if ($filters['has_vehicle'] != false && $filters['has_vehicle'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->mortuary->vehicle }}</td>
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
