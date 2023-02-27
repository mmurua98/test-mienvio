</html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <title>Hello, world!</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #dfe3e7;
        }

        .navbar-dark .navbar-nav .navTitle {
            color: white;
        }
        .navTitle{
            font-size: 20px;
            box-shadow: inset 0 0 0 0 #54b3d6;
            color: #54b3d6;
            transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
        }
        .navTitle:hover {
            box-shadow: inset 130px 0 0 0 #54b3d6;
            color: white;
        }

        .btn-primary{
            background-color: #41566c
        }
        .btn-primary:hover{
            color: #fff;
            background-color: #203e5c;
        }
        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem #18222c;
        }

        .btn-success{
            background-color: #545b62;
            border: none;
            border-radius: 50px;
        }
        .btn-success:hover{
            color: #fff;
            background-color: #000;
        }
        .btn-success:focus {
            box-shadow: 0 0 0 0.2rem black;
        }

        .tdAcciones{
            color: #ffffff;
        }
        
    </style>
</head>

<body>
    
    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <a class="navbar-brand navTitle" href="/">Test mienvío</a>
    </nav>

    <div class="container mt-4">
        <form>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="min_price">Precio mínimo</label>
                        <input type="text" class="form-control" id="min_price" name="min_price"
                            aria-describedby="minimo" value="{{$min_price}}" placeholder="Mínimo">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="max_price">Precio máximo</label>
                        <input type="text" class="form-control" id="max_price" name="max_price" placeholder="Máximo"
                            value="{{$max_price}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="byName">Nombre del producto</label>
                        <input type="text" class="form-control" id="byName" name="byName"
                            value="{{$byName}}" placeholder="Nombre del producto">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addProductoModal">Add Todo</button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr id="product_{{$product->id}}">
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>>
                    <td class="tdAcciones">
                        <a data-id="{{ $product->id }}" onclick="editProducto(event.target)" class="btn btn-info btnEdit">Edit</a>
                        <a class="btn btn-danger btnDelete" onclick="deleteProducto({{ $product->id }})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addProductoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar producto</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nombre"
                            placeholder="Nombre del producto">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descripción</label>
                        <input type="text" class="form-control" id="description" placeholder="Descripción">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Precio</label>
                        <input type="text" class="form-control" id="price" placeholder="Precio">
                        <span id="taskError" class="alert-message"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addProducto()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductoModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Editar producto</h4>
              </div>
              <div class="modal-body">
      
                     <input type="hidden" name="product_id" id="product_id">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="editName" aria-describedby="nombre"
                            placeholder="Nombre del producto">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descripción</label>
                        <input type="text" class="form-control" id="editDescription" placeholder="Descripción">
                        <span id="taskError" class="alert-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Precio</label>
                        <input type="text" class="form-control" id="editPrice" placeholder="Precio">
                        <span id="taskError" class="alert-message"></span>
                    </div>
      
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="updateProducto()">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        function addProducto() {
            var name = $('#name').val();
            var description = $('#description').val();
            var price = $('#price').val();
            let _url     = `/products`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    name: name,
                    description: description,
                    price: price,
                    _token: _token
                },
                success: function(data) {
                        product = data
                        $('table tbody').append(`
                            <tr id="product_${product.id}">
                                <td>${data.id}</td>
                                <td>${ data.name }</td>
                                <td>${ data.description }</td>
                                <td>${ data.price }</td>
                                <td>
                                    <a data-id="${ data.id }" onclick="editProducto(${data.id})" class="btn btn-info">Edit</a>
                                    <a data-id="${data.id}" class="btn btn-danger" onclick="deleteProducto(${data.id})">Delete</a>
                                </td>
                            </tr>
                        `);
                        console.log(data.responseJSON)
                        $('#name').val('');
                        $('#description').val('');
                        $('#price').val('');

                        $('#addProductoModal').modal('hide');

                        window.location.reload();
                },
                error: function(response) {
                    $('#taskError').text(response.responseJSON.errors.product);
                }
            });
        }
        
        function editProducto(e) {
            var id  = $(e).data("id");
            var name  = $("#product_"+id+" td:nth-child(2)").html();
            var description  = $("#product_"+id+" td:nth-child(3)").html();
            var price  = $("#product_"+id+" td:nth-child(4)").html();
            $("#product_id").val(id);
            $("#editName").val(name);
            $("#editDescription").val(description);
            $("#editPrice").val(price);
            $('#editProductoModal').modal('show');
        }

        function updateProducto() {
            var name = $('#editName').val();
            var description = $('#editDescription').val();
            var price = $('#editPrice').val();
            var id = $('#product_id').val();
            let _url     = `/product/update/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    name: name,
                    description: description,
                    price: price,
                    _token: _token
                },
                success: function(data) {
                        product = data
                        $("#product_"+id+" td:nth-child(2)").html(product.name);
                        $("#product_"+id+" td:nth-child(3)").html(product.description);
                        $("#product_"+id+" td:nth-child(4)").html(product.price);

                        $('#producto_id').val('');
                        $('#editName').val('');
                        $('#editDescription').val('');
                        $('#editPrice').val('');
                        $('#editProductoModal').modal('hide');

                        window.location.reload();
                },
                error: function(response) {
                    $('#taskError').text(response.responseJSON.errors);
                }
            });
        }

        function deleteProducto(id) {
            let url = `/product/${id}`;
            let token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                _token: token
                },
                success: function(response) {
                    alert("Seguro que quieres eliminar este producto?");
                    $("#product_"+id).remove();
                }
            });
        }
    </script>
</body>

</html>
