<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\Ressources;

class AdvancedSearchController extends SearchControllerManager
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
        $categories = (new Category)->get();
        $regions = (new Zone)->get();
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

        $ordersList = array();

        array_push($ordersList, ['id' => 0, 'name' => "Derniers créés d'abord"]);
        array_push($ordersList, ['id' => 1, 'name' => "Premiers créés d'abord"]);
        array_push($ordersList, ['id' => 2, 'name' => "Premiers modifiés d'abord"]);
        array_push($ordersList, ['id' => 3, 'name' => "Derniers modifiés d'abord"]);
        array_push($ordersList, ['id' => 4, 'name' => "Les plus vus d'abord"]);
        array_push($ordersList, ['id' => 5, 'name' => "Les moins vus d'abord"]);

        return view('advancedSearch',[
            'searchResults' => $tableResults,
            'categoriesList' => $categories,
            'regionsList' => $regions,
            'ordersList' => $ordersList,
        ]);
    }
}
