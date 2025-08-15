
@if (!empty(auth()->id()))
<div class="bg-gray-900 md:w-[95vw] md:h-[95vh] w-full h-full flex items-center justify-center">
    {{ $id = request()->route('id') }}

    <span id="chatlist"></span>

    
    <livewire:chat.chatlist  :conversations="$conversations" :data="$data" wire:key="chatlist" wire:id="chatlist"/>
    

    <livewire:chat.chat :data="$data" :id="$id" wire:key="chatbox"/>
</div>

@else
<div>
    <script defer>
        window.location.href = '/login'
    </script>
</div>
@endif