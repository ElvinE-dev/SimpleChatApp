<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversation';

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function receiver(){
        return User::find($this->sender_id === auth()->id() ? $this->receiver_id : $this->sender_id);
    }

    public function unread(){
        $column = $this->sender_id === auth()->id() ?  'sender_read_at' : 'receiver_read_at';
        return Message::where('conversation_id', $this->id)
        ->whereNull($column)->count();
    }
    public function latest(){
        return Message::where('conversation_id', $this->id)->get()->sortByDesc('created_at')->first()->body;
    }

    protected $fillable = [
        'receiver_id',
        'sender_id'
    ];
}
