<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="bg-white rounded shadow p-4 w-full">
        <h1 class=" font-bold text-center capitalize text-2xl">{{ $table }} Details</h1>
        <div class="flex w-full items-center justify-around gap-6 ">

            <h2 class=" capitalize">{{ $table }}d By:{{ $data->user->name }}</h2>
            <h2 class=" capitalize">{{ $table }}d At: {{ Carbon\Carbon::parse($data->purchase_date)->format('d-M-Y') }}</h2>
        </div>
{{-- {{ $items }} --}}
    </div>
    <div class="bg-white rounded shadow p-4 w-full">
        <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                    
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->quantity_purchased }}</td>
                  <td>{{  $item->price }}</td>
                  <td>{{  $item->totalPrice }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="5" class=" text-right pr-40"> Total Amount Spent : {{ $data->total_amount }}</th>
                </tr>

              </tbody>
            </table>
          </div>
    </div>
</div>
