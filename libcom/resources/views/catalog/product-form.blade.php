<head>
    <link rel="stylesheet" href="{{ asset('styles/product-form.css') }}">
</head>
<div id="form-admin">
    <div id="content">

        <form action="{{ route('update.article', ['article' => $article]) }}" method="POST"
              enctype="multipart/form-data">
            @method('put')
            @csrf
            <h2 id="h2-admin">Animalscom</h2>
            <div class="form-sect">
                <label>Name : </label>
                <input class="input-admin" type="text" name="title"
                       class="{{ $errors->has('title') ? 'invalid-input' : 'valid-input' }}"
                       value="{{ $article->title }}">
                @error('title')
                <div class="form-error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-sect">
                <label>Description : </label>
                <input class="input-admin" type="text" name="speech"
                       class="{{ $errors->has('speech') ? 'invalid-input' : 'valid-input' }}"
                       value="{{ $article->speech }}">
                @error('speech')
                <div class="form-error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-sect">
                <label>Item on stock: </label>
                <input class="input-admin" type="number" name="stock" min="0"
                       class="{{ $errors->has('stock') ? 'invalid-input' : 'valid-input' }}"
                       value="{{ $article->stock }}">
                @error('stock')
                <div class="form-error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-sect">
                <label>Price :</label>
                <input class="input-admin" type="number" name="price" min="0"
                       class="{{ $errors->has('price') ? 'invalid-input' : 'valid-input' }}"
                       value="{{ $article->price }}">
                @error('price')
                <div class="form-error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-sect">
                <label>Category :</label>
                <select class="input-admin" name="category_id" autocomplete="off">
                    @foreach ($categories as $category)
                        <option value={{ $category->id }}
                            {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-sect">
                <p>Image :</p>
                <select class="input-admin" name="image_id" autocomplete="off">
                    @foreach ($images as $image)
                        <option value={{ $image->id }}


                            {{ $article->images->first() != null && $article->images->first()["id"] == $image->id ? 'selected' : '' }}>
                            {{ $image->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-sect">
                <button>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
