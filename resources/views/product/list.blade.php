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
            <a href="{{ route('product.create') }}" class="btn btn-dark">Create</a>
          </div>
        </div>

        <div class='row d-flex justify-content-center'>
            @if(Session::has('success'))
            <div class="col-md-10">
              <div class="alert alert-success">
                {{ Session::get('success') }}
              </div>
            </div>
            @endif

            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-3">
                    <div class="card-header">
                        <h3> Products </div>
                    </div>

                    <div class="card-body">
                      <table class="table">
                        <tr>
                          <th>ID</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>SKU</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>

                        @if ($products->isNotEmpty())
                          @foreach ($products as $p)
                            <tr>
                              <td>{{$p->id}}</td>
                              <td>
                                @if ($p->image != "")
                                  <img width="50" src="{{ asset('uploads/products/'. $p->image) }}">
                                @endif
                              </td>
                              <td>{{$p->name}}</td>
                              <td>{{$p->sku}}</td>
                              <td>{{$p->price}}</td>
                              <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M, Y')}}</td>
                              <td>
                                <a href="{{ route('product.edit', $p->id) }}" class="btn btn-dark">Edit</a>
                                <a href="#" onclick="deleteProduct({{ $p->id }});" class="btn btn-danger">Delete</a>
                                <form id="delete-product-{{ $p->id }}" action="{{ route('product.destory', $p->id)}}" method="post">                                
                                  @csrf
                                  @method('delete')
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        @endif

                        
                      </table>
                    </div>
                  

                </div>
            <div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>


<script>
  function deleteProduct(id){
    if(confirm("Are you sure you want to delete product")){
      document.getElementById("delete-product-" + id).submit();
    }
  }

</script>