<x-app-layout>
  
<div class=" flex justify-center ">
  <form method="POST" action="{{ route('product.store') }}" class="w-full max-w-md shadow-md bg-white rounded p-4 my-6">
    @csrf
    <h1 class="text-center text-xl  font-extrabold my-4">New Product Entry</h1>
    <div class="mb-4 flex flex-wrap justify-between">
      <div class="mb-4 w-full  md:w-1/2">
        <label class="mb-2 block text-sm font-bold text-gray-700" for="barcode"> Barcode </label>
        <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="barcode" name="barcode" type="number" placeholder="Barcode" />
        @error('barcode')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-4 w-full  md:w-1/2">
        <label class="mb-2 block text-sm font-bold text-gray-700" for="name"> Name </label>
        <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="name" name="name" type="text" placeholder="Name" />
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
    </div>
    <div class="mb-4 flex flex-wrap justify-between">
      <div class="mb-4 w-full md:mb-0 md:w-1/3">
        <label class="mb-2 block text-sm font-bold text-gray-700" for="stock_quantity"> Quantity </label>
        <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="stock_quantity" name="stock_quantity" type="number" placeholder="Quantity" />
        @error('stock_quantity')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-4 w-full md:mb-0 md:w-1/3">
        <label class="mb-2 block text-sm font-bold text-gray-700" for="sale_price"> Sale Price </label>
        <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="sale_price" name="sale_price" type="number" placeholder="Sale Price" />
        @error('sale_price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-4 w-full md:mb-0 md:w-1/3">
        <label class="mb-2 block text-sm font-bold text-gray-700" for="retail_price"> Retail Price </label>
        <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="retail_price" name="retail_price" type="number" placeholder="Retail Price" />
        @error('retail_price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
    </div>
    <div class="flex justify-center">
      <button type="submit" class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none" type="button">Submit</button>
    </div>
  </form>
</div>
@php
    if (Session::has("success")) {
     echo"<script>$.notify('Product Entered Successfully', 'success');</script>";
    }
@endphp
{{-- <script>
$.notify("Hello World");
$.notify("Access granted", "success");
$.notify("Do not press this button", "info");
$.notify("Warning: Self-destruct in 3.. 2..", "warn");
$.notify("BOOM!", "error");
</script> --}}
</x-app-layout>