<?php

namespace App\Http\Controllers;

use App;
use App\Models\CatalogProduct;
use App\Models\CatalogCategory;
use App\Models\CatalogProductColor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CatalogProductResource;


class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Базовые значения цен
        $baseQuery = CatalogProduct::query();
        $minPrice = $baseQuery->min('price') ?? 0;
        $maxPrice = $baseQuery->max('price') ?? 10000;

        // Основной запрос с фильтрами
        $query = CatalogProduct::query()->with(['category', 'colors']);

        // Фильтр по цене
        if ($request->filled(['min_price', 'max_price'])) {
            $query->whereBetween('price', [
                max($request->min_price, $minPrice),
                min($request->max_price, $maxPrice)
            ]);
        }

        // Фильтр по категориям
        if ($request->filled('categories')) {
            $validCategories = CatalogCategory::whereIn('id', $request->categories)->pluck('id');
            $query->whereIn('category_id', $validCategories);
        }

        // Фильтр по цветам
        if ($request->filled('colors')) {
            $validColors = CatalogProductColor::whereIn('id', $request->colors)->pluck('id');
            $query->whereHas('colors', function($q) use ($validColors) {
                $q->whereIn('id', $validColors);
            });
        }

        // Получение продуктов
        $products = $query->paginate(10)->withQueryString();

        // Данные для фильтров
        $filteredProductsIds = $query->pluck('id');
        
        $categories = CatalogCategory::withCount(['products' => function($q) use ($filteredProductsIds) {
            $q->whereIn('id', $filteredProductsIds);
        }])->get();

        $colors = CatalogProductColor::withCount(['products' => function($q) use ($filteredProductsIds) {
            $q->whereIn('id', $filteredProductsIds);
        }])->get();

        // Ответ для AJAX
        if ($request->ajax()) {
            return view('partials.products', compact('products'));
        }

        return view('catalog', compact(
            'products',
            'minPrice',
            'maxPrice',
            'categories',
            'colors'
        ));
    }

    public function apiIndex(Request $request): JsonResponse
    {
        $request->validate([
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:catalog_categories,id',
            'colors' => 'nullable|array', 
            'colors.*' => 'integer|exists:catalog_product_colors,id',
            'page' => 'nullable|integer|min:1'
        ]);

        $query = CatalogProduct::query()->with(['category', 'colors']);

        // Фильтр по цене
        if ($request->filled(['min_price', 'max_price'])) {
            $query->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        // Фильтр по категориям
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Фильтр по цветам
        if ($request->filled('colors')) {
            $query->whereHas('colors', function($q) use ($request) {
                $q->whereIn('id', $request->colors);
            });
        }

        $products = $query->paginate(40);

        return response()->json([
            'data' => CatalogProductResource::collection($products),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ],
            'links' => [
                'first' => $products->url(1),
                'last' => $products->url($products->lastPage()),
                'prev' => $products->previousPageUrl(),
                'next' => $products->nextPageUrl(),
            ],
        ]);
    }
}
