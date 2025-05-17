@extends('layouts.app')

@section('body')
<header>
    @include('partials.customer-navbar')
</header>

<main class="customer-content">
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} My Cinema</p>
</footer>
@endsection
