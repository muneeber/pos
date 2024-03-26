<aside class="hidden sm:flex flex-col sm:w-52 md:w-60 min-h-screen  px-5 pb-8 pt-2 overflow-y-auto bg-[rgb(251,251,251)] border-r rtl:border-r-0 rtl:border-l ">
    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="-mx-3 space-y-6 ">
            <div class="space-y-3 ">
                {{-- <label class="px-3 text-xs text-gray-500 uppercase ">analytics</label> --}}

                <a wire:navigate.hover href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>

                    <span class="mx-2 text-sm font-medium">Dashboard</span>
                </a>

               
                <a wire:navigate.hover href="{{ route("product.create") }}" class="{{ request()->routeIs('product.create') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>

                    <span class="mx-2 text-sm font-medium">New Product</span>
                </a>
                <a wire:navigate.hover href="{{ route("pos.index") }}" class="{{ request()->routeIs('pos.index') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>

                    <span class="mx-2 text-sm font-medium">Point of Sale</span>
                </a>
                <a wire:navigate.hover href="{{ route('purchase.index') }}" class="{{ request()->routeIs('purchase.index') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>

                    <span class="mx-2 text-sm font-medium">Purchase</span>
                </a>
                <a wire:navigate.hover href="{{ route('sales.index') }}" class="{{ request()->routeIs('sales.index') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>

                    <span class="mx-2 text-sm font-medium">Sales</span>
                </a>
                <a wire:navigate.hover href="{{ route('stock.index') }}" class="{{ request()->routeIs('stock.index') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layers-3"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m6.08 9.5-3.5 1.6a1 1 0 0 0 0 1.81l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9a1 1 0 0 0 0-1.83l-3.5-1.59"/><path d="m6.08 14.5-3.5 1.6a1 1 0 0 0 0 1.81l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9a1 1 0 0 0 0-1.83l-3.5-1.59"/></svg>

                    <span class="mx-2 text-sm font-medium">Stock</span>
                </a>
                <a wire:navigate.hover href="{{ route('accounts.index') }}" class="{{ request()->routeIs('accounts.index') ? 'bg-blue-500 text-white hover:bg-blue-800' : 'hover:bg-gray-100   hover:text-gray-700' }} flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg  " >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round"><path d="M18 21a6 6 0 0 0-12 0"/><circle cx="12" cy="11" r="4"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg>

                    <span class="mx-2 text-sm font-medium">Account</span>
                </a>
            </div>

         

       
        </nav>
    </div>
</aside>