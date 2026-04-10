@include('layouts.header')

<main>
  @yield('content')
</main>

@include('layouts.footer')

<script src="{{ asset('js/dropdown.js') }}" defer></script>