<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">
    <title>Inquiry</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4014863685234927"
    crossorigin="anonymous"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Overpass:wght@400;700&display=swap');

    :root {
        --orange: #ca9b49;
        --white: hsl(0, 0%, 100%);
        --lightGrey: hsl(217, 12%, 63%);
        --mediumGrey: hsl(216, 12%, 54%);
        --mediumGreyOp: hsla(216, 12%, 54%, 0.2);
        --darkBlue: hsl(213, 19%, 18%);
        --veryDarkBlue: hsl(216, 12%, 8%);
        --bodyCopy: 16px;
        --mobile: 375px;
        --desktop: 1440px;
        --light: 400;
        --bold: 700;
    }

    html,
    body {
        font-family: 'Overpass', sans-serif;
        background-color: #f7f6f3;
    }

    p {
        font-size: var(--bodyCopy);
        font-weight: var(--light);
        color: #7db381;
        letter-spacing: .5px;
        line-height: 1.5;
    }

    h1 {
        font-weight: var(--bold);
    }

    h2,
    .btn,
    #thankYou p,
    .attribution,
    .message,
    .opt {
        text-align: center;
    }

    input[type=radio] {
        opacity: 0;
        position: fixed;
        width: 0;
    }

    .flexbox {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .opt {
        display: block;
        position: relative;
        width: 3rem;
        height: 0;
        padding-bottom: 3rem;
        background-color: #296E45;
        line-height: 3;
        color: var(--white);
        border-radius: 50%;
        cursor: pointer;
    }

    .opt:hover {
        background-color: #296e45d9;
    }

    #star {
        padding: 1rem;
        border-radius: 50%;
        background-color: var(--mediumGreyOp);
    }

    .card {
        width: 90%;
        max-width: 40ch;
        background-color: #1B3425;
        padding: 2rem;
        border-radius: 2rem;
        margin: 0 auto;
        margin-top: 2rem;
    }

    #thankYou {
        display: none;
    }

    .imgBlock {
        width: 100%;
        height: 15ch;
        background: url(https://raw.githubusercontent.com/hejkeikei/interactive-rating-component/16de82dee8e9299ac78d332cc3b5480da9bf435c/images/illustration-thank-you.svg) no-repeat center;
    }

    .message {
        width: 100%;
        max-width: 25ch;
        margin: 0 auto;
        padding: .2rem;
        background-color: var(--mediumGreyOp);
        color: var(--orange);
        border-radius: 2rem;
    }

    .btn {
        width: 100%;
        padding: 1rem;
        margin-top: 2rem;
        border-radius: 2rem;
        text-transform: uppercase;
        font-weight: var(--bold);
        letter-spacing: 2px;
        border: none;
        background-color: var(--orange);
        color: var(--white);
        cursor: pointer;
    }

    .btn:hover {
        background-color: var(--white);
        color: var(--orange);
    }

    .attribution {
        width: 100%;
        font-size: .5rem;
        /*     position: fixed;
                        bottom: 0; */
        padding: 1rem;
    }

    .attribution a {
        color: hsl(228, 45%, 44%);
    }

</style>

<style>

    textarea:focus-visible{
        outline: none !important;
    }

    .message-blue {
        position: relative;
        margin-left: 20px;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f8e896;
        width: 200px;
        height: auto;
        padding-bottom: 1.5rem;
        text-align: left;
        font: 400 0.9em 'Open Sans', sans-serif;
        border: 1px solid #dfd087;
        border-radius: 10px;
        overflow-wrap: break-word;
    }

    .message-orange {
        position: relative;
        margin-bottom: 10px;
        margin-left: calc(100% - 240px);
        padding: 10px;
        background-color: white;
        width: 200px;
        height: fit-content;
        text-align: left;
        font: 400 .9em 'Open Sans', sans-serif;
        border: 1px solid #dfd087;
        border-radius: 10px;
        overflow-wrap: break-word;
        padding-bottom: 30px;

    }

    .message-content {
        padding: 0;
        margin: 0;
        color: #000000e8;
    }

    .message-timestamp-right {
        position: absolute;
        font-size: .85em;
        font-weight: 300;
        bottom: 5px;
        right: 5px;
        color: #181616cc;
        font-size: x-small;
        margin-top: -15px;
    }

    .message-timestamp-left {
        position: absolute;
        font-weight: 300;
        bottom: 5px;
        left: 10px;
        color: #181616cc;
        font-size: x-small;
        margin-top: -15px;
    }

    .message-blue:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-top: 15px solid #f8e896;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        top: 0;
        left: -15px;
    }

    .message-blue:before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-top: 17px solid #f8e896;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        top: -0.8px;
        left: -17px;
    }

    .message-orange:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-bottom: 15px solid white;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        bottom: 0;
        right: -15px;
    }

    .message-orange:before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-bottom: 17px solid white;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        bottom: -1px;
        right: -17px;
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
        /* padding: 15px 15px 15px 15px; */
        border-radius: 10px;
        box-shadow: -1px -1px 5px 0px rgb(0 0 0 / 42%);
        flex-basis: unset !important;
        flex-grow: unset !important;
        justify-content: center;
        min-width: 120px;
        min-height: 8rem;
        background-color: white;
    }
    #result{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px 0;
    }
</style>

<body>
    <!-- Rating state start -->

    <div id="rating" class="card">

        <h1 style=" color: #ca9b49;margin-top: 0px;">{{ $complaints[0]->id }}</h1>

        <div style="margin-top: 15px;display: grid;grid-template-columns: auto auto;justify-content: start;">

            @if (!empty($complaints[0]->order_number))
                <div
                    style="font-size: 15px;padding: 2px 0px 2px 0px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;display: flex;align-items: center;justify-content: start;">
                    <p
                        style="font-family: 'Bebas Neue', cursive; letter-spacing: 1.5px;font-size: 20px;color: #f7f6f3;margin: 0px;">
                        Order Number :</p>
                    <span style="margin-left: 5px;"> {{ $complaints[0]->order_number }}</span>
                </div>
                <br>
            @endif
            
            @if (isset($complaints[0]->complain))
                <div style="font-size: 15px;padding: 2px 0px 2px 0px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;display: flex;align-items: center;justify-content: start;">
                    <p style="font-family: 'Bebas Neue', cursive; letter-spacing: 1.5px;font-size: 20px;color: #f7f6f3;margin: 0px;">
                        Reasons:</p>
                    @if ( $complaints[0]->complain == 'customer_others' || $complaints[0]->complain == 'guest_others')
                        <span style="font-size: 13px;margin-left: 15px; border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Others</span>
                    
                    @elseif ($complaints[0]->special_case ==1)

                        @php
                            $complains = explode('|', $complaints[0]->complain);
                        @endphp

                        @foreach ($complains as $item)
                            <div
                            style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">

                            <span>{{$item}} item</span>
                            </div>
                        @endforeach    
                    @elseif($complaints[0]->complain[0] =='0' || $complaints[0]->complain[0] =='1')
                    
                        @if ($complaints[0]->complain[0] == '1')
                            <span style="font-size: 13px;margin-left: 15px; border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Missing
                                items</span>
                        @endif
                        @if ($complaints[0]->complain[1] == '1')
                            <span style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Wrong
                                items</span>
                        @endif
                        @if ($complaints[0]->complain[2] == '1')
                            <span style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">No
                                response from courier company</span>
                        @endif


                        @if ($complaints[0]->complain[3] == '1')
                            <span style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Late
                                Delivery</span>
                        @endif
                        @if ($complaints[0]->complain[4] == '1')
                            <span
                                style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Others</span>
                        @endif
                        @if (isset($complaints[0]->complain[5]) && $complaints[0]->complain[5] == '1')
                        <span
                            style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">Cancel Order</span>
                        @endif
                    @else
                    <span
                    style="font-size: 13px;margin-left: 15px;border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">{{$complaints[0]->complain}}</span>
                    @endif


                </div>

                @if ($complaints[0]->complain =='Rescheduling')
                    </div>
                        <p style="font-family: 'Bebas Neue', cursive; letter-spacing: 1.5px;font-size: 20px;color: #f7f6f3;margin: 0px;">
                            To : <span style="font-size: 13px;margin-left: 15px; border: 1px solid #77aa78;padding: 5px;border-radius: 8px;">{{ date('j M Y', strtotime($complaints[0]->message)) }}</span>                    </p>
                    <div>
                @endif
            @endif
            
        </div>

        <hr style="border-bottom: hidden;">
        @if(!empty($complaints[0]->message))
            <p style="@if (preg_match('/[اأإء-ي]/ui', $complaints[0]->message) > 0)text-align: right; @else text-align: left; @endif white-space: pre-line;color: #ca9b49;width: 100%;overflow-wrap: break-word;margin-top: -22px; ">
                @if ($complaints[0]->complain =='Rescheduling')
                    No Message attached
                @else 
                    {{$complaints[0]->message}}  
                @endif
            </p>
        @else
            <p style="color: #ca9b49;width: 100%;overflow-wrap: break-word;margin-top: -5px;">
                No Message attached
            </p>
        @endif

        @if ($complaints[0]->special_case == 1)
            <hr style="border-bottom: hidden;">

            {{-- <h4 style="margin-left: -15px;font-size: 18px;color: #ca9b49;margin-top: 10px;">Attachments</h4> --}}

            <div id="result" style="margin-top: 20px;justify-content: space-around;"> 
                @php
                    $in=0;
                    $counter=0;
                @endphp
                @foreach ($complaints_files as $file)
                    @if ($file->id == $complaints[0]->id)

                        @if ($file->file_id != null && !empty($file->file_id))
                            @php    $in =1; $counter++;   @endphp 

                            @if ($file->file_type == 'image')
                            
                                <div class="col result_files" style="margin-bottom: 15px;">
                                    <div style="width: 100%;display: flex;justify-content: center;">
                                        <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->file_old_name}}">
                                            <img style="max-height: 95px;width: auto;max-width: 100%;height: auto;" src="{{asset("uploads/complaints/$file->file_new_name")}}" >
                                        </a>
                                    </div>
                                </div>
                            @elseif($file->file_type == 'video')
                                <div class="col result_files" style="margin-bottom: 15px;">
                                    <div style="width: 100%;display: flex;justify-content: center;">
                                        <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->file_old_name}}">
                                            <img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">
                                    <div style="width: 100%;display: flex;justify-content: center;">
                                        <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->file_old_name}}">
                                            <img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.sgatech.co.uk/resources/images/generic-file.png" >
                                        </a>
                                    </div>                            
                                </div>
                                

                            @endif

                        @endif
                        
                    @endif
                @endforeach
                
                @if ($in ==0)
                    <div class="col">
                        <span> No attachments in this inquiry</span>

                    </div>
                @endif

                

            </div>
        @endif
        <h5 style=" color: #ffffffc2;font-size: x-small; "> {{ $complaints[0]->saved_at }}</h5>

        @if (isset($complaints[0]->reply) && $complaints[0]->complaint_side == 1 )
            @foreach ($complaints as $complaint)
                <div @if ($complaint->side == 0) class="message-blue" @else  class="message-orange" @endif>
                    <p style="@if (preg_match('/[اأإء-ي]/ui', $complaint->reply) > 0) text-align: right; @else text-align: left; @endif white-space: pre-line;margin-top: -15px;" class="message-content">
                        {{ $complaint->reply }}
                    </p>
                    <div
                        @if ($complaint->side == 0) class="message-timestamp-left"  @else class="message-timestamp-right" @endif>
                        {{ $complaint->replied_at }}</div>
                </div>
            @endforeach

            @if ($complaints[0]->solved == 0 && isset($complaints[0]->reply))
                <form action="customer_complaint_reply" method="post" onSubmit="document.getElementById('reply_submit').disabled=true;">
                    @csrf
                    <textarea style="width: 100%; border-radius: 5px; background-color: white;   margin-top: 5%;" name="customer_reply"
                        id="" cols="5" rows="5" maxlength="5000"></textarea>
                    <input name="id" type="text" value="{{ $complaints[0]->id }}" hidden readonly>
                    <button id="reply_submit" class="btn" type="submit">send reply</button>
                </form>
            @endif
            @if ($complaints[0]->solved == 1  && $complaints[0]->rating == 0)
                <form id='rate' action="rating" method="post" style="margin-top: 25px;">
                    @csrf
                    <div class="flexbox" id="options">
                        <label for="rate5" class="opt"><i
                                style="color: #4dda21; font-size: 2.5rem;  padding-top: 8%;"
                                class="far fa-grin-hearts"></i></label>
                        <input type="radio" name="rate" id="rate5" value="5" />
                        <label for="rate4" class="opt"><i
                                style="color: #a3ff00; font-size: 2.5rem;  padding-top: 8%;"
                                class="far fa-grin-beam"></i></label>
                        <input type="radio" name="rate" id="rate4" value="4" />
                        <label for="rate3" class="opt"><i
                                style="color: #fff400; font-size: 2.5rem;  padding-top: 8%;"
                                class="far fa-grin"></i></label>
                        <input type="radio" name="rate" id="rate3" value="3" />
                        <label for="rate2" class="opt"><i
                                style="color: #ffa700; font-size: 2.5rem;  padding-top: 8%;"
                                class="far fa-frown-open"></i></label>
                        <input type="radio" name="rate" id="rate2" value="2" />
                        <label for="rate1" class="opt"><i
                                style="color: #ff0000; font-size: 2.5rem;  padding-top: 8%;"
                                class="far fa-angry"></i></label>
                        <input type="radio" name="rate" id="rate1" value="1" />
                    </div>
                    <input type="text" value="{{ $complaints[0]->id }}" name='complaint_num' hidden readonly>
                    <input type="submit" class="btn" value="Submit" id="submitBtn" />
                </form>
            @endif
        @elseif ( $complaints[0]->complaint_side == 0 )
            @if (isset($complaints[0]->reply))
                @foreach ($complaints as $complaint)
                    <div @if ($complaint->side == 0) class="message-blue" @else  class="message-orange" @endif>
                        <p style="@if (preg_match('/[اأإء-ي]/ui', $complaint->reply) > 0) text-align: right; @else text-align: left; @endif white-space: pre-line;margin-top: -15px;" class="message-content">
                            {{ $complaint->reply }}
                        </p>
                        <div
                            @if ($complaint->side == 0) class="message-timestamp-left"  @else class="message-timestamp-right" @endif>
                            {{ $complaint->replied_at }}</div>
                    </div>
                @endforeach
            @endif
            @if ($complaints[0]->solved == 0 )
                <form action="customer_complaint_reply" method="post" onSubmit="document.getElementById('reply_submit').disabled=true;">
                    @csrf
                    <textarea style="width: 100%; border-radius: 5px; background-color: white;   margin-top: 5%;" name="customer_reply"
                        id="" cols="5" rows="5" maxlength="5000"></textarea>
                    <input name="id" type="text" value="{{ $complaints[0]->id }}" hidden readonly>
                    <button id="reply_submit" class="btn" type="submit">send reply</button>
                </form>
            @endif
        @else
            <p
                style="font-family: 'Bebas Neue', cursive;color: #c94949;letter-spacing: 1.5px;font-size: 22px;text-align: center;margin: 1px;">
                No replies yet!</p>
        @endif

        
        
    </div>




    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
        <script>
        var getSiblings = function(elem) {
            var siblings = [];
            var sibling = elem.parentNode.firstChild;
            while (sibling) {
                if (sibling.nodeType === 1 && sibling !== elem) {
                    siblings.push(sibling);
                }
                sibling = sibling.nextSibling;
            }
            return siblings;
        };
        var userInput;
        var opt = document.querySelectorAll("input[name=rate]");
        for (let i of opt) {
            i.addEventListener("click", function() {
                userInput = i.value;
                sessionStorage.setItem('rating', userInput);

                let rateNum = "label[for=rate" + i.value + "]";

                let optBtn = document.querySelector(rateNum);

                optBtn.style.backgroundColor = "#121417";
                let sib = getSiblings(optBtn);

                for (let i in sib) {

                    sib[i].style.backgroundColor = "var(--mediumGreyOp)";
                }
            });
        }


        var rating = JSON.parse('{!! json_encode($complaints[0]->rating) !!}');
        var solved = JSON.parse('{!! json_encode($complaints[0]->solved) !!}');
        if (performance.navigation.type == 2 && solved == 0) {
            location.reload(true);
        }
        /* sessionStorage.setItem('key', 3);
        let data = sessionStorage.getItem('key');*/

        var data = sessionStorage.getItem('rating');

        if (data > 0 && performance.navigation.type == 2 && solved == 1) {

            $("#rate").html("");
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'You have already rated this complaint!',
                showConfirmButton: true,
                timer: 1500
            })

        }
    </script>
</body>

</html>
