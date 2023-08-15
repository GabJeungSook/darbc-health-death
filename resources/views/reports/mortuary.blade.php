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
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONTACT NUMBER</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CLAIMANT
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CLAIMANTS CONTACT NUMBER</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DIAMOND PACKAGE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">VEHICLE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">COVERAGE TYPE</th>
                </tr>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($mortuary as $item)
            <tr>
              @php
                  $url = 'https://darbcrelease.org/api/member-information/'.$item->member_id;
                  $response = file_get_contents($url);
                  $member_data = json_decode($response, true);

                  $collection = collect($member_data['data']);
                  $darbc_id = $collection['darbc_id'];
                  $member_name = strtoupper($collection['user']['surname']) . ' '
                  .strtoupper($collection['user']['first_name']) . ' '
                  . strtoupper($collection['user']['middle_name']);
                  @endphp
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  \Carbon\Carbon::parse($item->created_at)->format('F, d Y') }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  $member_name }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->contact_number }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->amount }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->claimants_last_name). ', '.strtoupper($item->claimants_first_name).' '
             .strtoupper($item->claimants_middle_name) }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->claimants_contact_number }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->status }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->diamond_package }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->vehicle == 1 ? 'Yes' : 'No' }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">
                @switch($item->coverage_type)
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
             </td>
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
