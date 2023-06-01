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
              <h3 class="text-base font-semibold leading-7 text-gray-900">Community Relation Information</h3>
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
            </div>
            <div class="mt-6">
              <dl class="grid grid-cols-1 sm:grid-cols-3">
                <div class="border-t border-gray-100 px-4 p-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">FULL NAME</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"> {{strtoupper($record->first_name).' '.strtoupper($record->middle_name).' '.strtoupper($record->last_name)}}</dd>
                    <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">PURPOSE</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                        {{$record->community_purpose->name}}
                    </dd>
                  </div>

                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">CONTACT NUMBER</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                    {{$record->contact_number}}
                  </dd>
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">TYPE</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->community_type->name}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">ORGANIZATION / ADDRESS</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->organization)}}</dd>
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">NUMBER OF PARTICIPANTS</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->number_of_participants}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">STATUS</dt>
                   <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $record->status }}</dd>
                </div>
                <div class="hidden border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">STATUS</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $record->status }}</dd>
                </div>
              </dl>
            </div>
          </div>
    </div>

</div>
