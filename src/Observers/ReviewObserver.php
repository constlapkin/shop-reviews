<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Observers;

use Constlapkin\Reviews\Models\Review;

/**
 * Class ReviewObserver
 *
 * @package Constlapkin\Reviews\Observers
 */
class ReviewObserver
{
    /**
     * @param Review $review
     *
     * @return void
     */
    public function created(Review $review): void
    {
        if (config('shop-reviews.moderate')) {
            $review->published_at = now();
        }
    }

    /**
     * @param Review $review
     *
     * @return void
     */
    public function updated(Review $review): void
    {
        if (config('shop-reviews.moderate')) {
            $review->published_at = null;
        }
    }
}
