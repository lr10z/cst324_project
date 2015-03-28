<?php

class ListingController extends BaseController
{
    public function getListing($listingId) 
    {
        // query the listing from the database
        $listing = Listing::where('id', '=', $listingId)->first();

        // set the listing to the view data and then return
        $this->viewData['listing'] = $listing;
        $view = View::make('partials/listing', $this->viewData)->render();

        // return the view in JSON format
        return Response::json($view);
    }
}
