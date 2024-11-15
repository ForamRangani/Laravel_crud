@extends('backend.layout.main')

@section('content')

    <h1>Products</h1>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <a href="{{ route('products.create') }}" class="btn btn-success" style="margin-bottom: 20px;">Add Product</a>

    @if ($products->count())
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th, td {
                padding: 12px 15px;
                border: 1px solid #ddd;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            img {
                width: 100px;
                height: auto;
                border-radius: 5px;
            }

            .btn {
                padding: 8px 12px;
                border-radius: 4px;
                text-decoration: none;
                color: white;
            }

            .btn-primary {
                background-color: #007bff;
                margin-right: 5px;
            }

            .btn-danger {
                background-color: #dc3545;
            }

            .btn-success {
                background-color: #28a745;
            }

            .btn-primary:hover, .btn-danger:hover, .btn-success:hover {
                opacity: 0.9;
            }

            form {
                display: inline-block;
            }
        </style>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Short Description</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->short_description }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                        <td><img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->name }}"></td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products found.</p>
    @endif
@endsection
