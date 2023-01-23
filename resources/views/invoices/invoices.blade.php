@extends('layouts.master')
@section('title')
{{__('invoices.List')}}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
        <!--Internal   Notify -->
        <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('invoices.Invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                  {{__('invoices.List')}}  </span>
            </div>
        </div>


    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


@if (session()->has('Archive'))

  <script>
    window.onload = function() {
        notif({
            msg: "تم ارشفة الفاتورة بنجاح",
            type: "success"
        })
    }

   </script>
@endif

@if (session()->has('Delete'))

  <script>
    window.onload = function() {
        notif({
            msg: "تم حذف الفاتورة بنجاح",
            type: "success"
        })
    }

   </script>
@endif
    <!-- row -->
    <div class="row">


        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                        @can('invoice-export-excel')
                        <a class="modal-effect btn btn-success " data-effect="effect-rotate-bottom"
                        href="{{route('invoice.export')}}"><i class="fas fa-file-download"> {{__('invoices.Export_excel')}}</i></a>
                        @endcan
                 @can('invoice-create')


                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-rotate-bottom"
                        href="/invoices/create"> {{__('invoices.Create')}}</a>
                 @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{__('invoices.Invoice_number')}} </th>
                                    <th class="border-bottom-0"> {{__('invoices.Invoice_date')}}</th>
                                    <th class="border-bottom-0"> {{__('invoices.Invoice_due_date')}}</th>
                                    <th class="border-bottom-0">{{__('products.Product_name')}}</th>
                                    <th class="border-bottom-0">{{__('sections.Section_name')}}</th>
                                    <th class="border-bottom-0">{{__('invoices.Discount')}}</th>
                                    <th class="border-bottom-0">{{__('invoices.Rate_vat')}} </th>
                                    <th class="border-bottom-0"> {{__('invoices.Value_vat')}}</th>
                                    <th class="border-bottom-0">{{__('invoices.Total')}}</th>
                                    <th class="border-bottom-0">{{__('invoices.Statue')}}</th>
                                    <th class="border-bottom-0">{{__('invoices.Note')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($invoices as $invoice)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td> {{ $i }}</td>
                                        <td><a href="/invoice/{{$invoice->id}}/details">{{ $invoice->invoice_number }}</a></td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>{{ $invoice->section->section_name }}</td>
                                        <td>{{ $invoice->rate_vat }}</td>
                                        <td>{{ $invoice->value_vat }}</td>
                                        <td>{{ $invoice->discount }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>
                                            @if ($invoice->status_value == 0)
                                                <span class="text-danger"> {{ $invoice->status }}</span>
                                            @elseif($invoice->status_value == 1)
                                                <span class="text-success"> {{ $invoice->status }}</span>
                                            @else
                                                <span class="text-warning"> {{ $invoice->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $invoice->note }}</td>
                                        <td><div class="dropdown">
											<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">Dropdown Menu <i class="fas fa-caret-down ml-1"></i></button>
											<div  class="dropdown-menu tx-13">
                                                @can('invoice-edit')
												<a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}">Edit</a>
                                                @endcan
                                                    @can('invoice-delete')
                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                    data-toggle="modal" data-target="#delete_invoice"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                    الفاتورة</a>
                                                    @endcan
                                                    <a class="dropdown-item" href="{{route('show.status.payment',$invoice->id)}}"
                                                        ><i
                                                            class="text-danger"></i>&nbsp;&nbsp;
                                                        تغيير حالة الدفع</a>

                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#archive_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;ارشفة
                                                            الفاتورة</a>
                                                              @can('invoice-export-pdf')

                                                            <a class="dropdown-item"  href="{{route('invoice.print',$invoice->id)}}"
                                                                ><i
                                                                    class="text-success fas fa-info-alt"></i>&nbsp;&nbsp;طباعة
                                                                الفاتورة <input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}" ></a>
                                                                @endcan
											</div>
										</div></td>

                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
     <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
          </div>
     </div>


        <!--div-->

        <div class="modal fade" id="archive_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoice.archive', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الارشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
          </div>
     </div>

    </div>
    <!-- /row -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
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

    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        <script>

           $('#delete_invoice').on('show.bs.modal',function(event){
          var button=$(event.relatedTarget);
          var invoice_id=button.data('invoice_id');
          var modal=$(this)
          modal.find('.modal-body #invoice_id').val(invoice_id)
           })
            </script>

<script>

    $('#archive_invoice').on('show.bs.modal',function(event){
   var button=$(event.relatedTarget);
   var invoice_id=button.data('invoice_id');
   var modal=$(this)
   modal.find('.modal-body #invoice_id').val(invoice_id)
    })
     </script>


@endsection
