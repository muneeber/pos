<div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
   
    <div class=" flex justify-center ">
        <form wire:submit.prevent="save" class="w-full max-w-lg shadow-md bg-white rounded p-4 sm:my-6">
            @csrf
            <div wire:loading class="">
                <span class="loading loading-spinner loading-md"></span>
            </div>
            <h1 class="text-center text-xl  font-extrabold my-2 mt-1 sm:my-4">New Product Entry</h1>
            <div class="mb-4 flex  form-control gap-y-3">
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="barcode"> Barcode </label>
                    <input wire:model="barcode" wire:keydown.enter.prevent
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="barcode" name="barcode" type="number" placeholder="Barcode" />
                @error('barcode')
                    <div class="text-white text-sm mt-1 mx-1 text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                   
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="name"> Name </label>
                    <input wire:model="name"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="name" name="name" type="text" placeholder="Name" />
                @error('name')
                    <div class="text-white text-sm mt-1 mx-1  text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="company"> Company </label>
                    <input wire:model="company"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="company" name="company" type="text" placeholder="Company" />
                @error('company')
                    <div class="text-white text-sm mt-1 mx-1  text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="category"> Category </label>
                    {{-- <input wire:model="category"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="category" name="category" type="text" placeholder="Category" /> --}}
                    <select wire:model="category" id="category" name="category" class="select select-sm rounded  h-11 capitalize select-bordered w-full" >
                        {{-- <option disabled selected>Who shot first?</option> --}}
                        @foreach ($categories as $category)
                            @if ($category->name == "general")
                                
                            <option class=" capitalize" selected  value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                            <option class=" capitalize" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                        {{-- <option>Greedo</option> --}}
                      </select>
                @error('category')
                    <div class="text-white text-sm mt-1 mx-1  text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="category"> Shelf (optional) </label>
                    <input wire:model="shelf"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="shelf" name="shelf" type="text" placeholder="Shelf" />
                @error('shelf')
                    <div class="text-white text-sm mt-1 mx-1  text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="name"> Quantity </label>
                    <input wire:model="qty"
                        class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                        id="stock_quantity" name="stock_quantity" type="number" placeholder="Quantity" />
                    @error('qty')
                        <div class="text-white text-sm mt-1 mx-1 text-center bg-red-500 p-1">{{ $message }}</div>
                    @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="name"> Retail Price </label>
                    <input wire:model="retailPrice"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="retail_price" name="retail_price" type="number" placeholder="Retail Price" />
                @error('retailPrice')
                    <div class="text-white text-sm mt-1 mx-1 text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
                <div class=" w-full  ">
                    <label class="mb-2 block text-sm font-bold text-gray-700" for="name"> Sale Price </label>
                    <input wire:model="salePrice"
                    class="focus:shadow-outline w-full input h-10 input-bordered appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none""
                    id="sale_price" name="sale_price" type="number" placeholder="Sale Price" />
                @error('salePrice')
                    <div class="text-white text-sm mt-1 mx-1 text-center bg-red-500 p-1">{{ $message }}</div>
                @enderror
                    
                </div>
           {{-- <div class="flex w-full justify-around"> --}}
                
                <button type="submit"
                    class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none"
                    type="button">Submit</button>
                    <button  type="reset" wire:click="formReset"
                    class="focus:shadow-outline rounded bg-red-500 px-4 py-2  mt-4 font-bold text-white hover:bg-red-700 focus:outline-none"
                    type="button">Reset</button>
                {{-- </div> --}}
            </div>
        </form>
    </div>


    {{-- <script>
      $.notify("Hello World");
      $.notify("Access granted", "success");
      $.notify("Do not press this button", "info");
      $.notify("Warning: Self-destruct in 3.. 2..", "warn");
      $.notify("BOOM!", "error");
      </script> --}}
    @script
        <script>
            $wire.on('productCreated', () => {
                $.notify("Product Created Successfully", "success");
                $('form :input').val('');
            });
            $wire.on('priceError', () => {
                $.notify("The Sale Price should be greater or equal to the Retail Price", "error");
            });
        </script>
    @endscript

</div>
