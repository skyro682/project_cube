<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressources;

class SearchController extends Controller
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
        $tableResults = new Ressources;
        $tableTreated = false;
        if ((isset($_GET['query'])) and ($_GET['query'] != ''))
        {
            $tableResults = $tableResults->WHERE('name' , 'like', '%'.($_GET['query']).'%')->get();
            $tableTreated = true;
        }
        if ($tableTreated == false)
        {
            $tableResults = array();
        }

        return view('search',[
            'searchResults' => $tableResults
        ]);
    }
}
