@extends('layouts.app')

@section('content')
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                {!! Form::open(array('route' => 'users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                <div class="input-group" id="adv-search">
                    {!! Form::text('search', NULL, array('id' => 'search', 'class' => 'form-control', 'placeholder' => 'Suche', 'autofocus')) !!}
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary form-control">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="input-group" id="adv-search">
                    <button onclick="location.href='{{ route('add-users') }}'" type="button" class="btn btn-primary form-control mt-2">Neuer Benutzer</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Benutzer</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Optionen</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->scoutname)
                                    {{ $user->firstname }} {{ $user->lastname }} / {{ $user->scoutname }}
                                @else
                                    {{ $user->firstname }} {{ $user->lastname }}
                                @endif
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <button onclick="location.href='{{ route('edit-users',$user->id) }}'" class="btn btn-info ml-2"><span class="fa fa-edit"></span></button>
                                <button onclick="location.href='{{ route('destroy-users',$user->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
