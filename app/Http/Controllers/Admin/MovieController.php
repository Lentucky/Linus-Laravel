<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
class MovieController extends Controller
{
    public function index(){
        $movies = Movie::with('genre')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.movies.index',[ 'movies' => $movies]);        
    }
    public function create(){
        $genres = Genre::all();

        return view('admin.movies.create',['genres' => $genres]);
    }   
    public function store(Request $request){

        $validated = $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title'=> 'required|string|max:100',
            'description' => 'required|string|max:500',
            'duration' => 'required|integer',
            'poster_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
        if ($request->hasFile('poster_url')) {
                $image = $request->file('poster_url');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);

                // Save the file path or filename to DB
                $validated['poster_url'] = 'uploads/' . $imageName;
            }     

        Movie::create($validated);
        return redirect()->route('movies.index')->with('success',  "Movie succesfully added");    //remove with if not gonna use     
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all(); // for dropdown select in view

        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    public function storeedit(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        //dd($request->poster_url);
        $validated = $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'duration' => 'required|integer',
            'poster_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // allow nullable for optional re-upload
        ]);
        //dd($request->poster_url);
        if ($request->poster_url) {
            // delete old image if needed
            //dd($request->hasFile('poster_url'));
            if ($movie->poster_url && file_exists(public_path($movie->poster_url))) {
                unlink(public_path($movie->poster_url));
            }

            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image = $request->file('poster_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $validated['poster_url'] = 'uploads/' . $imageName;
        }

        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }
    public function delete(Movie $movie){
        //dd($uploadPath, $movie->poster_url);
        if ($movie->poster_url && file_exists(public_path($movie->poster_url))) {
            unlink(public_path($movie->poster_url));

        }        
        $movie->delete();

        return redirect()->route('movies.index')->with('success',  "Movie succesfully deleted");
    }

    public function search(Request $request)
        {
            $query = $request->input('search');

        

            $movies = Movie::when($query, function ($q) use ($query) { 
                $q->where('title', 'LIKE', "%{$query}%");
            })->orderBy('created_at', 'DESC')->paginate(10);

            return view('admin.movies.index', compact('movies', 'query'));
        } 
}
