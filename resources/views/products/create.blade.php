@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.store') }}" method="POST">
    	@csrf


         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
               <strong>{!! Form::label('category_id', 'Category Id:') !!}</strong>
               {!! Form::select('category_id', App\Category::pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'category_id']) !!}
             </div>
           </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Set -Item1:</strong>
		            <input type="text" name="item1" class="form-control" placeholder="Item1">
		        </div>
		    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Set -Item2:</strong>
		            <input type="text" name="item2" class="form-control" placeholder="Item2">
		        </div>
		    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Set -Item3:</strong>
		            <input type="text" name="item3" class="form-control" placeholder="Item3">
		        </div>
		    </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="form-group">
               <strong>Price:</strong>
               <input type="text" name="price" class="form-control" placeholder="Price">
           </div>
       </div>
       <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Quantity:</strong>
              <input type="number" name="quantity" class="form-control" placeholder="Quantity">
          </div>
      </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>

<p class="text-center text-primary"><small>Food and Beverage Point of Sales System</small></p>
@endsection
