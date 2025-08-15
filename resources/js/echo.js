import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: true,
    disableStats: true,
});


window.Echo.channel('chat.'+conversationId)
        .listen('NewMessage', (e) => {
            console.log(e)
            Livewire.dispatch('refresh');
            console.log('refresh dispatched');
});

window.Echo.channel('chat.'+conversationId)
        .listen('UpdateRead', (e) => {
            console.log(e)
            Livewire.dispatch('refresh');
            console.log('refresh dispatched');
});

document.getElementById('chatlist')?.dispatchEvent(
    new CustomEvent('refresh', { 
        bubbles: true,
        detail:{
            id : document.URL
        }

    })
);