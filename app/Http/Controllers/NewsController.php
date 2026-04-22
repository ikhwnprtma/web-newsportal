<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news = News::with(['category', 'user'])->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function adminIndex()
    {
        $news = News::with(['category', 'user'])->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function adminCreate()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news-images', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function adminEdit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function adminUpdate(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news-images', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function adminDestroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }

    // Handle Upload Image dari Summernote
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('news_images', $filename, 'public');

            return response()->json([
                'url' => asset("admin/doksli/{$path}"),
                'filename' => $filename
            ]);
        }

        return response()->json(['error' => 'Gagal mengupload gambar'], 400);
    }
    public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required',
        'image'       => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    News::create([
        'title'       => $request->title,
        'slug'        => Str::slug($request->title),
        'content'     => $request->content,
        'image'       => $request->image, // Ambil dari hidden input
        'user_id'     => auth()->id(),
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
}

}
