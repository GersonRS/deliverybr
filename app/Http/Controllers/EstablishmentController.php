<?php

namespace App\Http\Controllers;

use App\Establishment;
use App\Http\Resources\EstablishmentCollection;
use App\Http\Resources\EstablishmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $relationships
     * @return EstablishmentCollection
     */
    public function index($relationships = null)
    {
        $establishments = Establishment::with($relationships ? explode('-', $relationships) : [])->get();
        return new EstablishmentCollection($establishments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'name_label' => 'required|max:255',
            'lat' => 'alpha_num|required',
            'lng' => 'alpha_num|required',
            'website' => 'required',
            'mail' => 'email|required',
            'address' => 'required',
            'phone' => 'alpha_dash|required',
            'image' => 'required',
            'thumbnail' => 'required',
            'active' => 'required|boolean',
            'user_id' => 'exists:App\User,id| required'
        ],[
            'name.required' => 'Please fill out the :attribute.',
            'mail.email' => 'Please fill in valid email address.',
            'mail.required' => 'Please fill out the :attribute.',
            'user_id.exists' => ':attribute does not exist.',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation errors',
                'errors' =>  $validator->errors(),
                'status' => false], 422);
        }
        $establishment = Establishment::create($request->all());
        return (new EstablishmentResource($establishment))->additional(['message' => 'Created success'])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param null $relationships
     * @return EstablishmentResource
     */
    public function show($id, $relationships = null)
    {
        $establishments = Establishment::with($relationships ? explode('-', $relationships) : [])->find($id);
        return new EstablishmentResource($establishments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        try {
            $establishment = Establishment::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => ['message' => 'Establishment not found. Consider adding it!']
            ], 404);
        }
        $this->validate($request, [
            'name' => 'required|max:255',
            'name_label' => 'required|max:255',
            'lat' => 'alpha_num|required',
            'lng' => 'alpha_num|required',
            'website' => 'required',
            'mail' => 'email|required',
            'address' => 'required',
            'phone' => 'alpha_dash|required',
            'image' => 'image|required',
            'thumbnail' => 'image|required',
            'active' => 'required|boolean',
            'user_id' => 'exists:App\User,id|required'
        ],[
            'name.required' => 'Please fill out the :attribute.',
            'mail.email' => 'Please fill in valid email address.',
            'mail.required' => 'Please fill out the :attribute.',
            'user_id.exists' => ':attribute does not exist.',
        ]);
        $establishment->fill($request->all());
        $establishment->save();

        return (new EstablishmentResource($establishment))->additional(['message' => 'Update success'])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $establishment = Establishment::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Establishment not found. Consider adding it!'
                ] ], 404);
        }
        $establishment->delete();
        return (new EstablishmentResource($establishment))->additional(['message' => 'Delete success'])->response()->setStatusCode(200);
    }

}
