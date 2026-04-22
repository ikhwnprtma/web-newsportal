<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view("admin.category.index",compact("categories"));
    }

    public function create(){
        return view("admin.category.create");
    }
    
    public function store(Request $request){
        $request->validate([
            "name"=> "required|unique:categories|max:255" 
        ]);

        Category::create($request->all());

        return redirect()->route("categories.index")->with("success","Kategori berhasil ditambahkan.");
    }

    public function edit(Category $category){
        return view("admin.category.edit",compact("category"));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            "name"=> "required|max:256|unique:categories,name," . $category->id 
        ]);
        
        $category->update($request->all());
        return redirect()->route("categories.index")->with("success","Kategori Berhasil Di Perbarui");
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route("categories.index")->with("success","Kategori Berhasil Di Hapus");
        
    }
}

