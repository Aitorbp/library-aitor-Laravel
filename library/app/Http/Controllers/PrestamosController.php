<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Libro;
use Exception;
use Illuminate\Support\Facades\Input;
class PrestamosController extends Controller
{
    public function booksToLend(Request $request)
    {
        $bookLoan = new Prestamo;
                $this->validateDate($bookLoan,$request);
                $bookLoan->user_id = $request->input('user_id');
                $libroId = $bookLoan->libro_id = $request->input('libro_id');
                $libroPrestado = Libro::find($libroId)->prestado;
            
                if($libroPrestado===1){
                var_dump($libroPrestado);
                    abort(403, 'Ese libro ya está prestado.');
               }
               else{
                $this->forLend($libroId);
                $bookLoan->save();
                return response()->json($bookLoan);
                }    

    }

    public function booksToReturn($libroId)
    {
        if($libroId == null || empty($libroId)){
            $response = array('error_code' => 404, 'error_msg' => 'Null value');
            return response()->json($response);
        }
        else{
           $prestado= Prestamo::where('id', $libroId)->update(['prestado'=>0]);
            var_dump($prestado);
            Libro::where('id', $libroId)->update(['prestado'=>0]);
        }
    }


    function forLend($libroId)
    {
     if($libroId == null ||  empty($libroId)){
        $response = array('error_code' => 404, 'error_msg' => 'Null value');
        return response()->json($response);
     }
     else{
        Libro::where('id', $libroId)->update(['prestado'=>1]);
     }   
     

    }
    public function validateDate($bookLoan, Request $request)
    {
        if(isset($request->fecha_devolucion) && isset($request->fecha_prestamo) && $request->fecha_devolucion <= $request->fecha_prestamo){
            $mensajeError = 'End date must be higher than start date';
           
        }
        else{
            if(isset($request->fecha_devolucion) && !isset($request->fecha_prestamo) && ($request->fecha_devolucion <= $bookLoan->fecha_prestamo || empty($bookLoan->fecha_prestamo))){
                $mensajeError = 'End date must be higher than start date';
            
            }elseif (!isset($request->fecha_devolucion) && isset($request->fecha_prestamo) && $request->fecha_prestamo >= $bookLoan->fecha_devolucion) {
                $mensajeError = 'Start date must be lower than end date';
             
            }else{
                if(isset($request->fecha_devolucion))
                    $bookLoan->fecha_devolucion = $request->fecha_devolucion;
                if(isset($request->fecha_prestamo))
                    $bookLoan->fecha_prestamo = $request->fecha_prestamo;
            }  
    }
    }
    public function showmylends(){
        $q = Input::get ('q');
        $loan = Prestamo::where('fecha_prestamo','LIKE','%'.$q.'%')
        ->orWhere('fecha_devolucion','LIKE','%'.$q.'%')
        ->get();
        if(count($loan) > 0)
            return view('lend', ['loans' => $loan]);
        else return view ('lend')->withMessage('No Details found. Try to search again !');
    }
}
