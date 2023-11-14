<div x-data x-animate>
    <div class="mt-4 flex">
        <div class=""></div>
        <div>
            <x-button label="PRINT" sm dark icon="printer" class="font-bold"
            @click="printOut($refs.printContainer.outerHTML);"  />
            <x-button label="Export to Word(.docx)" sm primary icon="document-download" class="font-bold" wire:click="downloadToWord"/>
        </div>
    </div>
    <div class="p-3 mt-3" x-ref="printContainer" id="contentToExport">
        {{-- <div class="mt-4 flex justify-center text-center space-x-1">
            <div class="grid ">
              <img src="{{ asset('images/darbc.png') }}" class="h-10 mt-1" alt="" media="print">
            </div>
            <div>
              <h1 class="text-xl font-bold text-gray-700"> DOLEFIL AGRARIAN REFORM BENEFICIARIES COOP.</h1>
              <h1>DARBC Complex, Brgy. Cannery Site, Polomolok, South Cotabato</h1>
              <div class="mx-auto">
                <h1>CDA REG. #: 9520-12006162</h1>
                <h1>FAX NO. (083) 500-2411</h1>
              </div>
            </div>
          </div>
          <div class="mt-2 h-0.5 bg-gray-700"></div>
          <div class="mt-0.5 h-0.5 bg-gray-700"></div> --}}
          <div class="mt-28">
            <h3 class="text-md font-normal ml-4">{{\Carbon\Carbon::parse(now())->format('F d, Y')}}</h3>
          </div>
          <div class="mt-4">
            <h3 class="text-lg font-bold ml-4">THE ADMINISTRATOR</h3>
          </div>
          <div class="mt-1">
            <h3 class="text-md font-normal ml-4">{{$record->hospitals->name}}</h3>
          </div>
          <div class="mt-1">
            <h3 class="text-md font-normal ml-4">{{$record->hospitals->address}}</h3>
          </div>
          <div class="mt-10">
            <h3 class="text-md font-normal ml-4">Sir/Madam:</h3>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">Please charge to <span class="font-bold">Dolefil Agrarian Reform Beneficiaries Cooperative (DARBC)</span>

            @if ($record->enrollment_status == "member")
            the medical bills of our member
            <span class="font-bold">{{strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name)}}</span>
            @else
            the medical bills of our beneficiary
            <span class="font-bold">{{strtoupper($record->dependents_last_name) . ' ' . strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name)}}</span>
            @endif
            @php
                function convertNumberToWords($number) {
    $words = "";

    $numArr = explode(".", $number);

    // Convert whole number
    $wholeNum = $numArr[0];
    if ($wholeNum != "") {
        $words = convertWholeNumberToWords($wholeNum) . " PESOS";
    }

    // Convert decimal
    if (count($numArr) == 2) {
        $decimal = $numArr[1];
        if ($decimal != "") {
            // Append zero to the decimal if it has only one digit
            $decimal = str_pad($decimal, 2, "0", STR_PAD_RIGHT);
            $words .= " AND " . convertDecimalToWords($decimal) . " CENTAVOS";
        }
    }

    return $words;
}

                function convertWholeNumberToWords($num) {
                    $ones = array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");
                    $tens = array("", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

                    if ($num < 20) {
                        return $ones[$num];
                    } elseif ($num < 100) {
                        return $tens[floor($num/10)] . " " . $ones[$num%10];
                    } elseif ($num < 1000) {
                        return $ones[floor($num/100)] . " HUNDRED " . convertWholeNumberToWords($num%100);
                    } elseif ($num < 1000000) {
                        return convertWholeNumberToWords(floor($num/1000)) . " THOUSAND " . convertWholeNumberToWords($num%1000);
                    } elseif ($num < 1000000000) {
                        return convertWholeNumberToWords(floor($num/1000000)) . " MILLION " . convertWholeNumberToWords($num%1000000);
                    } else {
                        return convertWholeNumberToWords(floor($num/1000000000)) . " BILLION " . convertWholeNumberToWords($num%1000000000);
                    }
                }

                function convertDecimalToWords($num) {
    $ones = array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE");
    $tens = array("", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

    if ($num < 20) {
        return $ones[$num];
    } elseif ($num < 100) {
        return $tens[floor($num/10)] . " " . $ones[$num%10];
    } else {
        return $ones[floor($num/100)] . " HUNDRED " . convertDecimalToWords($num%100);
    }
}
             $amountInWords = strtoupper(convertNumberToWords($record->amount));
            @endphp
          up to <span class="font-bold"> {{$amountInWords}} (Php {{ number_format($record->amount, 2, '.', ',') }})</span> only.</p>
          </div>
          <div class="mt-8">
            <p class="text-md font-normal ml-4">Kindly submit your billing to our cashier for payment processing.</p>
          </div>
          <div class="mt-8">
            <p class="text-md font-normal ml-4">Thank you and more power.</p>
          </div>
          <div class="mt-8">
            <p class="text-md font-normal ml-4">Very truly yours,</p>
          </div>
          <div class="mt-16">
            <p class="text-md font-normal ml-4">{{$signatory->name}}</p>
          </div>
          <div class="mt-1">
            <p class="text-lg font-bold ml-4">{{$signatory->position}}</p>
          </div>
          <div class="mt-16">
            <p class="text-lg font-bold ml-4">Chargeable To: <span class="font-normal">{{$record->last_name . ', ' . $record->first_name . ' ' . $record->middle_name}}</span></p>
          </div>


    </div>

</div>
