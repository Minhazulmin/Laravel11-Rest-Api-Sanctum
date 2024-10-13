<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware {

    public static function middleware() {
        return [
            new Middleware( 'auth:sanctum', except: ['index', 'show'] ),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StorePostRequest $request ) {

        $validatedData = $request->validated();
        $request->user()->posts()->create( $validatedData );

        return response()->json( [
            'success' => true,
            'message' => 'Data has been saved successfully!',
        ], 200 );
    }

    /**
     * Display the specified resource.
     */
    public function show( Post $post ) {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( UpdatePostRequest $request, Post $post ) {
        Gate::authorize( 'modify', $post );
        $validatedData = $request->validated();
        $post->update( $validatedData );

        return response()->json( [
            'success' => true,
            'message' => 'Data has been update successfully!',
        ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Post $post ) {
        Gate::authorize( 'modify', $post );
        $post->delete();

        return response()->json( [
            'success' => true,
            'message' => 'Data has been deleted successfully!',
        ], 200 );
    }
}