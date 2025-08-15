<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class Chatbox extends Component
{

    public $messages;
    public $data;

    protected $listeners = ['refresh' => 'refreshMessages'];
    public function mount($data){
        $this->data = $data;
        $this->messages = Message::where('conversation_id', $data->id)->get();
    }

    public function refreshMessages()
    {

        $this->messages = Message::where('conversation_id', $this->data->id)->get();
    }
    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
