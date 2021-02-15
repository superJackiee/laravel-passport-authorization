<?php
namespace App\Http\Controllers;

use App\Book;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            [
                'auth:api', 
                'scopes:edit,create,delete'
            ])->except(
                [
                    'index', 'show'
                ]   
            );
    }
  
    public function index()
    {
        //return your all products
    }
  
    public function store(Request $request)
    {      
        //who has create scope, only he can store the products  
    }
  
    public function show($id)
    {
        //Show single product here
    }

    public function update(Request $request, $id)
    {
        //who has edit scope, only he can update the products
    }

    public function destroy($id)
    {
        //who has delete scope, only he can delete the products
    }

}