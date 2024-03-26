<div class="bg-[#D1D5DB] w-screen h-screen">

    <div class="h-full w-full flex flex-col">
        <div class="overflow-hidden flex flex-auto">
            <div id="dashboard-body" class="flex flex-auto flex-col overflow-hidden">
                <div class="overflow-y-auto flex-auto">
                    <div id="pos-app" class="h-full w-full relative" data-v-app="">
                        <div class="h-full flex-auto flex flex-col" id="pos-container">
                            {{-- navbar --}}
                            <div id='nav' class="flex overflow-hidden flex-shrink-0 px-2 pt-2">
                                <div class="-mx-2 flex overflow-x-auto pb-1">
                                    <div class="header-buttons flex px-2 flex-shrink-0">
                                        <div class="">
                                            <a wire:navigate.hover href="{{ route('dashboard') }}"
                                                class="rounded btn text-white btn-success shadow flex-shrink-0 h-12 flex items-center px-2 py-1 text-sm">
                                                {{-- <i class="mr-1 text-xl las la-tachometer-alt"></i> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-gauge">
                                                    <path d="m12 14 4-4" />
                                                    <path d="M3.34 19a10 10 0 1 1 17.32 0" />
                                                </svg>
                                                <span>Dashboard</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="header-buttons flex px-2 flex-shrink-0">
                                        <div class="ns-button error">

                                            <button wire:click='rest'
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
                                        <div class="ns-button default">
                                            <button id='custom'
                                                class="rounded shadow flex-shrink-0 bg-white h-12 flex gap-x-2 items-center px-2 py-1 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-square-plus">
                                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                                    <path d="M8 12h8" />
                                                    <path d="M12 8v8" />
                                                </svg>
                                                <span class=' font-bold'>Add Custom Item</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="header-buttons flex px-2 flex-shrink-0">
                                        <div class="ns-button error">

                                            <button wire:click='test'
                                                class="rounded shadow flex-shrink-0 bg-white gap-1 text-black h-12 flex items-center px-2 py-1 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-todo"><rect x="3" y="5" width="6" height="6" rx="1"/><path d="m3 17 2 2 4-4"/><path d="M13 6h8"/><path d="M13 12h8"/><path d="M13 18h8"/></svg>
                                                <span>Tester</span></button>
                                        </div>
                                    </div> --}}



                                    {{-- </div> --}}

                                    <div wire:loading class="">
                                        <span class="loading loading-spinner loading-lg"></span>

                                    </div>
                                </div>
                            </div>
                            <div class="flex-auto overflow-hidden flex p-2">
                                <div class="flex flex-auto overflow-hidden -m-2">
                                    <div id='cart' class="w-1/2 flex overflow-hidden p-2">
                                        <div id="pos-cart" class="flex-auto bg-white flex flex-col">
                                            <div id="grid-header" class="p-2 border-b">
                                                {{-- Barcode form --}}
                                                <div class="border rounded flex overflow-hidden"><button
                                                        title="Barcode."
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
                                                    </button>
                                                    <form wire:submit="fbarcode"
                                                        class="flex flex-auto items-center outline-none px-2">
                                                        <input type="text" wire:model="barcode" class="mr-2 w-full"
                                                            id="barcode" placeholder="Enter Barcode ..."
                                                            class="w-full outline-none"><input type="submit"
                                                            class="btn  btn-sm btn-success rounded" value="Enter">
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- Cart Headings --}}
                                            <div class="rounded shadow ns-tab-item flex-auto flex overflow-hidden">
                                                <div class="cart-table flex flex-auto flex-col overflow-hidden">
                                                    <div id="cart-table-header"
                                                        class="w-full text-black font-semibold flex">
                                                        <div class="w-full lg:w-4/6 p-2 border border-l-0 border-t-0">
                                                            Product</div>
                                                        <div class="hidden lg:flex lg:w-1/6 p-2 border-b border-t-0">
                                                            Quantity</div>
                                                        <div
                                                            class="hidden lg:flex lg:w-1/6 p-2 border border-r-0 border-t-0">
                                                            Price</div>
                                                        <div
                                                            class="hidden lg:flex lg:w-1/6 p-2 border border-r-0 border-t-0">
                                                            Total</div>
                                                    </div>
                                                  <form wire:submit.prevent='custom' id='customForm' class="flex hidden">
                                                    <div class="border w-4/6">
                                                          <input type="text" required wire:model='Cproduct' class=" w-full" placeholder="Enter Product Name">
                                                    </div>
                                                    <div class="border w-1/6">
                                                          <input type="text" required wire:model='Cqty' class=" w-full" placeholder="Qty">
                                                    </div>
                                                    <div class="border w-1/6">
                                                          <input type="text" required  wire:model='Cprice' class=" w-full" placeholder="Price">
                                                    </div>
                                                    <div class="border w-1/6">
                                                        <button type="submit" class='hidden'>hi</button>
                                                    </div>
                                                  </form>
                                                    {{-- Cart Data --}}
                                                    @forelse ($selectedProducts as $index => $SP)
                                                        <div class="w-full flex text-black font-semibold">
                                                            <div id="showProduct"
                                                                class="w-full text-center lg:w-4/6 p-2 border border-l-0 border-t-0">
                                                                {{ $SP['name'] }}
                                                            </div>
                                                            <!-- Input field for quantity -->
                                                            <div
                                                                class="lg:flex lg:w-1/6 text-center px-3 border-b border-t-0">
                                                                <input type="number"
                                                                    wire:model.change="selectedProducts.{{ $index }}.qty"
                                                                    wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                                                    class="w-full outline-none" min="1">
                                                            </div>
                                                            <div id="productPrice"
                                                                class="hidden lg:flex lg:w-1/6 p-2 border border-r-0 border-t-0">
                                                                {{ $SP['price'] }}
                                                            </div>
                                                            <div id="productPrice"
                                                                class="hidden lg:flex lg:w-1/6 p-2 border border-r-0 border-t-0">
                                                                {{ $SP['totalPrice'] }}
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                    <div id="cart-products-table"
                                                        class="flex flex-auto flex-col overflow-auto">
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
                                                                    Rs.{{ $billSubtotal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="200" class="border p-2"><a
                                                                        class="cursor-pointer outline-none border-dashed py-1 border-b border-info-black text-sm">Type:
                                                                        N/A</a></td>
                                                                <td width="200" class="border p-2">
                                                                    <span>Discount</span>
                                                                </td>
                                                                <td width="200" class="border p-2 text-right">
                                                                    <p
                                                                        class="cursor-pointer outline-none border-dashed py-1 border-b border-info-black text-sm">
                                                                        Rs.{{ $discount }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr class="bg-[#4ADE80]">
                                                                <td width="200" class="border p-2"></td>
                                                                <td width="200" class="border p-2">Total</td>
                                                                <td width="200" class="border p-2 text-right">
                                                                    Rs.<span id="billTotal">{{ $billTotal }}</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="h-16 flex flex-shrink-0 border-t border-box-edge"
                                                        id="cart-bottom-buttons">
                                                        <button id="pay-button" wire:click='pay'
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
                                                        </button>
                                                        <div id="hold-button" wire:click='credit'
                                                            class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center bg-blue-500 text-white border-r hover:bg-blue-600 border-blue-600 flex-auto"
                                                            settings="[object Object]"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-pause">
                                                                <rect width="4" height="16" x="6" y="4" />
                                                                <rect width="4" height="16" x="14" y="4" />
                                                            </svg><span
                                                                class="text-lg hidden md:inline lg:text-2xl">Credit</span>
                                                        </div>
                                                        <div id="discount-button"
                                                            class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center border-r border-box-edge flex-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-percent">
                                                                <line x1="19" x2="5" y1="5"
                                                                    y2="19" />
                                                                <circle cx="6.5" cy="6.5" r="2.5" />
                                                                <circle cx="17.5" cy="17.5" r="2.5" />
                                                            </svg>
                                                            <span
                                                                class="text-lg hidden md:inline lg:text-2xl">Discount</span>
                                                        </div>
                                                        <div id="void-button" wire:click="rest"
                                                            class="flex-shrink-0 w-1/4 flex items-center gap-2 font-bold cursor-pointer justify-center bg-red-500 text-white border-box-edge hover:bg-red-600 flex-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-trash-2">
                                                                <path d="M3 6h18" />
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                <line x1="10" x2="10" y1="11"
                                                                    y2="17" />
                                                                <line x1="14" x2="14" y1="11"
                                                                    y2="17" />
                                                            </svg>
                                                            <span
                                                                class="text-lg hidden md:inline lg:text-2xl">Void</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div description="search" class="w-1/2 p-2 flex overflow-hidden">
                                        <div id="pos-grid" class="flex-auto bg-white flex flex-col">
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
                                                            </svg></button>
                                                        <form wire:submit.prevent='fsearch' class="w-full">
                                                            <input id="search" type="text" wire:model="search"
                                                                placeholder="Search Your Product Here ..."
                                                                class="flex-auto outline-none px-2 w-full">
                                                            <input type="submit" class="hidden ">
                                                        </form>
                                                    </div>
                                                </div>
                                                <div style="height:0"></div>

                                                <div id="grid-items" class="p-3 overflow-y-auto h-full flex-col flex">
                                                    <div
                                                        class="grid gap-1 grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                                        {{--  --}}
                                                        @forelse ($products as $item)
                                                            <div wire:key="{{ $item->id }}"
                                                                wire:click="addProduct({{ $item->id }})"
                                                                class=" btn w-full h-36 cursor-pointer border flex flex-col items-center justify-center overflow-hidden relative">

                                                                <h3 class="text-sm text-center font-bold py-2 ">
                                                                    {{ $item->name }} </h3>
                                                                <h3>{{ $item->sale_price }} Rs</h3>


                                                            </div>
                                                        @empty
                                                            <div class="col-span-5">
                                                                <h3 class="text-center text-bold text-xl mt-5">
                                                                    {{ $response }}
                                                                </h3>
                                                            </div>
                                                        @endforelse
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
        <div class="fixed inset-0 overflow-y-auto {{ $modal }}" id="modal">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50"></div>

                <div class="bg-white rounded-lg z-50 p-6 max-w-lg w-full">
                    <!-- Modal content goes here -->
                    <h2 class="text-xl font-bold mb-1">Accounts</h2>
                    <p class=" text-sm mb-4">Click on the Account you want to select</p>
                    <div class="overflow-x-auto overflow-y-scroll  max-h-96 ">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    {{-- <th>Price</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                @forelse ($accounts as $account)
                                    <tr class="hover cursor-pointer" wire:key="{{ $account->id }}"
                                        wire:click='khata({{ $account->id }})'>
                                        <td>{{ $account->id }}</td>
                                        <td>{{ $account->Name }}</td>
                                        <td>{{ $account->Contact }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Close button -->
                    <button onclick="closeModal()"
                        class="bg-red-500 mt-2 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none">Close</button>
                </div>
            </div>
        </div>


        <script>
            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }
        </script>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    @script
        <script>
            // Wait for the DOM to be ready
            $(document).ready(function() {
                $('#custom').click(function (e) { 
                    e.preventDefault();
                    $('#customForm').removeClass('hidden');
                });
                $wire.on('Crest', async () => {
                    console.log('uff');
                    $('#customForm').addClass('hidden');
                    $('#customForm').find('input').val('');

                })
                // Add click event handler to the button
                $('#discount-button').click(async function() {
                    // Trigger SweetAler
                    const {
                        value: number
                    } = await Swal.fire({
                        input: "number",
                        inputLabel: "Discount",
                        inputPlaceholder: "Enter Your Discount in Rs.",
                        inputAttributes: {
                            "aria-label": "Type your message here"
                        },
                        showCancelButton: true
                    });
                    if (number) {
                        $wire.dispatch('discount', {
                            value: number
                        });
                    }
                });

            });

            $wire.on('extras', async () => {
                var billTotalText = $('#billTotal').text();
                console.log(billTotalText);
                var billTotal = parseFloat(billTotalText);
                console.log(billTotal);
                const {
                    value: number
                } = await Swal.fire({
                    input: "number",
                    inputLabel: "Amount",
                    inputPlaceholder: "Enter Give Amount in Rs.",
                    inputAttributes: {
                        "aria-label": "Type Amount here"
                    },
                    showCancelButton: true
                });
                if (number) {
                    var extra = number - billTotal;
                    console.log(extra);
                    Swal.fire(
                        `The Rupees you have to return is ${extra}`
                    );
                }
            });




            // $wire.on('barError', () => {
            //     $.notify("Wrong  Bar Code Number", "error");
            // });
            // $wire.on('notifyError', (e) => {
            //     $.notify(`${e}`, "error");
            // });
            $wire.on('overDiscount', (data) => {
                const limit = data[0].limit;
                const discount = data[0].discount;
                Swal.fire({
                    icon: "error",
                    title: "Oops... Over Discount",
                    text: `You have applied the discount of ${discount} but Only ${limit} can be applied`,
                });
            });
            $wire.on('modalError', (error) => {
                Swal.fire({
                    icon: "error",
                    title: "Oops... Error",
                    text: `${error}`,
                });
            });
            $wire.on('resetBar', () => {
                $('#barcode').val('');
                // console.log('done');
            });
            $wire.on('resetSearch', () => {
                $('#search').val('');
                console.log('done');
            });
        </script>
    @endscript
    @include('livewire.err')
</div>
