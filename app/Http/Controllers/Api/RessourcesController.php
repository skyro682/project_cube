<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ressources;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RessourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ressources = Ressources::with(['Users:id,username', 'Category', 'Zone'])->orderBy('created_at', 'DESC')->get();
        return response([ 'ressources' => ApiResource::collection($ressources), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'content' => 'required|max:255',
            'zone_id' => 'required',
            'category_id' => 'required',
        ]);

        $data['count_view'] = 0;
        $data['users_id'] = Auth::user()->id;

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $ressources = new Ressources();
        $ressources->name = $data['name'];
        $ressources->content = $data['content'];
        $ressources->count_view = $data['count_view'];
        $ressources->zone_id = $data['zone_id'];
        $ressources->category_id = $data['category_id'];
        $ressources->users_id = $data['users_id'];
        $ressources->save();

        $ressources = Ressources::find($ressources->id);

        return response(['project' => new ApiResource($ressources), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['ressources'] = Ressources::with(['Category', 'Zone', 'Users:id,username'])->find($id);
        $data['comments'] = Comments::with(['Users:id,username'])->where('ressources_id', $id)->orderBy('created_at', 'DESC')->get();
        return response([ 'ressources' => ApiResource::collection($data), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ressources = Ressources::find($id);

        if($ressources->users_id != Auth::user()->id){
            return response(['error' => 401, 'Permission error']);
        }

        $ressources->update($request->all());

        return response(['project' => new ApiResource($ressources), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ressources = Ressources::find($id);

        if($ressources->users_id != Auth::user()->id){
            return response(['error' => 401, 'Permission error']);
        }

        $ressources->delete();

        return response(['message' => 'Deleted']);
    }
}
