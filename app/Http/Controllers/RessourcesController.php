<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\http\Request;
use App\Models\Ressources;
use App\Models\Comments;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class RessourcesController extends Controller
{
    // Post
    public function listAll()
    {
        $ressources = Ressources::with(['Users', 'Category', 'Zone'])->orderBy('created_at', 'DESC')->Paginate(3);
        return view('home', ['ressources' => $ressources]);
    }

    //----------------------------------------------------------------------------------
    public function addRes() // affiche page new ressource
    {
        $zones = Zone::orderBy('id', 'ASC')->get();
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('addRessource', ['zones' => $zones, 'categories'  => $categories]);
        //return view('addRessource');
    }

    public function updateRes($id) // affiche page new ressource en mode update
    {
        $userId = Auth::user();
        $ressource = Ressources::with(['Users', 'Category', 'Zone'])->find($id);

        if ($ressource->users_id == $userId->id) {
            $zones = Zone::orderBy('id', 'ASC')->get();
            $categories = Category::orderBy('id', 'ASC')->get();
            return view('addRessource', ['ressource' => $ressource, 'zones' => $zones, 'categories'  => $categories]);
        } else {
            return redirect('/');
        }
    }

    public function isImage($filePath)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        $explodeImage = explode('.', $filePath);
        $extension = end($explodeImage);

        if(in_array($extension, $imageExtensions))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function addResClick(Request $file)
    {
        //dd($file);
       /* if ($file->file('file') == null) {
            return('Impossible d\'importer le fichier.');
        }else{
            $f = $file->file->store('public');
        }*/
        $userId = Auth::user()->id;

        $ressource = new Ressources();
        $ressource->name = request('name');
        $ressource->content = request('content');
        $ressource->count_view = 0;
        $ressource->zone_id = request('zone_id');
        $ressource->category_id = request('category_id');
        $ressource->users_id = $userId;


        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)
            {
                $filesize = $_FILES["file"]["size"];

                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

                if(file_exists("uploads/" . $_FILES["file"]["name"])) {
                    echo $_FILES["file"]["name"] . " existe déjà.";
                }
                else
                {
                    if (!is_dir("uploads")) {
                        mkdir("uploads", 0777, true);
                    }
                    $filePath = "uploads/" . $_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
                    $ressource->file_path = $filePath;
                    echo "Votre fichier a été téléchargé avec succès.";
                }
            }
        }

        $ressource->save();

        return redirect('/');
    }

    public function updateResClick($id)
    {
        $userId = Auth::user()->id;

        $ressource = new Ressources();
        $ressource->name = request('name');
        $ressource->content = request('content');
        $ressource->count_view = 0;
        $ressource->zone_id = request('zone_id');
        $ressource->category_id = request('category_id');
        $ressource->users_id = $userId;


        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)
            {
                $filesize = $_FILES["file"]["size"];

                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

                if(file_exists("uploads/" . $_FILES["file"]["name"])) {
                    echo $_FILES["file"]["name"] . " existe déjà.";
                }
                else
                {
                    if (!is_dir("uploads")) {
                        mkdir("uploads", 0777, true);
                    }
                    $filePath = "uploads/" . $_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
                    $ressource->file_path = $filePath;
                    echo "Votre fichier a été téléchargé avec succès.";
                }
            }
        }

        $ressource->save();

        return redirect('/');
    }

    public function deleteRessource($id)
    {
        $userId = Auth::user();

        $ressource = Ressources::find($id);
        $favorites = Favorite::where('ressources_id', $id);
        if ($ressource->users_id == $userId->id || $userId->grade_id > 1) {
            $favorites->delete();
            $ressource->delete();
        }

        return redirect('/');
    }

    //----------------------------------------------------------------------------------
    // view de ressource.blade.php
    public function viewRes($id)
    {
        $userId = Auth::user();
        $ressource = Ressources::with(['Category', 'Zone', 'Users'])->find($id);
        $count_view = ($ressource->count_view)+1;
        $ressource->update(['count_view' => $count_view]);
        $fileIsImage = $this->isImage($ressource->file_path);
        if (Auth::user()) {
            $favoris = Favorite::with(['Ressources', 'Users'])->where([['ressources_id', $id], ['users_id', $userId->id]])->get();
        }
        $comments = Comments::with(['Users'])->where('ressources_id', $id)->orderBy('created_at', 'DESC')->get();
        if (Auth::user()) {
            return view('ressource', ['ressource' => $ressource, 'comments' => $comments, 'fileIsImage' => $fileIsImage, 'favoris' => $favoris]);
        } else {
            return view('ressource', ['ressource' => $ressource, 'comments' => $comments, 'fileIsImage' => $fileIsImage]);
        }
    }

    //----------------------------------------------------------------------------------
    // Comment
    public function addComment($id)
    {
        $userId = Auth::user();
        $comment = new Comments;
        $comment->content = request('comment');
        $comment->ressources_id = $id;
        $comment->users_id = $userId->id;
        $comment->save();

        return redirect(route('viewRes', ['id' => $id]));
    }

    public function deleteComment($id, $id_com)
    {
        $userId = Auth::user();

        $comment = Comments::find($id_com);
        if ($comment->users_id == $userId->id || $userId->grade_id > 1) {
            $comment->delete();
        }
        return redirect(route('viewRes', ['id' => $id]));
    }

    public function viewUpdateComment($id, $id_com)
    {
        $userId = Auth::user();

        $ressource = Ressources::with(['Category', 'Zone', 'Users'])->find($id);
        $comments = Comments::with(['Users'])->where('ressources_id', $id)->orderBy('created_at', 'DESC')->get();
        $favoris = Favorite::with(['Ressources', 'Users'])->where([['ressources_id', $id], ['users_id', $userId->id]])->get();
        $commentEdit = Comments::with('Users', 'Ressources', 'Ressources.Users')->find($id_com);

        if ($commentEdit->users_id == $userId->id || $userId->grade_id > 1) {
            return view('ressource', ['ressource' => $ressource, 'comments' => $comments, 'favoris' => $favoris, 'edit' => 1, 'commentEdit' => $commentEdit]);
        } else {
            return redirect(route('viewRes', ['id' => $id]));
        }
    }

    public function updateComment($id, $id_com)
    {
        $userId = Auth::user();

        $comment = Comments::find($id_com);
        $ressource = Ressources::with('users', 'comments', 'comments.users')->find($id);
        if ($comment->users_id == $userId->id || $userId->grade_id > 1) {
            $comment->content = request('comment');
            $comment->save();
        }
        return redirect(route('viewRes', ['id' => $id]));
    }
    //----------------------------------------------------------------------------------
    //Favorite
    public function viewFavorite()
    {
        $userId = Auth::user();

        $favorites = Favorite::with('Ressources', 'Ressources.Users')->where('users_id', $userId->id)->get();

        return view('favorite', ['favorites' => $favorites]);
    }

    public function add_or_delete($id, $add, $view)
    {
        $userId = Auth::user();
        //dd( $view);
        //dd($add, $id, $userId->id);
        if ($add < 1) {
            $favorite = Favorite::where([['ressources_id', $id], ['users_id', $userId->id]])->get();
            if (count($favorite) < 1) {
                $favorite = new Favorite;
                $favorite->ressources_id = $id;
                $favorite->users_id = $userId->id;
                $favorite->save();
            }
        } else if ($add > 0) {
            $favorite = Favorite::where([['ressources_id', $id], ['users_id', $userId->id]])->first();
            $favorite->delete();
        }

        if ($view == '1') {        // vue ressource
            return redirect(route('viewRes', ['id' => $id]));
        }
        else if ($view == '2'){    // vue favoris
            $favorites = Favorite::with('Ressources', 'Ressources.Users')->where('users_id', $userId->id)->get();
            return view('favorite', ['favorites' => $favorites]);
        }
        else{                   // sinon vue accueil
            return redirect('/');
        }
    }
}
