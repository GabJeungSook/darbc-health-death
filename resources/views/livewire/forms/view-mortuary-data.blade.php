<div>
    <div>
        <div class="px-4 sm:px-0">
          <h3 class="text-base font-semibold leading-7 text-gray-900">Member / Claimant Information</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
        </div>
        <div class="mt-6">
          <dl class="grid grid-cols-1 sm:grid-cols-3">
            @php
            $url = 'https://darbc.org/api/member-information/'.$record->member_id;
              $response = file_get_contents($url);
              $member_data = json_decode($response, true);

              $collection = collect($member_data['data']);
                @endphp
            <div class="border-t border-gray-100 px-4 p-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">DARBC ID</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$collection['darbc_id']}}</dd>
                <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">AMOUNT</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">₱{{number_format($record->amount, 2, '.', ',')}}</dd>
            </div>

            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">FULL NAME</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->member_name)}}</dd>

              <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4"></dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"></dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">CONTACT NUMBER</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->contact_number == null ? '---' : $record->contact_number}}</dd>
              <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">HOLLOGRAPHIC</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->hollographic == 1 ? 'Yes' : 'No'}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">CLAIMANT'S FULLNAME</dt>
               <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->claimants_middle_name == null ?
               strtoupper($record->claimants_first_name).' '.strtoupper($record->claimants_middle_name).' '.strtoupper($record->claimants_last_name)
             : strtoupper($record->claimants_first_name).' '.strtoupper($record->claimants_last_name)}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">CLAIMANT'S CONTACT NUMBER</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $record->claimants_contact_number}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">DATE RECEIVED</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{\Carbon\Carbon::parse($record->date_received)->format('F d, Y')}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">STATUS</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->status}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">DIAMOND PACKAGE</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->diamond_package}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">VEHICLE</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->vehicle}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-3 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
              @if ($record->mortuary_attachments()->count() == 0)
              <span class="text-lg font-medium leading-6 text-gray-900">NO ATTACHED DOCUMENT</span>
              @else
              @foreach($record->mortuary_attachments as $attachment)
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
                    <div class="ml-4 flex-shrink-0">
                      <a href="{{ $this->getFileUrl($attachment->path) }}" x-data="{}" target='_blank' class="font-medium text-indigo-600 hover:text-indigo-500">View</a>
                      <button wire:click="deleteAttachment({{ $attachment->id }})" class="ml-2 text-red-600 hover:text-red-500"><span class="sr-only">Delete</span>Delete</button>
                    </div>
                  </li>
                </ul>
              </dd>
              @endforeach
              @endif
              <div class="py-3">
                <x-button emerald icon="plus" label="Add Attachments" wire:click="$set('mortuaryModal', true)" />
              </div>
            </div>
          </dl>
        </div>
      </div>

      {{-- DEATH MODAL --}}
        <x-modal.card title="Upload" align="center" blur wire:model.defer="mortuaryModal">
        <livewire:forms.upload-mortuary-attachments :mortuary_id="$record->id" />
        </x-modal.card>
</div>
