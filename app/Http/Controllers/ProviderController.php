<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Provider::all(),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        try {
            $provider = new Provider();
            $provider->name = $request->input('name');
            $provider->email = $request->input('email');
            $provider->save();
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $provider,
        ]);
    }
}
