<div>
    <div>
        <div class="border border-gray-400">
          <dl class="">
            <div class="px-4 py-3 flex space-x-4">
                @php
                $url = 'https://darbcrelease.org/api/member-information/'.$record->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);
                $darbc_id = $collection['darbc_id'];
                $member_name = strtoupper($collection['user']['surname']) . ' '
                .strtoupper($collection['user']['first_name']) . ' '
                . strtoupper($collection['user']['middle_name']).'.';
                $contact_number = $collection["contact_number"];
                $date_of_birth = $collection['date_of_birth'];
                $age = date_diff(date_create($date_of_birth), date_create('today'))->y;
                @endphp
              <dt class="text-sm font-medium text-gray-900">DARBC ID: </dt>
              <dd class="text-sm text-center">{{$darbc_id}}</dd>
            </div>
            <div class="px-4 py-3 flex space-x-4">
                <dt class="text-sm font-medium text-gray-900">Full name: </dt>
                <dd class="text-sm text-center">{{$member_name}}</dd>
            </div>
            <div class="px-4 py-3 flex space-x-4">
                <dt class="text-sm font-medium text-gray-900">Contact Number: </dt>
                <dd class="text-sm text-center">{{$contact_number}}</dd>
            </div>
            <div class="px-4 py-3 flex space-x-4">
                <dt class="text-sm font-medium text-gray-900">Age: </dt>
                <dd class="text-sm text-center">{{$age}}</dd>
            </div>
            <div class="px-4 py-3 flex space-x-4">
                <dt class="text-sm font-medium text-gray-900">Dependent: </dt>
                @if ($record->enrollment_status == "member")
                    <dd class="text-sm text-center">{{$member_name}}</dd>
                @else
                    <dd class="text-sm text-center">{{strtoupper($record->last_name) . ' '
                        .strtoupper($record->first_name) . ' '
                        . strtoupper($record->middle_name).'.'}}</dd>
                @endif

            </div>
            {{-- <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Application for</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Backend Developer</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Email address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">margotfoster@example.com</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Salary expectation</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">$120,000</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">About</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
              <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                  <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                    <div class="flex w-0 flex-1 items-center">
                      <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                      </svg>
                      <div class="ml-4 flex min-w-0 flex-1 gap-2">
                        <span class="truncate font-medium">resume_back_end_developer.pdf</span>
                        <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                      </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                      <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                    </div>
                  </li>
                  <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                    <div class="flex w-0 flex-1 items-center">
                      <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                      </svg>
                      <div class="ml-4 flex min-w-0 flex-1 gap-2">
                        <span class="truncate font-medium">coverletter_back_end_developer.pdf</span>
                        <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                      </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                      <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                    </div>
                  </li>
                </ul>
              </dd>
            </div> --}}
          </dl>
        </div>
        {{-- <div class="mt-4 border border-gray-400">
            <dl class="">
            <div class="px-4 py-2 flex space-x-4">
                    <dt class="text-md font-bold text-gray-900">Available Days </dt>
            </div>
              <div class="px-4 py-3 flex space-x-4">
                <dt class="text-sm font-medium text-gray-900">Members: </dt>
                <dd class="text-sm text-center">{{$record->number_of_days}}</dd>
              </div>
              <div class="px-4 py-3 flex space-x-4">
                  <dt class="text-sm font-medium text-gray-900">Dependent: </dt>
                  <dd class="text-sm text-center">{{$record->number_of_days}}</dd>
              </div>
            </dl>
          </div> --}}
          {{-- <div class="mt-4 border border-gray-400">
            <dl class="">
            <div class="px-4 py-2 flex space-x-4">
                <dt class="text-md font-bold text-gray-900">Summary</dt>
            </div>
              <div class="px-4 py-3">
                <dt class="text-sm font-medium text-gray-900">Members: </dt>
                <div>
                    <div class="mt-3 flow-root">
                      <div class="-my-2 overflow-x-auto">
                        <div class="inline-block min-w-full py-2 align-middle">
                          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                              <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Date Of Confinement</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hospital</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"># of Days</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date of Payment</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attatchments</th>
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 bg-white">
                                <tr>
                                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Lindsay Walton</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>
                                </tr>

                                <!-- More people... -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="px-4 py-3">
                  <dt class="text-sm font-medium text-gray-900">Dependent: </dt>
                  <div>
                    <div class="mt-3 flow-root">
                      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle">
                          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                              <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Date Of Confinement</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hospital</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"># of Days</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date of Payment</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attatchments</th>
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 bg-white">
                                <tr>
                                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Lindsay Walton</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Front-end Developer</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>
                                </tr>

                                <!-- More people... -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </dl>
          </div> --}}
      </div>
</div>
