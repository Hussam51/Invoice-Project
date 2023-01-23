@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('invoices.Note')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ $invoice->invoice_number }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">{{__('invoices.Note')}}</h6>
                        <p class="text-muted card-sub-title">Invoice Details with Payment Status
                            apllication.</p>

                    </div>
                     @if (session()->has('Delete'))
                    <div class="alert alert-danger alert-dismissble fade show "role="alert">
                        <strong>{{ session()->get('Delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->

                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">invoice information</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">payment status</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">attachments</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class="table-responsive mt-15" id="tab1">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><strong>invoice number</strong></th>
                                                            <td>{{ $invoice->invoice_number }}</td>
                                                            <th>invoice date</th>
                                                            <td>{{ $invoice->invoice_date }}</td>
                                                            <th>invoice due_date</th>
                                                            <td>{{ $invoice->due_date }}</td>
                                                            <th>Section</th>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">product</th>
                                                            <td>{{ $invoice->product }}</td>
                                                            <th>Amount Collection</th>
                                                            <td>{{ $invoice->amount_collection }}</td>
                                                            <th>Amount Commission</th>
                                                            <td>{{ $invoice->amount_commission }}</td>
                                                            <th>Discount</th>
                                                            <td>{{ $invoice->discount }}</td>


                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Rate Vat</th>
                                                            <td>{{ $invoice->rate_vat }}</td>
                                                            <th>Value Vate</th>
                                                            <td>{{ $invoice->value_vat }}</td>
                                                            <th>Total</th>
                                                            <td>{{ $invoice->total }}</td>
                                                            <th>Status</th>
                                                            @if ($invoice->status_value == 0)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                                                </td>
                                                            @elseif ($invoice->status_value == 2)
                                                                <td><span
                                                                        class=" badge badge-pill badge-success">{{ $invoice->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>invoice number</th>
                                                        <th>product</th>
                                                        <th>Section</th>
                                                        <th>invoice Date</th>
                                                        <th>Payment Status</th>
                                                        <th>Add By User </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @forelse ($invoices_details as $inv_det)
                                                        @php
                                                            $i++;
                                                        @endphp
                                                        <tr>
                                                            <th>{{ $i }}</th>
                                                            <th>{{ $inv_det->invoice_number }}</th>
                                                            <th>{{ $inv_det->product }}</th>
                                                            <th>{{ $invoice->section->section_name }}</th>
                                                            <th> {{ $inv_det->created_at }}</th>
                                                            @if ($inv_det->status_value == 0)
                                                                <th>

                                                                    <span
                                                                        class="badge badge-pill badge-danger">{{ $inv_det->status }}
                                                                    </span>
                                                                </th>
                                                            @elseif ($inv_det->status_value == 1)
                                                                <th>

                                                                    <span
                                                                        class="badge badge-pill badge-warning">{{ $inv_det->status }}
                                                                    </span>
                                                                </th>
                                                            @else
                                                                <th>

                                                                    <span
                                                                        class="badge badge-pill badge-success">{{ $inv_det->status }}
                                                                    </span>
                                                                </th>
                                                            @endif

                                                            <th>{{ $inv_det->user }} </th>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane active" id="tab3">

                                            <div class="card-body">
                                                <p class="text-danger">*  pdf, jpeg ,.jpg , png </p>
                                                <h5 class="card-title">اضافة مرفقات</h5>
                                                <form method="post" action="{{ route('invoice.attachments') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="file_name" required>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                            value="{{ $invoice->invoice_number }}">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <label class="custom-file-label" for="customFile">حدد
                                                            المرفق</label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary btn-sm "
                                                        name="uploadedFile">تاكيد</button>
                                                </form>
                                            </div>
                                            <br>
                                            <br>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>File</th>
                                                        <th>Created By</th>
                                                        <th>Created At</th>
                                                        <th>Opperations</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @forelse ($invoice_attachments as $invoice_attachment)
                                                        @php
                                                            $i++;
                                                        @endphp
                                                        <tr>
                                                            <th>{{ $i }}</th>
                                                            <th>{{ $invoice_attachment->file_name }}
                                                            <th>{{ $invoice_attachment->createdBy }}</th>
                                                            <th>{{ $invoice_attachment->created_at }}</th>
                                                            <th colspan="2">

                                                                <a class="btn btn-outline-success btn-sm"
                                                                    href="{{ url('View/' . $invoice_attachment->invoice_number . '/' . $invoice_attachment->file_name) }}"
                                                                    role="button">
                                                                    <i class="fas fa-eye">&nbsp; View</i>
                                                                </a>
                                                                <a class="btn btn-outline-info btn-sm"
                                                                    href="{{ url('Download/' . $invoice_attachment->invoice_number . '/' . $invoice_attachment->file_name) }}"
                                                                    role="button">
                                                                    <i class="fas fa-download">&nbsp; Download</i>
                                                                </a>
                                                                <a class="btn btn-danger" data-toggle="modal"
                                                                    data-effect="effect-rotate-bottom"
                                                                    href="#modaldemodelete"
                                                                    data-invoice_number="{{ $invoice_attachment->invoice_number }}"
                                                                    data-file_name="{{ $invoice_attachment->file_name }}"
                                                                    data-id="{{ $invoice_attachment->id }}">

                                                                    Deleteode
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modaldemodelete">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المرفق</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('attach.destroy') }} " method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <p> هل انت متأكد من عملية الحذف</p>
                                <input class="form-control" type="hidden" id="id" name="id">
                                <input class="form-control" type="text" id="file_name" name="file_name" readonly>
                                <input class="form-control" type="text" id="invoice_number" name="invoice_number" readonly>
                            </div>


                            <div class="modal-footer">
                                <div class="form-group">
                                    <button class="btn ripple btn-primary" type="submit">تأكيد</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal"
                                        type="button">إغلاق</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /div -->





    <!-- Container closed -->



    <!-- main-content closed -->
@endsection


@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script>
        $('#modaldemodelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('modal-body #id').value(id)
            modal.find('modal-body #file_name').value(file_name)
            modal.find('modal-body #invoice_number').value(invoice_number)
        })
    </script>
@endsection
