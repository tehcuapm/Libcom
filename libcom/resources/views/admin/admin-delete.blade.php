@extends('layouts.base')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ 'styles/global.css' }}">
    <link rel="stylesheet" href="{{ 'styles/admin.css' }}">
    <link rel="stylesheet" href="{{ 'styles/admin-delete.css' }}">
    <title>Animalscom</title>
</head>

<body>
    @section('content')
        @include('admin.admin-layout')
        <div id="content">
            <div id="form-del">
                <form method="POST" action="{{ route('delete.article') }}">
                    @csrf
                    @method('DELETE')
                    <select id="select-del" name="article">
                        @foreach ($articles as $article)
                            <option value="{{ $article->id }}">
                                {{ $article->title }}
                            </option>
                        @endforeach
                    </select>
                    <button id="button-del">Delete Article</button>
                </form>
            </div>
        </div>
    @endsection
</body>
@push('scripts')
    <script src="js/adminajax.js"></script>
@endpush

</html>
