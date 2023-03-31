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

  <h1 class="text-xl mt-5 text-left font-bold text-gray-700">{{ \Carbon\Carbon::parse($date_from)->format('F d, Y') }}
  </h1>
  <div class="mt-5  w-1/2">
    <table id="example" class="table-auto mt-5" style="width:100%">
      <thead class="font-normal">
        <tr>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
        </tr>
      </thead>
      <tbody class="">
        @foreach ($accountings as $item)
          <tr>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->members->name ?? 0 }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">
              @php
                $number = str_replace(',', '', $item->amount);
                $number = floatval($number);
                $number = intval($number);
              @endphp
              &#8369;{{ number_format($number, 2) }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-5">
      <h1>Prepaid by:</h1>
      <span class="font-bold">FUNNY C. BALENDES</span>
    </div>
    <div class="mt-5">
      <h1>Checked by:</h1>
      <span class="font-bold">JOHN EFFIE T. BELARMA</span>
    </div>
    <div class="mt-5">
      <h1>Received by:</h1>
      <span class="font-bold">DONITA ROSE GANANCIAL</span>
    </div>
  </div>
</div>
