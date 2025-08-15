<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSenderOrReceiver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $conversation_id = $request->route('id');

        $conversation = Conversation::findOrFail($conversation_id);

        if(auth()->id() === $conversation->sender_id || auth()->id() === $conversation->receiver_id){
            return $next($request);
        }else{
            return redirect('/chat');
        }

    }
}
