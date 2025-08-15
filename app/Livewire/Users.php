<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $data = User::all();
        return view('livewire.users', ['data' => $data])->layout('layouts.app');
    }

    public function createConversation(Int $id){
        $newConversation = Conversation::create([
            'receiver_id' => $id,
            'sender_id'=> auth()->id(),
        ]);

        return redirect('chat/'.$newConversation->id);

    }
}
