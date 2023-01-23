<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use App\Models\Section;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index_invoice()
    {
        return view('invoices.report_invoice');
    }

    public function search_invoice(Request $request)
    {


        $rdio = $request->rdio;



        if ($rdio == 1) {      //search by type invoice

            $type = $request->type;
            if ($type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::where('status', $type)->get();

                return view('invoices.report_invoice', compact('type', 'invoices'));
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

                $invoices = Invoice::whereBetween('invoice_date', [$start_at, $end_at])->where('status', $type)->get();
                return view('invoices.report_invoice', compact('type', 'start_at', 'end_at', 'invoices'));
            }
        } else {
            $invoices = Invoice::where('invoice_number', '=', $request->invoice_number)->get();
            return view('invoices.report_invoice', compact('invoices'));
        }
    }




    public function index_customer()
    {
        $sections = Section::all();
        return view('users.report', compact('sections'));
    }

    public function search_customer(Request $request)
    {
        $section = $request->Section;
        $product = $request->product;
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        $sections = Section::all();
        $invoices=Invoice::query();
        if ($start_at && $end_at && $section && $product) {

            $invoices = $invoices->where('section_id', $section)
                ->where('product', $product)
                ->whereBetween('invoice_date', [$start_at, $end_at]);
        }

else{
        if ($section && $product) {

            $invoices = $invoices->where('section_id', $section)
                ->where('product', $product);

        }
        if ($start_at && $end_at) {

            $invoices = $invoices->whereBetween('invoice_date', [$start_at, $end_at]);

        }

        $invoices=$invoices->paginate(3);
        return view('users.report', compact('invoices', 'sections'));
    }
}


public function view_file(Invoice $invoice, $number, $name)
{


    $path = $number . '/' . $name;
    if (!Storage::disk('attachments_invoice')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('attachments_invoice')->get($path);


    $http_response_header = ['Content-type' => 'type'];

    $response = Response::make($file, 200, $http_response_header);

    return $response;
}

public function download_file(Invoice $invoice, $number, $name)
{

    $file_name_downloaded = $name;
    $path = $number . '/' . $name;


    $http_response_header = ['Content-type' => 'png', Storage::path($path)];
    $exists = Storage::disk('attachments_invoice')->exists($path);
    if (!$exists) {
        return abort(404);
    }

    return  Storage::download(public_path('Attachments/' . $path), $file_name_downloaded, $http_response_header);
}



    /// archive invoice
    public function archive_invoice(Request $request)
    {
        $invoice = Invoice::find($request->invoice_id);
        $invoice->delete();
        session()->flash('Archive');
        return redirect()->route('invoices.archivment');
    }
    // cancel archive invoice
    public function archive_transfer(Request $request)
    {
        $invoice = Invoice::withTrashed()
            ->where('id', $request->invoice_id)
            ->restore();
        session()->flash('Archive_Transfer');
        return redirect()->route('invoices.archivment');
    }



    public function invoice_print(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)
            ->first();
        $pdf = Pdf::loadView('invoices.print_invoice', compact('invoice'));


        return $pdf->stream('invoice-' . $id . '.pdf');
    }

    public function export()
    {
        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    }


    //delete archive invoices from archivement
    public function archive_destroy(Request $request)
    {
        $invoice = Invoice::withTrashed()
            ->where('id', $request->invoice_id)
            ->first();
        $invoice->forceDelete();

        session()->flash('Destroy_Archive');
        return redirect()->route('invoices.archivment');
    }



    public function archivment(Invoice $invoice)
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.archivment', compact('invoices'));
    }




}
