<?php

public function search()
{
    $array_where_ref = array();
    $array_where_desi = array();

    $categorieArray = array();
    $fabricantArray = array();

    $searchCategorie = array();
    $searchFabricant = array();

    if(isset($_GET['cat']) && strlen($_GET['cat'][0]) > 0  ) { foreach($_GET['cat'] as $cat) { array_push($searchCategorie, $cat); } }
    if(isset($_GET['fab']) && strlen($_GET['fab'][0]) > 0 ) { foreach($_GET['fab'] as $fab) { array_push($searchFabricant, $fab); } }

    // (desi & ref) empty or not set
    if((!isset($_GET['desi']) || strlen($_GET['desi']) == 0) && (!isset($_GET['ref']) || strlen($_GET['ref']) == 0)){
        array_push($array_where_ref, ['reference', 'LIKE', '%' ]);
        array_push($array_where_desi, ['designation', 'LIKE', '%' ]);
    }
    // desi not set & ref set
    elseif((!isset($_GET['desi']) || strlen($_GET['desi']) == 0) && (isset($_GET['ref']) && strlen($_GET['ref']) > 0)){
        array_push($array_where_ref, ['reference', 'LIKE', $_GET['ref'] ]);
        array_push($array_where_desi, ['designation', 'LIKE', '%' ]);
    }
    // desi set & ref not set
    elseif((isset($_GET['desi']) && strlen($_GET['desi']) > 0) && (!isset($_GET['ref']) || strlen($_GET['ref']) == 0)){
        array_push($array_where_ref, ['reference', 'LIKE', '%' ]);
        array_push($array_where_desi, ['designation', 'LIKE', $_GET['desi'] ]);
    }
    // (desi & ref) set
    elseif((isset($_GET['desi']) && strlen($_GET['desi']) > 0) && (isset($_GET['ref']) && strlen($_GET['ref']) > 0)){
        array_push($array_where_ref, ['reference', 'LIKE', $_GET['ref'] ]);
        array_push($array_where_desi, ['designation', 'LIKE', $_GET['desi'] ]);
    }

    foreach($searchCategorie as $categorie){
        $categorieId = Categorie::where('id', $categorie)->with('child')->first();
        array_push($categorieArray, $categorieId->id);
        foreach($categorieId->child as $child){
            array_push($categorieArray, $child->id);
        }
    }

    foreach($searchFabricant as $fabricant){
        array_push($fabricantArray, $fabricant);
    }

    // From
    $processing_query = Composant::with('categorie', 'fabriquant', 'tarif_fournisseur');

    // Where In
    if (count($categorieArray) > 0 && count($fabricantArray) > 0){ 
        $processing_query = $processing_query->whereIn('categorie_id', $categorieArray)
            ->where(function ($q) use ($fabricantArray) {
                $q->where('fabriquant_id', $fabricantArray[0]);
                for ($i=1; $i < count($fabricantArray); $i++) { 
                    $q = $q->orWhere('fabriquant_id', $fabricantArray[$i]);
                }
            } );
    }
    else if (count($categorieArray) > 0 && count($fabricantArray) == 0) $processing_query = $processing_query->whereIn('categorie_id', $categorieArray);
    else if (count($fabricantArray) > 0 && count($categorieArray) == 0) $processing_query = $processing_query->whereIn('fabriquant_id', $fabricantArray);

    // Where
    $processing_query = $processing_query->Where([[$array_where_ref],[$array_where_desi]]);     

    // Sort by / Order by
    if (isset($_GET['sortBy']) && strlen($_GET['sortBy']) > 0) {
        $sortBy = explode(',', $_GET['sortBy']);
        $processing_query = $processing_query->orderBy($sortBy[0], $sortBy[1]);
    }

    // End
    $processing_query = $processing_query->paginate(20);
    $composants = $processing_query->appends(request()->query());

    $data['composants'] = $composants;
    $data['categories'] = Categorie::where('parent_id', null)->orderBy('nom', 'ASC')->get();
    $data['fabriquants'] = Fabriquant::orderBy('nom', 'ASC')->get();
    $data['fournisseurs'] = Fournisseur::orderBy('nom', 'ASC')->get();

    return view('catalogue', $data);
    
}