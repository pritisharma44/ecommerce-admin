@extends('layout.master')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Products</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Product List</h5>
                        <a href="{{route('products.create')}}"><button id="customButton" class="btn btn-primary mb-2">Add</button></a>
                    </div>
                    <div class="table-responsive">
                        <table id="productTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S. N.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Discounted Price</th>
                                    <th>Description</th>
                                    <th>Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here via AJAX -->
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            processing: true
            , serverSide: true
            , ajax: '{{ route('products.index') }}'
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , searchable: false
                    , orderable: false
                }
                , {
                    data: 'image'
                    , name: 'image'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'price'
                    , name: 'price'
                }
                , {
                    data: 'discount'
                    , name: 'discount'
                }
                , {
                    data: 'discounted_price'
                    , name: 'discounted_price'
                }
                , {
                    data: 'description'
                    , name: 'description'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            ]
        });
    });
    $("body").on('click', '#deleteProduct', function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            html: 'You want to delete!'
            , title: 'Are you sure?'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete"
                    , url: '{{ url('admin/products') }}' + "/" + id
                    , headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                    , success: function(data) {
                        var dataTable = $('#productTable').DataTable();
                        dataTable.ajax.reload();

                    }
                    , error: function(data) {
                        var dataTable = $('#productTable').DataTable();
                        dataTable.ajax.reload();

                    }
                });
                Swal.fire(
                    ''
                    , 'Product Deleted Successfully.'
                    , 'success'
                )
            }
        });
    });

</script>
@endpush
@endsection
