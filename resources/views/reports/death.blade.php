<div>
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
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBERS NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AGE</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENTS NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HAS DIAMOND PACKAGE</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HAS VEHICLE</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF DEATH</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PLACE OF DEATH</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBERS BIRTHDAY</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">COVERAGE TYPE</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
        </tr>
      </thead>
      <tbody class="">
        @foreach ($deaths as $item)
          <tr>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">
              {{ $item->batch_number }}
            </td>
            @if ($item->enrollment_status == "member")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">M</td>
            @elseif($item->enrollment_status == "dependent")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">D</td>
            @elseif($item->enrollment_status == "replacement")
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">R</td>
            @endif

            {{-- @php
                $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                $response = Http::withOptions(['verify' => false])->get($url);
                $member_data = $response->json();


                $collection = collect($member_data['data']);
                $darbc_id = $collection['darbc_id'];
                $member_name = strtoupper($collection['user']['surname']) . ', '
                .strtoupper($collection['user']['first_name']) . ' '
                . strtoupper($collection['user']['middle_name']);
                @endphp --}}
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->darbc_id }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->member_name }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->age }}</td>
            @if ($item->enrollment_status == "member")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">---
            </td>
            @elseif($item->enrollment_status == "dependent" || $item->enrollment_status == "replacement")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->dependents_first_name).' '.
            strtoupper($item->dependents_middle_name).' '.strtoupper($item->dependents_last_name)}}</td>
            @endif
            <td class="border text-gray-600 uppercase px-3 py-1">{{$item->has_diamond_package == 'Yes' ? 'Yes' : 'No'}}</td>
            <td class="border text-gray-600 uppercase px-3 py-1">{{$item->has_vehicle}}</td>
            <td class="border text-gray-600 uppercase px-3 py-1">
                {{ $item->date_of_death != null ? \Carbon\Carbon::parse($item->date_of_death)->format('F d, Y') : '' }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ $item->place_of_death }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
                {{ $item->birthday != null ? \Carbon\Carbon::parse($item->birthday)->format('F d, Y') : '' }}
              </td>
            @switch($item->coverage_type)
                @case(1)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Accidental Death/ Disablement
                    </td>
                    @break
                @case(2)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Accident Burial Benefit
                    </td>
                    @break
                @case(3)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Unprovoked Murder & Assault
                    </td>
                    @break
                @case(4)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Burial Benefit due to Natural Death
                    </td>
                    @break
                @case(5)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Motorcycling Coverage
                    </td>
                    @break
                @case(6)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Daily Hospital Income Benefit, due to accident and/or illness
                    </td>
                    @break
                @case(7)
                    <td class="border text-gray-600 uppercase  px-3  py-1">Premium inclusive of taxes
                    </td>
                    @break
                @default

            @endswitch
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->amount }}
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
