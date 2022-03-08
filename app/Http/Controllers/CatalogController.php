<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{

    public function getIndex()
    {
        $peliculas = Movie::all();
		return view('catalog.index', ['peliculas' => $peliculas]);
    }

    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id);
		return view('catalog.show', ['pelicula' => $pelicula]);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        $pelicula = Movie::findOrFail($id);
		return view('catalog.edit', ['pelicula' => $pelicula]);
    }
    public function postCreate(Request $req)
    {
        $movie = new Movie();
		$movie->title = $req->input('title');
		$movie->year = $req->input('year');
		$movie->director = $req->input('director');
		$movie->poster = $req->input('poster');
		$movie->rented = false;
		$movie->synopsis = $req->input('synopsis');
		$result = $movie->save();//true o false
		if ($result){
			return redirect()->action($this->getIndex());
		} else {
			return ['result' => 'error'];
		}
    }
    public function putEdit(Request $req,$id) //action
    {
        $movie = Movie::findOrFail($id);
		$movie->title = $req->input('title');
		$movie->year = $req->input('year');
		$movie->director = $req->input('director');
		$movie->poster = $req->input('poster');
		$movie->synopsis = $req->input('synopsis');
		$result = $movie->save();
		if ($result){
			return redirect()->action($this->getShow($id));
		} else {
			return ['result' => 'error'];
		}

    }
}
