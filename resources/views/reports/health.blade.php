<div>
    <style>
        @media print {
          @page {
            size: auto;
          }
        }
    </style>
  <div class="flex space-x-1">
    <div class="grid place-content-center">
      <img src="{{ asset('images/darbc.png') }}" class="h-10" alt="">
    </div>
    <div>
      <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP. (DARBC)</h1>
      <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
    </div>
  </div>
  <h1 class="text-xl mt-5 text-center font-bold text-gray-700">{{strtoupper($first_report->header)}}</h1>
  <div class="mt-5 overflow-x-auto">
    <table id="example" class="table-auto mt-5" style="width:100%">
      <thead class="font-normal">
        <tr>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCH NUMBER</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ENROLLMENT STATUS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DARBC ID</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AGE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT FROM
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT TO
          </th>

          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NO. OF DAYS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS</th>
        </tr>
      </thead>
      <tbody class="">
        @foreach ($healths as $item)
          <tr>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">
              {{ $item->batch_number }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->enrollment_status) }}</td>
            {{-- @php
                $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                $response = Http::withOptions(['verify' => false])->get($url);
                $member_data = $response->json();

                if($member_data == null)
                {
                    $darbc_id = '';
                    $member_name = '';
                }else{
                $collection = collect($member_data['data']);
                $darbc_id = $collection['darbc_id'];
                $member_name = strtoupper($collection['user']['surname']) . ', '
                .strtoupper($collection['user']['first_name']) . ' '
                .strtoupper($collection['user']['middle_name']);
                }


            @endphp --}}
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->darbc_id }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->member_name }}
            </td>
            @if ($item->enrollment_status == "member")
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">---</td>
            @else
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->last_name . ' ' . $item->first_name . ' ' . $item->middle_name ?? '' }}</td>
            @endif
            <td class="border text-gray-600 uppercase  px-3  py-1">
                {{ $item->age }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y') }}
            </td>

            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->number_of_days }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->amount }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->status }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-20 flex justify-around">
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
