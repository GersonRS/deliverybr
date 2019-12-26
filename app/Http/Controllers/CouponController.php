<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Http\Resources\CouponResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $relationships
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($relationships = null)
    {
        $coupons = Coupon::with($relationships ? explode('-', $relationships) : [])->get();
        return CouponResource::collection($coupons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
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
        $coupon = Coupon::create($request->all());

        return (new CouponResource($coupon))->additional(['message' => 'Created success', 'status' => true])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param null $relationships
     * @return CouponResource
     */
    public function show($id, $relationships = null)
    {
        $coupon = Coupon::with($relationships ? explode('-', $relationships) : [])->find($id);
        return new CouponResource($coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => ['message' => 'Establishment not found. Consider adding it!']
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
        $coupon->fill($request->all());
        $coupon->save();

        return (new CouponResource($coupon))->additional(['message' => 'Update success'])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Coupon not found. Consider adding it!'
                ] ], 404);
        }
        $coupon->delete();
        return (new CouponResource($coupon))->additional(['message' => 'Delete success'])->response()->setStatusCode(200);
    }
}
