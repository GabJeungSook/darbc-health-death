<div>
    <div class="flex space-x-1">
      <div class="grid place-content-center">
        <img src="{{ asset('images/darbc.png') }}" class="h-10" alt="">
      </div>
      <div>
        <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP.</h1>
        <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
      </div>
    </div>

    <h1 class="text-xl mt-5 text-center font-bold text-gray-700">{{$first_report->header}}</h1>
    <div class="mt-5 overflow-x-auto">
      <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
              <tr>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ENROLLMENT STATUS</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DARBC ID</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PURPOSE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ACCOUNT
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT REQUESTED
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE RECEIVED</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS</th>
                </tr>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($cashAdvance as $item)
            <tr>
              @php
              $response = Http::get('https://darbc.org/api/member-information/'.$item->member_id);

                if ($response->successful()) {
                    $member_data = $response->json();
                    $collection = collect($member_data['data']);
                    $darbc_id = $collection['darbc_id'];
                    $member_name = strtoupper($collection['user']['surname']) . ', '
                  .strtoupper($collection['user']['first_name']) . ' '
                  . strtoupper($collection['user']['middle_name']);
                } else {
                    // Handle unsuccessful response
                    $errorMessage = $response->status() . ' ' . $response->reason();
                    // Handle the error appropriately, such as logging or displaying an error message
                }
                //   $url = 'https://darbc.org/api/member-information/'.$item->member_id;
                //   $response = file_get_contents($url);
                //   $member_data = json_decode($response, true);

                //   $collection = collect($member_data['data']);
                //   $darbc_id = $collection['darbc_id'];
                //   $member_name = strtoupper($collection['user']['surname']) . ', '
                //   .strtoupper($collection['user']['first_name']) . ' '
                //   . strtoupper($collection['user']['middle_name']);
                  @endphp
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->enrollment_status) }}
              </td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $darbc_id }}
                </td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $member_name }}
              </td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->last_name).', '.strtoupper($item->first_name).' '.strtoupper($item->middle_name) }}
              </td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->purpose }}
             </td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->account }}
             </td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->amount_requested }}
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ \Carbon\Carbon::parse($item->date_received)->format('F d, Y') }}
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->status }}
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-10 flex justify-around">
        @foreach ($first_signatories as $item)
            <div class="mt-5">
                <h1>{{$item->description}}:</h1>
                @if ($item->name == null || $item->name == '')
                <div class="mt-6 w-36 h-0.5 bg-gray-600">
                </div>
                @else
                <span class="font-bold">{{$item->name}}</span>
                @endif
                <h1 class="text-sm">{{$item->position ?? ''}}</h1>
            </div>
        @endforeach
    </div>
    </div>
  </div>
