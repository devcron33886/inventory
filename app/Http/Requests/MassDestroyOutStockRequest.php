<?php

namespace App\Http\Requests;

use App\Models\OutStock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOutStockRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('out_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:out_stocks,id',
        ];
    }
}
