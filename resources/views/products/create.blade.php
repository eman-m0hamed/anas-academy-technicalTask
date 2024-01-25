@extends('Template')

@section('title')
    <title>create Product</title>
@endsection

@section('main')
    <section class="container">
        <section class="row pt-5">
            <h1 class="col-8" id="form-title">Create New Product</h1>

            {{-- ajax form --}}
            <form id="product-form" class="col-6 mx-5">
                @csrf

                {{-- product name field --}}
                <div class="mt-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                {{-- product price field --}}
                <div class="mt-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>

                {{-- product quantity field --}}
                <div class="mt-3">
                    <label for="quantity" class="form-label">Product Quantity</label>
                    <input type="number" class="form-control invalid" id="quantity" name="quantity">
                </div>

                {{-- product category field --}}
                <div class="mt-3">
                    <label for="category_id" class="form-label">Product Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option disabled selected>Choose a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- submit button --}}
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </section>

    </section>
@endsection

@section('script')
<!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- AJAX script -->
    <script>
        $(document).ready(function() {
            $('#product-form').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                // Serialize the form data
                let formData = $(this).serialize();

                // remove errors from form
                $('#product-form input').removeClass('border-danger');
                $('#product-form select').removeClass('border-danger');
                $('#product-form .error-message').remove();

                // Send an AJAX request
                $.ajax({
                    url: "/api/products",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        // display success response message
                        $('#form-title').before("<div class= 'alert alert-success'>" + response.message + "</div>");

                        // reset the from
                        $("#product-form"). reset();
                    },

                    error: function(error) {
                        let response = error.responseJSON;
                        console.log(response);
                        if (response.errors && typeof(response.errors) === "object" && !Array.isArray(response.errors)) {

                            // Iterate over the errors object and display them after each input
                            $.each(response.errors, function(field, errors) {
                                $('input[name="' + field + '"]').addClass('border-danger');
                                $('select[name="' + field + '"]').addClass('border-danger');

                                $('<div class="error-message text-danger">' + errors[0] + '*' + '</div>')
                                    .insertAfter($('input[name="' + field + '"]'));

                                $('<div class="error-message text-danger">' + errors[0] + '*' + '</div>')
                                    .insertAfter($('select[name="' + field + '"]'));

                            });
                        }

                    }
                });
            });
        });
    </script>
@endsection
