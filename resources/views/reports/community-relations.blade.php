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
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">REF. NO.</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">FULL NAME</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONTACT NUMBER</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ORGANIZATION / ADDRESS</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PURPOSE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TYPE</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NUMBER OF PARTICIPANTS</th>
                  <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS</th>
                </tr>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($communityRelations as $item)
            <tr>
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->reference_number }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ strtoupper($item->first_name).' '.strtoupper($item->middle_name).' '.strtoupper($item->last_name) }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->contact_number }}</td>
              <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->organization }}</td>
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->purpose }}</td>
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->type }}</td>
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->number_of_participants }}</td>
              <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->status }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
