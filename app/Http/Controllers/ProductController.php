<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }
    
    public function showCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                        ->where('is_approved', true)
                        ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                        ->select('products.*', 
                                 DB::raw('AVG(reviews.rating) as reviews_avg_rating'),
                                 DB::raw('COUNT(reviews.id) as reviews_count'))
                        ->groupBy('products.id');
    
        // --- FILTERING LOGIC ---
        $query->when($request->filled('price_min'), function ($q) use ($request) {
            return $q->where('price', '>=', $request->input('price_min'));
        });
    
        $query->when($request->filled('price_max'), function ($q) use ($request) {
            return $q->where('price', '<=', $request->input('price_max'));
        });
        
        $query->when($request->filled('rating'), function ($q) use ($request) {
            $rating = $request->input('rating');
            // ZAP! This is the fix! We use havingRaw to make sure the database understands the command!
            return $q->havingRaw('AVG(reviews.rating) >= ?', [$rating]);
        });
        
        // --- SORTING LOGIC ---
        switch ($request->input('sort_by')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'most_reviewed':
                $query->orderBy('reviews_count', 'desc');
                break;
            case 'best_rated':
                $query->orderBy('reviews_avg_rating', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }
    
        $products = $query->get();
        $categoryName = ucwords(str_replace('-', ' ', $category));
    
        return view('products.category', compact('products', 'categoryName', 'category'));
    }

    public function show($id)
    {
        $product = Product::where('id', $id)
                          ->where('is_approved', true)
                          ->firstOrFail();

        $product->load('reviews.user');
        $product->avg_rating = $product->reviews->avg('rating');
        $product->review_count = $product->reviews->count();

        $reviews = $product->reviews;
        $canReview = false;
        $userReview = null;

        if (Auth::check()) {
            $hasPurchased = Order::where('user_id', Auth::id())
                                 ->where('status', 'delivered')
                                 ->whereHas('orderItems', function ($query) use ($id) {
                                     $query->where('product_id', $id);
                                 })
                                 ->exists();

            $userReview = Review::where('user_id', Auth::id())
                                 ->where('product_id', $id)
                                 ->first();

            $canReview = $hasPurchased && !$userReview;
        }

        return view('products.show', compact('product', 'reviews', 'canReview', 'userReview'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $searchResults = Product::where('is_approved', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        return view('products.search-results', [
            'products' => $searchResults,
            'searchQuery' => $query,
        ]);
    }

    public function deals()
    {
        $deals = Product::where('is_deal', true)
                        ->where('is_approved', true)
                        ->get();
        return view('deals.index', compact('deals'));
    }

    public function storeReview(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $hasPurchased = Order::where('user_id', Auth::id())
                             ->where('status', 'delivered')
                             ->whereHas('orderItems', function ($query) use ($product) {
                                 $query->where('product_id', $product->id);
                             })
                             ->exists();

        $hasAlreadyReviewed = Review::where('user_id', Auth::id())
                                     ->where('product_id', $product->id)
                                     ->exists();
        
        if (!$hasPurchased || $hasAlreadyReviewed) {
            return back()->with('error', 'You are not eligible to review this product.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
    
    public function updateReview(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review updated successfully!');
    }

    public function deleteReview(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }
        
        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}