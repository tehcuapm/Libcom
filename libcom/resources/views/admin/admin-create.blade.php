@extends('layouts.base')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('styles/admin.css') }}" />
    <title>Animalscom</title>
</head>

<body>
    @section('content')
        @include('admin.admin-layout')
        <div id="content">
            <div class="form-container">
                <h2>Animalscom</h2>


                <form action="{{ Route('new.article') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-sect">
                        <input class="input-admin" type="text" name="title"
                            class="{{ $errors->has('title') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('title') }}" placeholder="Name">
                        @error('title')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">
                        <input class="input-admin" type="text" name="speech"
                            class="{{ $errors->has('speech') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('speech') }}" placeholder="Description">
                        @error('speech')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">
                        <input class="input-admin" type="number" name="stock" min="0"
                            class="{{ $errors->has('stock') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('stock') }}" placeholder="Items on Stock">
                        @error('stock')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">
                        <input class="input-admin" type="number" name="price" min="0"
                            class="{{ $errors->has('price') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('price') }}" placeholder="Price">
                        @error('price')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sect">
                        <select class="input-admin" name="category_id">
                            <option value="1">Chien</option>
                            <option value="2">Chat</option>
                        </select>
                    </div>
                    <div class="form-sect">
                        <input class="input-admin" type="file" accept="image/png, image/jpeg" name="path_file"
                            class="{{ $errors->has('path_file') ? 'invalid-input' : 'valid-input' }}"
                            value="{{ old('path_file') }}" placeholder="Image">
                        @error('path_file')
                            <div class="form-error-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-sect">
                        <button>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

</body>
@push('scripts')
    <script src="js/adminajax.js"></script>
@endpush

</html>
