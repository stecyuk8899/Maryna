<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Product"},
     *     path="/api/product",
     *     @OA\Response(response="200", description="Get All Products.")
     * )
     */
    public function index()
    {
        $products = Product::with('product_images')->get();

        return response()->json($products, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Ідентифікатор продукту",
     *         required=true,
     *         @OA\Schema(
     *             type="number",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успішне видалення продукту"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Продукт не знайдено"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизований"
     *     )
     * )
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json("Delete complete!", 200,
            ["Content-Type"=>"application/json;", "Charset"=>"UTF-8"], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @OA\Get(
     *     tags={"Product"},
     *     path="/api/product/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Ідентифікатор продукту",
     *         required=true,
     *         @OA\Schema(
     *             type="number",
     *             format="int64"
     *         )
     *     ),
     *   security={{ "bearerAuth": {} }},
     *     @OA\Response(response="200", description="List Products."),
     * @OA\Response(
     *    response=404,
     *    description="Wrong id",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong Product Id has been sent. Pls try another one.")
     *        )
     *     )
     * )
     */
    public function getById($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200,
            ["Content-Type"=>"application/json;", "Charset"=>"UTF-8"], JSON_UNESCAPED_UNICODE);
    }
    /**
 * @OA\Post(
 *     tags={"Product"},
 *     path="/api/product/edit/{id}",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Ідентифікатор продукту",
 *         required=true,
 *         @OA\Schema(
 *             type="number",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="category_id",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="description",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="price",
 *                     type="number"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Update Product"
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Product not found"
 *     )
 * )
 */
    public function edit($id, Request $request)
    {
    $product = Product::findOrFail($id);
    $input = $request->all();
    $message = [
        'name.required' => 'Вкажіть назву продукту',
        'category_id.required' => 'Вкажіть ID категорії',
        'description.required' => 'Вкажіть опис продукту',
        'price.required' => 'Вкажіть ціну продукту'
    ];

    $validation = Validator::make($input, [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'category_id' => 'required'
    ], $message);

    if ($validation->fails()) {
        return response()->json($validation->errors(), 400, [], JSON_UNESCAPED_UNICODE);
    }

    $product->update($input);
    return response()->json($product, 200, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @OA\Post(
     *     tags={"Product"},
     *     path="/api/product",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={},
     *                 @OA\Property(
     *                     property="price",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Add Product.")
     * )
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $message = array(
            'name.required'=>'Вкажіть назву продукту',
            'price.required'=>'Вкажіть ціну продукту',
            'description.required'=>'Вкажіть опис продукту',
            'category_id.required'=>'Вкажіть ID категорії',
        );
        $validation = Validator::make($input, [
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'category_id'=>'required',
        ], $message);

        if($validation->fails()) {
            return response()->json($validation->errors(), 400,
                ["Content-Type"=>"application/json;charset=UTF-8", "Charset" => "utf-8"], JSON_UNESCAPED_UNICODE);
        }
        $product = Product::create($input);
        return response()->json($product, 201,
            ["Content-Type"=>"application/json;charset=UTF-8", "Charset" => "utf-8"], JSON_UNESCAPED_UNICODE);
    }
}
