<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'img' => 'image|max:100000',
            'content' => 'required'
        
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'content.required' => 'Description for post is compulsory'
        ];
    }
}
