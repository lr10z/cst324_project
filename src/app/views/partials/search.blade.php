<h2>Results</h2>
@if (count($listings) < 1)
    <h5>No listings found. Please search again.</h5>
@else
    <h5>Click on a listing to view details.</h5>
@endif
<ul class="list-group">
    @foreach ($listings as $listing)
    <li class="list-item" data-id="{{{$listing->id}}}">
        <span class="item-name"><a href="/">{{{$listing->listing_title}}}</a></span>
        <span class="item-price">${{{$listing->product->price}}}</span>
    </li>
    @endforeach
</ul>
