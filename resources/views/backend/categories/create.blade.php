@extends('backend.layout.main')

@section('content')

<link rel="stylesheet" href="{{ asset('backend/dist/css/admin_cat.css') }}">

    <div class="form-container">
        <h1>Add Category</h1>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <form action="{{ route('category.store') }}" method="POST" class="form-box">
            @csrf
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" name="name" class="form-input" required>
            </div>


            <button type="submit" class="submit-btn">Add Category</button>
        </form>
    </div>
@endsection
