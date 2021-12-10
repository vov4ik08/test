<?php


namespace App\Services\Order\V1_0\Domain\Request;


use Bobolink\Core\Domains\Http\Foundation\ApiFormRequest;

class CreateOrderRequest extends ApiFormRequest
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
            'from' => ['required'],
            'to' => ['required'],
            'price' => ['required'],
            'polyline_information' => ['required'],
            'platform' => ['required'],
            'user_fire_base_token' => ['required'],
            'snapshot' => ['required'],

        ];
    }
}
