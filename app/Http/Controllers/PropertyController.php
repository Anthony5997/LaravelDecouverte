<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Exception;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{

     /**
     * @OA\Get(
     *      path="/properties",
     *      operationId="getAllProperties",
     *      tags={"GET"},

     *      summary="Récupéré la liste des propriétés",
     *      description="Retourne la liste complète de toute les propriétés.",
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Requête erroné"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *   ),
     *  )
     */

    public function index(){

      $properties = Property::all();
      return response()->json($properties);
    }
 

    /**
     * @OA\Post(
     *      path="/property/create",
     *      operationId="createProperty",
     *      tags={"POST"},
     *      summary="Crée une propriété",
     *      description="Retourne une propriété.",
     *     @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *        )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *           response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     * 
     *      @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"title", "description", "image", "postcode", "city", "address", "room", "price", "size", "floor" },
     *                 @OA\Property(
     *                     property="title",
     *                     description="Titre de la propriété",
     *                     type="string",
     *                 ),
     *                @OA\Property(
     *                     property="image",
     *                     description="l'image de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="price",
     *                     description="le prix de la propriété",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="size",
     *                     description="Surface de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="floor",
     *                     description="Nombre d'étage de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="description",
     *                     description="Description de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="address",
     *                     description="L'address de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="postcode",
     *                     description="Code postale de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="room",
     *                     description="Nombre de pièces de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="city",
     *                     description="Ville de la propriété",
     *                     type="string"
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */


    public function store(Request $request){
      
     
      $this->validate($request, [
        'title' => "required",
        'image' => "required",
        'price' => "required",
        'size' => "required",
        'floor' => "required",
        'description' => "required",
        'address' => "required",
        'postcode' => "required",
        'room' => "required",
        'city' => "required",
      ]);


      $property = Property::create([
        'title' => $request->title,
        'image' => $request->image,
        'price' => $request->price,
        'size' => $request->size,
        'floor' => $request->floor,
        'description' => $request->description,
        'address' => $request->address,
        'postcode' => $request->postcode,
        'room' => $request->room,
        'city' => $request->city
    ]);
 
      return response()->json($property, 201);
     }


     /**
     * @OA\Get(
     *      path="/property/{id}",
     *      operationId="getProperty",
     *      tags={"GET"},

     *      summary="Récupéré une propriété",
     *      description="Retourne une propriété.",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Requête erroné"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *   ),
     *  )
     */


    public function show($id){

     $property =  Property::findOrFail($id);

     if ($property == null) {
      throw new Exception("Propriété inexistante", 404);
    }

      return response()->json($property);
    }

    /**
     * @OA\Put(
     *      path="/property/update/{id}",
     *      operationId="updateProperty",
     *      tags={"PUT"},
     *      summary="Met à jour une propriété",
     *      description="Modifie une propriété.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Requête erroné"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *   ),
     *      @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"title", "description", "image", "postcode", "city", "address", "room", "price", "size", "floor" },
     *                 @OA\Property(
     *                     property="title",
     *                     description="Titre de la propriété",
     *                     type="string",
     *                 ),
     *                @OA\Property(
     *                     property="image",
     *                     description="l'image de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="price",
     *                     description="le prix de la propriété",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="size",
     *                     description="Surface de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="floor",
     *                     description="Nombre d'étage de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="description",
     *                     description="Description de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="address",
     *                     description="L'address de la propriété",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="postcode",
     *                     description="Code postale de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="room",
     *                     description="Nombre de pièces de la propriété",
     *                     type="number"
     *                 ),
     *                @OA\Property(
     *                     property="city",
     *                     description="Ville de la propriété",
     *                     type="string"
     *                 ),
     *             ),
     *         ),
     *     ),
     *  )
     */


    public function update(Request $request, $id){

      $property = Property::findOrFail($id);
      
      $this->validate($request, [
        'title' => "required",
        'image' => "required",
        'price' => "required",
        'size' => "required",
        'floor' => "required",
        'description' => "required",
        'address' => "required",
        'postcode' => "required",
        'room' => "required",
        'city' => "required",
      ]);

       $property->update([
        'title' => $request->title,
        'image' => $request->image,
        'price' => $request->price,
        'size' => $request->size,
        'floor' => $request->floor,
        'description' => $request->description,
        'address' => $request->address,
        'postcode' => $request->postcode,
        'room' => $request->room,
        'city' => $request->city
      ]);

      return response()->json(["code" => 200]);
     }


    /**
     * @OA\Delete(
     *     path="/property/delete/{id}",
     *     summary="Supprimé une propriété",
     *     tags={"DELETE"},
     *     description="Supprimé une propriété",
     *     operationId="deleteProperty",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id de la propriété",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalide id",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Propriété non trouvé",
     *     )
     * )
     */

     public function delete(Request $request, $id){

      $property = Property::find($id);
      return $property->delete();
     }


}
