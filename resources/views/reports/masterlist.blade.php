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

  <h1 class="text-xl mt-5 text-center font-bold text-gray-700">MASTERLIST</h1>
  <div class="mt-5 overflow-x-auto">
    <table id="example" class="table-auto mt-5" style="width:100%">
      <thead class="font-normal">
        <tr>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">I.D
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NAME OF MEMBER
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TOTAL
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">JANUARY
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">FEBRUARY
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MARCH
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">APRIL
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MAY
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">JUNE
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">JULY
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AUGUST
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">SEPTEMBER
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">OCTOBER
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NOVEMBER
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DECEMBER
          </th>

        </tr>
      </thead>
      <tbody class="">
        @foreach ($members as $item)
          <tr>
            <td class="border text-gray-600  px-3  py-1">{{ $item->member_id }}</td>
            <td class="border text-gray-600  px-3  py-1">{{ $item->name }}</td>
            <td class="border text-gray-600  px-3  py-1">
              @php
                $total = App\Models\HealthDeath::where('member_id', $item->member_id)->sum('number_of_days');
              @endphp
              {{ $total }}
            </td>
            <td class="border text-gray-600  px-3  py-1">
              @php
                
                $jan = $total =
                    App\Models\HealthDeath::where('member_id', $item->member_id)
                        ->whereRaw('DATE_FORMAT(date_of_confinement_from, "%m") = ?', [1])
                        ->first()->number_of_days ?? 0;
              @endphp
              {{ $jan }}
            </td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">
              @php
                $march = $total =
                    App\Models\HealthDeath::where('member_id', $item->member_id)
                        ->whereRaw('DATE_FORMAT(created_at, "%m") = ?', [3])
                        ->first()->number_of_days ?? 0;
              @endphp
              {{ $march }}
            </td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
            <td class="border text-gray-600  px-3  py-1">SDSD</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
