<?php

namespace App\Services\User\V1_0\Domain\Requests;

use Bobolink\Core\Domains\Http\Foundation\ApiFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends ApiFormRequest
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
            'first_name' => ['string', 'required'],
            'last_name' => ['string', 'required'],
            'email' => ['string', Rule::unique('user')->ignore(Auth::id())],
            'date_of_birth' => ['string', 'nullable'],

        ];
    }
}
