@extends('layouts.app')

@section('content')
    <div id="message-to-group">
        <message-to-group-board></message-to-group-board>
    </div>
@endsection

@section('additionalJs')
    <script>
        const message_to_group = new Vue({
            el: '#message-to-group'
        });

        const myGroup = "{{ Auth::user()->group }}";
    </script>
@endsection

