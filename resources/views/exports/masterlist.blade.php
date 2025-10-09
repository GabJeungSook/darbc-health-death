<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
              <tr>
                 <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ENROLLMENT STATUS</th>
                 <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DARBC ID</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PURPOSE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ACCOUNT
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT REQUESTED
                  </th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT APPROVED</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE RECEIVED</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS</th>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($cashAdvance as $item)
            <tr>
              {{-- @php
                  $url = 'https://darbcmembership.org/api/member-information/'.$item->member_id;
                  $response = Http::withOptions(['verify' => false])->get($url);
                  $member_data = $response->json();

                  $collection = collect($member_data['data']);
                  $darbc_id = $collection['darbc_id'];
                  $member_name = strtoupper($collection['user']['surname']) . ' '
                  .strtoupper($collection['user']['first_name']) . ' '
                  . strtoupper($collection['user']['middle_name']);
                  @endphp --}}
               <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->enrollment_status }}</td>
               <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->darbc_id }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  $item->member_name }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->last_name).', '.strtoupper($item->first_name).' '.strtoupper($item->middle_name) }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->purpose }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->account }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  number_format($item->amount_requested ?? 0, 2, '.', ',') }}</td>
             <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{  number_format($item->amount_approved ?? 0, 2, '.', ',') }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ \Carbon\Carbon::parse($item->date_received)->format('F d, Y') }}</td>
             <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->status }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
