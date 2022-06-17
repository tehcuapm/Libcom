@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    @push("head")
        <link rel="stylesheet" href="{{asset('styles/admin-users.css')}}"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    @endpush

</head>

<body>
@section('content')
    @if(session()->has("message"))
        <div>{{session('message')}}</div>
    @endif
    <div id="content">

        <table id="users">
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
@endsection
</body>
@push("scripts")
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script src="/js/admin_users.js"></script>
@endpush
</html>
