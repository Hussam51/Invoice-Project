<html lang="en">
<head>
  <meta charset="UTF-8" http-equiv="Content-Type" content="text/html" >
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Export PDF</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
  body {
    margin: 0;
    padding: 0;
    font-size: 14px;
    background-color:rgb(236, 237, 245), 31%, 94%) ;

    background-size: cover;
  }

  h4 {

    font-size: 22px;
  }

  .container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
    padding: 30px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 10px;
    box-shadow: 0 15px;
    50px rgba(0, 0, 0, .2)
  }

  .image {
    width: 200px;
    height: 200px;
    background: url(authr.jpg);
    background-size: cover;
    float: left;
    margin: 30px 30px 30px 0;
  }
</style>
<body>
<div class="row">


    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Invoice Details</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>

                                <th class="border-bottom-0"> invoice number</th>
                                <th class="border-bottom-0"> invoice data</th>
                                <th class="border-bottom-0">invoice Due-date</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0"> Rate-vat</th>
                                <th class="border-bottom-0">  Value-vat</th>
                            </tr>
                            <tr>

                            <td><a href="/invoice/{{$invoice->id}}/details">{{ $invoice->invoice_number }}</a></td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->due_date }}</td>
                            <td>{{ $invoice->product }}</td>
                            <td>{{ $invoice->section->section_name }}</td>
                            <td>{{ $invoice->rate_vat }}</td>
                            <td>{{ $invoice->value_vat }}</td>
                            </tr>
                            <br>
                            <br>
                            <tr>
                                <th class="border-bottom-0"> Discount </th>
                                <th class="border-bottom-0">Total </th>
                                <th class="border-bottom-0">Status </th>
                                <th class="border-bottom-0">Notes </th>

                            </tr>
                            <tr>
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

                            </tr>
                        </thead>
                        <tbody>

                                <tr>


                                </tr>
                                <br>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--/div-->
</body>
</html>
