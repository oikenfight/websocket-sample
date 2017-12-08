@extends('layouts.app')

@section('content')
    <div id="message-to-presence">
        <message-to-presence-board v-bind:auth-user="{{ Auth::user() }}"></message-to-presence-board>
    </div>
@endsection

@section('additionalJs')
    <script>
        const message_to_presence = new Vue({
            el: '#message-to-presence'
        });
    </script>
@endsection

