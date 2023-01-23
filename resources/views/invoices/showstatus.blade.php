@extends('layouts.master')
@section('css')
@endsection
@section('title')
      {{__('invoices.Change_payment_statue')}}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('invoices.Invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     {{__('invoices.Change_payment_statue')}} </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.status.payment', $invoice->id) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('invoices.Invoice_number')}} </label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                   value="{{ $invoice->invoice_number }}" required
                                    readonly>
                            </div>

                            <div class="col">
                                <label> {{__('invoices.Invoice_date')}}</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->invoice_date }}" required readonly>
                            </div>

                            <div class="col">
                                <label> {{__('invoices.Invoice_due_date')}}</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->due_date }}" required readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('invoices.Section_number')}}</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->section->id }}">
                                        {{ $invoice->section->section_name }}
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('products.Product_name')}}</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('invoices.Amount_collection')}} </label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_collection }}" readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('invoices.Amount_Commission')}}</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_commission }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('invoices.Discount')}}</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">  {{__('invoices.Rate_vat')}}</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->rate_vat }}">
                                        {{ $invoice->rate_vat }}
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">  {{__('invoices.Value_vat')}} </label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->value_vat }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('invoices.Total')}} </label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $invoice->total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{__('invoices.Note')}}</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                {{ $invoice->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea"> {{__('invoices.Statue')}}</label>
                                <select class="form-control" id="value_status" name="value_status" required>
                                    <option selected="true" disabled="disabled">--  {{__('invoices.Statue')}}  --</option>
                                    <option value="2">{{__('invoices.Paid')}}</option>
                                    <option value="1"> {{__('invoices.Partially_paid')}}</option>
                                     <option value="0"> {{__('invoices.Unpaid')}} </option>

                                </select>
                            </div>

                            <div class="col">
                                <label> {{__('invoices.Payment_date')}}</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> {{__('invoices.Change_payment_statue')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
