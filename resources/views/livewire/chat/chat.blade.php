
<div class=" {{ empty(request()->route('id')) ? 'hidden' : 'w-screen' }} md:w-7/12 lg:w-9/12 border border-gray-400 h-full bg-gray-800 rounded-md md:flex flex-col relative">

    @if(!empty($data))

    {{-- Header --}}
    <div class="flex sticky top-0 items-center justify-start p-5 w-full h-20 border-b bg-gray-800 border-white/20 gap-2
    ">
        <a href="/chat" class="dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-7 w-7" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
        </a>
        <x-avatar/>
        <h1 class="ml-3 dark:text-white text-lg">{{ $receiver ?->name }}</h1>
    </div>

    <livewire:chat.chatbox :data="$data"/>

    <form enctype="multipart/form-data" wire:submit.prevent ="post" method="post" class="w-full h-16 flex sticky bottom-0 flex-shrink-0">
        <img src="" alt="" id="preview" class="w-48 absolute bottom-24 left-12">
        @csrf

        <label for="image" class="w-1/12 flex items-center justify-center dark:text-white bg-gray-800 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
            </svg>
        </label>
        <input type="text" name="body" wire:model="body" class="w-10/12 bg-gray-800 border-0 text-white focus:ring-0" placeholder="Type A Message">

        <label for="send" class="w-1/12 flex items-center justify-center dark:text-white bg-gray-800 text-lg rounded-br-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
              </svg>
        </label>

        <input type="file" name="image" wire:model="image" id="image" hidden>

        <input type="submit" value="" name="send" id="send">
    </form>

    @else
    <p class="dark:text-white flex items-center justify-center w-full h-full">Start an conversation</p>
    @endif


    <script defer>
        let imgInput = document.getElementById('image');
        let preview = document.getElementById('preview');

        imgInput.onchange = event =>{
            let [files] = imgInput.files
            preview.setAttribute('src', URL.createObjectURL(files))
        }
    </script>

    @if(!empty($data->id))
    <script defer>
        let conversationId =  @json($data->id)
    </script>
    @endif
</div>
