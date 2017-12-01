@extends('layouts.app')

@section('content')
    <div id="message-to-user">
        <message-to-user-board></message-to-user-board>
    </div>
@endsection

@section('additionalJs')
    <script>
        const message_to_user = new Vue({
            el: '#message-to-user'
        });
    </script>
@endsection

