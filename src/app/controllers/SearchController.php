<?php

class SearchController extends BaseController
{
    /**
     * init the search categories array.
     *
     * @return void
     */
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * search(): given the search keyword and the category (if
     * available), search the database for the relevant listings
     *
     * @return json encoded string
     */
    public function search()
    {
        // read the POST fields
        $keyword  = trim(Input::get('search'));
        $category = trim(Input::get('category'));

        // pass this callback function to the query
        $callback = function ($query) use ($category)
        {
            if (!empty($category) && $category !== 'All Categories')
            {
                $category = $this->categories[$category];
                return $query->where('category', '=', $category);
            }
            return $query;
        };

        // Query listings that match the keyword
        $keyword  = "%$keyword%";
        $listings = Listing::whereHas('product', function($sub) use ($keyword, $callback)
        {
            $sub->where('name', 'LIKE', $keyword);
            $sub = $callback($sub);
        })
        ->orWhereHas('product', function($sub) use ($keyword, $callback)
        {
            $sub->where('description', 'LIKE', $keyword);
            $sub = $callback($sub);
        })
        ->get();

        // render the view with the new data
        $this->viewData['listings'] = $listings;
        $view = View::make('partials/search', $this->viewData)->render();
        return Response::json($view);
    }
}
