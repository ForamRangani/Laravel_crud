@extends('backend.layout.main')

@section('content')
<div class="container">
    <h2>Subcategories</h2>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <a href="{{ route('subcategories.create') }}" class="btn btn-success">Add Subcategory</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->id }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>
                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
