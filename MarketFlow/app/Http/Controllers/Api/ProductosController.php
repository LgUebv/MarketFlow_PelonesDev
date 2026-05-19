<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductoService;
use Illuminate\Http\JsonResponse;

class ProductosController extends Controller
{

    public function __construct(
        private readonly ProductoService $productoService
    ) {}

    public function index() : JsonResponse
    {
        try {
        $products = $this->productoService->getCatalogo();

        return response()->json([
            'success' => true,
            'data'    => $products,
        ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos',
            ], 500);
        }
    }

        public function show(int $id) : JsonResponse
    {
        try {
            $product = $this->productoService->getDetalle($id);

            return response()->json([
                'success' => true,
                'data'    => $product,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el producto',
            ], 500);
        }
    }
}
