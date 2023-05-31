@section('title', 'Manage Settings')
<x-main-layout>
    <div x-cloak x-data="{ activeTab: 'hospitals' }">
        <div>
            <div class="hidden sm:block">
              <div class="border-b border-gray-200">
                <nav class="-mb-px flex" aria-label="Tabs">
                  <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                  <a href="#" class="border-indigo-500 text-indigo-600 hover:text-gray-700 hover:border-gray-300 w-1/4 py-4 px-1 text-center border-b-2 font-bold text-sm"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'hospitals', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'hospitals' }"
                    @click.prevent="activeTab = 'hospitals'" aria-current="page">Hospitals</a>

                  <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/4 py-4 px-1 text-center border-b-2 font-bold text-sm"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'headers', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'headers' }"
                    @click.prevent="activeTab = 'headers'">Report Headers</a>

                  <a href="#" class="border-transparent text-gray-500 w-1/4 py-4 px-1 text-center border-b-2 font-bold text-sm"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'signatories', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'signatories' }"
                    @click.prevent="activeTab = 'signatories'">Signatories</a>

                  {{-- <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/4 py-4 px-1 text-center border-b-2 font-bold text-sm"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'logo', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'logo' }"
                    @click.prevent="activeTab = 'logo'">Logo</a> --}}
                  <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/4 py-4 px-1 text-center border-b-2 font-bold text-sm"
                    :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'supervisor', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'supervisor' }"
                    @click.prevent="activeTab = 'supervisor'">Supervisor Code</a>
                </nav>
              </div>
            </div>
          </div>

          <div x-show="activeTab === 'hospitals'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                          <livewire:hospital />
                    </span>
                </div>
            </div>
          </div>

          <div x-show="activeTab === 'headers'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                          <livewire:report-headers />
                    </span>
                </div>
            </div>
          </div>

          <div x-show="activeTab === 'signatories'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                        <div class="">
                            <livewire:report-signatory />
                        </div>
                        <div class="mt-10">
                            <livewire:signatories />
                        </div>
                    </span>
                </div>
            </div>
          </div>

          {{-- <div x-show="activeTab === 'logo'">
            <div class="flex justify-center items-center mt-52">
                <div class="animate-pulse relative block w-full rounded-lg border-2 border-dashed border-gray-300 text-center focus:outline-none">
                    <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    <span class="mt-2 block text-2xl font-semibold text-gray-600">Content Coming Soon</span>
                </div>
            </div>
          </div> --}}

          <div x-show="activeTab === 'supervisor'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg text-center focus:outline-none">
                    <span class="mt-2 block text-gray-600">
                        <livewire:supervisor-code />
                    </span>
                </div>
            </div>
          </div>

        </div>
</x-main-layout>
