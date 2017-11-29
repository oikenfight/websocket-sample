@extends('layouts.app')

@section('content')
    <div class="container">
        <input type="button" value="push" onclick='push()'>
        <ul id="messages"></ul>
    </div>

@endsection

@section('additionalJs')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        function push(){
            $.get('/pusher');
        }

        Echo.channel("{{ App\Events\PusherEvent::CHANNEL_NAME }}")
            .listen(".{{ App\Events\PusherEvent::EVENT_NAME }}", (data) => {
                $('#messages').prepend('<li>' + data.message + '</li>');
            });
    </script>
@endsection
