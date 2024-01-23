@extends('Template')

@section('title')
    <title>All Products</title>
@endsection

@section('style')
    <style>

        table form {
            display: inline-block;
            margin-left: 10px
        }

        h1 {
            margin-top: 20px;
        }
    </style>
@endsection

@section('main')
    <section class="container">
        <h1>All Products</h1>
        <a href="{{ route('product.create') }}" style="font-size:20px; display:inline-block; margin:20px 5px 5px;">create new
            Product</a>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="">
            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Product Price</th>
                        <th>Product quantity</th>
                        <th>Created at</th>
                        <th>Action</th>
                    <tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            {{-- <td>{{ $product->category->name }}</td> --}}
                            <td>{{ $product->category_id }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>
                                <form action="{{ route('product.show', $product->id) }}" method="get">
                                    <button class="btn btn-primary">Show</button>
                                </form>
                                <form action="{{ route('product.update', $product->id) }}" method="get">
                                    <button class="btn btn-success">Edit</button></form>
                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                    @method('delete')
                                    @csrf()
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $products->links() }} --}}
        </div>
    </section>
@endsection
