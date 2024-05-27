<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Laravel 11 CRUD Operation</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
              <a href="{{ route('product.list') }}" class="btn btn-dark">Back</a>
            </div>
          </div>

        <div class='row d-flex justify-content-center'>
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-3">
                    <div class="card-header">
                        <h3> Create Product </div>
                    </div>
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name"
                                name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">SKU</label>
                                <input value="{{ old('sku') }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="SKU"
                                name="sku">
                                @error('sku')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Price</label>
                                <input value="{{ old('price') }}" type="text" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price"
                                name="price">
                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea class="form-control" placeholder="Description"
                                name="description" col="30" rows="5"> {{ old('description')}} </textarea>
                            </div>

                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control form-control-lg" placeholder="Image"
                                name="image">
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-dark">Submit</button>
                            </div>

                        <div>
                    </form>

                </div>
            <div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>