<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="navbar  bg-white  gap-x-12  p-3 px-8">
        <h1 class="text-4xl font-bold">Sales:</h1>
        <form wire:submit.prevent='byDate' class="flex gap-2 justify-center ">
            <input type="date" wire:model='startDate' class="rounded input-sm"> To <input wire:model='endDate' type="date" class="rounded input-sm"> <input
                class="btn btn-sm btn-primary" type="submit">
        </form>
        <div class=" flex gap-10 justify-around">
                <select wire:model='status' wire:change='byStatus' class="select select-bordered w-full select-md">
                    <option class=" capitalize">completed</option>
                    <option class=" capitalize">pending</option>
                </select>
                <button class="btn btn-md btn-accent">Today's Report</button>
        </div>
    </div>
    <div class=" bg-white rounded m-2 p-3">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th class="text-center">Status</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                        <th>Profit</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="hover">
                            <th>{{ $sale->id }}</th>
                            @if ($sale->account)
                                
                            <td>{{ $sale->account->Name }}</td>
                            @else
                            <td>{{ $sale->user->name }}</td>
                                
                            @endif
                            @if (\Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') == $today)
                                <td class="">
                                    <div class="badge  bg-blue-500 text-gray-100">Today</div>
                                </td>
                            @else
                                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                            @endif
                            <td class="flex justify-center items-center">
                                @if ($sale->status == 'completed')
                                    <div class="badge bg-green-500 text-gray-100">{{ $sale->status }}</div>
                                @elseif ($sale->status == 'pending')
                                    <div class="badge bg-amber-500 text-gray-100">Credit</div>
                                @endif
                            </td>
                            <td>{{ $sale->subtotal }}</td>
                            <td>{{ $sale->discount }}</td>
                            <td>{{ $sale->total_amount }}</td>
                            <td>{{ $sale->profit }}</td>
                            <td class=""> <button class="btn btn-sm btn-primary" wire:navigate href='{{ route('detail',['sale',$sale->id ] ) }}'>Details</button></td>
                        </tr>
                    @empty
                    @endforelse
                 
                </tbody>
            </table>
        </div>
    </div>
            <div class="flex bg-white w-full rounded m-2 p-3 items-center justify-around">
                <div> Σ Sub Total = {{ $sumSubTotal }}</div>
                <div> Σ Total = {{ $sumTotal }}</div>
                <div> Σ profit = {{ $sumProfit }}</div>
        </div>
</div>
