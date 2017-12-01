@extends('layouts.app')

@section('content')
    <div id="message">
        <message-board></message-board>
    </div>
@endsection

@section('additionalJs')
    <script>
        const message = new Vue({
            el: '#message'
        });
    </script>
@endsection

