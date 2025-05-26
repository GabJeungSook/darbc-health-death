
<div class="p-3 mt-3" x-ref="printContainer" id="contentToExport">
      <div class="mt-28">
        <h3 class="text-md font-normal ml-4">{{\Carbon\Carbon::parse(now())->format('F d, Y')}}</h3>
        <p></p>
      </div>
      <div class="mt-4">
        <h3 class="text-lg font-bold ml-4" style="font-weight: bold; margin-top: 5px;">THE ADMINISTRATOR</h3>
      </div>
      <div class="mt-1">
        <h3 class="text-md font-normal ml-4">{{$record->hospitals->name}}</h3>
      </div>
      <div class="mt-1">
        <h3 class="text-md font-normal ml-4">{{$record->hospitals->address}}</h3>
      </div>
      <p></p>
      <p></p>
      <div class="mt-10">
        <h3 class="text-md font-normal ml-4">Sir/Madam:</h3>
      </div>
      <p></p>
      <div class="mt-16">
        <p class="text-md font-normal ml-4" style="margin-top: 20px;">Please charge to <span class="font-bold">Dolefil Agrarian Reform Beneficiaries Cooperative (DARBC)</span>

        @if ($record->enrollment_status == "member")
        the medical bills of our member
        <span class="font-bold">{{strtoupper($record->last_name) . ', ' . strtoupper($record->first_name) . ' ' . strtoupper($record->middle_name)}}</span>
        @else
        the medical bills of our beneficiary
        <span class="font-bold">{{strtoupper($record->dependents_last_name) . ' ' . strtoupper($record->dependents_first_name) . ' ' . strtoupper($record->dependents_middle_name)}}</span>
        @endif
        @php
            function convertNumberToWords1($number) {
$words = "";

$numArr = explode(".", $number);

// Convert whole number
$wholeNum = $numArr[0];
if ($wholeNum != "") {
    $words = convertWholeNumberToWords1($wholeNum) . " PESOS";
}

// Convert decimal
if (count($numArr) == 2) {
    $decimal = $numArr[1];
    if ($decimal != "") {
        // Append zero to the decimal if it has only one digit
        $decimal = str_pad($decimal, 2, "0", STR_PAD_RIGHT);
        $words .= " AND " . convertDecimalToWords1($decimal) . " CENTAVOS";
    }
}

return $words;
}

            function convertWholeNumberToWords1($num) {
                $ones = array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");
                $tens = array("", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

                if ($num < 20) {
                    return $ones[$num] ?? '';
                } elseif ($num < 100) {
                    return $tens[floor($num/10)] . " " . $ones[$num%10];
                } elseif ($num < 1000) {
                    return $ones[floor($num/100)] . " HUNDRED " . convertWholeNumberToWords1($num%100);
                } elseif ($num < 1000000) {
                    return convertWholeNumberToWords1(floor($num/1000)) . " THOUSAND " . convertWholeNumberToWords1($num%1000);
                } elseif ($num < 1000000000) {
                    return convertWholeNumberToWords1(floor($num/1000000)) . " MILLION " . convertWholeNumberToWords1($num%1000000);
                } else {
                    return convertWholeNumberToWords1(floor($num/1000000000)) . " BILLION " . convertWholeNumberToWords1($num%1000000000);
                }
            }

            function convertDecimalToWords1($num) {
$ones = array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE");
$tens = array("", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

if ($num < 20) {
    return $ones[$num] ?? 'test';
} elseif ($num < 100) {
    return $tens[floor($num/10)] . " " . $ones[$num%10];
} else {
    return $ones[floor($num/100)] . " HUNDRED " . convertDecimalToWords1($num%100);
}
}
         $amountInWords = strtoupper(convertNumberToWords1($record->amount));
        @endphp
      up to <span class="font-bold"> {{$amountInWords}} (Php {{ number_format($record->amount, 2, '.', ',') }})</span> only.</p>
      </div>
      <p></p>
      <div class="mt-8">
        <p class="text-md font-normal ml-4">Kindly submit your billing to our cashier for payment processing.</p>
      </div>
      <p></p>
      <div class="mt-8">
        <p class="text-md font-normal ml-4">Thank you and more power.</p>
      </div>
      <p></p>
      <div class="mt-8">
        <p class="text-md font-normal ml-4">Very truly yours,</p>
      </div>
      <p></p>
      <div class="mt-16">
        <p class="text-md font-normal ml-4">{{$signatory->name}}</p>
      </div>
      <div class="mt-1">
        <p class="text-lg font-bold ml-4">{{$signatory->position}}</p>
      </div>
      <p></p>
      <p></p>
      <div class="mt-16">
        <p class="text-lg font-bold ml-4">Chargeable To: <span class="font-normal">{{$record->last_name . ', ' . $record->first_name . ' ' . $record->middle_name}}</span></p>
      </div>


</div>
