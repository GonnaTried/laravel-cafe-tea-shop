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

                {{-- Item Options (Radio Buttons) --}}
                <div class="field">
                    <label class="label">Available Options <span class="has-text-danger">*</span></label>
                    {{-- Added required indicator --}}
                    <div class="control">
                        {{-- Use a single radio button group --}}
                        @foreach ($itemOptions as $option)
                            @php
                                // Check if this option is currently attached to the product OR was previously selected
                                // We expect the product to have *one* option attached now
                                $isChecked =
                                    old('selected_option_id', optional($product->itemOptions->first())->id) ==
                                    $option->id;
                            @endphp

                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="selected_option_id" value="{{ $option->id }}"
                                        {{ $isChecked ? 'checked' : '' }} required> {{-- Made radio required --}}
                                    {{ $option->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('selected_option_id')
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

                {{-- Display current image / Image Preview  --}}
                <div class="field">
                    <label class="label">Product Image</label>
                    <div class="control">
                        {{-- Modify the existing figure/img element to have the ID --}}
                        <figure class="image is-128x128 mt-4">
                            <img id="image-preview" src="{{ $product->image_url }}" alt="Current Product Image">
                        </figure>
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="field">
                    {{-- <label class="label" for="image">Choose New Image</label> Changed label text slightly --}}
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
            const imagePreview = document.getElementById('image-preview'); // Get the preview element

            // Add console logs to help debug
            console.log('Script loaded for product edit.');
            console.log('fileInput:', fileInput);
            console.log('fileNameSpan:', fileNameSpan);
            console.log('imagePreview:', imagePreview);
            console.log('Initial imagePreview src:', imagePreview ? imagePreview.src : 'Element not found');


            if (fileInput && fileNameSpan && imagePreview) { // Check if all elements are found
                fileInput.onchange = () => {
                    console.log('File input change event fired.');

                    if (fileInput.files.length > 0) {
                        const selectedFile = fileInput.files[0];
                        console.log('File selected:', selectedFile);

                        // Update file name display
                        fileNameSpan.textContent = selectedFile.name;

                        // Check if the selected file is an image before trying to preview
                        if (selectedFile.type.startsWith('image/')) {
                            console.log('File is an image. Reading for preview.');
                            // Read the selected file for preview
                            const reader = new FileReader();

                            reader.onload = (e) => {
                                console.log('FileReader onload complete. Setting preview src.');
                                // Set the image source to the data URL
                                imagePreview.src = e.target.result;
                            };

                            reader.onerror = (e) => {
                                console.error('FileReader error:', e);
                                // Optionally show a broken image or placeholder on error
                                imagePreview.src =
                                    "{{ asset('images/error_placeholder.png') }}"; // Make sure you have an error placeholder
                            };

                            // Read the file as a Data URL
                            reader.readAsDataURL(selectedFile);
                        } else {
                            console.log('Selected file is not an image.');
                            // If a non-image is selected, revert to the original image
                            imagePreview.src = "{{ $product->image_url }}";
                        }


                    } else {
                        console.log('No file selected.');
                        // Reset file name and preview if no file is chosen
                        fileNameSpan.textContent = 'No file chosen';
                        // On edit, reset to the *original* image URL if user deselects the file
                        imagePreview.src = "{{ $product->image_url }}";
                    }
                }
            } else {
                console.error('One or more required elements for image preview not found.');
            }
        </script>
    @endpush

@endsection
