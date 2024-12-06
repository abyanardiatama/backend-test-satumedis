<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'per_page' => 'nullable|integer|min:1',  // Validasi parameter per_page
        ]);
        $query = Product::query();
        // Pencarian berdasarkan nama produk
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Pencarian berdasarkan harga produk
        if ($request->filled('price')) {
            $query->where('price', $request->input('price'));
        }

        // Tentukan jumlah item per halaman, default 10
        $perPage = $request->input('per_page', 10);

        // Ambil data produk dengan pagination
        $products = $query->paginate($perPage);

        // Jika tidak ada data ditemukan
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No products found matching your criteria',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Search results retrieved successfully',
            'data' => $products
        ]);
    }
}
