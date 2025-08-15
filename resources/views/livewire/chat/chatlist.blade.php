<div class="{{  !empty(request()->route('id')) ? 'hidden md:block' : 'w-screen h-screen md:h-full' }} md:w-5/12 lg:w-3/12 border border-gray-400 h-full bg-gray-800 rounded-md">
    {{-- Header --}}
    <div class="border-b border-white/20 h-1/6">
        <div class="flex items-center justify-between p-5">
            <h1 class="dark:text-white font-sans text-2xl">Chatapp</h1> 


            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <svg  class="dark:text-white w-8 h-8 p-2 hover:bg-gray-700 rounded-full transition-colors" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                    </svg>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        {{-- Search --}}
        <form action="" class="w-full px-5 flex items-center" method="get">
            @csrf

            <input type="text" name="search" class="search dark:text-white w-10/12 h-8 focus:ring-0 rounded-l-full bg-gray-700 placeholder:text-gray-300 placeholder:text-sm border border-y-0 border-l-0 border-r border-white/20" placeholder="Search Here...">

            <label for="submit" class="w-2/12 h-8 bg-gray-700 flex items-center justify-center rounded-r-full">

                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>

            </label>
            <input type="submit"  id="submit" value="" hidden>
        </form>
    </div>

{{-- ChatList --}}
    <div class="flex flex-col w-full h-5/6 overflow-auto pt-3">
        @foreach($conversations as $key => $conversation)
                <div class="w-full h-16 bg-gray-800 hover:bg-gray-900 flex items-center p-5 mt-3">
                    <a href="/chat/{{ $conversation->id }}" class="w-2/12 flex items-center justify-center" wire:click="updateRead({{ $conversation->id }})">
                        <x-avatar src=""/> 
                    </a>
                    <a class="info w-9/12" href="/chat/{{ $conversation->id }}" wire:click="updateRead({{ $conversation->id }})">
                        <span class="flex justify-between">
                            <p class="truncate dark:text-white">{{ $conversation->receiver()->name }}</p>
                            @if($conversation->unread() !== 0)
                            <p class="dark:text-white bg-blue-500 rounded-full px-1 w-fit h-4 flex justify-center items-center">{{ $conversation->unread() }}</p>
                            @endif
                        </span>
                        @if(!empty($conversation->messages->sortByDesc('created_at')->first()))
                        <div class="flex items-center">
                            {{-- Double --}}
                            @if($conversation->messages->sortByDesc('created_at')->first()->sender_id === auth()->id() && $conversation->messages->sortByDesc('created_at')->first()->receiver_read_at !== null )
                            <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                            
                            @elseif($conversation->messages->sortByDesc('created_at')->first()->sender_id !== auth()->id())
                            @else
                            {{-- Single --}}
                            <svg class="dark:text-white w-4 h-4 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                            </svg>

                            @endif
                            <p class="truncate dark:text-white text-sm">
                                {{ $conversation->latest() }}
                            </p>

                        </div>
                        @endif
                    </a>

                    <div class="w-1/12">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <svg  class="dark:text-white w-8 h-8 p-2 hover:bg-gray-700 rounded-full transition-colors" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                </svg>
                            </x-slot>
                        
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
        @endforeach
            
    </div>
</div>
