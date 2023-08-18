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
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Cash Advance information.</p>
            </div>
            <div class="mt-6">
              <dl class="grid grid-cols-1 sm:grid-cols-3">
                @php
                 $url = 'https://darbcrelease.org/api/member-information/'.$record->member_id;
                 $response = Http::withOptions(['verify' => false])->get($url);
                 $member_data = $response->json();

                  $collection = collect($member_data['data']);
                  $member_name = $collection['user']['first_name'].' '.$collection['user']['middle_name'].' '.$collection['user']['surname'];
                  @endphp
                <div class="border-t border-gray-100 px-4 p-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">DARBC ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$collection['darbc_id']}}</dd>
                    <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">DEPENDENT NAME</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->first_name.' '.$record->middle_name.' '.$record->last_name)}}</dd>
                  </div>

                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">MEMBER NAME</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$member_name}}</dd>
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">PURPOSE</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->purpose}}</dd>
                  @if ($record->purpose == "Others")
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->other_purpose}}</dd>
                  @endif
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">ENROLLMENT STATUS</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->enrollment_status)}}</dd>
                  <dt class="text-sm font-medium leading-6 text-gray-900 border-t border-gray-100 mt-3 pt-4">ACCOUNT</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->account}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">AMOUNT REQUESTED</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">₱{{number_format($record->amount_requested, 2, '.', ',')}}</dd>
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
                    <dt class="text-sm font-medium leading-6 text-gray-900">REASON</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->reason)}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">AMOUNT APPROVED</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">₱{{$record->amount_approved != null ? number_format($record->amount_approved, 2, '.', ',') : ' ---'}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">DATE APPROVED</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->date_approved != null ? \Carbon\Carbon::parse($record->date_approved)->format('F d, Y') : '---'}}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-3 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">CONTACT NUMBERS</dt>
                    @foreach($record->contact_numbers as $contact)
                    <dd class="mt-2 text-sm text-gray-900">
                      <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                          <div class="flex w-0 flex-1 items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                              </svg>
                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                              <span class="truncate font-medium">{{$contact['contact_number']}}</span>
                              {{-- <span class="flex-shrink-0 text-gray-400">2.4mb</span> --}}
                            </div>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                          </div>
                        </li>
                      </ul>
                    </dd>
                    @endforeach
                  </div>
              </dl>
            </div>
          </div>
    </div>

</div>
