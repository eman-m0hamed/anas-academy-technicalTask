@extends('Template')

@section('title')
    <title>Edit Product</title>
@endsection

@section('main')
    @if (isset($notFound))
        <div>
            <p class="alert alert-danger text-center">{{ $notFound }}</p>
        </div>
    @else
        <section class="container">
            <div class="row">
                <h1 class="col-8 mt-5">Edit Product</h1>
                <form action="{{ route('products.edit', $product->id) }}" method="post" class="col-6 mx-5">
                    @method('put')
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $product->name }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ $product->price }}">
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" value="{{ $product->quantity }}">
                    </div>
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Product Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option disabled selected>Choose a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"  @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    @endif
@endsection
