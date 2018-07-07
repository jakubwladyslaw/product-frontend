@extends('product-frontend::layouts/2columns-left')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{array_get($product, 'id', null) ?: 'New product'}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="productNameInput" class="col-md-4 control-label">Product name:</label>

                            <div class="col-md-6">
                                <input id="productNameInput" type="text" class="form-control" name="name"
                                       value="{{ $product['name'] }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="productAmountInput" class="col-md-4 control-label">Product amount:</label>

                            <div class="col-md-6">
                                <input id="productAmountInput" type="text" class="form-control" name="amount"
                                       value="{{ $product['amount'] }}" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    {{array_get($product, 'id', null) == null ? 'Add' : 'Edit'}} product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection