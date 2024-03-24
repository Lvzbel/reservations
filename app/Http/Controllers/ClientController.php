<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Client::all(),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        try {
            $client = new Client();
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->save();
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $client,
        ]);
    }
}
