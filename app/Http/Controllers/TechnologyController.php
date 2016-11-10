<?php

namespace App\Http\Controllers;

use App\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;

        if(isset($name) && !empty($name)){

            $technology_search = Technology::where('name',$name)->first();

            if(is_null($technology_search)){

                $technology = new Technology();
                $technology->name = $name;
                $technology->image = '';
                $technology->save();
                return response()->json($technology);
            } else {
                return response('Technology with this name already exist',404);
            }


        } else {
            return response('Fill the name',404);
        }
    }

    /**
     * @SWG\Post(
     *   path="/api/v1/technologies",
     *     tags={"Technologies"},
     *   summary="Get a technologies",
     *     description="{Auth}",
     *   @SWG\Response(
     *     response=200,
     *     description="Auth"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * @SWG\Parameter(
    type="string",
    name="Authorization",
    in="header",
    required=true),
    * @SWG\Parameter(
    type="string",
    name="name",
    in="query",
    required=true)
     *
     *
     * )
     */

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technology = Technology::all();
        
        $message = 'Technologies not exist yet';

        if(count($technology)){
            return response()->json($technology);
        }
        else{
            return response($message,404);
        }
    }

    /**
     * @SWG\Get(
     *   path="/api/v1/technologies",
     *     tags={"Technologies"},
     *   summary="Get a technologies",
     *     description="{Auth}",
     *   @SWG\Response(
     *     response=200,
     *     description="Auth"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * @SWG\Parameter(
    type="string",
    name="Authorization",
    in="header",
    required=true)
     *
     *
     * )
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $position = Technology::where('id',$id)->first();
        if(!is_null($position)){
            $position->delete();

            return response('',204);

        } else {
            return response('Missing in DB',404);
        }

    }

    /**
     * @SWG\Delete(
     *   path="/api/v1/technologies/{id}",
     *     tags={"Technologies"},
     *   summary="Delete a technologies",
     *     description="{Auth}",
     *   @SWG\Response(
     *     response=200,
     *     description="Auth"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * @SWG\Parameter(
    type="string",
    name="Authorization",
    in="header",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="id",
    in="path",
    required=true),
     *
     *
     * )
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateName($id, Request $request){

        $technology = Technology::where('id',$id)->first();
        $requestName = $request->name;

        if(isset($requestName) && !empty($requestName)){

            if(!is_null($technology)){

                if($requestName != $technology->name){

                    $technology->name  = $requestName;
                    $technology->save();
                    return response()->json($technology);
                } else {
                    return response('Try to change on similar name',404);
                }

            } else {
               return response('Try to update not existing technology',404);
            }
        }
        else {
                return response('Fill the name',404);
            }
    }
    /**
     * @SWG\Put(
     *   path="/api/v1/technologies/{id}",
     *     tags={"Technologies"},
     *   summary="Update a technologies",
     *     description="{Auth}",
     *   @SWG\Response(
     *     response=200,
     *     description="Auth"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * @SWG\Parameter(
    type="string",
    name="Authorization",
    in="header",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="id",
    in="path",
    required=true),
     *@SWG\Parameter(
    type="string",
    name="name",
    in="query",
    required=true),
     *
     *
     * )
     */
}