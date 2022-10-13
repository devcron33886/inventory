<?php

namespace App\Http\Requests;

use App\Models\InStock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInStockRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('in_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:in_stocks,id',
        ];
    }
}
