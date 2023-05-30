<div x-data x-animate>
    <div>
      <div class="flex justify-between">
      </div>
      <div class="grid grid-cols-4 gap-2 mt-4">
        {{-- <div class="border p-1 px-3 rounded">
          <x-checkbox label="REF. NO." wire:model="filters.reference_number" />
        </div> --}}
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
          <x-checkbox id="right-label" label="ORGANIZATION / ADDRESS" wire:model="filters.organization" />
        </div>
        <div class="border p-1 px-3 rounded">
          <x-checkbox id="right-label" label="CONTACT NUMBER" wire:model="filters.contact_number" />
        </div>
        <div class="border p-1 px-3 rounded">
           <x-checkbox id="right-label" label="PURPOSE" wire:model="filters.purpose" />
        </div>
        <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="TYPE" wire:model="filters.type" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="NUMBER OF PARTICIPANTS" wire:model="filters.number_of_participants" />
         </div>
         <div class="border p-1 px-3 rounded">
            <x-checkbox id="right-label" label="STATUS" wire:model="filters.status" />
         </div>
      </div>

      <div class="mt-4 relative">
        <div class="p-3 border rounded-lg">
          <div class="flex mb-2 justify-between items-center">
            <div>
              <x-button label="Back" class="font-bold" icon="arrow-left" positive  wire:click="redirectToCommunityRelation" />
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
                        {{-- <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          REF. NO.
                        </th> --}}
                        <th
                          class="whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                          FIRST NAME
                        </th>
                        <th
                          class=" whitespace-nowrap border-t px-4 py-1 text-center text-sm font-semibold bg-indigo-500 text-white">
                          MIDDLE NAME
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          LAST NAME
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          ORGANIZATION / ADDRESS
                        </th>
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                          CONTACT NUMBER
                        </th>
                        <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                        PURPOSE
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      TYPE
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      NUMBER OF PARTICIPANTS
                      </th>
                      <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white ">
                      STATUS
                      </th>
                      </tr>
                    @elseif($count > 0)
                      <tr class="divide-x divide-gray-200">

                        @if ($filters['reference_number'] != false && $filters['reference_number'] != null)
                          {{-- <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            REF. NO.
                          </th> --}}
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
                        @if ($filters['organization'] != false && $filters['organization'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            ORGANIZATION / ADDRESS
                          </th>
                        @endif
                        @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                          <th
                            class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                            CONTACT NUMBER
                          </th>
                        @endif
                        @if ($filters['purpose'] != false && $filters['purpose'] != null)
                        <th
                          class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                          PURPOSE
                        </th>
                      @endif
                      @if ($filters['type'] != false && $filters['type'] != null)
                      <th
                        class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                        TYPE
                      </th>
                    @endif
                    @if ($filters['number_of_participants'] != false && $filters['number_of_participants'] != null)
                    <th
                      class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                      NUMBER OF PARTICIPANTS
                    </th>
                  @endif
                  @if ($filters['status'] != false && $filters['status'] != null)
                  <th
                    class="whitespace-nowrap border-t py-1 pl-4 pr-4 text-center text-sm font-semibold bg-indigo-500 text-white">
                    STATUS
                  </th>
                @endif
                      </tr>
                    @endif
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($records as $record)
                      @if ($count < 1)
                      {{-- @dump($records) --}}
                        <tr class="divide-x divide-gray-200">
                          {{-- <td class=" py-4 pl-4 pr-4 text-sm  text-gray-700 ">{{ $record->reference_number }}</td> --}}
                          <td class="p-4 text-sm text-gray-700 text-left">{{ $record->first_name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->middle_name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->last_name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->organization }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->community_purpose?->name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->community_type?->name }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->number_of_participants }}</td>
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->status }}</td>
                        </tr>
                      @elseif($count > 0)
                        <tr class="divide-x divide-gray-200">

                          @if ($filters['reference_number'] != false && $filters['reference_number'] != null)
                            {{-- <td class=" py-4 pl-4 pr-4 text-sm font-medium text-gray-900 ">{{ $record->reference_number }}</td> --}}
                          @endif
                          @if ($filters['first_name'] != false && $filters['first_name'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->first_name }}</td>
                          @endif
                          @if ($filters['middle_name'] != false && $filters['middle_name'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->middle_name }}
                            </td>
                          @endif
                          @if ($filters['last_name'] != false && $filters['last_name'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->last_name }}</td>
                          @endif
                          @if ($filters['organization'] != false && $filters['organization'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                              {{ $record->organization }}
                            </td>
                          @endif
                          @if ($filters['contact_number'] != false && $filters['contact_number'] != null)
                            <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">{{ $record->contact_number }}
                            </td>
                          @endif
                          @if ($filters['purpose'] != false && $filters['purpose'] != null)
                          <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                            {{ $record->community_purpose?->name }}</td>
                         @endif
                         @if ($filters['type'] != false && $filters['type'] != null)
                         <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                           {{ $record->community_type?->name }}</td>
                        @endif
                        @if ($filters['number_of_participants'] != false && $filters['number_of_participants'] != null)
                        <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                          {{ $record->number_of_participants }}</td>
                       @endif
                       @if ($filters['status'] != false && $filters['status'] != null)
                       <td class=" py-4 pl-4 pr-4 text-sm text-gray-700 text-left uppercase ">
                         {{ $record->status }}</td>
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
