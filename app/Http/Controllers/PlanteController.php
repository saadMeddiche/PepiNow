<?php

namespace App\Http\Controllers;

use App\Models\Plante;
use Illuminate\Http\Request;
use App\Http\Requests\PlanteFormValidation;
use Illuminate\Support\Facades\File;


class PlanteController extends Controller
{
   //Show All Plantes
   public function index()
   {
       //fetch all Plantes
       $Plantes = Plante::all();

       //return all Plantes in json format
       return response()->json(['Plantes' => $Plantes]);
   }

    //Add Plante
    public function store(PlanteFormValidation $request)
    {
        //store the validated data from the request , and store it in an associative array
        $data = $request->validated();

        //new instance
        $Plante = new Plante();

        //Affect the validated data to the new object
        $Plante->nom = $data["nom"];
        $Plante->description = $data["description"];
        $Plante->price = $data["price"];

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/plants/', $filename);
        $Plante->image = $filename;

        $Plante->categorie_id = $data["categorie_id"];
        
        //Insert the new Plante to the DB
        $Plante->save();

        //Return a success message
        return response()->json(['message' => 'Plante Added Successfuly']);
    }

   //Show Plantes
   public function show($id)
   {
       //Fetch Plante
       $Plante = Plante::find($id);

       //Return a "Fail Message" if no Plante has been found with that given ID
       if (!$Plante) return response()->json(['message' => 'No Plante Found'] , 404);
           
       //Return The Plante in json format
       return response()->json(['Plantes' => $Plante] , 200);
   }

    //Update Plante
    public function update(PlanteFormValidation $request, $id)
    {
        //store the validated data from the request , and store it in an associative array
        $data = $request->validated();

        // Find the choosen Plante to update
        $Plante = Plante::find($id);

        //Return a "Fail Message" if no Plante has been found with that given ID
        if (!$Plante)  return response()->json(['message' => 'No Plante Found'], 404);

        //afect the new data to the choosen object
        $Plante->nom = $data["nom"];
        $Plante->description = $data["description"];
        $Plante->price = $data["price"];

        if ($request->hasfile('image')) {

            //Delete the image from upload folder
            $destination = 'uploads/plante/' . $Plante->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            //Update the image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/plante/', $filename);
            $Plante->image = $filename;
        }

        $Plante->categorie_id = $data["categorie_id"];
       
        //Update the data of that Plante
        $Plante->update();

        //Return a success message
        return response()->json(['message' => 'Plante Updated Successfuly'], 200);
    }

    //Delete Plante
    public function destroy($id)
    {
        //Find the choosen Plante to delete
        $Plante = Plante::find($id);

        //Delete the image from upload folder
        $destination = 'uploads/plante/' . $Plante->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        //Return a "Fail Message" if no Plante has been found with that given ID
        if (!$Plante)  return response()->json(['message' => 'Plante Not Found'],404);

        //delete choosed Plante
        $Plante->delete();

        //Return a success message
        return response()->json(['message' => 'Plante Deleted Successfuly'],200);
    }
}
