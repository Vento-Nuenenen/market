@extends('layouts.app')

@section('index-frame')
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@endsection
