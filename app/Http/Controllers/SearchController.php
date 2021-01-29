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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = (new Category)->get();
        $regions = (new Zone)->get();
        $tableResults = new Ressources;
        $tableTreated = false;

        $tableResults = $this->queryMake($_GET['query'], $_GET['contentQuery'], $_GET['category'], $_GET['region'], $_GET['order']);

        return view('search',[
            'searchResults' => $tableResults,
            'categoriesList' => $categories,
            'regionsList' => $regions,
        ]);
    }
}
