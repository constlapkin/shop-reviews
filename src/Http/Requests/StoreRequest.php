<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 *
 * @package Constlapkin\Reviews\Http\Requests
 */
class StoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer'],
            'comment' => ['nullable', 'string'],
            'score' => ['required', 'integer'],
        ];
    }
}
