<h2>{{{$listing->seller->user->first_name}}}'s Shop</h2>

<div class="item-info">
    <span class="item-name"><h4>{{{$listing->listing_title}}}</h4></span>
    <span class="item-price"><h4>${{{$listing->product->price}}}</h4></span>
</div>
<article>
    At only ${{{$listing->product->price}}}, this is a
    smokin' hot deal and a rare opportunity to own a
    {{{$listing->product->name}}},
    {{{$listing->product->description}}}. Shipping and
    handling will be calculated upon purchase. Act now, as
    there <?php echo ($listing->product->inventory > 1) ?
    "are" : "is" ?> only
    {{{$listing->product->inventory}}} left!
</article>
