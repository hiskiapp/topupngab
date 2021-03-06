<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'code' => 'required|unique:games,code',
                    'name' => 'required',
                    'unit' => 'required',
                    'items.*.amount' => 'required|numeric',
                    'items.*.price' => 'required|numeric',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'code' => 'required|unique:games,code,'.$this->game,
                    'name' => 'required',
                    'unit' => 'required',
                    'items.*.amount' => 'required|numeric',
                    'items.*.price' => 'required|numeric',
                ];
            default:
                break;
        }
    }
}
