<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 *
 * @package Constlapkin\Reviews\Http\Requests
 */
class IndexRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'integer'],
            'product_id' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
        ];
    }
}
