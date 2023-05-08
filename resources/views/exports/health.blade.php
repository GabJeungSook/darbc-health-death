<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
          <tr>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCH NUMBER
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME</th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT FROM
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF CONFINEMENT TO
            </th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HOSPITAL</th>
            <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NO. OF DAYS</th>
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
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $member_name }}
              </td>
              @if ($item->enrollment_status == "member")
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $member_name ?? '' }}
              @else
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->last_name . ' ' . $item->first_name . ' ' . $item->middle_name . '.' ?? '' }}
              @endif
              <td class="border text-gray-600 uppercase  px-3  py-1">
                {{ \Carbon\Carbon::parse($item->confinement_date_from)->format('F d, Y') }}
              </td>
              <td class="border text-gray-600 uppercase  px-3  py-1">
                {{ \Carbon\Carbon::parse($item->confinement_date_to)->format('F d, Y') }}
              </td>
              <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->hospitals->name }}
              </td>
              <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->number_of_days }}
              </td>
              <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->status }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
