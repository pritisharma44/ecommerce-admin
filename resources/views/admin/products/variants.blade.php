@extends('layout.master')
@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Add Product Variants</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Add Product Variants (Color, Size, and Images)</h5>
                    </div>
                    <form method="POST" action="{{ route('product.variants.store', $id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <!-- Color Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color Name</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" placeholder="Enter color name" value="{{ old('color') }}" />
                                    @error('color')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" accept="image/*">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Size (Checkbox Dropdown) -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Product Size</label>
                                    <div class="dropdown">
                                        <button class="btn btn-light form-control dropdown-toggle" type="button" id="sizeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select Sizes
                                        </button>
                                        <div class="dropdown-menu p-3" aria-labelledby="sizeDropdown">
                                            @foreach(['S' => 'Small (S)', 'M' => 'Medium (M)', 'L' => 'Large (L)', 'XL' => 'Extra Large (XL)', 'XXL' => 'Double Extra Large (XXL)'] as $value => $label)
                                            <label class="dropdown-item d-flex align-items-center">
                                                <input class="form-check-input mr-2" type="checkbox" name="sizes[]" value="{{ $value }}" {{ collect(old('sizes'))->contains($value) ? 'checked' : '' }}>
                                                {{ $label }}
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('sizes')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Variants Section -->
    @if(isset($productVariants) && $productVariants->isNotEmpty())
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Existing Product Variants</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Sizes</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productVariants as $variant)
                            <tr>
                                <td>{{ $variant->color }}</td>
                                <td>

                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        @foreach($variant->sizes as $size)
                                        <span style="background-color: black;color: white;padding: 8px 12px;border-radius: 4px;ext-align: center;font-size: 12px;">
                                            {{ $size }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    @if($variant->image)
                                    <img src="{{ asset('storage/' . $variant->image) }}" alt="Variant Image" width="60" height="60">
                                    @else
                                    No Image
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
