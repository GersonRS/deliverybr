<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($relationships = null)
    {
        $categories = Category::with($relationships ? explode('-', $relationships) : [])->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'establishment_id' => 'required|exist:App\Establishment,id',
        ],[
            'code.required' => 'Please fill out the :attribute.',
            'value.required' => 'Please fill out the :attribute.',
            'type.required' => ':attribute is required.',
            'establishment_id.exist' => ':attribute does not equals.',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation errors',
                'errors' =>  $validator->errors(),
                'status' => false], 422);
        }
        $category = Category::create($request->all());

        return (new CategoryResource($category))->additional(['message' => 'Created success', 'status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CategoryResource
     */
    public function show($id, $relationships = null)
    {
        $category = Category::with($relationships ? explode('-', $relationships) : [])->find($id);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => ['message' => 'Category not found. Consider adding it!']
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'establishment_id' => 'required|exist:App\Establishment,id',
        ],[
            'code.required' => 'Please fill out the :attribute.',
            'value.required' => 'Please fill out the :attribute.',
            'type.required' => ':attribute is required.',
            'establishment_id.exist' => ':attribute does not equals.',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Validation errors',
                'errors' =>  $validator->errors(),
                'status' => false], 422);
        }
        $category->fill($request->all());
        $category->save();

        return (new CategoryResource($category))->additional(['message' => 'Update success'])->response()->setStatusCode(200);
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
            $establishment = Category::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Category not found. Consider adding it!'
                ] ], 404);
        }
        $establishment->delete();
        return (new CategoryResource($establishment))->additional(['message' => 'Delete success'])->response()->setStatusCode(200);
    }
}
