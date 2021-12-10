<?php


namespace App\Services\Driver\V1_0\Domain\Request;


use Bobolink\Core\Domains\Http\Foundation\ApiFormRequest;

class AcceptOrderRequest extends ApiFormRequest
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
            'order_id' => ['required'],
        ];
    }
}
