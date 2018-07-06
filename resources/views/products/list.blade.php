@extends('product-frontend::layouts/2columns-left')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Products List</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('product.form', ['id' => 'add'])}}" class="btn btn-primary pull-right">Add
                                product</a>
                            <div class="pull-left">
                                <ul>
                                    <li><a href="{{route('products')}}">Wszystkie</a></li>
                                    <li>
                                        <a href="{{route('products', ['amount' => 0, 'conditional' => 'greaterThen'])}}">Znajdują
                                            się na składzie</a></li>
                                    <li><a href="{{route('products', ['amount' => 0, 'conditional' => 'equal'])}}">Nie
                                            znajdują
                                            się na składzie</a></li>
                                    <li>
                                        <a href="{{route('products', ['amount' => 5, 'conditional' => 'greaterThen'])}}">Znajdują
                                            się na składzie w ilości większej niż 5</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if (count($products) > 0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row">{{array_get($product, 'id')}}</th>
                                            <td>{{array_get($product, 'name')}}</td>
                                            <td>{{array_get($product, 'amount')}}</td>
                                            <td>
                                                <a href="{{route('product.form', ['id' => array_get($product, 'id')])}}">
                                                    EDIT
                                                </a>
                                                <a href="{{route('product.delete', ['id' => array_get($product, 'id')])}}">
                                                    DELETE
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else

                                Your search returned no results.

                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection