<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsService extends Controller{
    
    public function index()
    {
        $news = News::with(['user', 'category'])->get();

        return response()->json([
            'message' => 'List Berita Berhasil Diambil',
            'data' => $news
        ]);
    }

    public function show($id)
    {
        $news = News::with(['user', 'category'])->find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail Berita Ditemukan',
            'data' => $news
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'image'       => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $news = News::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->content,
            'image'       => $request->image,
            'category_id' => $request->category_id,
            'user_id'     => 1, 
        ]);

        return response()->json([
            'message' => 'Berita berhasil ditambahkan',
            'data' => $news
        ], 201);
    }

    // Update Berita
    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'image'       => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $news->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->content,
            'image'       => $request->image,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Berita berhasil diperbarui',
            'data' => $news
        ]);
    }

    // Hapus Berita
    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $news->delete();

        return response()->json(['message' => 'Berita berhasil dihapus']);
    }
}
