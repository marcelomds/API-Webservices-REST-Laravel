<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product, $totalPage;
    private $path = 'products';

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->totalPage = 10;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = $this->product->getResults($request->all(), $this->totalPage);

        return response()->json($products, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $name = kebab_case($request->name);
            $extension = $request->file('image')->extension();

            $nameFIle = "{$name}.{$extension}";
            $data['image'] = $nameFIle;

            $upload = $request->file('image')->storeAs($this->path, $nameFIle);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $product = $this->product->create($data);

        return response()->json($product, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($product, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $data = $request->all();

        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if ($product->image) {
                if (Storage::exists("{$this->path}/{$product->image}"))
                    Storage::delete("{$this->path}/{$product->image}");
            }

            $name = kebab_case($request->name);
            $extension = $request->file('image')->extension();

            $nameFIle = "{$name}.{$extension}";
            $data['image'] = $nameFIle;

            $upload = $request->file('image')->storeAs($this->path, $nameFIle);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $product->update($data);

        return response()->json($product, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$product = $this->product->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        if ($product->image) {
            if (Storage::exists("{$this->path}/{$product->image}"))
                Storage::delete("{$this->path}/{$product->image}");
        }

        $product->delete();

        return response()->json(['success' => true], 204);
    }
}
