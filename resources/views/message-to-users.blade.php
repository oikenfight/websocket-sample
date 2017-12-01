@extends('layouts.app')

@section('content')
    <div id="message-to-users">
        <message-to-users-board></message-to-users-board>
    </div>
@endsection

@section('additionalJs')
    <script>
        const message_to_user = new Vue({
            el: '#message-to-users'
        });
    </script>
@endsection

