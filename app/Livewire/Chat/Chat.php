<?php

namespace App\Livewire\Chat;

use App\Events\NewMessage;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chat extends Component
{
    use WithFileUploads;
    
    public $data;
    public $receiver;
    public $id;
    public $body;
    public $image;




    protected $rules = [
        'body' => 'string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ];


    public function mount($data){
        $this->receiver = $data === null ? null : User::findOrFail($data->sender_id === auth()->id() ? $data->receiver_id : $data->sender_id);
        
    }




    
    public function post(){
        $this->validate();


        $id = $this->id;

        $conversation = Conversation::findOrFail($id);
        $sender = $conversation->sender_id === auth()->id() ? 'sender_read_at':'receiver_read_at';

        
        $imagePath = $this->image?->store('images', 'public');

        // $imagePath = $request->file('image') === null ? null : $request->file('image')->store('images', 'public');
    // dd($request->file('image'));

        $newMessage = Message::create([
            'body' => $this->body,
            'image' => $imagePath,
            'sender_id' => auth()->id(),
            $sender => now(),
            'receiver_id' => $conversation->receiver_id === auth()->id() ? $conversation->receiver_id : $conversation->sender_id,
            'conversation_id' => $id,
        ]);
        
        broadcast(new NewMessage($newMessage));
        $this->body = '';
        $this->image = null;

    }
    public function render()
    {
        return view('livewire.chat.chat');
    }
}
