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

    <h1>Add Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Product Name</label>
        <input type="text" name="name" required>

        <label for="price">Price</label>
        <input type="number" name="price" required>

        <label for="short_description">Short Description</label>
        <textarea name="short_description" required></textarea>

        <label for="long_description">Long Description</label>
        <textarea name="long_description" required></textarea>

        <label for="image">Product Image</label>
        <input type="file" name="image" required>

        <!-- Category Dropdown -->
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <!-- Subcategory Dropdown (Initially empty) -->
        <label for="subcategory_id">Subcategory</label>
        <select name="subcategory_id" id="subcategory_id">
            <option value="">Select Subcategory</option>
        </select>

        <button type="submit">Add Product</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Listen for changes on the category dropdown
            $('#category_id').change(function() {
                var category_id = $(this).val(); // Get the selected category ID

                // Send an AJAX request to get the subcategories based on the category
                if (category_id) {
                    $.ajax({
                        url: "{{ route('getSubcategories') }}", // This is the route you will create
                        type: "GET",
                        data: {category_id: category_id},
                        success: function(data) {
                            // $('#subcategory_id').empty(); // Clear previous options
                            // $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                            // $.each(data, function(key, value) {
                            //     $('#subcategory_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            // });
                            $('#subcategory_id').html();
                            $('#subcategory_id').html(data);

                        }
                    });
                } else {
                    $('#subcategory_id').empty(); // Clear the subcategory dropdown if no category is selected
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                }
            });
        });
    </script>
@endsection
