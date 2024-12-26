@extends('layout.master')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Product</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Edit Product Details</h5>
                    </div>
                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter product name" value="{{ old('name', $product->name) }}" />
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Enter price" value="{{ old('price', $product->price) }}" />
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount(%)</label>
                                    <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" id="discount" placeholder="Enter discount" value="{{ old('discount', $product->discount) }}" />
                                    @error('discount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discounted Price</label>
                                    <input type="text" class="form-control @error('discounted_price') is-invalid @enderror" name="discounted_price" id="discounted_price" placeholder="Enter discounted price" value="{{ old('discounted_price', $product->discounted_price) }}" readonly />
                                    @error('discounted_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" accept="image/*">
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if (isset($product->image) && $product->image)
                            <div class="mt-2">
                                <img src="{{ url(Storage::url($product->image)) }}" alt="Current Product Image" width="150" height="150">
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="descriptionEditor" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <a href="{{route('products.index')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('descriptionEditor');

        // Auto-calculate the discounted price when discount is entered
        document.getElementById('discount').addEventListener('input', function() {
            const price = parseFloat(document.getElementById('price').value);
            const discount = parseFloat(this.value);

            if (!isNaN(price) && !isNaN(discount)) {
                const discountedPrice = price - (price * discount / 100);
                document.getElementById('discounted_price').value = discountedPrice.toFixed(2); // Format to 2 decimal places
            } else {
                document.getElementById('discounted_price').value = ''; // Clear if inputs are invalid
            }
        });
    });
</script>

@endsection
