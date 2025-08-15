<?php

namespace App\Livewire\Chat;

use App\Events\NewMessage;
use App\Events\UpdateRead;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;




class Chatlist extends Component
{
    public $conversations;
    
    public $data;


    protected $listeners = ['refresh' => 'refresh'];


    public function mount($data, $conversations){
        $this->data = $data;
        $this->conversations = $conversations;
    }

    
    #[\Livewire\Attributes\On('refresh')]
    public function refresh()
    {
        return '';
    }

    public function updateRead($id){
        $message = Message::where('conversation_id' , $id)->get()->sortByDesc('created_at')->first();

        if($message->sender_id === auth()->id()){
            
        }
        else{
            $message->update([
                'receiver_read_at' => now()
            ]);
        }
        broadcast(new UpdateRead($id));
        // redirect(route('chat.chat', $id));
    }

    public function render()
    {
        return view('livewire.chat.chatlist');
    }
}
