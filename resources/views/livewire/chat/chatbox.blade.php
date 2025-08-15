
<div class="h-[84vh] overflow-auto flex flex-col bg-gray-800" id="container">
    <div class="mt-auto flex flex-col space-y-2">
    

        @foreach ($messages as $message )

        @if($message->sender_id === auth()->id() && $message->image === null)
            {{-- Sender --}}
            <div wire:key="{{ $message->id . now() }}" class="bg-blue-500 w-fit max-w-[33.3333%] h-fit text-white rounded-md rounded-br-none p-3 flex flex-col mr-3 self-end">
            
                <p class="max-w-full h-fit break-words">
                   {{ $message->body }}
                </p>
            
                @if($message->receiver_read_at !== null)
                <span class="self-end flex items-center justify-center gap-2">
                   <span class="text-xs">{{ $message->created_at->format('H:i') }}</span>
                   <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0 " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                      <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                  </svg>
                </span>
                @else
            
               {{-- Single --}}
               <span class="self-end flex items-center justify-center gap-2">

                <span class="text-xs">{{ $message->created_at->format('H:i') }}</span>
                <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0 self-end" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                </svg>
                
            </span>
               @endif
            </div>

        @elseif ($message->sender_id === auth()->id() && $message->image !== null)
        
            {{-- Sender With Image--}}
            <div wire:key="{{ $message->id . now() }}" class="bg-blue-500 w-fit max-w-[33.3333%] h-fit text-white rounded-md rounded-br-none p-3 flex flex-col mr-3 self-end">
                <img src="{{ asset('storage/'.$message->image) }}" alt="">
            
            
                <p class="max-w-full h-fit break-words">
                    {{ $message->body }}
                </p>
            
                 {{-- Double --}}
                 @if($message->receiver_read_at !== null)
                 <span class="self-end flex items-center justify-center gap-2">
                    <span class="text-xs">{{ $message->created_at->format('H:i') }}</span>
                    <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0 " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                       <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                       <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                   </svg>
                 </span>
                 @else
             
                {{-- Single --}}
                <span class="self-end flex items-center justify-center gap-2">

                    <span class="text-xs">{{ $message->created_at->format('H:i') }}</span>
                    <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0 self-end" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                    </svg>

                </span>
                @endif
            </div>
        @elseif ($message->sender_id !== auth()->id() && $message->image !== null)
            {{-- Receiver with img --}}
            <div wire:key="{{ $message->id . now() }}" class="flex ml-3 items-end">
                <x-avatar/>
                <div class="bg-gray-200 w-fit max-w-[33.3333%] h-fit text-black rounded-md rounded-bl-none p-3 flex flex-col ml-3 self-start flex-wrap">
                    <img src="{{ asset('storage/'.$message->image) }}" alt="">

                
                    <p class="max-w-full h-fit break-words">
                        {{ $message->body }}
                    </p>
                
                    <span class="self-end flex items-center justify-center gap-2 text-xs">{{ $message->created_at->format('H:i') }}</span>
                </div>
            </div>
        @elseif ($message->sender_id !== auth()->id())
            {{-- Receiver --}}
            <div wire:key="{{ $message->id . now() }}" class="flex ml-3 items-end">
                <x-avatar/>
                <div class="bg-gray-200 w-fit max-w-[33.3333%] h-fit text-black rounded-md rounded-bl-none p-3 flex flex-col ml-3 self-start">
                    <p class="max-w-full h-fit break-words">
                        {{ $message->body }}
                    </p>
                
                    <span class="self-end flex items-center justify-center gap-2 text-xs">{{ $message->created_at->format('H:i') }}</span>
                </div>
            </div>

        @else

        {{ dd($message) }}
        @endif

        @endforeach


    

    
    </div>


    <script defer>
        let container = document.getElementById('container');
        window.onload = event => {
            container.scrollTo(0, container.scrollHeight)
        }
    </script>
</div>

