<div x-data x-animate>
    <div class="mt-4 flex">
        <div class=""></div>
        <div>
            <x-button label="PRINT" sm dark icon="printer" class="font-bold"
            @click="printOut($refs.printContainer.outerHTML);"  />
        </div>
    </div>
    <div class="py-3 mt-3 px-4 border-2" x-ref="printContainer">
        <div class="mt-4 flex justify-center text-center space-x-1">
            <div class="grid ">
              <img src="{{ asset('images/darbc.png') }}" class="h-10 mt-1" alt="" media="print">
            </div>
            <div>
              <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP.</h1>
              <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
              <div class="mx-auto">
                <h1>CDA REG. #: 9520-12006162</h1>
                <h1>FAX NO. (083) 500-2411</h1>
              </div>
            </div>
          </div>
          <div class="mt-2 h-0.5 bg-gray-700"></div>
          <div class="mt-0.5 h-0.5 bg-gray-700"></div>
          <div class="mt-3">
            <h1 class="font-bold text-center text-xl">HEALTH & DEATH CLAIM INSURANCE</h1>
          </div>
          <div class="px-8">
            <div class="mt-7 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">NAME OF MEMBER: </h1>
                </div>
                @php
                 $url = 'https://darbcmembership.org/api/member-information/'.$record->member_id;
                 $response = Http::withOptions(['verify' => false])->get($url);
                 $member_data = $response->json();

                  $collection = collect($member_data['data']);
                @endphp
                {{strtoupper($collection['user']['full_name'])}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">REPLACEMENT: </h1>
                </div>
                @if ($record->enrollment_status == "replacement")
                {{strtoupper($record->dependents_last_name).', '.strtoupper($record->dependents_middle_name).' '.strtoupper($record->dependents_first_name)}}
                @endif
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">NAME OF DEPENDENT: </h1>
                </div>
                @if ($record->enrollment_status == "dependent")
                {{strtoupper($record->dependents_last_name).', '.strtoupper($record->dependents_middle_name).' '.strtoupper($record->dependents_first_name)}}
                @endif
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">ADDRESS: </h1>
                </div>
                {{-- {{strtoupper($record->last_name).', '.strtoupper($record->middle_name).' '.strtoupper($record->first_name)}} --}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="grid grid-cols-2 space-x-3">
                <div class="mt-1 grid grid-rows-2 grid-cols-3">
                    <div class="row-start-1 col-span-1">
                        <h1 class="font-medium">BIRTHDATE: </h1>
                    </div>
                    {{\Carbon\Carbon::parse($collection['date_of_birth'])->format('F d, Y')}}
                    <div class="row-start-2 col-start-2 col-span-2 h-0.5 w-full bg-gray-700"></div>
                  </div>
                  <div class="mt-1 grid grid-rows-2 grid-cols-6">
                    <div class="row-start-1 col-span-1 text-center">
                        <h1 class="font-medium">AGE: </h1>
                    </div>
                    <span class="text-start">{{$record->age}}</span>
                    <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
                  </div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">CONTACT NUMBER: </h1>
                </div>
                {{$record->contact_number}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">DATE OF DEATH: </h1>
                </div>
                {{\Carbon\Carbon::parse($record->date_of_death)->format('F d, Y')}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">PLACE OF DEATH: </h1>
                </div>
                {{strtoupper($record->place_of_death)}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="grid grid-cols-2 space-x-3">
                {{-- <div class="mt-1 grid grid-rows-2 grid-cols-3">
                    <div class="row-start-1 col-span-1">
                        <h1 class="font-medium">NUMBER OF DAYS: </h1>
                    </div>
                    {{$record->number_of_days}}
                    <div class="row-start-2 col-start-2 col-span-2 h-0.5 w-full bg-gray-700"></div>
                  </div>
                  <div class="mt-1 grid grid-rows-2 grid-cols-6"> --}}
                    <div class="row-start-1 col-span-1 text-center">
                        <h1 class="font-medium">AMOUNT: </h1>
                    </div>
                    <span class="text-start">₱{{number_format($record->amount, 2, '.', ',')}}</span>
                    <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
                  </div>
              </div>
              <div class="mt-1 grid grid-rows-2 grid-cols-6">
                <div class="row-start-1 col-span-1">
                    <h1 class="font-medium">ENROLLMENT STATUS: </h1>
                </div>
                {{strtoupper($record->enrollment_status)}}
                <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
              </div>
              <div class="mt-20 grid grid-cols-2 space-x-3">
                <div class="mt-1 grid grid-rows-2 grid-cols-3">
                    <div class="row-start-1 col-span-1">
                        <h1 class="font-medium">DATE: </h1>
                    </div>
                    {{\Carbon\Carbon::now()->format('F d, Y')}}
                    <div class="row-start-2 col-start-2 col-span-2 h-0.5 w-full bg-gray-700"></div>
                  </div>
                  <div class="mt-1 grid grid-rows-2 grid-cols-6">
                    <div class="row-start-1 col-span-1 text-center">
                        <h1 class="font-medium">SIGNATURE: </h1>
                    </div>
                    <div class="row-start-2 col-start-2 col-span-5 h-0.5 w-full bg-gray-700"></div>
                  </div>
              </div>
          </div>

    </div>

</div>
