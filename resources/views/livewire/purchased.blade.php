<div id="data">
    <div class="bg-white rounded p-3 pt-1 pb-4 m-3 shadow-lg">
        <h2 class="my-2 text-2xl font-bold text-blue-700 text-center">New Purchase</h2>
        <div class="">
            <script src="{{ asset('js/sweetalert.js') }}"></script>


            <div class="grid grid-cols-3 grid-rows-1 gap-4">
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text ml-3">Date :</span>
                        </div>
                        <input type="date" wire:model='todayDate' placeholder="Type here"
                            class="input input-md input-bordered rounded-lg w-full max-w-xs" />
                    </label>
                    @error('todayDate')
                       <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                    @enderror
                </div>
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Total Amount :</span>
                        </div>
                        <input type="number"  wire:model='total_amount' placeholder="Enter the amount you spent"
                            class="input input-md input-bordered rounded-lg w-full max-w-xs" />
                    </label>
                    @error('total_amount')
                    <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                 @enderror
                </div>
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Purchased by :</span>
                        </div>
                        <input type="text" wire:model='name' placeholder="Type here" value="Atif"
                            class="input input-md input-bordered rounded-lg w-full max-w-xs" />
                    </label>
                    @error('name')
                    <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                 @enderror
                </div>
            </div>
            <h2 class=" text-lg font-bold text-center mt-3">Purchased Items</h2>
            <form wire:submit='item' class=" flex gap-x-2 w-full">

                <label class="input input-md grow input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-barcode">
                        <path d="M3 5v14" />
                        <path d="M8 5v14" />
                        <path d="M12 5v14" />
                        <path d="M17 5v14" />
                        <path d="M21 5v14" />
                    </svg>
                    <input  type="text" wire:model='barcode' class="grow new border-none" placeholder="BarCode" />
                  
                </label>
               
                <button type="submit" class="btn btn-md btn-primary text-white ">Get</button>

            </form>
             @error('barcode')
             <p class=" bg-red-600 text-white mx-1 px-1 rounded"> 
                {{ $message }} </p>
         @enderror
            <div class="mx-1 m-3 p-3  border-2  rounded-lg">
                <form wire:submit.prevent='add' class="grid grid-cols-9  gap-x-4">

                    <div class="col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Name</span>
                            </div>

                            <p class="input input-sm input-bordered rounded  w-full max-w-xs">{{ $product->name ?? '' }} </p>
                        </label>
                    </div>
                    <div class="col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Quantity</span>
                            </div>
                            <input type="text" required wire:model='itemQty' placeholder="Type here"
                                class="input input-sm input-bordered new w-full max-w-xs" />
                        </label>
                        @error('itemQty')
                        <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                     @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Purchase Price</span>
                            </div>
                            <input type="text" wire:model='itemNPP' placeholder="New Purchase Price"
                            class="input {{ $hide }} new input-sm input-bordered w-full max-w-xs" />
                            
                            <p class="input input-sm input-bordered rounded w-full max-w-xs"><span class="{{ $hide }}">Old Purchase Price :</span>{{ $product->retail_price ?? '' }}</p>
                        </label>
                        @error('itemNPP')
                        <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                     @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Sale Price</span>
                            </div>
                            <input wire:model='itemNSP' type="text" placeholder="New Sale Price"
                            class="input {{ $hide }} input-sm new input-bordered w-full max-w-xs" />
                            <p class="input input-sm input-bordered w-full rounded max-w-xs"><span class="{{ $hide }}">Old Sale Price :</span>{{ $product->sale_price ?? ''}}</p>
                        </label>
                        @error('itemNSP')
                        <p class=" bg-red-600 text-white mx-1 px-1 rounded"> {{ $message }} </p>
                     @enderror
                    </div>
                    <div class=" justify-center items-center flex flex-col gap-1 {{ $expand }}">
                        <button id="edit-button" wire:click='show' type="button" class="btn  btn-accent  btn-sm">Edit Price</button>
                        <button type="submit" class="btn  btn-primary w-20  btn-sm">Add</button>
                        <button type="button" wire:click='hidde' class="btn {{ $btnStatus }}  bg-red-700 text-white btn-sm">Hide Price</button>
                    </div>
                  
                </form>

            </div>
            <div class="show border">
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Purchase Price</th>
                                <th>Sale Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            @forelse ($selectedProducts as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ $item['pp'] }}</td>
                                    <td>{{ $item['sp'] }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4"><h3 class=" text-center">Noting Here Yet !</h3></td>
                            </tr>
                            @endforelse
                           
                            <!-- row 2 -->

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex w-full justify-end items-center">
                <button wire:click='submit' class="btn  btn-md btn-success text-white  w-36 my-2">Save</button>
            </div>



        </div>
    </div>
    <div class="{{ $state }}">
        <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet" />
      <div class="flex justify-center items-center h-screen ">
        <div id="modal" class="fixed top-0 left-0 w-full h-full bg-gray-900  !bg-opacity-50 flex justify-center  items-center ">
          <div class="bg-white p-8 rounded shadow-lg">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                          Create New Product
                      </h3>
                      <button wire:click='close' type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                 <livewire:EnterProduct/>
        </div>
      </div>
    </div>
    </div>
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>

    @script
    <script>
        $wire.on('new', () => {
            // $('#recycle')[0].reset();
            $('.new').val('');
        });
        $wire.on('reset', () => {
            $("#data :input").val("");
        });
        $wire.on('error', (i) => {
      $.notify(`${i}`, "error",{
  // whether to hide the notification on click
  clickToHide: true,
  autoHide: false
      });

    });
    </script>
    @endscript
    @include('livewire.err')
</div>