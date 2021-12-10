<?php


namespace App\Services\Driver\V1_0\Domain\Request;


use Bobolink\Core\Domains\Http\Foundation\ApiFormRequest;

class PingRequest extends ApiFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'lat' => ['required'],
            'lng' => ['required'],
        ];
    }
}
