<div  x-data x-animate>
    <div class="flex justify-end">
        <div class=""></div>
        <div>
            <x-button label="PRINT" sm dark icon="printer" class="font-bold"
            @click="printOut($refs.printContainer.outerHTML);"  />
        </div>
    </div>
    <div x-ref="printContainer">
        <div>
            <div class="px-4 sm:px-0">
              <h3 class="text-base font-semibold leading-7 text-gray-900">Member / Dependent Information</h3>
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Death and insurance information.</p>
            </div>
            <div class="mt-6">
              <dl class="grid grid-cols-1 sm:grid-cols-3">
                @php
                 $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                 $response = Http::withOptions(['verify' => false])->get($url);
                 $member_data = $response->json();

                  $collection = collect($member_data['data']);
                    @endphp
                <div class="border-t border-gray-100 px-4 p-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">DARBC ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$collection['darbc_id']}}</dd>
                    <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">BATCH NUMBER</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->batch_number}}</dd>
                </div>

                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">FULL NAME</dt>
                  @if ($record->enrollment_status == "member")
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($collection['user']['full_name'])}}</dd>

                  @else
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name) . ' ' . strtoupper($record->dependents_last_name)}}</dd>
                  @endif
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">DIAMOND PACKAGE</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->has_diamond_package}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">ENROLLMENT STATUS</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                    {{$record->enrollment_status == "dependent" ? strtoupper($record->enrollment_status).' ('.strtoupper($record->dependent_type).')'
                    : strtoupper($record->enrollment_status) }}
                  </dd>
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">HAS VEHICLE</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->has_vehicle}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">CONTACT NUMBER</dt>
                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->contact_number}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">BIRTHDAY</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ \Carbon\Carbon::parse($record->birthday)->format('F d, Y')}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">AGE</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->age}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">DATE OF DEATH</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->date_of_death != null ? \Carbon\Carbon::parse($record->date_of_death)->format('F d, Y') : '---'}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">PLACE OF DEATH</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->place_of_death != null ? strtoupper($record->place_of_death) : '---'}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">COVERAGE TYPE</dt>
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
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Amount</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">₱{{number_format($record->amount, 2, '.', ',')}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-3 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                  @if ($record->death_attachments()->count() == 0)
                  <span class="text-lg font-medium leading-6 text-gray-900">NO ATTACHED DOCUMENT</span>
                  @else
                  @foreach($record->death_attachments as $attachment)
                  <dd class="mt-2 text-sm text-gray-900">
                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                      <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                        <div class="flex w-0 flex-1 items-center">
                          <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                          </svg>
                          <div class="ml-4 flex min-w-0 flex-1 gap-2">
                            <span class="truncate font-medium">{{$attachment->document_name}}</span>
                            {{-- <span class="flex-shrink-0 text-gray-400">2.4mb</span> --}}
                          </div>
                        </div>
                        <div class="print-button ml-4 flex-shrink-0">
                          <a href="{{ $this->getFileUrl($attachment->path) }}" x-data="{}" target='_blank' class="font-medium text-indigo-600 hover:text-indigo-500">View</a>
                          <button wire:click="deleteAttachment({{ $attachment->id }})" class="ml-2 text-red-600 hover:text-red-500"><span class="sr-only">Delete</span>Delete</button>
                        </div>
                      </li>
                    </ul>
                  </dd>
                  @endforeach
                  @endif
                  <div class="print-button py-3">
                    <x-button emerald icon="plus" label="Add Attachments" wire:click="$set('deathModal', true)" />
                  </div>
                </div>
              </dl>
            </div>
          </div>
    </div>


      {{-- DEATH MODAL --}}
        <x-modal.card title="Upload" align="center" blur wire:model.defer="deathModal">
        <livewire:forms.upload-death-attachments :death_id="$record->id" />
        </x-modal.card>
</div>
