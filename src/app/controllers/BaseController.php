<?php

class BaseController extends Controller
{
    /**
     * Setup the search categories
     *
     * @return void
     */
    public function __construct()
    {
        $this->initializeSearchCategories();
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * initializeCategories(): set all the categories possible
     * categories
     *
     * @return void
     */
    private function initializeSearchCategories()
    {
        $this->categories = [
            'All Categories'=>'all',
            'Cameras'=>'camera',
            'Computers'=>'computer',
            'Printers'=>'printer',
            'Phones'=>'cell phone',
            'Televisions'=>'tv'
        ];

        $this->viewData['categories'] = $this->categories;
    }
}