<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 *
 * @package Constlapkin\Reviews\Http\Requests
 */
class UpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'comment' => ['nullable', 'integer'],
            'score' => ['required', 'integer'],
        ];
    }
}
