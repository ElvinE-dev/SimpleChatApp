<div class="max-w-6xl mx-auto my-16">

    <h5 class="text-center text-5xl font-bold py-3 dark:text-white">Users</h5>



    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 p-2 ">

            


        {{-- child --}}
        @foreach ($data as $key=>$data)
        @if($data->id === auth()->id())
        @else
        <div class="w-full bg-white dark:bg-gray-800 border dark:border-gray-700 border-gray-200 rounded-lg p-5 shadow">
            <div class="flex flex-col items-center pb-10">

                <img src="https://picsum.photos/2{{ $key }}/200" alt="image" class="w-24 h-24 mb-2 5 rounded-full shadow-lg">

                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" >
                    {{ $data->name }}
                </h5>
                <span class="text-sm text-gray-500 dark:text-gray-300"> {{ $data->email }}</span>

                <div class="flex mt-4 space-x-3 md:mt-6">

                    <x-secondary-button>
                        Add Friend
                    </x-secondary-button>

                    <x-primary-button wire:click="createConversation({{ $data->id }})">
                        Message
                    </x-primary-button>

                </div>

            </div>
        </div>
        @endif
        @endforeach

    </div>

</div>