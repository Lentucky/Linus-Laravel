@extends('layouts.app')

@section('body')
<div class="admin-wrapper">
    @include('partials.admin-navbar')
    
    <main class="admin-content">
        @yield('content')
    </main>
</div>
@endsection
