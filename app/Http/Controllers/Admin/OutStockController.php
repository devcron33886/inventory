<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOutStockRequest;
use App\Http\Requests\StoreOutStockRequest;
use App\Http\Requests\UpdateOutStockRequest;
use App\Models\OutStock;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OutStockController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('out_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OutStock::with(['product', 'created_by'])->select(sprintf('%s.*', (new OutStock())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'out_stock_show';
                $editGate = 'out_stock_edit';
                $deleteGate = 'out_stock_delete';
                $crudRoutePart = 'out-stocks';

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

        return view('admin.outStocks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('out_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.outStocks.create', compact('products'));
    }

    public function store(StoreOutStockRequest $request)
    {
        $outStock = OutStock::create($request->all());

        return redirect()->route('admin.out-stocks.index');
    }

    public function edit(OutStock $outStock)
    {
        abort_if(Gate::denies('out_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $outStock->load('product', 'created_by');

        return view('admin.outStocks.edit', compact('outStock', 'products'));
    }

    public function update(UpdateOutStockRequest $request, OutStock $outStock)
    {
        $outStock->update($request->all());

        return redirect()->route('admin.out-stocks.index');
    }

    public function show(OutStock $outStock)
    {
        abort_if(Gate::denies('out_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outStock->load('product', 'created_by');

        return view('admin.outStocks.show', compact('outStock'));
    }

    public function destroy(OutStock $outStock)
    {
        abort_if(Gate::denies('out_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outStock->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutStockRequest $request)
    {
        OutStock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
