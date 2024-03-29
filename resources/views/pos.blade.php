<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-[#D1D5DB]  w-screen h-screen">
        <div class="h-full w-full flex flex-col">
            <div class="overflow-hidden flex flex-auto">
                <div id="dashboard-body" class="flex flex-auto flex-col overflow-hidden">
                    <div class="overflow-y-auto flex-auto">
                        <div id="pos-app" class="h-full w-full relative" data-v-app="">
                            <div class="h-full flex-auto flex flex-col" id="pos-container">
                                <div class="flex overflow-hidden flex-shrink-0 px-2 pt-2">
                                    <div class="-mx-2 flex overflow-x-auto pb-1">
                                        <div class="header-buttons flex px-2 flex-shrink-0">
                                            <div class=""><a wire:navigate href="{{ route('dashboard') }}"
                                                    class="rounded btn  text-white btn-success shadow flex-shrink-0 h-12 flex items-center px-2 py-1 text-sm">
                                                    {{-- <i
                                                        class="mr-1 text-xl las la-tachometer-alt"></i> --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="lucide lucide-gauge">
                                                        <path d="m12 14 4-4" />
                                                        <path d="M3.34 19a10 10 0 1 1 17.32 0" />
                                                    </svg>
                                                    <span>Dashboard</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="header-buttons flex px-2 flex-shrink-0">
                                            <div class="ns-button default">
                                                <button
                                                    class="rounded shadow flex-shrink-0 bg-white h-12 flex items-center gap-x-1 px-2 py-1 text-sm">
                                                    <svg fill="#000000" height="18px" width="18px" version="1.1"
                                                        id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        viewBox="0 0 203.079 203.079" xml:space="preserve">
                                                        <path d="M192.231,104.082V102c0-12.407-10.094-22.5-22.5-22.5c-2.802,0-5.484,0.519-7.961,1.459
                                                   C159.665,70.722,150.583,63,139.731,63c-2.947,0-5.76,0.575-8.341,1.61C128.667,55.162,119.624,48,109.231,48
                                                   c-2.798,0-5.496,0.541-8,1.516V22.5c0-12.407-10.094-22.5-22.5-22.5s-22.5,10.093-22.5,22.5v66.259
                                                   c-3.938-5.029-8.673-9.412-14.169-11.671c-6.133-2.52-12.587-2.219-18.667,0.872c-11.182,5.686-15.792,19.389-10.277,30.548
                                                   l27.95,56.563c0.79,1.552,19.731,38.008,54.023,38.008h40c31.54,0,57.199-25.794,57.199-57.506l-0.031-41.491H192.231z
                                                    M135.092,188.079h-40c-24.702,0-40.091-28.738-40.646-29.796l-27.88-56.42c-1.924-3.893-0.33-8.519,3.629-10.532
                                                   c2.182-1.11,4.081-1.223,6.158-0.372c8.281,3.395,16.41,19.756,19.586,29.265l2.41,7.259l12.883-4.559V22.5
                                                   c0-4.136,3.364-7.5,7.5-7.5s7.5,3.364,7.5,7.5V109h0.136h14.864h0.136V71c0-4.187,3.748-8,7.864-8c4.262,0,8,3.505,8,7.5v15v26h15
                                                   v-26c0-4.136,3.364-7.5,7.5-7.5s7.5,3.364,7.5,7.5V102v16.5h15V102c0-4.136,3.364-7.5,7.5-7.5s7.5,3.364,7.5,7.5v10.727h0.035
                                                   l0.025,32.852C177.291,169.014,158.36,188.079,135.092,188.079z" />
                                                    </svg>
                                                    <span>Orders</span>
                                                </button>
                                            </div>
                                        </div>


                                        <div class="header-buttons flex px-2 flex-shrink-0">
                                            <div class="ns-button error"><button
                                                    class="rounded shadow flex-shrink-0 bg-red-500 gap-1 text-white h-12 flex items-center px-2 py-1 text-sm"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-eraser">
                                                        <path
                                                            d="m7 21-4.3-4.3c-1-1-1-2.5 0-3.4l9.6-9.6c1-1 2.5-1 3.4 0l5.6 5.6c1 1 1 2.5 0 3.4L13 21" />
                                                        <path d="M22 21H7" />
                                                        <path d="m5 11 9 9" />
                                                    </svg><span>Reset</span></button>
                                            </div>
                                        </div>
                                        <div class="header-buttons flex px-2 flex-shrink-0">
                                            <div class="ns-button default"><button
                                                    class="rounded shadow bg-white flex-shrink-0 h-12 gap-1 flex items-center px-2 py-1 text-sm"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-coins">
                                                        <circle cx="8" cy="8" r="6" />
                                                        <path d="M18.09 10.37A6 6 0 1 1 10.34 18" />
                                                        <path d="M7 6h1v4" />
                                                        <path d="m16.71 13.88.7.71-2.82 2.82" />
                                                    </svg> <span>Cash
                                                        Register</span></button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-auto overflow-hidden   flex p-2">
                                    <div class="flex flex-auto overflow-hidden -m-2">
                                        <div class="w-1/2  flex overflow-hidden p-2">
                                            <div id="pos-cart" class="flex-auto bg-white flex flex-col"><!---->
                                                <div class="rounded shadow ns-tab-item flex-auto flex overflow-hidden">
                                                    <div class="cart-table flex flex-auto flex-col overflow-hidden">
                                                       
                                                        <div id="cart-table-header"
                                                            class="w-full text-black font-semibold flex">
                                                            <div
                                                                class="w-full lg:w-4/6 p-2 border border-l-0 border-t-0">
                                                                Product</div>
                                                            <div
                                                                class="hidden lg:flex lg:w-1/6 p-2 border-b border-t-0">
                                                                Quantity</div>
                                                            <div
                                                                class="hidden lg:flex lg:w-1/6 p-2 border border-r-0 border-t-0">
                                                                Total</div>
                                                        </div>
                                                        <div id="cart-products-table"
                                                            class="flex flex-auto flex-col overflow-auto">
                                                            <div class="text-black flex">
                                                                <div class="w-full text-center py-4 border-b">
                                                                    <h3>No products added...</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="cart-products-summary" class="flex">
                                                            <table class="table ns-table w-full text-sm">
                                                                <tr>
                                                                    <td width="200" class="border p-2"><a
                                                                            class="cursor-pointer outline-none border-dashed py-1 border-b border-info-black text-sm">Customer:
                                                                            N/A</a></td>
                                                                    <td width="200" class="border p-2">Sub Total
                                                                    </td>
                                                                    <td width="200" class="border p-2 text-right">
                                                                        Rs.0</td>
                                                                </tr><!---->
                                                                <tr>
                                                                    <td width="200" class="border p-2"><a
                                                                            class="cursor-pointer outline-none border-dashed py-1 border-b border-info-black text-sm">Type:
                                                                            N/A</a></td>
                                                                    <td width="200" class="border p-2">
                                                                        <span>Discount</span><!----><!---->
                                                                    </td>
                                                                    <td width="200" class="border p-2 text-right">
                                                                        <a
                                                                            class="cursor-pointer outline-none border-dashed py-1 border-b border-info-black text-sm">Rs.0</a>
                                                                    </td>
                                                                </tr><!---->
                                                                <tr class="bg-[#4ADE80]">
                                                                    <td width="200" class="border p-2"><!----></td>
                                                                    <td width="200" class="border p-2">Total</td>
                                                                    <td width="200" class="border p-2 text-right">
                                                                        Rs.0</td>
                                                                </tr>
                                                            </table><!---->
                                                        </div>
                                                        <div class="h-16 flex flex-shrink-0 border-t border-box-edge"
                                                            id="cart-bottom-buttons"><!---->
                                                            <div id="pay-button"
                                                                class="flex-shrink-0 w-1/4 flex gap-2 items-center font-bold cursor-pointer justify-center bg-green-500 text-white hover:bg-green-600 border-r border-green-600 flex-auto"
                                                                settings="[object Object]"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-wallet">
                                                                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4" />
                                                                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5" />
                                                                    <path d="M18 12a2 2 0 0 0 0 4h4v-4Z" />
                                                                </svg><span
                                                                    class="text-lg hidden md:inline lg:text-2xl">Pay</span>
                                                            </div>
                                                            <div id="hold-button"
                                                                class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center bg-blue-500 text-white border-r hover:bg-blue-600 border-blue-600 flex-auto"
                                                                settings="[object Object]"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-pause">
                                                                    <rect width="4" height="16" x="6" y="4" />
                                                                    <rect width="4" height="16" x="14"
                                                                        y="4" />
                                                                </svg><span
                                                                    class="text-lg hidden md:inline lg:text-2xl">Hold</span>
                                                            </div>
                                                            <div id="discount-button"
                                                                class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center border-r border-box-edge flex-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-percent">
                                                                    <line x1="19" x2="5"
                                                                        y1="5" y2="19" />
                                                                    <circle cx="6.5" cy="6.5" r="2.5" />
                                                                    <circle cx="17.5" cy="17.5" r="2.5" />
                                                                </svg>
                                                                <span
                                                                    class="text-lg hidden md:inline lg:text-2xl">Discount</span>
                                                            </div>
                                                            <div id="void-button"
                                                                class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center bg-red-500 text-white border-box-edge hover:bg-red-600 flex-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-trash-2">
                                                                    <path d="M3 6h18" />
                                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                    <line x1="10" x2="10"
                                                                        y1="11" y2="17" />
                                                                    <line x1="14" x2="14"
                                                                        y1="11" y2="17" />
                                                                </svg>
                                                                <span
                                                                    class="text-lg hidden md:inline lg:text-2xl">Void</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-1/2 p-2  flex overflow-hidden">
                                            <div id="pos-grid" class="flex-auto bg-white flex flex-col"><!---->
                                                <div id="grid-container"
                                                    class="rounded shadow overflow-hidden flex-auto flex flex-col">
                                                    <div id="grid-header" class="p-2 border-b">
                                                        <div class="border rounded flex overflow-hidden"><button
                                                                title="Search for products."
                                                                class="w-10 h-10 border-r flex justify-center items-center outline-none"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-search">
                                                                    <circle cx="11" cy="11" r="8" />
                                                                    <path d="m21 21-4.3-4.3" />
                                                                </svg></button><button title="Barcode."
                                                                class="outline-none flex justify-center items-center w-10 h-10 border-r">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-barcode">
                                                                    <path d="M3 5v14" />
                                                                    <path d="M8 5v14" />
                                                                    <path d="M12 5v14" />
                                                                    <path d="M17 5v14" />
                                                                    <path d="M21 5v14" />
                                                                </svg>
                                                            </button><input type="number" placeholder="Enter Barcode ..."
                                                                class="flex-auto outline-none px-2">
                                                        </div>
                                                    </div>
                                                    <div style="height: 0px;"><!----></div>
                                                    <div id="grid-breadscrumb" class="p-2">
                                                        <ul class="flex">
                                                            <li><a href="javascript:void(0)" class="px-3">Home</a>
                                                                <i class="las la-angle-right"></i>
                                                            </li>
                                                            <li></li>
                                                        </ul>
                                                    </div>
                                                    <div id="grid-items" class="overflow-y-auto h-full flex-col flex">
                                                        <div
                                                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                                            <div
                                                                class="cell-item w-full h-36 cursor-pointer border flex flex-col items-center justify-center overflow-hidden relative">
                                                                <div
                                                                    class="h-full w-full flex items-center justify-center">
                                                                    <img src="./POS — NexoPOS_files/twin-comforter-sets.jpg"
                                                                        class="object-cover h-full"
                                                                        alt="Bedding &amp; Bath"><!---->
                                                                </div>
                                                                <div class="w-full absolute z-10 -bottom-10">
                                                                    <div
                                                                        class="cell-item-label relative w-full flex items-center justify-center -top-10 h-20 py-2">
                                                                        <h3 class="text-sm font-bold py-2 text-center">
                                                                            Bedding &amp; Bath</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="cell-item w-full h-36 cursor-pointer border flex flex-col items-center justify-center overflow-hidden relative">
                                                                <div
                                                                    class="h-full w-full flex items-center justify-center">
                                                                    <img src="./POS — NexoPOS_files/furnitures.jpg"
                                                                        class="object-cover h-full"
                                                                        alt="Furnitures"><!---->
                                                                </div>
                                                                <div class="w-full absolute z-10 -bottom-10">
                                                                    <div
                                                                        class="cell-item-label relative w-full flex items-center justify-center -top-10 h-20 py-2">
                                                                        <h3 class="text-sm font-bold py-2 text-center">
                                                                            Furnitures</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="cell-item w-full h-36 cursor-pointer border flex flex-col items-center justify-center overflow-hidden relative">
                                                                <div
                                                                    class="h-full w-full flex items-center justify-center">
                                                                    <img src="./POS — NexoPOS_files/kitchen-dinning.jpg"
                                                                        class="object-cover h-full"
                                                                        alt="Kitchen &amp; Dining"><!---->
                                                                </div>
                                                                <div class="w-full absolute z-10 -bottom-10">
                                                                    <div
                                                                        class="cell-item-label relative w-full flex items-center justify-center -top-10 h-20 py-2">
                                                                        <h3 class="text-sm font-bold py-2 text-center">
                                                                            Kitchen &amp; Dining</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="cell-item w-full h-36 cursor-pointer border flex flex-col items-center justify-center overflow-hidden relative">
                                                                <div
                                                                    class="h-full w-full flex items-center justify-center">
                                                                    <img src="./POS — NexoPOS_files/decor.jpg"
                                                                        class="object-cover h-full"
                                                                        alt="Decors"><!---->
                                                                </div>
                                                                <div class="w-full absolute z-10 -bottom-10">
                                                                    <div
                                                                        class="cell-item-label relative w-full flex items-center justify-center -top-10 h-20 py-2">
                                                                        <h3 class="text-sm font-bold py-2 text-center">
                                                                            Decors</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!----><!---->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
