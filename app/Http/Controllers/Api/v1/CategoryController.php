<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Http\Requests\StoreUpdateCategoryFormRequest as StoreUpdateCategoryFormRequestAlias;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @var Category
     */
    private Category $category;
    private $totalPage = 5;

    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return response()->json($categories, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($category, 200);
    }

    /**
     * @param StoreUpdateCategoryFormRequestAlias $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }


    /**
     * @param \App\Http\Controllers\Api\v1\StoreUpdateCategoryFormRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        if (!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $category->update($request->all());

        return response()->json($category, 200);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$category = $this->category->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $category->delete();

        return response()->json(['success' => true], 204);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function products($id)
    {
        if (!$category = $this->category->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);

    }
}
