<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\InvoiceFormRequest;
use App\Http\Requests\Invoice\InvoiceFormUpdateRequest;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    //
    public function all(Request $request)
    {
        return Inertia::render('Invoice/All', ['invoices' => Invoice::all()]);
    }

    public function create(InvoiceFormRequest $request)
    {
        Invoice::create($request->validated());

        return to_route('invoice.all');
    }

    public function edit(InvoiceFormUpdateRequest $request)
    {
        $invoice = Invoice::find($request->get('id'));
        if ($request->validated()) {
            $invoice->update($request->all());
        }
        return to_route('invoice.all');
    }

    public function delete(Request $request)
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::find($request->get('id'));
        if ($invoice) {
            $invoice->delete();
        }
        return to_route('invoice.all');
    }
}
