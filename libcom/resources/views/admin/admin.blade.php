@extends('layouts.base')
    <!DOCTYPE html>
<html lang="en">


@push("head")
    <link rel="stylesheet" href="{{ 'styles/admin-dashboard.css' }}">
@endpush


<body>
@section('content')
    @include('admin.admin-layout')
    <div id="content">
        <div class="buttons-div">
            <div>
                <a href="{{ route('admin.createArticle') }}">Create Article</a>
            </div>

            <div>
                <a href="{{ route('admin.deleteArticle') }}">Delete Article</a>
            </div>
            <div>
                <a href="{{ route('admin.addImg') }}">Add/Delete Image</a>
            </div>


        </div>
    </div>
@endsection
</body>
@push('scripts')
    <script src="js/adminajax.js"></script>
@endpush


</html>
