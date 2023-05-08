@section('title', 'Dashboard')
<x-main-layout>
  <div class="relative bg-white">
    <img class="h-56 w-full object-cover lg:absolute  lg:inset-y-0 lg:left-0 lg:h-full lg:w-1/2"
      src="{{ asset('images/darbcmap3.jpg') }}" alt="">
    <div class="mx-auto grid max-w-7xl lg:grid-cols-2">
      <div class="px-6 pt-16 pb-24 sm:pt-20 sm:pb-32 lg:col-start-2 lg:px-8 lg:pt-32">
        <div class="mx-auto max-w-2xl lg:mr-0 lg:max-w-lg">
          <h2 class="text-2xl uppercase font-montserrat font-bold leading-8 text-indigo-600">DARBC</h2>
          <p class="mt-2 text-3xl font-bold tracking-tight text-gray-700 sm:text-4xl">Health & Death Management</p>

          <dl class="mt-16 grid max-w-xl grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 xl:mt-16">
            <div class="flex flex-col gap-y-3 border-l border-white pl-6">
              {{-- <dt class="text-sm leading-6 text-gray-600">Creators on the platform</dt>
              <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">8,000+</dd> --}}
            </div>

            <div class="flex flex-col gap-y-3 border-l border-white pl-6">
              {{-- <dt class="text-sm leading-6 text-gray-600">Flat platform fee</dt>
              <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">3%</dd> --}}
            </div>

            <div class="flex flex-col gap-y-3 border-l border-white pl-6">
              {{-- <dt class="text-sm leading-6 text-gray-600">Uptime guarantee</dt>
              <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">99.9%</dd> --}}
            </div>

            <div class="flex flex-col gap-y-3 pl-6">
               {{--  <div class="flex flex-col gap-y-3 border-l border-gray-900/10 pl-6">
               <dt class="text-sm leading-6 text-gray-600">Paid out to creators</dt>
              <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">$70M</dd> --}}
            </div>
          </dl>
        </div>
      </div>
    </div>
  </div>

</x-main-layout>
