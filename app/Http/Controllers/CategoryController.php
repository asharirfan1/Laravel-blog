<?php

namespace App\Http\Controllers;

use App\Imports\CatImport;
use App\Models\Category;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class CategoryController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }


    public function create()
    {

        $category = new Category();
        return view('category.create ', compact('category', 'category'));
    }


    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image_category = $this->catimage($request);
        }

        $category = Category::create([
            'name' => $request->name,
            'image_category' => $request->image_category,
        ]);
        return redirect()->route('category.index');

    }


    public function edit(Category $category)
    {


        return view('category.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {


        $category->update([
            'name' => $request->name,
            'image_category' => $request->image_category
        ]);
        return redirect()->route('category.index');

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');

    }

    public function import(Request $request)
    {
        Excel::import(new CatImport, $request->file('file'));
        return redirect()->route('category.index');

    }
}





