<div x-data x-animate>
    <div class="mt-4 flex">
        <div class=""></div>
        <div>
            <x-button label="PRINT" sm dark icon="printer" class="font-bold"
            @click="printOut($refs.printContainer.outerHTML);"  />
        </div>
    </div>
    <div class="p-3 mt-3 border-2" x-ref="printContainer">
        <div class="mt-4 flex space-x-1">
            <div class="grid place-content-center">
              <img src="{{ asset('images/darbc.png') }}" class="h-10" alt="" media="print">
            </div>
            <div>
              <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP.</h1>
              <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
            </div>
          </div>

          {{-- <h1 class="text-xl mt-5 text-center font-bold text-gray-700">MASTERLIST</h1> --}}
          <div class="mt-16">
            <h3 class="text-md font-normal ml-4">{{\Carbon\Carbon::parse(now())->format('F d, Y')}}</h3>
          </div>
          <div class="mt-16">
            <h3 class="text-lg font-bold ml-4">THE ADMINISTRATOR</h3>
          </div>
          <div class="mt-1">
            <h3 class="text-md font-normal ml-4">{{$record->hospitals->name}}</h3>
          </div>
          <div class="mt-1">
            <h3 class="text-md font-normal ml-4">{{$record->hospitals->address}}</h3>
          </div>
          <div class="mt-16">
            <h3 class="text-md font-normal ml-4">{{\Carbon\Carbon::parse(now())->format('F d, Y')}}</h3>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">Please charge to <span class="font-bold">Dolefil Agrarian Reform Beneficiaries Cooperative (DARBC)</span>
            the medical bills of our member-beneficiary <span class="font-bold">{{$record->first_name . ' ' . $record->middle_name . '.' . $record->last_name}}</span>
            @php
            function numberToWords($number) {
                $words = '';
                $units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
                $teens = ['eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
                $tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
                $hundreds = ['', 'one hundred', 'two hundred', 'three hundred', 'four hundred', 'five hundred', 'six hundred', 'seven hundred', 'eight hundred', 'nine hundred'];
                $thousands = ['', 'one thousand', 'two thousand', 'three thousand', 'four thousand', 'five thousand', 'six thousand', 'seven thousand', 'eight thousand', 'nine thousand'];

                if ($number == 0) {
                    return 'zero';
                }

                if ($number < 0) {
                    $words .= 'negative ';
                    $number = abs($number);
                }

                if ($number >= 1000 && $number <= 9999) {
                    $words .= $thousands[floor($number / 1000)] . ' ';
                    $number %= 1000;
                }

                if ($number >= 100 && $number <= 999) {
                    $words .= $hundreds[floor($number / 100)] . ' ';
                    $number %= 100;
                }

                if ($number >= 20 && $number <= 99) {
                    $words .= $tens[floor($number / 10)] . ' ';
                    $number %= 10;
                }

                if ($number >= 11 && $number <= 19) {
                    $words .= $teens[$number - 11] . ' ';
                    $number = 0;
                }

                if ($number >= 1 && $number <= 9) {
                    $words .= $units[$number] . ' ';
                    $number = 0;
                }

                return ucwords(trim($words)) . ' PESOS';
            }
            $amountInWords = strtoupper(numberToWords($record->amount));
            @endphp
          to <span class="font-bold"> {{$amountInWords}} (Php {{ number_format($record->amount, 2, '.', ',') }})</span> only.</p>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">Kindly submit your billing to our cashier for payment processing.</p>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">Thank you and more power</p>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">Very truly yours</p>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">VINCENT E. PALMA</p>
          </div>
          <div class="mt-1">
            <p class="text-lg font-bold ml-4">DARBC Chairman</p>
          </div>
          <div class="mt-16">
            <p class="text-lg font-bold ml-4">CHARGABLE TO: <span class="font-normal">{{$record->first_name . ' ' . $record->middle_name . '.' . $record->last_name}}</span></p>
          </div>


    </div>

</div>
