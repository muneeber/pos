<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="navbar  bg-white  gap-x-12  p-3 px-8">
        <h1 class="text-4xl font-bold">Purchases:</h1>
        <form wire:submit.prevent='byDate' class="flex gap-2 justify-center ">
            <input type="date" wire:model='startDate' class="rounded input-sm"> To <input wire:model='endDate'
                type="date" class="rounded input-sm"> <input class="btn btn-sm btn-primary" type="submit">
        </form>
        <div class=" flex justify-around">

            <a href="{{ route('purchase.create') }}" class="btn btn-md ml-4 btn-accent">New Purchase</a>
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
                        <th>Total Amount</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="hover">
                            <th>{{ $sale->id }}</th>
                            <td>{{ $sale->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                            <td>{{ $sale->total_amount }}</td>
                            <td class=""> <button class="btn btn-sm btn-primary">Details</button></td>
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
