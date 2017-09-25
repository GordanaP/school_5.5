<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} @yield('title')</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/classes.css') }}" rel="stylesheet">

<!-- Icons -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/elegant-icons-style.css') }}">

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => [
            'name' => Auth::check() && Auth::user()->name,
            'role' => [
                'teacher' => Auth::check() && Auth::user()->isTeacher(),
                'student' => Auth::check() && Auth::user()->isStudent(),
                'parent' => Auth::check() && Auth::user()->isParent(),
                'admin' => Auth::check() && Auth::user()->isAdmin(),
                'superadmin' => Auth::check() && Auth::user()->isSuperAdmin(),
            ]
        ],
    ]) !!};
</script>