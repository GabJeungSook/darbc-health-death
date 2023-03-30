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

  <h1 class="text-xl mt-5 text-center font-bold text-gray-700">HEALTH - MEMBERS & DEPENDENTS</h1>
  <div class="mt-5 overflow-x-auto">
    <table id="example" class="table-auto mt-5" style="width:100%">
      <thead class="font-normal">
        <tr>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCH
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ID
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER NAME</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PATIENT NAME</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONTACT NUMBER
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AGE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ENROLLMENT STATUS
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DHIB</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONFINEMENT FROM
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONFINEMENT TO
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">HOSPITAL</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">NO. OF DAYS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TRANSMITTAL
            STATUS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCHES</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TRANSMITTED DATE
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">FORTUNE DATE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF PAYMENT
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">REMARKS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DIFFERENCE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCHES</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">WITH HOLLOGRAPHIC
            WILL</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">VEHICLE CASH</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">VEHICLE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CANNERY</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">POLOMOLOK</th>

        </tr>
      </thead>
      <tbody class="">
        @foreach ($healths as $item)
          <tr>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->batch }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">
              {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->member_id }}
            </td>
            <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->members->name }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->patients_name }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->contact_number }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->age }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->enrollement_status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->dhib }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_confinement_from)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_confinement_to)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->hospital_name }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->number_of_days }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->amount }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->transmittal_status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->batches }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->transmital_date }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->fortune_paid }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_payment)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->difference }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->_batches }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->with_hollographic_will }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->vehicle_cash }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->vehicle }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->cannery }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->polomolok }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
