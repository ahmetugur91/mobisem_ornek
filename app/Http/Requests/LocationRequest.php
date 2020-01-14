<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "city" => "required",
            "district" => "required",
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Lokasyon Adı alanı gereklidir.",
            "city.required" => "Şehir alanı gereklidir.",
            "district.required" => "İlçe alanı gereklidir.",
            "lat.required" => "Latitude alanı gereklidir.",
            "lat.regex" => "Geçerli bir Latitude formatı giriniz.",
            "lng.required" => "Longitude alanı gereklidir.",
            "lng.regex" => "Geçerli bir Longitude formatı giriniz.",
        ];
    }
}
