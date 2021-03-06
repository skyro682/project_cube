<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\Ressources;

class SearchController extends SearchControllerManager
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchRes()
    {
        $query = '';
        if(isset($_GET['query']))
        {
            $query = $_GET['query'];
        }
        $contentQuery = '';
        if(isset($_GET['contentQuery']))
        {
            $contentQuery = $_GET['contentQuery'];
        }
        $category = 'all';
        if(isset($_GET['category']))
        {
            $category = $_GET['category'];
        }
        $region = 'all';
        if(isset($_GET['region']))
        {
            $region = $_GET['region'];
        }
        $order = 0;
        if(isset($_GET['order']))
        {
            $order = $_GET['order'];
        }

        $tableResults = $this->queryMake($query, $contentQuery, $category, $region, $order);

        return view('search',[
            'searchResults' => $tableResults,
        ]);
    }
}
