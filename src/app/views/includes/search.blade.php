<div class="container search">
    <div class="column col-md-10">
        <div class="input-group">
            <input type="text" class="form-control"
                   placeholder="Enter a keyword and press 'Search'">
            <div class="dropdown input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle"
                        data-toggle="dropdown" aria-expanded="false">
                    <span class="category">All Categories</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="categories">
                    @foreach ($categories as $key=>$value)
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">{{{$key}}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="column col-md-1">
        <button type="button" class="btn btn-success" tabindex="-1">Search</button>
    </div>
</div>
