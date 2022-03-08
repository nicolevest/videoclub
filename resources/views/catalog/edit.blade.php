@extends('layouts.master')

@section('content')
<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar Película
         </div>
         <div class="card-body" style="padding:30px">

            <form action='{{url("catalog/edit/$pelicula->id")}}' method="POST">

            {{ csrf_field() }}
            @method('PUT')

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control" value="{{$pelicula->title}}">
            </div>

            <div class="form-group">
            <label for="year">Año</label>
            <input type="text" name="year" id="year" class="form-control" value="{{$pelicula->year}}">
            </div>

            <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" id="director" class="form-control" value="{{$pelicula->director}}">
            </div>

            <div class="form-group">
            <label for="poster">Poster</label>
            <input type="text" name="poster" id="poster" class="form-control" value="{{$pelicula->poster}}">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{$pelicula->synopsis}}</textarea>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar película
               </button>
               <a href=" {{ url('catalog/show/' . $pelicula->id) }}" class="btn btn-light" style="padding:8px 131px;">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
								<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
							</svg>
							Volver
						</a>
            </div>

            </form>

         </div>
      </div>
   </div>
</div>

@stop
