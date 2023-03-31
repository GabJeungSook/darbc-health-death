<div>
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
                {{ $total == 0 ? '-' : $total }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                @php

                  $jan =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 1)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $jan == 0 ? '-' : $jan }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $feb =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 2)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $feb == 0 ? '-' : $feb }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                @php
                  $march =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 3)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $march == 0 ? '-' : $march }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                @php
                  $april =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 4)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $april == 0 ? '-' : $april }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $may =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 5)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $may == 0 ? '-' : $may }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $june =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 6)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $june == 0 ? '-' : $june }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $july =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 7)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $july == 0 ? '-' : $july }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $aug =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 8)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $aug == 0 ? '-' : $aug }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $sep =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 9)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $sep == 0 ? '-' : $sep }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $oct =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 10)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $oct == 0 ? '-' : $oct }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $nov =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 11)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $nov == 0 ? '-' : $nov }}
              </td>
              <td class="border text-gray-600  px-3  py-1">
                  @php

                  $dec =
                      App\Models\HealthDeath::where('member_id', $item->member_id)
                          ->whereMonth('date_of_confinement_to', '=', 12)
                          ->get()
                          ->sum('number_of_days') ?? '-';
                @endphp
                {{ $dec == 0 ? '-' : $dec }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
