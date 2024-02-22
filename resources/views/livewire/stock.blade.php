<div>
   
    <div class="navbar px-4  items-center bg-white rounded w-full -mt-2">
        <div class="w-full">

            <form class="w-full" wire:submit='fsearch'>
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search"  id="default-search" wire:model='search' 
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Search Any Product Here ! ------"  />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                        {{-- <span wire:loading>Saving...</span>  --}}
                </div>
            </form>

        </div>
        <div class=" flex justify-center items-center h-full w-full ">
            <select wire:change='scope' wire:model='status' class="select rounded select-bordered w-full max-w-xs">
                <option>All Stock</option>
                <option>In Stock</option>
                <option>Out Stock + Almost End</option>
                <option>Out Stock</option>
                <option>Almost End</option>
              </select>
        </div>
        <div class="   w-[21rem]">
            Showing {{ $results }} Results.
        </div>
    </div>
    <div class="overflow-x-auto shadow-md p-3 bg-white m-3 rounded">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>BarCode</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Retail Price</th>
                    <th>Sale Price</th>
                    <th class="text-center">Opt</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                {{-- <tr>
                    <th>1</th>
                    <td>100202009</td>
                    <td>Quality Control Specialist</td>
                    <td>2</td>
                    <td>
                        <div class="badge bg-green-500 p-3 text-slate-100">In-Stock</div>
                        <div class="badge bg-red-500 p-3 text-slate-100">Out-Stock</div>
                        <div class="badge bg-amber-500 p-3 text-slate-100">Almost End</div>
                    </td>
                    <td>Rs.120</td>
                    <td>Rs.150</td>
                    <td class="flex flex-col  ">
                        <button class="btn btn-sm btn-primary rounded text-white">Edit</button>

                        <button class="btn btn-sm bg-red-500 hover:bg-red-700 rounded text-white">Delete</button>
                    </td>
                </tr> --}}
                {{-- {"id":1,"barcode":39,"name":"Gannon Wheeler","description":null,"retail_price":"916.00","sale_price":"284.00","category_id":null,"stock_quantity":629,"created_at":"2024-02-19T17:21:55.000000Z","updated_at":"2024-02-19T17:21:55.000000Z"} --}}
                @forelse ($products as $item)
                    <tr wire:key='{{ $item->id}}'>
                        {{-- <th>{{ $item->id}}</th> --}}
                        <td>{{ $item->barcode }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->stock_quantity }}</td>
                        <td class=" w-32">


                            @if ($item->stock_quantity > 9)
                                <div class="badge bg-green-500  text-slate-100">In-Stock</div>
                            @elseif ($item->stock_quantity = 0)
                                <div class="badge bg-red-500 text-slate-100">Out-Stock</div>
                            
                            @elseif ($item->stock_quantity < 9)
                                <div class="badge bg-amber-500  text-slate-100">Almost-End</div>
                            @endif
                        </td>
                        <td>{{ $item->retail_price }}</td>
                        <td>{{ $item->sale_price }}</td>
                        <td class="flex flex-col  ">
                            <a wire:navigate href='{{ route('product.edit', $item->id) }}' class="btn btn-sm btn-primary rounded text-white">Edit</a>

                            <button wire:confirm="Are You Sure To Delete {{ $item->name }}" wire:click="delete({{ $item->id}})" class="btn btn-sm bg-red-500 hover:bg-red-700 rounded text-white">Delete</button>
                        </td>
                    </tr>
                @empty
                @endforelse

            </tbody>
        </table>
    </div>
  
        
   
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    @script
    <script>
        $wire.on('barError', () => {
            $.notify("Product Deleted Successfully", "success");
        });
       
    </script>
@endscript
@if (Session::has('editSuccess')) {
   <script>
      $.notify("Product Edited Successfully", "success");
    </script>     
@endif    
}
</div>
