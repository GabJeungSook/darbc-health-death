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

  <h1 class="text-xl mt-5 text-center font-bold text-gray-700">DEATH - MEMBERS & DEPENDENTS</h1>
  <div class="mt-5 overflow-x-auto">
    <table id="example" class="table-auto mt-5" style="width:100%">
      <thead class="font-normal">
        <tr>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCH NUMBER
                </th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER FIRST NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER MIDDLE NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER LAST NAME</th>

                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT FIRST NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT MIDDLE NAME</th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT LAST NAME</th>

                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HAS DIAMOND PACKAGE
                </th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF DEATH
                </th>
                <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PLACE OF DEATH</th>
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
            @php
                $url = 'https://darbc.org/api/member-information/'.$item->member_id;
                $response = file_get_contents($url);
                $member_data = json_decode($response, true);

                $collection = collect($member_data['data']);
                $darbc_id = $collection['darbc_id'];
                $member_name = strtoupper($collection['user']['surname']) . ' '
                .strtoupper($collection['user']['first_name']) . ' '
                . strtoupper($collection['user']['middle_name']).'.';
                @endphp
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['first_name'] }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['middle_name'] }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['surname'] }}
            </td>
            @if ($item->enrollment_status == "member")
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['first_name'] }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['middle_name'] }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $collection['user']['surname'] }}
            </td>
            @else
            <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->dependets_first_name ?? '' }}
            <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->dependets_middle_name ?? '' }}
            <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->dependets_last_name ?? '' }}
            @endif
            @if ($item->has_diamond_package == '1')
            <td class="border text-gray-600 uppercase  px-3  py-1">
                YES
            </td>
            @else
            <td class="border text-gray-600 uppercase  px-3  py-1">
                NO
            </td>
            @endif
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_death)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ $item->place_of_death }}
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
  </div>
</div>
