<div>
    <form wire:submit="save">
        <input type="file" wire:model.live="image">

        <button  type="submit" class="btn btn-md">Save photo</button>
    </form>
    <div>
        
    
        {{-- @if($path)
            <img src="{{ asset('storage/'.$path) }}" alt="Uploaded Photo">
        @endif --}}
        <img src="{{ $imageUrl }}" alt="skfj">

    
    @include('livewire.err')
</div>
