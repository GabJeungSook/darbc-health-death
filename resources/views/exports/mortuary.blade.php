<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
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
                </tr>
        </thead>
        <tbody class="">
          @foreach ($mortuary as $item)
            <tr>
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
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  \Carbon\Carbon::parse($item->created_at)->format('F, d Y') }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  $member_name }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->contact_number }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->amount }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->claimants_last_name). ', '.strtoupper($item->claimants_first_name).' '
             .strtoupper($item->claimants_middle_name) }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->claimants_contact_number }}
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->status }}
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->diamond_package }}
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->vehicle == 1 ? 'Yes' : 'No' }}
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
