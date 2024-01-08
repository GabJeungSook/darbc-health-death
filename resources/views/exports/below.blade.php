<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NO.
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT FROM
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT TO
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NUMBER OF DAYS
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT
            </th>

          </tr>
        </thead>
        <tbody class="">
            @php
                $count = 1;
            @endphp
          @foreach ($below as $item)
            <tr>
                @php
                    $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);
                @endphp
              <td class="border text-gray-600  px-3  py-1">{{$count++}}</td>
              <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($collection['user']['surname']).', '.
              strtoupper($collection['user']['first_name']).' '.strtoupper($collection['user']['middle_name']) }}</td>
              @if ($item->enrollment_status == 'member')
              {{-- <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($collection['user']['first_name']).' '.
                strtoupper($collection['user']['middle_name']).' '.strtoupper($collection['user']['surname']) }}</td> --}}
                <td class="border text-gray-600  px-3 whitespace-nowrap py-1">---</td>
              @else
              <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($item->first_name).' '.
                strtoupper($item->middle_name).' '.strtoupper($item->last_name) }}</td>
              @endif

              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->number_of_days }}</td>
              <td class="border text-gray-600  px-3  py-1">₱{{number_format($item->amount, 2, '.', ',') }}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="6" class="border text-md font-medium text-gray-600  px-3  py-2">TOTAL: </td>
            <td class="border text-md font-medium text-gray-600  px-3  py-2">₱{{number_format($total, 2, '.', ',')}} </td>
          </tr>
        </tbody>
      </table>
</div>
