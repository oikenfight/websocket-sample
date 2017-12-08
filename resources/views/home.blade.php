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
                                <li class="list-group-item"><a href="{{ route('message.index') }}">message to broadcast</a></li>
                                <li class="list-group-item"><a href="{{ route('message-to-users.index') }}">message to a users</a></li>
                                <li class="list-group-item"><a href="{{ route('message-to-group.index') }}">message to a group users</a></li>
                                <li class="list-group-item"><a href="{{ route('message-to-presence.index') }}">message to presence users</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
