<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:20",
            "description" =>"required|string|max:100",
            "date" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>"Inserire nome prodotto",
            "description.required"=>"Inserire descrizione",
            "name.max"=>"Inserire nome prodotto di massimo 20 caretteri",
            "description.max"=>"La descrizione puo' contenere al massimo 100 caratteri",

        ];
    }
}
