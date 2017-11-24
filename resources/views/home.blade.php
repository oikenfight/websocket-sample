@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="{{ route('chat-1on1.index') }}">chat 1on1</a></li>
                                <li class="list-group-item"><a href="{{ route('chat-1on1.index') }}">chat 1onN</a></li>
                                <li class="list-group-item"><a href="{{ route('chat-1on1.index') }}">chat NonN</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
