<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests\CategorieFormValidation;

class CategorieController extends Controller
{
    //Show All Categories
    public function index()
    {
        //fetch all Categories
        $Categories = Categorie::all();

        //return all Categories in json format
        return response()->json(['Categories' => $Categories]);
    }

    //Add Categorie
    public function store(CategorieFormValidation $request)
    {
        //store the validated data from the request , and store it in an associative array
        $data = $request->validated();

        //new instance
        $Categorie = new Categorie();

        //Affect the validated data to the new object
        $Categorie->nom = $data["nom"];
        
        //Insert the new Categorie to the DB
        $Categorie->save();

        //Return a success message
        return response()->json(['message' => 'Categorie Added Successfuly']);
    }

    //Show Categories
    public function show($id)
    {
        //Fetch Categorie
        $Categorie = Categorie::find($id);

        //Return a "Fail Message" if no categorie has been found with that given ID
        if (!$Categorie) return response()->json(['message' => 'No Categorie Found'] , 404);
            
        //Return The Categorie in json format
        return response()->json(['Categories' => $Categorie] , 200);
    }

    //Update Categorie
    public function update(CategorieFormValidation $request, $id)
    {
        //store the validated data from the request , and store it in an associative array
        $data = $request->validated();

        // Find the choosen Categorie to update
        $Categorie = Categorie::find($id);

        //Return a "Fail Message" if no Categorie has been found with that given ID
        if (!$Categorie)  return response()->json(['message' => 'No Categorie Found'], 404);

        //afect the new data to the choosen object
        $Categorie->nom = $data["nom"];
       
        //Update the data of that Categorie
        $Categorie->update();

        //Return a success message
        return response()->json(['message' => 'Categorie Updated Successfuly'], 200);
    }

    //Delete Categorie
    public function destroy($id)
    {
        //Find the choosen Categorie to delete
        $Categorie = Categorie::find($id);

        //Return a "Fail Message" if no Categorie has been found with that given ID
        if (!$Categorie)  return response()->json(['message' => 'Categorie Not Found'],404);

        //delete choosed Categorie
        $Categorie->delete();

        //Return a success message
        return response()->json(['message' => 'Categorie Deleted Successfuly'],200);
    }
}
