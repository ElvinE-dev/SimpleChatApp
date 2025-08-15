<?php

namespace App\Livewire\Chat;

use App\Events\NewMessage;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request as HttpRequest;
use Livewire\Component;

class Index extends Component
{
    public $data;
    public $conversations;


    
    public function mount($id = null){
        $this->data = $id === null ? null : Conversation::findOrFail($id);
        $user = !empty($this->data->sender_id) && $this->data->sender_id === auth()->id() ? 'sender_read_at' : 'receiver_read_at';
        $this->conversations = Conversation::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->get();

        Message::where('conversation_id', $id)
        ->whereNull($user)
        ->update([
            $user => now()
        ]);

    }


    public function render()
    {
        return view('livewire.chat.index')->layout('layouts.app');
    }

}
