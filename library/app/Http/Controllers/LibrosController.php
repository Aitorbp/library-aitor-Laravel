<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use Illuminate\Support\Facades\Input;

class LibrosController extends Controller
{
    public function showAllBooks()
    {
        $libros = Libro::all();
        
        foreach ($libros as $libro) {
            print_r(json_encode($libro));
        }
    }
//Función para filtrar por género
    public function getByGenre($genre)
    {
        if($genre ==null){
            $response = array('error_code' => 404, 'error_msg' => 'Liga '.$genre. ' not found');
            return response()->json($response);
        }
        else{
            $books = Libro::where('genero',$genre)->get();
            return response()->json($books);
        }
    }
    public function getByAuthor($author)
    {
        
        $books = Libro::where('autor',$author)->get();

        return response()->json($books);
    }

    public function postBook(Request $request){

        $book = new Libro;

        if($request->nombre  == null || $request->autor == null || $request->descripcion == null ||$request->genero == null){
            $response = array('error_code' => 404, 'error_msg' => 'Null value');
            return response()->json($response);
        }else{
            $book->nombre = $request->input('nombre');
            $book->autor = $request->input('autor');
            $book->descripcion = $request->input('descripcion');
            $book->genero = $request->input('genero');
            $book->save();
            return response()->json($book);
        }
       
    }

    public function deleteBook($id)
    {
        if($id==null || empty($id)){
            $response = array('error_code' => 404, 'error_msg' => 'Row not found');
            return response()->json($response);
        }
        $book = Libro::find($id);
        $book->delete();
        return response("Libro borrado");
    }

    public function updateBook(Request $request, $id)
    {
        $book = Libro::find($id);
        if($book->nombre  ==null || $book->autor = null || $book->descripcion = null ||$book->genero == null){
            $response = array('error_code' => 404, 'error_msg' => 'Row not found');
            return response()->json($response);
        }else{
            $book->nombre = $request->input('nombre');
            $book->autor = $request->input('autor');
            $book->descripcion = $request->input('descripcion');
            $book->genero = $request->input('genero');
            $book->save();
            return response()->json($book);
        }
    }

    public function search(){
        $q = Input::get ('q');
        $libro = Libro::where('nombre','LIKE','%'.$q.'%')
        ->orWhere('autor','LIKE','%'.$q.'%')
        ->orWhere('genero','LIKE','%'.$q.'%')
        ->get();
        if(count($libro) > 0)
            return view('search', ['books' => $libro]);
        else return view ('search')->withMessage('No Details found. Try to search again !');
    }

   
}
