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

  <h1 class="text-xl mt-5 text-center font-bold text-gray-700">DEATH - MEMBERS & DEPENDENTS</h1>
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
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DEPENDENT'S NAME
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">CONTACT NUMBER</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AGE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">ENROLLMENT STATUS
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">STATUS
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF DEATH
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">PLACE OF DEATH</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">REPLACEMENT
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">MEMBER BIRTHDATE
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">AMOUNT</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">TRANSMITTAL
            STATUS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCHES</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">FORTUNE PAID</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DATE OF PAYMENT
          </th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">REMARKS</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">DIFFERENCE</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">BATCHES</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">WITH HOLLOGRAPHIC
            WILL</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">VEHICLE CASH</th>
          <th class="border text-left whitespace-nowrap px-2 text-sm font-medium text-gray-500 py-2">VEHICLE</th>

        </tr>
      </thead>
      <tbody class="">
        @foreach ($deaths as $item)
          <tr>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->batch }}</td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">
              {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600  px-3 whitespace-nowrap py-1">{{ $item->member_id }}
            </td>
            <td class="border text-gray-600  px-3 py-1 whitespace-pre-wrap">{{ $item->members->name ?? '' }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->dependents_name }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->contact_number }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->age }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->enrollment_status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_death)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->place_of_death }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->replacement }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_birth_m)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ number_format($item->amount, 2) }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->transmittal_status }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->batches }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->fortune_paid }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">
              {{ \Carbon\Carbon::parse($item->date_of_payment)->format('F d, Y') }}
            </td>
            <td class="border text-gray-600 uppercase  px-3  py-1">{{ $item->remarks }}
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
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
