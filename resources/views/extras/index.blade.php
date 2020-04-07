@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Extras</h2>
            </div>
            <div class="pull-right">
                @can('extra-create')
                <a class="btn btn-success" href="{{ route('extras.create') }}"> Create New Extras</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($extras as $extra)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $extra->name }}</td>
	        <td>{{ $extra->price }}</td>
	        <td>
                <form action="{{ route('extras.destroy',$extra->id) }}" method="POST">
                    @can('extra-edit')
                    <a class="btn btn-primary" href="{{ route('extras.edit',$extra->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('extra-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $extras->links() !!}

<p class="text-center text-primary"><small>Food and Beverage Point of Sales System</small></p>
@endsection
