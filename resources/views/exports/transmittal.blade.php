<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT FROM
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT TO
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HOSPITAL
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NUMBER OF DAYS
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS
            </th>

          </tr>
        </thead>
        <tbody class="">
          @foreach ($transmittals as $item)
            <tr>
                @php
                    $url = 'https://darbcrelease.org/api/member-information/'.$item->member_id;
                    $response = file_get_contents($url);
                    $member_data = json_decode($response, true);

                    $collection = collect($member_data['data']);
                @endphp
              <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($collection['user']['first_name']).' '.
              strtoupper($collection['user']['middle_name']).' '.strtoupper($collection['user']['surname']) }}</td>
              @if ($item->enrollment_status == 'member')
              <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($collection['user']['first_name']).' '.
                strtoupper($collection['user']['middle_name']).' '.strtoupper($collection['user']['surname']) }}</td>
              @else
              <td class="border text-gray-600 whitespace-nowrap  px-3  py-1">{{ strtoupper($item->first_name).' '.
                strtoupper($item->middle_name).'. '.strtoupper($item->last_name) }}</td>
              @endif

              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->hospitals->name }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->number_of_days }}</td>
              <td class="border text-gray-600  px-3  py-1">{{ $item->status }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
