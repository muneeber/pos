<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class=" m-5 p-5 rounded bg-white">
        <h2 class="  text-3xl font-extrabold mx-2 text-center">Edit Product:</h2>
        {{-- <div class=" form-control"> --}}

        <div class="grid grid-cols-6 grid-rows-2 gap-4">
            <div class="col-span-3">
                <div class="label">
                    <span class="label-text">BarCode:</span>
                </div>
                <input type="text" wire:model='barcode' placeholder="Type here" class="input input-bordered bg-white rounded w-full " />
            </div>
            <div class="col-span-3 col-start-4 row-start-1">
                <div class="label">
                    <span class="label-text">Product Name:</span>
                </div>
                <input type="text" wire:model='name' placeholder="Type here" class="input input-bordered bg-white rounded w-full " />
            </div>
            <div class="col-span-2 col-start-1 row-start-2">
                <div class="label">
                    <span class="label-text">Quantity:</span>
                </div>
                <input type="text" wire:model='qty' placeholder="Type here"
                    class="input input-bordered bg-white rounded w-full max-w-xs" />
            </div>
            <div class="col-span-2 col-start-3 row-start-2">
                <div class="label">
                    <span class="label-text">Retail Price:</span>
                </div>
                <input type="text" wire:model='retailPrice' placeholder="Type here"
                    class="input input-bordered bg-white rounded w-full max-w-xs" />
            </div>
            <div class="col-span-2 col-start-5 row-start-2">
                <div class="label">
                    <span class="label-text">Sale Price:</span>
                </div>
                <input type="text" wire:model='salePrice' placeholder="Type here"
                    class="input input-bordered bg-white rounded w-full max-w-xs" />
            </div>
            
    <div wire:loading> 
        <span class="loading loading-spinner loading-md"></span>
    </div>
            <div class="col-span-2 col-start-2 row-start-3">
                <a   href="{{ route('stock.index') }}" wire:navigate  class="btn w-full bg-red-500 text-white  rounded-md" type="button">Discard</a>

            </div>
            <div class="col-span-2 col-start-4 row-start-3">
                <button 
                {{-- wire:confirm='Do you want Save with New Info ?' --}}
                 wire:click='edit'  class="btn w-full bg-green-500 text-white  rounded-md" type="submit">Save</button>

            </div>

{{-- <button wire:click='red' class="btn">red</button> --}}
        </div>

        {{-- </div> --}}

    </div>
</div>
