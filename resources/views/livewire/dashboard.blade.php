<div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="stats shadow bg-white w-full">

        <div class="stat">
            <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-handshake">
                    <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                    <path
                        d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                    <path d="m21 3 1 11h-2" />
                    <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                    <path d="M3 4h8" />
                </svg>
            </div>
            <div class="stat-title">Today Sales</div>
            <div class="stat-value text-primary ml-2">{{ $sales }}</div>
            <div class="stat-desc">Its a good start</div>
        </div>
        <div class="stat">
            <div class="stat-figure text-neutral">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-banknote">
                    <rect width="20" height="12" x="2" y="6" rx="2" />
                    <circle cx="12" cy="12" r="2" />
                    <path d="M6 12h.01M18 12h.01" />
                </svg>
            </div>
            <div class="stat-title">Today Income</div>
            <div class="stat-value text-neutral">{{ $todaySale }} .Rs</div>
            <div class="stat-desc">21% more than last month</div>
        </div>
        <div class="stat">
            <div class="stat-figure text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div class="stat-title">Monthly Income</div>
            <div class="stat-value text-accent">{{ $monthlySale }} .Rs</div>
            <div class="stat-desc">21% more than last month</div>
        </div>
    </div>

    <div class="flex">
        <livewire:sales-chart />

        <div class="stats shadow bg-white h-36 m-3 p-3">
            <div class="stat-figure text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-coins">
                    <circle cx="8" cy="8" r="6" />
                    <path d="M18.09 10.37A6 6 0 1 1 10.34 18" />
                    <path d="M7 6h1v4" />
                    <path d="m16.71 13.88.7.71-2.82 2.82" />
                </svg>
            </div>
            <div class="stat">
                <div class="stat-title">Total Profit this Month</div>
                <div class="stat-value">{{ $ptm }}</div>
                {{-- <div class="stat-desc">21% more than last month</div> --}}
            </div>

        </div>
    </div>

</div>
