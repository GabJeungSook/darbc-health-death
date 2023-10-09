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

    <h1 class="text-xl mt-5 text-center font-bold text-gray-700">LETTER OF GUARANTEE (LOG)</h1>
    <div class="mt-5 overflow-x-auto">
      <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DARBC ID</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBERS NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HOSPITAL</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE RECEIVED</th>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($logs as $item)
            <tr>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
              @php
                  $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                  $response = Http::withOptions(['verify' => false])->get($url);
                  $member_data = $response->json();


                  $collection = collect($member_data['data']);
                  $darbc_id = $collection['darbc_id'];
                  $member_name = strtoupper($collection['user']['surname']) . ', '
                  .strtoupper($collection['user']['first_name']) . ' '
                  . strtoupper($collection['user']['middle_name']);
                  @endphp
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  $darbc_id }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $member_name }}</td>
              @if ($item->enrollment_status == "member")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $member_name }}
            </td>
            @elseif($item->enrollment_status == "dependent" || $item->enrollment_status == "replacement")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->dependents_first_name).' '.
            strtoupper($item->dependents_middle_name).' '.strtoupper($item->dependents_last_name)}}</td>
            @endif
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->hospitals->name }}</td>
              <td class="border text-gray-600 uppercase  px-3  py-1">{{ number_format($item->amount, 2) }}</td>
              <td class="border text-gray-600 uppercase  px-3  py-1">
                {{ \Carbon\Carbon::parse($item->date_received)->format('F d, Y') }}
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-10 flex justify-around">
          {{-- @foreach ($first_signatories as $item)
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
          @endforeach --}}
      </div>
    </div>
  </div>
