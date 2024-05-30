# Laravel Realtime Chat With Websocket, Broadcasting, Pusher, Echo
## Public Channel, Private Channel(One to One chat), Presence Channel(Group Chat)

## Description
- Laravel version 10
- Use Websocket, Event, Broadcast, Pusher
- Realtime chat: Public Channel, Private Channel(One to One chat), Presence Channel(Group Chat)
- Popup realtime notification cdn: toastr
- use laravel ui, bootstrap, ui auth


## Installation
- For clone this project run this command: 
- Then rename .env.example file to .env file and add database name

- Pusher install in laravel project:composer require pusher/pusher-php-server "~3.0"

- Then run these command: 
- composer update
- php artisan optimize:clear (optional)
- php artisan serve
- websocket server start: php artisan websockets:serve




## New Project Installation
- After new laravel project install
- Install this: laravel ui, bootstrap, ui auth(if private chat needed)

- For websocket install, follow the process: https://beyondco.de/docs/laravel-websockets/getting-started/installation

- For pusher install: composer require pusher/pusher-php-server "~3.0"

- Modify the env file with following credentials.
BROADCAST_DRIVER=pusher

PUSHER_APP_ID=anyid
PUSHER_APP_KEY=anykey
PUSHER_APP_SECRET=anysecret
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1



- Modify the config/broadcasting.php,  replace the following credentials in pusher part.

 'pusher' => 
        [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => env('PUSHER_HOST'),
                'port' => env('PUSHER_PORT', 6001),
                'scheme' => env('PUSHER_SCHEME', 'http'),
                'encrypted' => true,
                // 'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],


- Install laravel echo, follow the process: https://laravel.com/docs/11.x/broadcasting#client-side-installation

- After that modify bootstrap.js, replace the following credentials in laravel-echo and pusher-js part.

import jQuery from 'jquery';
window.$ = jQuery;

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStatus: true,
});



- For websocket server start: php artisan websockets:serve

- For websocket dashboard: App\Providers\BroadcastServiceProvider::class, comment out inside config\app.php.

- Then create event what you need

- Then run these command: 
- npm run build
- npm run dev
- php artisan optimize:clear (optional)
- php artisan serve
- websocket server start: php artisan websockets:serve

- Websocket dashboard localhost:8000/laravel-websockets


## Thank You


