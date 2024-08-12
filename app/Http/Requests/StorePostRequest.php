<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function attributes():array
    {
        return[
            'title' => 'Title',
            'full_content' => 'Content',
            'short_content' => 'Short Content',
            'photo' => 'Photo',
            'category_id' => 'Category',
            'tags' => 'Tags',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'short_content' => ['required', 'min:3'],
            'full_content' => ['required', 'min:3'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'user_id' => ['nullable', 'exists:users,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
        ];
    }


}
