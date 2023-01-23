<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use App\Models\invoice_attachment;
use App\Models\invoice_details;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\invoicemail;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpParser\Node\Expr\New_;

use Symfony\Component\HttpFoundation\File\File;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
        $this->middleware('permission:invoice-list', ['only' => ['index']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }



    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $invoice = new Invoice();


        $invoice->invoice_number = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_Date;
        $invoice->section_id = $request->Section;
        $invoice->note = $request->note;
        $invoice->amount_collection = $request->Amount_collection;
        $invoice->amount_commission = $request->Amount_Commission;
        $invoice->product = $request->product;
        $invoice->due_date = $request->Due_date;
        $invoice->discount = $request->Discount;
        $invoice->rate_vat = $request->Rate_VAT;
        $invoice->value_vat = $request->Value_VAT;
        $invoice->status_value = 0;
        $invoice->status = 'not_paid';
        $invoice->user = Auth::user()->name;
        $invoice->total = $request->Total;
        $invoice->save();


        $invoice_id = Invoice::latest()->first()->id;
        invoice_details::create([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'not_paid',
            'status_value' => 0,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);

        if ($request->hasFile('pic')) {

            $image = $request->file('pic');
            $image_path = $image->getClientOriginalName();
            invoice_attachment::create([
                'invoice_id' => $invoice_id,
                'invoice_number' => $request->invoice_number,
                'file_name' => $image_path,
                'createdBy' => Auth::user()->name
            ]);


            $image->storeAs($request->invoice_number . '/', $image_path, 'attachments_invoice');
        }
        $user = User::first();

        $user->notify(new invoicemail($invoice_id));
        session()->flash('Add', 'Created Successfully');
        return redirect()->back();
    }


    public function showstatus($id)
    {

        $invoice = Invoice::find($id)->first();
        return view('invoices.showstatus', compact('invoice'));
    }

    public function show(Invoice $invoice)
    {
    }


    public function update_status(Request $request, $id)
    {

        $invoice = Invoice::find($id);

        if ($request->value_status == 1) {
            $invoice->update([
                'status_value' => $request->value_status,
                'status' => 'partially_paid',
                'payment_date' => $request->Payment_Date,
            ]);

            invoice_details::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => "partially_paid",
                'status_value' => $request->value_status,
                'note' => $request->note,
                'payment_date' => $request->Payment_Date,
                'user' => Auth::user()->name,
            ]);
        }


        if ($request->value_status == 2) {
            $invoice->update([
                'status_value' => $request->value_status,
                'status' => 'paid',
                'payment_date' => $request->Payment_Date,
            ]);

            invoice_details::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => 'paid',
                'note' => $request->note,
                'status_value' => $request->value_status,
                'payment_date' => $request->Payment_Date,
                'user' => Auth::user()->name,
            ]);
        }

        if ($request->value_status == 0) {
            $invoice->update([
                'status_value' => $request->value_status,
                'status' => 'partially_paid',
                'payment_date' => $request->Payment_Date,
            ]);

            invoice_details::create([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => "not_paid",
                'status_value' => $request->value_status,
                'note' => $request->note,
                'payment_date' => $request->Payment_Date,
                'user' => Auth::user()->name,
            ]);
        }
    }



    public function attachinsert(Request $request)
    {


        $this->validate($request, [
            'file_name' => 'required|mimes:png,jpg,pdf'
        ]);



        $file = $request->file('file_name');
        $file_path = $file->getClientOriginalName();
        invoice_attachment::create([
            'invoice_id' => $request->invoice_id,
            'invoice_number' => $request->invoice_number,
            'file_name' => $file_path,
            'createdBy' => Auth::user()->name
        ]);


        $file->storeAs($request->invoice_number . '/', $file_path, 'attachments_invoice');

        session()->flash('Add', 'Created Successfully');
        return redirect()->back();
    }

    /**

     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function details(Invoice $invoice, $id)
    {
        $invoice = Invoice::find($id)->first();
        $invoices_details = invoice_details::where('invoice_id', $id)->get();
        $invoice_attachments = invoice_attachment::where('invoice_id', $id)->get();
        return view('invoices.details', compact('invoice', 'invoices_details', 'invoice_attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
        $invoice = invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit', compact('invoice', 'sections'));
    }


    public function update(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)
            ->update([
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_Date,
                'due_date' => $request->Due_date,
                'section_id' => $request->Section,
                'product' => $request->product,
                'amount_commission' => $request->Amount_Commission,
                'amount_collection' => $request->Amount_collection,
                'discount' => $request->Discount,
                'rate_vat' => $request->Rate_VAT,
                'value_vat' => $request->Value_VAT,
                'total' => $request->Total,
                'status' => 'not_paid',
                'status_value' => 0,
                'note' => $request->note,
                'user' => Auth::user()->name,

            ]);



        invoice_details::where('invoice_id', $id)
            ->update([
                'invoice_id' => $id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => 'not_paid',
                'status_value' => 0,
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]);

        session()->flash('Edit', 'Updated Successfully');
        return redirect()->route('invoices.index');
    }


    public function unpaid()
    {
        $invoices = Invoice::where('status_value', 0)->get();
        return view('invoices.unpaid_invoices', compact('invoices'));
    }


    public function partially_paid()
    {
        $invoices = Invoice::where('status_value', 1)->get();
        return view('invoices.partiallypaid_invoices', compact('invoices'));
    }



    public function paid()
    {
        $invoices = Invoice::where('status_value', 2)->get();
        return view('invoices.paid_invoices', compact('invoices'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $invoice = Invoice::find($request->invoice_id)->first();


        $attach = invoice_attachment::where('invoice_id', $request->invoice_id)->get();
        if ($attach) {
            Storage::disk('attachments_invoice')->deleteDirectory($invoice->invoice_number);
        }

        $invoice->forceDelete(); /*when destroy invoice ,
                                 done also destroy all relationships with this invoice
                               */
        session()->flash('Delete', 'Deleted Successfully');
        return redirect()->back();
    }

    //delete one attachment

    public function destroyattach(Invoice $invoice, $number, $name, $id)
    {
        $attach = invoice_attachment::find($id);
        $attach->delete();
        $path = $number . '/' . $name;  // path= invoice_number/name_file
        Storage::disk('attachments_invoice')->delete($path);
        session()->flash('Delete', 'Deleted Successfully');
        return redirect()->back();
    }






    public function make_all_read()
    {
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead();
            }
        }

        return view('home');
    }
    public function getproducts($id)
    {

        $products = Product::where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }
}
