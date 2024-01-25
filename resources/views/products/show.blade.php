@extends('Template')

@section('title')
    <title>Show Product</title>
@endsection

@section('style')
    <style>
        * {
            box-sizing: border-box;
        }

        .content {
            width: 600px;
            margin: 10px 10px 30px;
            padding-bottom: 15px;
            border: 1px solid rgba(0, 0, 0, 0.295);
            border-radius: 5px;
            font-size: 23px;
            overflow: hidden;
        }

        .content p {
            margin-left: 25px;
        }

        .content p:first-child {
            color: red;
            background: #f0f0f0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.295);
            padding: 10px;
            margin: 0;
        }

        .content span {
            font-weight: bolder;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('main')
    <section class="container">
        <h1>Product Show</h1>
        @if (isset($notFound))
            <div>
                <p class="alert alert-danger text-center">{{ $notFound }}</p>
            </div>
        @else
            @if (Session::has('success'))
                <div class="alert alert-success" style="width:600px">{{ Session::get('success') }}</div>
            @endif
            <div class="content">

                <p>Product info</p>

                <p> <span>Name:- </span> {{ $product->name }} </p>
                <p> <span> category:- </span> {{ $product->category_id }} </p>
                <p> <span> Price:- </span> {{ $product->price }} </p>
                <p> <span> Quantity:- </span> {{ $product->quantity }} </p>
                <p> <span>Created at:- </span> {{ $product->created_at }} </p>

                <div class="d-flex gap-3 mx-5 justify-content-end">
                    <form action="{{ route('products.update', $product->id) }}" method="get">
                        <button class="btn btn-success">Edit</button>
                    </form>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @method('delete')
                        @csrf()
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endif

    </section>
@endsection
