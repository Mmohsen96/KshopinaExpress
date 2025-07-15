<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Special Order Form</title>

    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">

    <link rel="shortcut icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">

    <link rel="icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D9%2584%25D9%2581%3ACircle-icons-computer.svg&psig=AOvVaw3O-ulCnXwWQPXHwnIAYu6z&ust=1647502755709000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCOi1wpaQyvYCFQAAAAAdAAAAABAD">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
        <script src="{{ asset('js/bootstrap.js') }}"></script>

    
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>


<style>

    .group_popup {
        margin: 30px auto;
        padding: 15px;
        background: #fff;
        border-radius: 5px;
        width: 55%;
        border: solid 0.1px #1b3425;
        position: relative;
        transition: all 5s ease-in-out;
        min-width: 300px;

    }


    .tasks_popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 50%;
        position: relative;
        transition: all 5s ease-in-out;
        height: 88%;
        overflow: auto;
    }

    .tasks_popup .closee,
    .group_popup .closee {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box,
    .group_input {
        margin-bottom: 15px;
        width: calc(100% - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .user-details .input-box input,
    .user-details .input-box textarea,
    .group_input_style {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box select {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid,
    .user-details .input-box textarea:focus {
        border-color: #CA9B49;
    }

    form .gender-details .gender-title {
        font-size: 20px;
        font-weight: 600;
    }

    form .category {
        display: flex;
        width: 80%;
        margin: 14px 0;
        justify-content: space-between;
    }

    form .category label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    form .category label .dot {
        height: 18px;
        width: 18px;
        border-radius: 50%;
        margin-right: 10px;
        background: #d9d9d9;
        border: 5px solid transparent;
        transition: all 0.3s ease;
    }

    #dot-1:checked~.category label .one,
    #dot-2:checked~.category label .two,
    #dot-3:checked~.category label .three {
        background: #CA9B49;
        border-color: #d9d9d9;
    }

    form input[type="radio"] {
        display: none;
    }

    form .button {
        height: 45px;
        margin: 35px 0
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #1B3425, #296E45);
    }

    form .button textarea {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #5f5386, #CA9B49);
    }

    form .button input:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    form .button textarea:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #1B3425, #CA9B49);
    }

    @media(max-width: 584px) {
        .container {
            max-width: 100%;
        }

        form .user-details .input-box,
        .group_input {
            margin-bottom: 15px;
            width: 100%;
        }

        form .category {
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            /* overflow-y: scroll; */
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media(max-width: 459px) {
        .container .content .category {
            flex-direction: column;
        }
    }
</style>

<style>

    html,
    body {
        display: table;
        height: 100%;
        width: 100%;
        background-color: #1b3425;
    }

    @media screen and (max-width: 680px) {
        .table-row {
            width: calc(50% - 13px);
        }
    }

    @media screen and (max-width: 480px) {
        .table-row {
            width: 100%;
        }
    }

    .btn-primary {
        border-radius: 18px;
        font-size: 14px;
        background-color: #e3ce88;
        border-color: #e3ce88;
        color: #426851;
    }

    .btn-primary:hover {
        border-radius: 18px;
        font-size: 14px;
        background-color: #cb9d48e6;
        border-color: #cb9d48e6;
    }

    .btn-primary:not(:disabled):not(.disabled):active {
        border-radius: 18px;
        font-size: 14px;
        background-color: #cb9d48e6 !important;
        border-color: #cb9d48e6 !important;
    }

    .btn:not(:disabled):not(.disabled) {
        outline: none;
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgb(144 114 57 / 50%) !important;
    }

    .print:hover {
        color: white;
        text-decoration: none;
    }

    .print {
        color: #426851;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }


</style>


<style>
    /* width */
    ::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #cb9d48;
        border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #cb9d48;
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-radius: 50%;
        border-top: 4px solid #cda051;
        width: 20px;
        height: 20px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loader_ {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #1B3425, #296E45);
    }
</style>

<style>
    .logo{
        width: 23%;
        min-width: 115px;
    }

    .form-control:focus{
        border-color: #cc9b48;
        box-shadow:none;
    }
    .result_files{
        margin: 0px;
        display: flex;
        flex-direction: column;
        width: 25%;
        border: 0.5px solid #00000057;
        padding: 15px 15px 15px 15px;
        border-radius: 10px;
        box-shadow: -1px -1px 5px 0px rgb(0 0 0 / 42%);
        flex-basis: unset !important;
        flex-grow: unset !important;
        justify-content: center;
        min-width: 120px;

    }
    #result{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px 0;
    }
</style>


<body style="display: flex;justify-content: center;align-items: center;">
    <div class="group_popup">
        <div class="container">
            <div style="margin-top: 15px;" class="title">
                <img  src="{{ asset('background-white.png') }}" class="logo"
                    alt="">
            </div>
        </div>
    
        <div style="margin-top: 40px;" class="container content">
            <form action="submit_somthing_wrong_form?token={{$_GET['token']}}" method="post" id="somthing_wrong_form" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" name="complaint_id" id="complaint_id" value="{{basename(url()->current())}}">

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Explain what the issue is in a clear and good manner.</span>
                        <textarea maxlength="1000" style="height: 90px;overflow: hidden;resize: none;" name="content" id="task" 
                            cols="30" rows="3" required></textarea>
                    </div>
                </div>

                <div class="user-details">
                    <div class="input-box" style="font-weight: 600;">
                         Please make sure to do the following (Mandatory):
                        <ol style="margin-top: 15px;font-weight: 400;">
                            <li>Attach an unboxing video of receiving the order (the video must be clear)</li>
                            <li>Attach a clear picture of the whole order (showing the invoice of the package)</li>
                        </ol>
                    </div>
                </div>
                <div class="input-box" style="margin-bottom: 12px;">
                    <span class="details">Images & Videos &nbsp;&nbsp;<span style="font-size: 12px;color: red;"> *Please note the maximum size of files is 50MB</span></span>
                        {{-- https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Microsoft_PowerPoint_2013-2019_logo.svg/1200px-Microsoft_PowerPoint_2013-2019_logo.svg.png --}} {{-- power point .pptx  .pptm  .ppt  --}}
                        {{-- https://www.freelogovectors.net/wp-content/uploads/2019/02/winrar_logo.png --}} {{-- rar .rar --}}
                        {{-- https://www.freeiconspng.com/thumbs/txt-file-icon/document-extension-file-file-format-filename-text-txt-icon--20.png --}} {{-- text .txt --}}
                        {{-- https://upload.wikimedia.org/wikipedia/commons/0/08/Microsoft_Word_logo_%282013-2019%29.png --}} {{-- word .doc .docx --}}
                        {{-- https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/119_Excel_logo_logos-512.png --}} {{-- excel .xls .xlsx --}}
                        {{--  https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png --}} {{-- pdf .pdf --}}
                        {{-- https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png --}} {{-- video --}}

                        {{-- https://www.sgatech.co.uk/resources/images/generic-file.png --}} {{-- UNKOWN FILE--}}

                    
                    <div id="files_section"><input id="files" type="file" multiple="multiple" name="files[]" accept="image/*,video/*" required>{{-- text --}}</div> 
                    <div id="result" style="margin-top: 20px;justify-content: space-around;"> 
                        {{-- <div class="col result_files" style="margin-bottom: 15px;">
                            <div style="width: 100%;display: flex;justify-content: center;"> 
                                <img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png" >
                            </div> 
                            <span style="text-align: center;overflow: hidden;">knvdsnksd</span>
                            <input type="text" name="side_note" id="side_note" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">
                        </div> 
                        <div class="col result_files" style="margin-bottom: 15px;">
                            <img style="width: 100%;" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" >
                            <input type="text" name="side_note" id="side_note" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">
                        </div> 
                        <div class="col result_files" style="margin-bottom: 15px;">
                            <img style="width: 100%;" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" >
                            <input type="text" name="side_note" id="side_note" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">
                        </div> 
                        <div class="col result_files" style="margin-bottom: 15px;">
                            <img style="width: 100%;" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" >
                            <input type="text" name="side_note" id="side_note" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">
                        </div> 
                        <div class="col result_files" style="margin-bottom: 15px;">
                            <img style="width: 100%;" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" >
                            <input type="text" name="side_note" id="side_note" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">
                        </div>  --}}
                    </div>
                </div>
                
                <div id="assign_submit" style="margin: 35px 0 15px;" class="button">
                    <input id="submit_note" type="submit" value="Submit">
                </div>
            </form>
        </div>
    
       
    </div>
</body>


<script>
    var content="";
    var file;
    var size=0;

    document.querySelector('input[type="file"]').addEventListener("change", (e) => {
        //CHANGE EVENT FOR UPLOADING PHOTOS
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            //CHECK IF FILE API IS SUPPORTED
            const files = e.target.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
            
            html="";
            
            for (let i = 0; i < files.length; i++) {
                size += ((files[i].size/1024)/1024);
            }
            if (size > 50) {
                e.preventDefault();
                document.getElementById("files").value = "";

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    /* title: 'Invalid file format!', */
                    text: "The size of the file exceeds 50 MB",
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }

            for (let i = 0; i < files.length; i++) {
                // LOOP THROUGH THE FILE LIST OBJECT
                
                if (files[i].type.match("image")){

                    const picReader = new FileReader(); // RETRIEVE DATA URI
                    picReader.addEventListener("load", function (event) {
                    // LOAD EVENT FOR DISPLAYING PHOTOS
                    const picFile = event.target;
                            
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 95px;width: auto;max-width: 100%;height: auto;min-height: 95px" src="'+picFile.result+'" >'+
                                '</div>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="image">'+
                                /* '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+ */
                            '</div>';
                            
                    /* $("#result").html(""); */
                    $("#result").html(html);
                    });
                    picReader.readAsDataURL(files[i]); //READ THE IMAGE
                    
                } 
                else if(files[i].type.match("video") ){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="video">'+

                                /* '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+ */
                            '</div>';
                            
                    /* $("#result").html(""); */
                    $("#result").html(html);
                }
                else{
                    Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid file format!',
                            text: "File should be Images and Videos",
                            showConfirmButton: false,
                            timer: 1500
                        });

                }
                
            }
        } else {
            alert("Your browser does not support File API");
        }


    });

    document.querySelector("#task").addEventListener("keypress", (e) => {

        if (content.length >= 1000) {
            e.preventDefault();
            document.getElementById("task").value=content;
        }else{
            content = document.getElementById("task").value;
        }

    });

    document.querySelector("#somthing_wrong_form").addEventListener("submit", (e) => {

        e.preventDefault();

        Swal.fire({
                title: 'Are you sure?',
                text: "Once you have submitted your inquiry, you can't change or edit anything.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('assign_submit').disabled= true;
        
                    document.getElementById("assign_submit").innerHTML = '<button class="loader_" style="align-items: center;justify-content: center;display: flex" disabled="disabled"><div class="loader"></div></button>';

                    $('#somthing_wrong_form').submit();
                }else{
                    return false;
                }
            });
    });   
    
</script>

@if ($message = Session::get('message'))
    @if ($message == 'FILE_SIZE')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Your files size exceed the limit 50 MB!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
   @elseif($message == 'FILES_NOT_FOUND')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'You must upload at least one file!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'DOES_NOT_MATCH')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Complaint has been expired!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'TOKEN')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Unauthorized!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'SUCCESS')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your inquiry has been submitted!',
                showConfirmButton: false,
                timer: 1500
            });

        </script>
    @elseif($message == 'SUBMITED_BEFORE')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Your inquiry has already been submitted!',
                showConfirmButton: false,
                timer: 1500
            });

        </script>

    @endif

@endif
</html>
