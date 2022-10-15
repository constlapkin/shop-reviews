<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Http\Controllers\Api;

use Constlapkin\Reviews\Http\Requests\IndexRequest;
use Constlapkin\Reviews\Http\Requests\StoreRequest;
use Constlapkin\Reviews\Http\Requests\UpdateRequest;
use Constlapkin\Reviews\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class ReviewController
 *
 * @package Constlapkin\Reviews\Http\Controllers\Api
 */
class ReviewController extends Controller
{
    /**
     * @param IndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        $reviews = Review::where(function ($q) use ($request) {
            if (!empty($request->user_id)) {
                $q->where('user_id', $request->user_id);
            }
            if (!empty($request->product_id)) {
                $q->where('product_id', $request->product_id);
            }
        });

        if (!empty($request->sort_by)) {
            $direction = 'desc';
            if (str_contains($request->sort_by, '-')) {
                $direction = 'asc';
            }
            $reviews->orderBy($request->sort_by, $direction)->get();
        }
        return response()->json($reviews);
    }

    /**
     * @param Review $review
     *
     * @return JsonResponse
     */
    public function show(Review $review): JsonResponse
    {
        return response()->json($review);
    }

    /**
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $userId = Auth::id();
        if (!empty($userId)) {
            return response()->json(null, 403);
        }
        $request->user_id = $userId;
        $review = Review::create($request);
        return response()->json($review, 201);
    }

    /**
     * @param UpdateRequest $request
     * @param Review        $review
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Review $review): JsonResponse
    {
        $review = $review->update([$request]);
        return response()->json($review);
    }

    /**
     * @param Review $review
     *
     * @return JsonResponse
     */
    public function destroy(Review $review): JsonResponse
    {
        $review->delete();
        return response()->json(null, 204);
    }
}
