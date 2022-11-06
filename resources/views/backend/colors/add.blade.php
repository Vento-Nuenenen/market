@extends('layouts.backend')

@section('content')
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="card col-md-10 offset-md-1">
            <div class="card-header">
                <h5 class="float-start">Neue Farbe</h5>

                <a href="{{  route('colors') }}" class="float-end">Zurück zu Farben</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'store-colors', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                @csrf

                <div class="row has-feedback {{ $errors->has('name') ? ' has-error ' : '' }}">
                    {!! Form::label('name', 'Farbe', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Farbe')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                    {!! Form::label('first_name', 'Vorname', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Vorname', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="first_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                    {!! Form::label('last_name', 'Nachname', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Nachname', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {!! Form::button('Benutzer erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
