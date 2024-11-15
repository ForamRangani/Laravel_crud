@extends('backend.layout.main')

@section('content')
    <style>
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        label, input, select, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input, select, textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>

    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Product Name</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="price">Price</label>
        <input type="number" name="price" value="{{ $product->price }}" required>

        <label for="short_description">Short Description</label>
        <textarea name="short_description" required>{{ $product->short_description }}</textarea>

        <label for="long_description">Long Description</label>
        <textarea name="long_description" required>{{ $product->long_description }}</textarea>

        <label for="image">Product Image</label>
        <input type="file" name="image">

        <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">

        <!-- Category Dropdown -->
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- Subcategory Dropdown -->
        <label for="subcategory_id">Subcategory</label>
        <select name="subcategory_id" id="subcategory_id">
            <!-- Subcategories will be loaded via AJAX -->
        </select>

        <button type="submit">Update Product</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load subcategories based on category
            function loadSubcategories(category_id, selected_subcategory_id = null) {
                if (category_id) {
                    $.ajax({
                        url: "{{ route('getSubcategories') }}",
                        type: "GET",
                        data: { category_id: category_id },
                        success: function(data) {
                            $('#subcategory_id').empty(); // Clear previous options
                            $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                            $.each(data, function(key, value) {
                                let selected = (selected_subcategory_id == value.id) ? 'selected' : '';
                                $('#subcategory_id').append('<option value="'+ value.id +'" '+ selected +'>'+ value.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                }
            }

            // On page load, load subcategories for the current category
            loadSubcategories($('#category_id').val(), "{{ $product->subcategory_id }}");

            // Listen for changes on the category dropdown
            $('#category_id').change(function() {
                var category_id = $(this).val(); // Get the selected category ID
                loadSubcategories(category_id); // Load subcategories based on selected category
            });
        });
    </script>
@endsection
