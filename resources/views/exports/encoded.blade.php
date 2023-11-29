<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AGE
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT FROM
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT TO
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HOSPITAL
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NUMBER OF DAYS
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS
            </th>

          </tr>
        </thead>
        <tbody class="">
          @foreach ($encoded as $item)
            <tr>
                @php
                    $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                    $response = Http::withOptions(['verify' => false])->get($url);
                    $member_data = $response->json();

                    $collection = collect($member_data['data']);
                @endphp
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
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
              <td class="border text-gray-600  px-3  py-1">{{ $item->age }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->hospitals->name }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->number_of_days }}</td>
              <td class="border text-gray-600  px-3  py-1">₱{{number_format($item->amount - ($item->amount * 0.01), 2, '.', ',') }}</td>
              <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->amount }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->status }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
