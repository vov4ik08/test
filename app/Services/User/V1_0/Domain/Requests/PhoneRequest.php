<?php


namespace App\Services\User\V1_0\Domain\Requests;


use Bobolink\Core\Domains\Http\Foundation\ApiFormRequest;

class PhoneRequest extends ApiFormRequest
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
            'phone' => ['string', 'required'],
        ];
    }
}
