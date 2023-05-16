<div>
    <ul role="list" class="gap-4 grid grid-cols-2">
        <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow col-span-1">
            <span class="mt-2 text-lg font-bold tracking-tight text-gray-700 sm:text-md">Health</span>
            <div class="mt-2 h-72 w-full">
                <canvas id="myChart1" ></canvas>
                @php
                $currentMonth = Carbon\Carbon::now()->format('Y-m');
                $month = Carbon\Carbon::parse(now())->format('F');
                //HEALTH
                $encoded = App\Models\Health::where('status', '=', 'ENCODED')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $transmitted = App\Models\Health::where('status', '=', 'TRANSMITTED')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $paid = App\Models\Health::where('status', '=', 'PAID')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $unpaid = App\Models\Health::where('status', '=', 'UNPAID')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                @endphp
            </div>
        </li>
        <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow col-span-1">
            <span class="mt-2 text-lg font-bold tracking-tight text-gray-700 sm:text-md">Death</span>
            <div class="mt-2 h-72 w-full">
                <canvas id="myChart2" ></canvas>
                @php
                          //DEATH
                $yes = App\Models\Death::where('has_diamond_package', '=', 'Yes')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $no = App\Models\Death::where('has_diamond_package', '=', 'No')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $islam = App\Models\Death::where('has_diamond_package', '=', 'Islam')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $distant = App\Models\Death::where('has_diamond_package', '=', 'Distant')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                @endphp
            </div>
          </li>
          <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow col-span-1">
            <span class="mt-2 text-lg font-bold tracking-tight text-gray-700 sm:text-md">Letter Of Guarantee (LOG)</span>
            <div class="mt-2 h-72 w-full">
                <canvas id="myChart3" ></canvas>
                @php
                    //LOG
                    $currentYear = Carbon\Carbon::now()->format('Y');
                    $data = array_fill(0, 12, 0);

                    $logCounts = App\Models\Log::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                        ->whereYear('created_at', $currentYear)
                        ->groupBy('month')
                        ->pluck('count', 'month')
                        ->toArray();

                    foreach ($logCounts as $month => $count) {
                        $monthIndex = $month - 1;
                        $data[$monthIndex] = $count;
                    }
                @endphp
            </div>
          </li>
          <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow col-span-1">
            <span class="mt-2 text-lg font-bold tracking-tight text-gray-700 sm:text-md">Cash Advance</span>
            <div class="mt-2 h-72 w-full">
                <canvas id="myChart4" ></canvas>
                @php
                //CASH ADVANCE
                $Hospitalization = App\Models\CashAdvance::where('purpose', '=', 'Hospitalization')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $Burial = App\Models\CashAdvance::where('purpose', '=', 'Burial')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $Maintenance = App\Models\CashAdvance::where('purpose', '=', 'Maintenance')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $School = App\Models\CashAdvance::where('purpose', '=', 'School assistance / Tuition Fee')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                $Others = App\Models\CashAdvance::where('purpose', '=', 'Others')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'")
                    ->count();
                @endphp
            </div>
          </li>
          <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow col-span-1">
            <span class="mt-2 text-lg font-bold tracking-tight text-gray-700 sm:text-md">Mortuary</span>
            <div class="mt-2 h-72 w-full">
                <canvas id="myChart5" ></canvas>
                @php
                //MORTUARY
                $currentYearMortuary = Carbon\Carbon::now()->format('Y');
                $data_mortuary = array_fill(0, 12, 0);

                $mortuaryCounts = App\Models\Mortuary::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                    ->whereYear('created_at', $currentYear)
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray();

                foreach ($mortuaryCounts as $month => $count) {
                    $monthIndex = $month - 1;
                    $data_mortuary[$monthIndex] = $count;
                }
            @endphp
            </div>
          </li>

        <!-- More items... -->
      </ul>
      @section('scripts')
      <script>
        const ctx1 = document.getElementById('myChart1');
        const ctx2 = document.getElementById('myChart2');
        const ctx3 = document.getElementById('myChart3');
        const ctx4 = document.getElementById('myChart4');
        const ctx5 = document.getElementById('myChart5');

        new Chart(ctx1, {
          type: 'bar',
          data: {
            labels: ['ENCODED', 'TRANSMITTED', 'PAID', 'UNPAID'],
            datasets: [{
              label: 'Records this month',
              data: [{{$encoded}}, {{$transmitted}}, {{$paid}}, {{$unpaid}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctx2, {
          type: 'bar',
          data: {
            labels: ['Yes', 'No', 'Islam', 'Distant'],
            datasets: [{
              label: 'Diamond Package (This Month)',
              data: [{{$yes}}, {{$no}}, {{$islam}}, {{$distant}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctx3, {
          type: 'bar',
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: 'LOG Count',
              data: [{{$data[0]}}, {{$data[1]}}, {{$data[2]}}, {{$data[3]}}, {{$data[4]}}, {{$data[5]}},{{$data[6]}}, {{$data[7]}}, {{$data[8]}}, {{$data[9]}}, {{$data[10]}}, {{$data[10]}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctx4, {
          type: 'bar',
          data: {
            labels: ['Hospitalization', 'Burial', 'Maintenance', 'School Assistance', 'Others'],
            datasets: [{
              label: 'Purpose (This Month)',
              data: [{{$Hospitalization}}, {{$Burial}}, {{$Maintenance}}, {{$School}}, {{$Others}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctx5, {
          type: 'bar',
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: 'Mortuary Count',
              data: [{{$data_mortuary[0]}}, {{$data_mortuary[1]}}, {{$data_mortuary[2]}}, {{$data_mortuary[3]}}, {{$data_mortuary[4]}}, {{$data_mortuary[5]}},{{$data_mortuary[6]}}, {{$data_mortuary[7]}}, {{$data_mortuary[8]}}, {{$data_mortuary[9]}}, {{$data_mortuary[10]}}, {{$data_mortuary[10]}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
      @endsection
</div>
