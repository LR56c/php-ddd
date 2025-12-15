<?php

namespace App\Http\Controllers;

use App\Domain\ValueObject\UUIDError;
use App\Domain\ValueObject\ValidUUID;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/posts",
     * summary="Obtener lista de posts",
     * tags={"Posts"},
     * @OA\Response(
     * response=200,
     * description="Operación exitosa"
     * ),
     * @OA\Response(
     * response=401,
     * description="No autenticado"
     * )
     * )
     */
    public function index()
    {
        return response()->json(Post::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $request->user()->posts()->create($request->all());

        return back()->with('success', 'Post creado!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();
        return back()->with('success', 'Eliminado');
    }
}
