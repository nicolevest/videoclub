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
            notify()->success('Película creada correctamente','Crear película'); //invocamos notificación
			return redirect()->action([CatalogController::class, 'getIndex']);
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
            notify()->success('Película editada correctamente','Editar película'); //invocamos notificación
			return redirect()->action([CatalogController::class, 'getShow'], ['id' => $id]);
		} else {
			return ['result' => 'error'];
		}

    }

    public function putRent($id)
	{
		$movie = Movie::findOrFail($id);
		$movie->rented = true;
		if ($movie->save()) {
			notify()->success('Película rentada','Rentar película'); //invocamos notificación
			return redirect()->action([CatalogController::class, 'getShow'], ['id' => $id]);
		} else {
			return ['result' => 'error'];
		}
	}

    public function putReturn($id)
	{
		$movie = Movie::findOrFail($id);
		$movie->rented = false;
		if ($movie->save()) {
			notify()->success('Película devuelta',' Devolución película'); //invocamos notificación
			return redirect()->action([CatalogController::class, 'getShow'], ['id' => $id]);
		} else {
			return ['result' => 'error'];
		}
	}
    public function deleteMovie($id)
        {
            $movie = Movie::findOrFail($id);
            if ($movie->delete()) {
                notify()->success('Película eliminada correctamente','Eliminar película'); //invocamos notificación
			return redirect()->action([CatalogController::class, 'getIndex']);
            } else {
                return ['result' => 'error'];
            }
        }
}
