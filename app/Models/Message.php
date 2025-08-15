<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{

    use HasFactory;
    protected $fillable = [
        'body',
        'image', 
        'sender_id', 
        'sender_read_at',
        'receiver_read_at',
        'receiver_id',
        'conversation_id'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}
