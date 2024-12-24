@extends('layouts.admin')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>product Management</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('admin.css') }}"/>
    </head>

    <body>
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>products</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addproductModal" class="btn btn-success" data-toggle="modal"><i
                                        class="material-icons">&#xE147;</i> <span>Add New product</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá</th>
                                <th>Sizes - số lượng</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><img width="50px;" height="50px" src="{{ asset($product->image) }}" alt=""></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>                        @if ($product->sizes->isEmpty())
                                        No sizes available
                                    @else
                                        <ul>
                                            @foreach ($product->sizes as $size)
                                                <li>{{ $size->size }} {{ $size->stock }}</li>
                                            @endforeach
                                        </ul>
                                    @endif</td>
                                    <td>
                                        <a href="#editproductModal" class="edit" data-toggle="modal"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->price }}"
                                            data-description="{{ $product->description }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteproductModal" class="delete" data-toggle="modal"
                                            data-id="{{ $product->id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="clearfix">
                        <div class="hint-text">Showing <b>{{ $products->count() }}</b> out of <b>{{ $products->total() }}</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $products->onFirstPage() ? '#' : $products->previousPageUrl() }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                <a href="{{ $products->hasMorePages() ? $products->nextPageUrl() : '#' }}">Next</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        
            <!-- Add Modal HTML -->
            <div id="addproductModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Add product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>price</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>description</label>
                                    <input type="text" name="description" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>image</label>
                                    <input type="text" name="image" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            <!-- Edit Modal HTML -->
            <div id="editproductModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" id="edit-form">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h4 class="modal-title">Edit product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="edit-id">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="edit-name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" id="edit-price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" id="edit-description" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="text" name="code" id="edit-code" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" value="Save">
                            </div>
                        </form>
                        <form action="{{ route('sizes.store') }}" method="POST">
                            @csrf
                            <input type="" name="product_id" id="editd-id">
                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="text" name="size" id="size" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        
            <!-- Delete Modal HTML -->
            <div id="deleteproductModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            <script>
                $(document).ready(function() {
                    $('.modal-backdrop fade show').remove();

                    $('.edit').on('click', function() {
                        const id = $(this).data('id');
                        const name = $(this).data('name');
                        const price = $(this).data('price');
                        const description = $(this).data('description');
                        $('#edit-id').val(id);
                        $('#editd-id').val(id);
                        $('#edit-name').val(name);
                        $('#edit-price').val(price);
                        $('#edit-description').val(description);
        
                        $('#edit-form').attr('action', `/products/${id}`);
                    });
        
                    $('.delete').on('click', function() {
                        const id = $(this).data('id');
                        $('#delete-form').attr('action', `/products/${id}`);
                    });
                });
            </script>        
    </body>

    </html>
@endsection
