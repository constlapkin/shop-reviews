<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Models;

use Constlapkin\Reviews\Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Review
 *
 * @package Constlapkin\Reviews\Models
 */
class Review extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'published_at',
        'comment',
        'score',
    ];

    /**
     * @return string
     */
    public function getTable(): string
    {
        return config('shop-reviews.table', Str::snake(Str::pluralStudly(class_basename($this))));
    }

    /**
     * @param $attributes
     * @param $exists
     *
     * @return Review
     */
    public function newInstance($attributes = [], $exists = false): Review
    {
        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->getTable());
        return $model;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(config('shop-reviews.relation_model'));
    }

    /**
     * @return ReviewFactory
     */
    protected static function newFactory(): ReviewFactory
    {
        return ReviewFactory::new();
    }
}
