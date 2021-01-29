<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\Ressources;

class SearchControllerManager extends Controller
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

    public function queryMake($query, $contentQuery, $selectedCategory, $selectedRegion, $order)
    {
        $whereArray = array();
        $hasTarget = false;
        if ((isset($query)) and ($query != ''))
        {
            array_push($whereArray, ['name', 'like', '%'.$query.'%' ]);
            $hasTarget = true;
        }
        if ((isset($contentQuery)) and ($contentQuery != ''))
        {
            array_push($whereArray, ['content', 'like', '%'.$contentQuery.'%' ]);
            $hasTarget = true;
        }
        if ((isset($selectedCategory)) and ($selectedCategory != '') and ($selectedCategory != 'all'))
        {
            array_push($whereArray, ['category_id', '=', $selectedCategory ]);
        }
        if ((isset($selectedRegion)) and ($selectedRegion != '') and ($selectedRegion != 'all'))
        {
            array_push($whereArray, ['zone_id', '=', $selectedRegion ]);
        }

        //$processing_query = Ressources::with('id', 'name', 'content', 'count_view', 'zone_id', 'category_id', 'users_id', 'created_at', 'updated_at');
        $processing_query = new Ressources;
        $processing_query = $processing_query->Where($whereArray);

        if ((isset($order)) and ($order != ''))
        {
            switch ($order) {
                case 1:
                    $processing_query = $processing_query->orderBy('created_at', 'asc');
                    break;
                case 2:
                    $processing_query = $processing_query->orderBy('updated_at', 'desc');
                    break;
                case 3:
                    $processing_query = $processing_query->orderBy('updated_at', 'asc');
                    break;
                case 4:
                    $processing_query = $processing_query->orderBy('count_view', 'asc');
                    break;
                case 5:
                    $processing_query = $processing_query->orderBy('count_view', 'desc');
                    break;
                default:
                    $processing_query = $processing_query->orderBy('created_at', 'desc');
            }
        }
        else
        {
            $processing_query = $processing_query->orderBy('created_at', 'desc');
        }

        $processing_query = $processing_query->paginate(10);

        if ($hasTarget == true)
        {
            return $processing_query;
        }
        else
        {
            return NULL;
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('search');
    }
}
