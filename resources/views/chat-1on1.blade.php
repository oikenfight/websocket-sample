@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Chat 1on1</div>
                    </div>

                    {{-- Form Panel --}}
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Form
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::open(['class' => 'form form-horizontal']) !!}
                                        <div class="form-group">
                                            {!! Form::label('to_user', 'To', ['class' => 'control-label col-sm-1']) !!}
                                            <div class="col-sm-2">
                                                {!! Form::select('to_user', ['sample user', 'sample user', 'sample user'], '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            {!! Form::label('to_user', 'Message', ['class' => 'control-label col-sm-1']) !!}
                                            <div class="col-sm-10">
                                                {!! Form::text('message', '', ['class' => 'form-control', 'placeholder' => 'message']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-offset-1 col-sm-2">
                                                {!! Form::button('submit', ['class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Message Panel --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Messages
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel">
                                            message 1
                                        </div>
                                        <div class="panel">
                                            message 2
                                        </div>
                                        <div class="panel">
                                            ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
