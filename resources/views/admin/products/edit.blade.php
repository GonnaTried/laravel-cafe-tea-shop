@extends('admin.layout.index')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">Edit Product: {{ $product->name }}</h1>

        <div class="box">

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Product Name --}}
                <div class="field">
                    <label class="label" for="name">Name <span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input @error('name') is-danger @enderror" type="text" name="name" id="name"
                            value="{{ old('name', $product->name) }}" required autofocus>
                    </div>
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="category_id">Category <span class="has-text-danger">*</span></label>
                    <div class="control">
                        <div class="select is-fullwidth @error('category_id') is-danger @enderror">
                            <select name="category_id" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('category_id')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="field">
                    <label class="label" for="description">Description</label>
                    <div class="control">
                        <textarea class="textarea @error('description') is-danger @enderror" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ingredients --}}
                <div class="field">
                    <label class="label" for="ingredients">Ingredients</label>
                    <div class="control">
                        <textarea class="textarea @error('ingredients') is-danger @enderror" name="ingredients" id="ingredients">{{ old('ingredients', $product->ingredients) }}</textarea>
                    </div>
                    @error('ingredients')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="field">
                    <label class="label" for="price">Price <span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input @error('price') is-danger @enderror" type="number" name="price"
                            id="price" value="{{ old('price', $product->price) }}" required min="0"
                            step="0.01"> {{-- step="0.01" for decimals --}}
                    </div>
                    @error('price')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Inventory --}}
                <div class="field">
                    <label class="label" for="inventory">Inventory <span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input @error('inventory') is-danger @enderror" type="number" name="inventory"
                            id="inventory" value="{{ old('inventory', $product->inventory) }}" required min="0">
                    </div>
                    @error('inventory')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div class="field">
                    <label class="label" for="image">Product Image</label>
                    <div class="file has-name is-fullwidth @error('image') is-danger @enderror">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image" id="image" accept="image/*">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                            </span>
                            <span class="file-name" id="file-name">
                                {{ $product->image_path ? basename($product->image_path) : 'No file chosen' }}
                            </span>
                        </label>
                    </div>
                    @error('image')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                    {{-- Display current image --}}
                    @if ($product->image_path)
                        <figure class="image is-128x128 mt-4">
                            <img src="{{ asset($product->image_path) }}" alt="Current Product Image">
                        </figure>
                    @endif
                </div>


                {{-- Submit and Cancel Buttons --}}
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">Save Changes</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.products.index') }}" class="button is-link is-light">Cancel</a>
                    </div>
                </div>

            </form>
        </div>

    </div>

    {{-- JavaScript to display the chosen file name --}}
    @push('scripts')
        <script>
            const fileInput = document.getElementById('image');
            const fileNameSpan = document.getElementById('file-name');

            if (fileInput) {
                fileInput.onchange = () => {
                    if (fileInput.files.length > 0) {
                        fileNameSpan.textContent = fileInput.files[0].name;
                    } else {
                        fileNameSpan.textContent = 'No file chosen';
                    }
                }
            }
        </script>
    @endpush

@endsection
