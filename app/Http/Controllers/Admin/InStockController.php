<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInStockRequest;
use App\Http\Requests\StoreInStockRequest;
use App\Http\Requests\UpdateInStockRequest;
use App\Models\InStock;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InStockController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('in_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InStock::with(['product', 'created_by'])->select(sprintf('%s.*', (new InStock())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'in_stock_show';
                $editGate = 'in_stock_edit';
                $deleteGate = 'in_stock_delete';
                $crudRoutePart = 'in-stocks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.inStocks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('in_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.inStocks.create', compact('products'));
    }

    public function store(StoreInStockRequest $request)
    {
        $inStock = InStock::create($request->all());

        return redirect()->route('admin.in-stocks.index');
    }

    public function edit(InStock $inStock)
    {
        abort_if(Gate::denies('in_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inStock->load('product', 'created_by');

        return view('admin.inStocks.edit', compact('inStock', 'products'));
    }

    public function update(UpdateInStockRequest $request, InStock $inStock)
    {
        $inStock->update($request->all());

        return redirect()->route('admin.in-stocks.index');
    }

    public function show(InStock $inStock)
    {
        abort_if(Gate::denies('in_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inStock->load('product', 'created_by');

        return view('admin.inStocks.show', compact('inStock'));
    }

    public function destroy(InStock $inStock)
    {
        abort_if(Gate::denies('in_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inStock->delete();

        return back();
    }

    public function massDestroy(MassDestroyInStockRequest $request)
    {
        InStock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
