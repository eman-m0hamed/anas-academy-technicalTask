@extends('Template')

@section('title')
    <title>create Product</title>
@endsection

@section('main')
    <section class="container">
        <div class="row">
            <h1 class="col-8 mt-5">Create New Product</h1>
            <form action="{{ route('product.store') }}" method="post" class="col-6 mx-5">
                @csrf
                <div class="mt-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}*</div>
                @enderror

                <div class="mt-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price') }}">
                </div>
                @error('price')
                    <div class="text-danger">{{ $message }}*</div>
                @enderror

                <div class="mt-3">
                    <label for="quantity" class="form-label">Product Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                        name="quantity" value="{{ old('quantity') }}">
                </div>
                @error('quantity')
                    <div class="text-danger">{{ $message }}*</div>
                @enderror


                <div class="mt-3">
                    <label for="category_id" class="form-label">Product Category</label>
                    <input type="number" class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" value="{{ old('category_id') }}">
                </div>
                @error('category_id')
                    <div class="text-danger">{{ $message }}*</div>
                @enderror


                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </section>
@endsection
