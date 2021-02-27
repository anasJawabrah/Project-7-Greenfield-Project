@extends('layouts.app')

@section('content')
<div class="section__content section__content--p30">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">Manage Product</div>
          <div class="card-body">
            <div class="card-title">
              <h3 class="text-center title-2">Create Product</h3>
            </div>
            <hr>
            <form action="products" method="post" enctype="multipart/form-data">
              {{ csrf_field()}}
              <div class="form-group">
                <label for="name" class="control-label mb-1">Product Name</label>
                <input name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="description" class="control-label mb-1">Product Description</label>
                <input name="description" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="image" class="control-label mb-1">Product image</label>
                <input name="image" type="file" class="form-control">
              </div>
              <div class="form-group">
                <label for="price" class="control-label mb-1">Product price</label>
                <input type="number" class="form-control" name="price" id="price" step=0.01>
              </div>
              <div class="form-group">
                <label for="discount" class="control-label mb-1">Product Discount (%)</label>
                <input type="number" class="form-control" name="discount" id="discount" max=100 min=0 value=00 >
                @if ($errors->has('discount'))
                <div class="alert alert-danger">{{ $errors->first('discount') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" id="category">
                  <option disabled selected>Select Category</option>
                  @foreach ($Categories as $Category)
									<option value={{$Category->id}}>{{$Category->name}}</option>
									@endforeach
                </select>
              </div>

              <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">Add
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row m-t-30">
      <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
          <table class="table table-borderless table-data3">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>price</th>
                <th>category</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Products as $product)
              <tr>

                <td>{{$product->name}}</td>

                <td>
                  <div class="image img-cir img-40">
                    <img src="{{asset("images/{$product->image}")}}">

                  </div>
                </td>
                @if ($product->discount !=0)
                <td>{{$product->price - ($product->discount * $product->price / 100)}} JOD</td>
                @else
                <td>{{$product->price }} JOD</td>
                
                @endif
                <td>{{$product->category_name}}</td>
                <td>{{$product->description}}</td>
                <td>
                  <a href="{{ route('admin.products.edit', $product->id)}}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                  <form action="{{ route('admin.products.destroy', $product->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- END DATA TABLE-->
      </div>
    </div>
  </div>
</div>
@endsection