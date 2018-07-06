<ul class="nav nav-pills nav-stacked nav-pills-stacked-example">
    <li role="presentation" class="{{ Request::path() == 'products' ? 'active' : '' }}">
        <a href="{{route('products')}}">Items list</a>
    </li>
</ul>