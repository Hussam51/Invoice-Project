@extends('layouts.master')
@section('title')
    {{__('products.Products')}}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Setting</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('products.Products')}}</span>
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
    <!-- row -->

    @if ($errors->any())
     <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
     </div>
   @endif

    <div class="row">
        @if (session()->has('Delete'))
        <div class="alert alert-danger alert-dismissble fade show "role="alert">
            <strong>{{ session()->get('Delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissble fade show "role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissble fade show "role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



        <div class="col-xl-12">
            <div class="card mg-b-20">
                    @can( 'product-create')
                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-rotate-bottom"
                    data-toggle="modal" href="#modaldemo8">  {{__('products.Create')}}</a>
                    @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <!--      data table      -->
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0"># </th>
                                    <th class="border-bottom-0">{{__('products.Product_name')}}  </th>

                                    <th class="border-bottom-0"> {{__('sections.Section_name')}} </th>

                                    <th class="border-bottom-0">{{__('products.Note')}} </th>
                                    <th class="border-bottom-0">options </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 0; ?>



                                @forelse ($products as  $product)
                                    <?php $i++; ?>

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->section->section_name }}</td>

                                        <td>{{ $product->description }}</td>
                                        <td>
                                              @can('product-delete')

                                            <a class="btn btn-danger" data-effect="effect-rotate-bottom" data-toggle="modal"
                                                href="#modaldemodelete" data-id="{{ $product->id }} " data-product_name="{{$product->product_name}}" > {{__('products.Delete')}}</a>
                                              @endcan
                                              @can( 'product-edit')
                                                <a class="btn btn-secondary" data-effect="effect-rotate-bottom"
                                                data-id="{{ $product->id }}"
                                                data-productname="{{ $product->product_name }} "
                                                data-sectionname="{{$product->section->section_name}}"
                                                data-section_id="{{$product->section->id}}"
                                                data-description="{{ $product->description }}" data-toggle="modal"
                                                href="#modaldemoedit">
                                                 {{__('products.Edit')}}</a>
                                             @endcan
                                        </td>

                                    </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title ">   {{__('products.Create')}}</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.store') }} " method="POST">
                            @csrf
                            @method('Post')
                            <div class="form-group">
                                <p>  {{__('products.Product_name')}}</p>
                                <input class="form-control" placeholder=" {{__('products.Product_name')}}" type="text" name="product_name">
                            </div>
                            <div class="form-group">

                                <label for="section" > {{__('sections.Section_name')}} </label><br>
                                <select name="section_id" id="id" required>
                                    <option value="" selected disabled> {{__('products.Product_name')}} --</option>
                                    @forelse ($sections as $section)

                                    <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @empty

                                    @endforelse
                                </select>

                            </div>
                            <div class="form-group">
                                <p>{{__('products.Note')}} </p>
                                <textarea class="form-control" placeholder="{{__('products.Note')}}" type="text" name="description"></textarea>
                            </div>

                            <div class="modal-footer">
                                <div class="form-group">
                                    <button class="btn ripple btn-primary" type="submit">send</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal"
                                        type="button">close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Scroll with content modal -->
        </div>

        <div class="modal" id="modaldemoedit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> {{__('products.Edit')}}</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.update') }} " method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="id" name="id">
                                <p>  {{__('products.Product_name')}}</p>
                                <input class="form-control" type="text" id="product_name" name="product_name">
                                <p>  {{__('sections.Section_name')}}</p>
                               <select name="section_id" id="section_id">
                                @forelse ($sections as $section)
                                  <option value="{{$section->id}}" >{{$section->section_name}}</option>
                                @empty

                                @endforelse
                               </select>
                            </div>
                            <div class="form-group">
                                <p>{{__('products.Note')}} </p>
                                <textarea class="form-control" type="text" id="description" name="description"></textarea>
                            </div>

                            <div class="modal-footer">
                                <div class="form-group">
                                    <button class="btn ripple btn-primary" type="submit">send</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal"
                                        type="button">close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemodelete">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> {{__('products.Delete')}}</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.destroy') }} " method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <p> {{__('products.Delete')}} ??</p>
                                <input class="form-control" type="hidden" id="id" name="id" >
                                <input class="form-control" type="text" id="product_name" name="product_name"
                                    readonly>
                            </div>


                            <div class="modal-footer">
                                <div class="form-group">
                                    <button class="btn ripple btn-primary" type="submit">send</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal"
                                        type="button">close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /row -->
  @endsection

    <!-- Container closed -->

    <!-- main-content closed -->

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
        <!-- Internal Modal js-->
        <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

        <script>
          $('#modaldemoedit').on('show.bs.modal',function(event){
            var button=$(event.relatedTarget)
            var id=button.data('id')
            var product=button.data('productname')
            var section=button.data('section_id')
            var section_name=button.data('section_name')
            var description=button.data('description')
            var modal=$(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(product)
            modal.find('.modal-body #section_id').val(section_id)
            modal.find('.modal-body #section_name').val(section_name)
            modal.find('.modal-body #description').val(description)
          })
            </script>
  <script>
$('#modaldemodelete').on('show.bs.modal',function(event2){

    var button2=$(event2.relatedTarget)
    var product_name=button2.data('product_name')
    var id=button2.data('id')
    var modal=$(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #product_name').val(product_name)


})
    </script>

        @endsection
