@extends('layouts.admin')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>bill Management</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('admin.css') }}" />
    </head>

    <body>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>bills</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addCouponModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New bill</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bill ID</th>
                            <th>Order ID</th>
                            <th>Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td rowspan="{{ count($bill->orders) + 1 }}">{{ $bill->id }}</td>
                            </tr>

                            @foreach ($bill->orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    {{-- <td>
                                        <select value="">
                                            <option name="" id="">{{ $order->status ?? 'no' }}</option>
                                            <option>f</option>
                                        </select>
                                    </td> --}}
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->size }}</td>
                                    <td>
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Assuming you're updating an order -->
                                        
                                            <div class="form-group">
                                                <label for="status">Order Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    @foreach(['pending', 'ship', 'done', 'cancel'] as $status)
                                                        <option value="{{ $status }}" 
                                                                {{ $order->status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                        </form>

                                    </td>
                                    {{-- <td>{{ $order->status ?? 'no' }}</td> --}}
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>{{ $bills->count() }}</b> out of <b>{{ $bills->total() }}</b> entries
                    </div>
                    <ul class="pagination">
                        <li class="page-item {{ $bills->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $bills->onFirstPage() ? '#' : $bills->previousPageUrl() }}">Previous</a>
                        </li>
                        @for ($i = 1; $i <= $bills->lastPage(); $i++)
                            <li class="page-item {{ $i == $bills->currentPage() ? 'active' : '' }}">
                                <a href="{{ $bills->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ !$bills->hasMorePages() ? 'disabled' : '' }}">
                            <a href="{{ $bills->hasMorePages() ? $bills->nextPageUrl() : '#' }}">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Add Modal HTML -->
        <div id="addCouponModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('bills.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add bill</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Discount (%)</label>
                                <input type="number" name="discount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
        <div id="editCouponModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="edit-form">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h4 class="modal-title">Edit bill</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="edit-code" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Discount (%)</label>
                                <input type="number" name="discount" id="edit-discount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="edit-status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="disabled">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deleteCouponModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h4 class="modal-title">Delete bill</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
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
                $('.edit').on('click', function() {
                    const id = $(this).data('id');
                    const code = $(this).data('code');
                    const discount = $(this).data('discount');
                    const status = $(this).data('status');
                    $('#edit-id').val(id);
                    $('#edit-code').val(code);
                    $('#edit-discount').val(discount);
                    $('#edit-status').val(status);

                    $('#edit-form').attr('action', `/bills/${id}`);
                });

                $('.delete').on('click', function() {
                    const id = $(this).data('id');
                    $('#delete-form').attr('action', `/bills/${id}`);
                });
            });
        </script>
    </body>

    </html>
@endsection
