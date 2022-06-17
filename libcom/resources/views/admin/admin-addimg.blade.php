@extends('layouts.base')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ 'styles/admin.css' }}">
    <link rel="stylesheet" href="{{ 'styles/admin-addimg.css' }}">
    <title>Animalscom</title>
</head>

<body>
    @section('content')
        @include('admin.admin-layout')
        <div id="content">
            <div id="addimage">
                <form id="form-addimage" method="POST" action="{{ route('add.image') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <p>Add an image :</p>
                        <input name="addimage" type="file" id="input-addimage">
                    </div>
                    <button id="button-addimage">Submit</button>
                </form>
            </div>
            <div id="delimage">
                <form id="form-delimage" method="POST" action="{{ route('delete.image') }}">
                    @csrf
                    @method('DELETE')
                    <div>
                        <p>Delete an image :</p>
                        <select name="image_id" id="select-delimage">
                            @foreach ($images as $image)
                                <option value="{{ $image->id }}">
                                    {{ $image->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button id="button-addimage">Submit</button>
                </form>
            </div>
        </div>
    @endsection
</body>
@push('scripts')
    <script src="js/adminajax.js"></script>
@endpush

</html>
