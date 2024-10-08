<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('categories.index')->with(['category' => $category, 'posts' => $category->getByCategory()]);
    }
}
