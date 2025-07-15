@extends('layouts.app')
@section('content')

    <html>

    <head>
        <title>Import Excel File</title>

    </head>
    <style>
        body {
            background-color: #dfdfdf;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        .td,
        .th {
            border: 1px solid #c6c6c6;
            text-align: left;
            padding: 8px;
            text-align: center;
            border: none;

        }

        .th {
            color: white;

        }

        tr {
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
        }

    </style>

    <body>

        <br />

        <div class="container">
            <h3 align="center" style="font-weight: bold;">Import Excel File</h3>
            <br />
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Upload Validation Error<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
                {{ csrf_field() }}
                <div style="text-align: center;align-items: center;text-align: center;justify-content: center;"
                    class="row form-group container">
                    <label style="margin-bottom: 0rem;margin-right: 10px;">Select File for Upload</label>
                    {{-- <div>
                        <input class="custom-file-input" id="customFile" type="file" name="select_file" />
                        <label class="custom-file-label" for="customFile">Choose file</label>

                    </div> --}}
                    <div style="width: 29%; margin-right: 100px; align-items: center;" class="input-group">

                        <div class="custom-file">
                            <input name="select_file" type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">
                                <span style="display: flex;position: absolute;left: 45px;">Choose file</span>
                            </label>
                        </div>
                        <td width="30"><span class="text-muted"> .xls, .xlsx</span></td>
                    </div>
                    <input id="submit" type="submit" name="upload" class="btn btn-primary" value="Upload">
                </div>
            </form>
            <div style="text-align: center;align-items: center;text-align: center;justify-content: center;"><span class="text-muted">  .xls, .xlsx</span></div>
            <!--  <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/product') }}">
                                   {{ csrf_field() }}

                                   <input type="submit" name="upload" class="btn btn-primary" value="duplicate">
                                   </form> -->
            <br />
            <table class="table">
                <tr style="background: #36304a;">
                    <th class="th">User name</th>
                    <th class="th">File name</th>
                    <th class="th">Status</th>
                    <th class="th">Completed at</th>
                    <th class="th">Download</th>
                </tr>
                @foreach ($files as $file)
                    <tr>
                        <td class="td">{{ $file->user_name }}</td>
                        <td class="td">{{ $file->file_name }}</td>
                        <td class="td">{{ $file->status }}</td>
                        <td class="td">{{ $file->completed_at }}</td>
                        <td class="td"><a href="<?= $file->url ?>" style="display: grid;" class="btn btn-success btn-s">
                                        <i class="fas fa-download"></i></a></td>
                                </tr>
                                                                @endforeach
                                                       
                                                      
                                                </table>
                                        </div>
                                </body>
                                <script>
                                    $('#submit').on('click',function(){
                                        swal({
                                        title: "Please wait!",
                                        text: " ",
                                        closeOnClickOutside: false,
                                        button: null,
                                        icon: "loader.gif",
                                    });
                                    });
                                        // Add the following code if you want the name of the file appear on select
                                        $(".custom-file-input").on("change", function() {
                                          var fileName = $(this).val().split("\\").pop();
                                          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                        });
                                        </script>
                                </html>
@endsection
