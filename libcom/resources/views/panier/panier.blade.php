@extends('layouts.base')
    <!DOCTYPE html>
<html lang="fr">

<head>
    @push("head")
        <link rel="stylesheet" href="{{asset('styles/panier.css')}}"/>

    @endpush

</head>

<body>
@section('content')
    @if(session()->has("message"))
        <div>{{session('message')}}</div>
    @endif
    <div id="content">
        <table class="table-style" id="panier">
            <thead>
            </thead>
            <tbody>

            </tbody>
        </table>


    </div>
@endsection
</body>
@push("scripts")
    <script src="/js/panierview.js"></script>
@endpush
</html>
