@extends('layouts.staff_layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/19.1.5/js/dx.all.js"></script>

<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/19.1.5/css/dx.common.css">

<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/19.1.5/css/dx.light.css">

<style>
    .content-wrapper{
        padding: 0rem 0rem;
        width: 95%;
        flex-grow: 0;
    }
</style>

<style>
   
   @import url("https://fonts.googleapis.com/css?family=Loved+by+the+King|Reenie+Beanie");

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
    .sticky_container {
        display: flex;
        width: 75%;
        grid-template-areas: "title title" "sticker1 sticker2";
        margin: 0 auto;
        padding-top: 10px;
        grid-gap: 35px;
        justify-content: space-between;

    }
    @media (max-width: 700px) {
        .sticky_container {
            grid-template-columns: 1fr;
            grid-template-areas: "title" "sticker1" "sticker2";
        }
    }

    .note-container {
        justify-self: center;
        width: 20%;
    }

    .sticky-note {
        width: 100%;
        height: 13rem;
        padding: 1em;
        font-size: 20px;
        letter-spacing: 2px;
        outline: none;
        position: relative;
        margin-top: 50px;
        margin-bottom: 10px;
        padding-top: 40px;
        font-size: 14px;
        font-weight: 400;
    }

    .sticky-note::before {
        content: "";
        position: absolute;
        display: block;
    }

    /* .sticky-note::after {
        content: "";
        position: absolute;
        bottom: 0;
        border-width: 20px 20px 20px 20px;
        border-style: solid;
    } */

    .sticky-note.sticky-note-two {
        background-color: #223f2e;
        grid-area: sticker2;
        box-shadow: -8px -6px 10px -5px rgb(0 0 0 / 42%);
        color: white;

    }
    .sticky-note.sticky-note-two::before {
        background-color: rgba(203, 157, 72, 0.75);
        height: 45px;
        width: 30px;
        left: 50%;
        top: -25px;
        transform: rotate(-3deg) translateX(-50%);
    }
    /* .sticky-note.sticky-note-two::after {
        right: 0;
        border-top-color: #cb9d48;
        border-left-color: #cb9d48;
        border-bottom-color: #ffffff;
        border-right-color: #ffffff;
    } */
    .notification_body{
        background: #223f2e24;
        width: 100%;
        border-radius: 0px 15px 15px 15px;
        box-shadow: -5px 1px 10px -5px rgb(0 0 0 / 42%);
        height: fit-content;
        margin-left: 5px;
        min-height: 65%;
    }
    .notification_user{

        height: 4vw;
        width: 4vw; 
        background-position: center;    
        box-shadow: -5px 0px 10px -5px rgb(0 0 0 / 42%);
    }
    .user_name:after {
        content: '';
        position: relative;
        width: 0;
        height: 0;
        border-top: 15px solid #e0e4e1;
        border-left: 10px solid transparent;
        border-right: 18px solid transparent;
        top: 36.2px;
        left: -60px;
        border-radius: 4px 0px 0px 0px;
    }
    .attachment_icon{
        display: flex;
        justify-content: end;
        align-items: flex-end;
        width: 4%;
    }
    .sticky_submit{
        position: absolute;
        bottom: -3px;
        right: -3px;
        z-index: 10;
        font-size: 17px;
        
    }
   
    /* .sticky_submit_hover{
        color: #cb9d48;
        transition: 0.3s;
    } */
    .sticky_after:hover{
        right: 0;
        border-top-color: #223f2e;
        border-left-color: #223f2e;
        border-bottom-color: #223f2e;
        border-right-color: #223f2e;
        transition: 0.2s;
        color: #cb9d48;
        cursor: pointer;
    }
    
    .sticky_after{
        right: 0;position: sticky;
        left: 100%;
        width: 10%;
        bottom: 0;
        border-width: 20px 20px 20px 20px;
        border-style: solid;
        border-top-color: #cb9d48;
        border-left-color: #cb9d48;
        border-bottom-color: #ffffff;
        border-right-color: #ffffff;
        cursor: pointer;
        color: #223f2e;
    }
    .main-panel {
        justify-content: center;
        flex-direction: row;

    }
</style>

<style>
    .floating-button-menu {
        z-index: 5;
        position: fixed;
        bottom: 20px;
        right: 50px;
        cursor: pointer;
        background: #1b3425;
        border-radius: 50%;
        min-width: 50px;
        max-width: 0px;
        min-height: 50px;
        max-height: 0px;
        box-shadow: 2px 1px 8px 1px rgb(0 0 0 / 25%);
        transition: all ease-in-out 0.8s;
    }

    .floating-button-menu:hover {
        background: #1b3425;
    }

    .floating-button-menu .floating-button-menu-links {
        width: 0;
        height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.4s;
    }

    .floating-button-menu .floating-button-menu-links a {
        position: relative;
        color: #454545;
        text-decoration: none;
        line-height: 50px;
        display: block;
        display: block;
        border-bottom: 1px solid #ccc;
        width: 100%;
        height: 45px;
        padding: 0 20px;
        border-bottom: 0.5px solid #ccc;
        transition: background ease-in-out 0.8s;
        background: rgba(0, 0, 0, 0);
    }

    .floating-button-menu .floating-button-menu-links a:hover {
        background: rgba(0, 0, 0, 0.1);
    }

    .floating-button-menu .floating-button-menu-links a:last-child {
        border-bottom: 0px solid #fff;
    }

    .floating-button-menu .floating-button-menu-links.menu-on {
        width: 450px;
        height: 400px;
        border-radius: 10px;
        opacity: 1;
        transition: all ease-in-out 0.8s;
    }

    .floating-button-menu .floating-button-menu-label {
        text-align: center;
        line-height: 74px;
        font-size: 25px;
        color: #fff;
        opacity: 1;
        transition: opacity 0.3s;
    }

    .floating-button-menu .floating-button-menu-label:hover {
        color: #ca9b49;
    }

    .floating-button-menu.menu-on {
        background: #fff;
        max-width: 340px;
        max-height: 3300px;
        border-radius: 10px;
    }

    .floating-button-menu.menu-on .floating-button-menu-links {
        width: 100%;
        height: 100%;
        opacity: 1;
        transition: all ease-in-out 1s;
    }

    .floating-button-menu.menu-on .floating-button-menu-label {
        height: 0px;
        overflow: hidden;
    }

    .floating-button-menu-close {
        position: fixed;
        z-index: 2;
        width: 0%;
        height: 0%;
    }

    .floating-button-menu-close.menu-on {
        width: 100%;
        height: 100%;
    }

    .vl {
        border-left: 1px solid #c8cecb;
        height: 80px;
    }

    option {
        margin-bottom: 50px !important;
    }
</style>

<style>
    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        display: none;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 35%;
        position: relative;
        transition: all 5s ease-in-out;
        height: 85%;
        overflow: auto;
    }

    .popup h2 {
        margin-top: 0;
        color: #ca9b49;
        font-family: Tahoma, Arial, sans-serif;
    }

    .popup .closee,.return_close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .popup .closee:hover,.return_close:hover {
        color: #ca9b49;
    }
</style>

<style>
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

    .tasks_popup .closee {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .content #create_announcment .user-details,
    .content #edit_announcement_popup .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    #create_announcment .user-details .input-box,
    #edit_announcement_popup .user-details .input-box {
       /*  margin-bottom: 15px; */
        /* width: calc(100% / 2 - 20px); */
        width: 100%;
    }

    #create_announcment .input-box span.details,
    #edit_announcement_popup .input-box span.details {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .user-details .input-box input,
    .user-details .input-box textarea {
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

    #create_announcment .gender-details .gender-title,
    #edit_announcement_popup .gender-details .gender-title
     {
        font-size: 20px;
        font-weight: 600;
    }
    
    #create_announcment .category,
    #edit_announcement_popup .category {
        display: flex;
        width: 80%;
        margin: 14px 0;
        justify-content: space-between;
    }

    #create_announcment .category label,
    #edit_announcement_popup .category label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    #create_announcment .category label .dot,
    #edit_announcement_popup .category label .dot {
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

    #create_announcment input[type="radio"],
    #edit_announcement_popup input[type="radio"] {
        display: none;
    }

    #create_announcment .button,
    #edit_announcement_popup .button {
        height: 45px;
        margin: 35px 0
    }

    #create_announcment .button input,#create_announcment .loader_ ,
    #edit_announcement_popup .button input,#edit_announcement_popup .loader_ {
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

    #create_announcment .button textarea,
    #edit_announcement_popup .button textarea {
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

    #create_announcment .button input:hover,
    #edit_announcement_popup .button input:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #142019, #296E45);
    }

    #create_announcment .button textarea:hover,
    #edit_announcement_popup .button textarea:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #142019, #296E45);
    }

    @media(max-width: 584px) {
        .container {
            max-width: 100%;
        }

        #create_announcment .user-details .input-box,
        #edit_announcement_popup .user-details .input-box {
            margin-bottom: 15px;
            width: 100%;
        }

        #create_announcment .category,
        #edit_announcement_popup .category {
            width: 100%;
        }

        .content #create_announcment .user-details,
        .content #edit_announcement_popup .user-details {
            max-height: 300px;
            overflow-y: scroll;
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
    #result{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px 0;
    }

    .thumbnail {
        height: 192px;
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
    }

    .fa-paperclip:before {
        cursor: pointer;
    }

    .edit_icon{
        border-radius: 1px 1px 1px 100px;
        background-color: #cb9d48;
        width: 2.5vw;
        height: 2.5vw;
        min-width: 0.8rem;
        color: #223f2e;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1vw;
        padding: 0px 0px 0.5vw 0.5vw;
    }
</style>

<style>
    .arrow {
        cursor: pointer;
        height: 30px;
        left: 55%;
        position: absolute;
        top: 80%;
        transform: translateX(50%) translateY(-70%);
        transition: transform 0.1s;
        width: 12px;
    }
    .arrow-top, .arrow-bottom {
        background-color: #CA9B49;;
        height: 4px;
        left: -5px;
        position: absolute;
        top: 50%;
        width: 100%;
    }
    .arrow-top:after, .arrow-bottom:after {
        background-color: #1b3425;
        content: "";
        height: 100%;
        position: absolute;
        top: 0;
        transition: all 0.15s;
    }
    .arrow-top {
        transform: rotate(135deg);
        transform-origin: bottom right;
        top: 40%;
        left: 0px;
    }
    .arrow-top:after {
        left: 100%;
        right: 0;
        transition-delay: 0s;
    }
    .arrow-bottom {
        transform: rotate(47deg);
        transform-origin: top right;
        top: 55%;
        left: 5px;
    }
    .arrow-bottom:after {
        left: 0;
        right: 100%;
        transition-delay: 0.15s;
    }
    .arrow:hover .arrow-top:after {
        left: 0;
        transition-delay: 0.15s;
    }
    .arrow:hover .arrow-bottom:after {
        right: 0;
        transition-delay: 0s;
    }
    .arrow:active {
        transform: translateX(75%) translateY(-70%);
    }

</style>

<style>

    .badge-wrap {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .badge-without-number {
        position: relative;
        background-color: #f5424e;
        font-size: 2px;
        width: 6px;
        height: 6px;
        border-radius: 80%;
        top: -6px;
        left: 0px;      
    }

    .badge-without-number.with-wave {
        animation-name: wave;
        animation-duration: 1s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }

    @keyframes wave {
        0% {box-shadow: 0 0 0px 0px rgba(245, 66, 78, 0.2);}
        100% {box-shadow: 0 0 0px 10px rgba(245, 66, 78, 0);}
    }

    #edited_note::placeholder {
        font-size: 12px;
    }
</style>

<style>
    .reply_user{
        height: 3vw;
        width: 3vw; 
        background-position: center;    
        background-size: cover;
        box-shadow: -5px 0px 10px -5px rgb(0 0 0 / 42%);
    }
    .reply {
        font-size: 16px;
        line-height: 25px;
        width: 100%;
        max-width: 450px;
        margin: 8px 10px;
        padding: 12px;
        border-radius: 16px;
        word-wrap: break-word;
        white-space: pre-line;
    }

    .reply.user {
        background-color: #e0e4e1;
        color: #1b3425;
        border-top-left-radius: 0px;
        padding-left: 30px;
    }

    .reply.me {
        background-color: #223f2ec4;
        color: white;
        border-top-right-radius: 0px;
        margin-left: auto;
        padding-right: 30px;
    }
    .dx-list-item-content {
        display: flex !important;
        align-items: center !important;
    }
    .dx-list-item-icon-container{
        width: 50px !important;
    }
    .dx-list-item-icon {
        width: 40px !important;
        height: 40px !important;
        background-position: 0px 0px !important;
        background-size: 40px 40px !important;
        padding: 0px !important;
        font-size: 40px !important;
        text-align: center !important;
        line-height: 40px !important;
        object-fit: cover !important;
    }
</style>

<style>
    .link_contain{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        min-width: 160px;
        margin: 0px 30px 0px 10px;
        flex-wrap: wrap;
    }
    .icon_links{
        font-size: 22px;
        font-weight: 600;
        margin-right: 20px;
        color: #223f2e;
    }
    

</style>

@if ($message = Session::get('message'))
    @if ($message == 'COMPLETED')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your announcement has been created!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'COMPLETED_EDIT')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your announcement has been edited!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'COMPLETED_REPLY')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your reply has been sent!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message == 'FILE_SIZE')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Your files size exceed the limit 200 MB!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    
@endif

<div style="width: 100%;display: flex;justify-content: center;">
    <div class="floating-button-menu menu-off" style="display: flex;align-items: center;justify-content: center;">
        <div class="floating-button-menu-label"><i class="fas fa-plus"></i></div>
    </div>

    <div class="floating-button-menu-close"></div>
    
    <div style="position: fixed;display: flex;background-color: #ffffff;height: 2rem;width: 74%;z-index: 25;justify-content: center;align-items: center;">
        
        <p style="margin-bottom: 0;font-size: 12px;margin-top:3px;">Communication Links<span></span>
            &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
            <div class="arrow" onclick="toggle_sticky_notes()">
                <div class="arrow-top"></div>
                <div class="arrow-bottom"></div>
            </div>
        </p>
    </div>
   
    <div id="sticky_div" class="sticky_container container row" 
        style="position: fixed;flex-wrap: nowrap;background-color: white;z-index: 10;height: 8rem;display:none; ">
        <div class="row" style="padding: 50px 0px;">
            <div class="link_contain">
                <span  class="icon_links" > <i class="fas fa-calendar-alt"></i> </span> 
                <a href="https://calendar.google.com/calendar/u/0?cid=Y19lMDE0ZGExNTlmNjM2MzgyYTQ1OWQzYTEwNTA3NWI5ZjY5MGI2NGMzZDdhYjNlNjk2N2UxY2Y2OTlkN2JlOGYyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20" target="blank" style="font-size: 12px;color: #5b5c5b;">Google Calender</a>
            </div>
            <div class="link_contain">
                <span  class="icon_links" > <i class="fab fa-figma"></i> </span> 
                <a href="https://www.figma.com/files/project/80261575/Team-project?fuid=1200127383556166355" target="blank" style="font-size: 12px;color: #5b5c5b;">Figma board</a>
            </div>
        </div>
        {{--  @foreach ($stickyNotes as $sticky_note)  
           
            @if ($sticky_note->sticky_order ==1)
                <div class="note-container">
                    <div class="sticky-note sticky-note-two" > 
                        {{-- <p @if (Auth::user()->id==1) contenteditable="true" @endif id="sticky_1" onkeyup="sticky_keypress(this,'sticky_1')" style="white-space: pre-line;outline: none;width: 100%;height: 100%;overflow-y: auto;" >
                            {{$sticky_note->note}}
                        </p> 
                        <textarea onkeyup="sticky_keypress(this,'sticky_1')" name="sticky_1" id="sticky_1" cols="30" rows="8" @if (Auth::user()->id != 8 )  readonly  @endif
                        style="white-space: pre-line;outline: none;width: 100%;height: 100%;background: transparent;color: white;border: none;letter-spacing: .5px;">{{$sticky_note->note}}</textarea>
                    </div>
                    <div style="width: 100%;position: relative;bottom: 16.3%;" >
                        <div class="sticky_after" onclick="sticky_submit('sticky_1')"> <i  class="fas fa-check sticky_submit"></i>  </div> </div>
                </div>
            @elseif($sticky_note->sticky_order ==2)
                <div class="note-container">
                    <div class="sticky-note sticky-note-two" > 
                        {{-- <div @if (Auth::user()->id==8) contenteditable="true" @endif id="sticky_2"  onkeyup="sticky_keypress(this,'sticky_2')" style="outline: none;width: 100%;height: 100%;overflow-y: auto;" >
                            {{$sticky_note->note}}
                        </div>   
                        <textarea onkeyup="sticky_keypress(this,'sticky_2')" name="sticky_2" id="sticky_2" cols="30" rows="8" @if (Auth::user()->id != 8)  readonly  @endif
                            style="white-space: pre-line;outline: none;width: 100%;height: 100%;background: transparent;color: white;border: none;letter-spacing: .5px;">{{$sticky_note->note}}</textarea>
                    </div>
                    <div style="width: 100%;position: relative;bottom: 16.3%;" >
                        <div class="sticky_after" onclick="sticky_submit('sticky_2')"> <i  class="fas fa-check sticky_submit"></i>  </div> </div>
                </div>
            @elseif($sticky_note->sticky_order ==3)
                <div class="note-container">
                    <div class="sticky-note sticky-note-two" > 
                       {{--  <div @if (Auth::user()->id==8) contenteditable="true" @endif id="sticky_3"  onkeyup="sticky_keypress(this,'sticky_3')" style="outline: none;width: 100%;height: 100%;overflow-y: auto;" >
                            {{$sticky_note->note}}
                        </div>  
                        <textarea onkeyup="sticky_keypress(this,'sticky_3')" name="sticky_3" id="sticky_3" cols="30" rows="8" @if (Auth::user()->id != 8)  readonly  @endif
                            style="white-space: pre-line;outline: none;width: 100%;height: 100%;background: transparent;color: white;border: none;letter-spacing: .5px;">{{$sticky_note->note}}</textarea>  
                    </div>
                    <div style="width: 100%;position: relative;bottom: 16.3%;" >
                        <div class="sticky_after" onclick="sticky_submit('sticky_3')"> <i  class="fas fa-check sticky_submit"></i>  </div> </div>
                </div>
            @elseif($sticky_note->sticky_order ==4)
                <div class="note-container">
                    <div class="sticky-note sticky-note-two" > 
                       {{--  <div @if (Auth::user()->id==8) contenteditable="true" @endif id="sticky_4"  onkeyup="sticky_keypress(this,'sticky_4')" style="outline: none;width: 100%;height: 100%;overflow-y: auto;" >
                            {{$sticky_note->note}}
                        </div>   
                        <textarea onkeyup="sticky_keypress(this,'sticky_4')" name="sticky_4" id="sticky_4" cols="30" rows="8" @if (Auth::user()->id != 8)  readonly  @endif
                            style="white-space: pre-line;outline: none;width: 100%;height: 100%;background: transparent;color: white;border: none;letter-spacing: .5px;">{{$sticky_note->note}}</textarea>
                    </div>
                    <div style="width: 100%;position: relative;bottom: 16.3%;" >
                        <div class="sticky_after" onclick="sticky_submit('sticky_4')"> <i  class="fas fa-check sticky_submit"></i>  </div> </div>
                </div>
            @endif
         @endforeach 
        --}}

    </div>

    @php
        date_default_timezone_set('Africa/Cairo');
        $now = date('Y-m', time());
    @endphp

    <div class="content-wrapper container" style="margin-bottom: 10vh;padding-right: 15px;padding-left: 15px;align-items: start;margin-top: 50px;">
        <div style="margin: 15px 0px;padding: 12px;border: 1px #1b342566 solid;border-radius: 10px;">
            <form action="/dashboard" method="GET" >
                <label for="date" style="margin-left: 3px;font-weight: 600;font-family: monospace;height: 5%;">Choose (month and year):</label>
                <input type="month" id="date" name="date" min="2022-12" max="{{$now}}" value="{{$_GET['date']}}" style="border: none;color: #cb9d48;cursor: pointer;">
                <button type="submit" class="btn" value="Submit" id="submitBtn" style="color: #cb9d48;background-color: transparent;" >
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </form>
        </div>

        @php
            $priorty=['Normal','Important','Urgent'];
        @endphp
        
        @foreach ($announcements as $announcement)
        
            <div class="row" style="margin-left: 0px;margin-top: 35px;width: 100%;flex-wrap: nowrap;">
                <div  title="All {{$announcement->name}} shared files" class="profile-image notification_user" style=" @if (isset( $announcement->form_url) && !empty($announcement->form_url)) background-size: cover;
                    background-image:url({{ asset($announcement->form_url) }}); @else background-size: cover;background-image:url({{ asset('uploads/profiles/anonymous.jpg') }}); @endif  cursor: pointer;" 
                    onclick="employees_files('{{$announcement->note_created_by}}')" >
                </div>
                <div style="width: 89%;min-height: 110px;">
                    <span class="user_name" style="margin-left: 3px;font-weight: 600;font-family: monospace;height: 5%;"> {{$announcement->name}} </span>
                    <div class="profile-name notification_body" >
                        <div class="col" style="display: flex; padding:0px;">
                            <div class="row" style="margin: 0px;height: 100%;width: 97%;">

                                <div class="col-10" style="width: 100%;padding: 12px;word-wrap: break-word;height: fit-content;margin-top: -20px;">
                                    <span style="word-wrap: break-word;height: max-content;white-space: pre-line;">
                                        {{$announcement->note}}
                                    </span>
                                </div>

                                <div class="col" style="margin-top: 2rem;display: flex;flex-direction: column;width: 100%;justify-content: center;align-items: center;padding-left: 85px;">
                                    <i class="fas fa-exclamation-circle"  style="display: flex;width: 6%;justify-content: center;align-items: center;font-size: 28px;
                                    @if ($announcement->priorty == 0) color: rgb(29, 141, 1);  @elseif($announcement->priorty == 1) color: rgb(214 144 0);  @elseif($announcement->priorty == 2) color: #c81313; @endif "></i> 
                                </div>
                                    
                            </div>
                            {{-- new --}}
                            @if ( Auth::user()->name  == $announcement->name )
                                <i  class="edit_icon far fa-edit" onclick="edit_announcement({{$announcement->note_id}})"></i>    
                            @endif
                            
                        </div>
                    
                        <div class="row" style="margin: 10px 0px 5px 10px;width: 83%;justify-content: space-between;">
                            <div style="display: flex;flex-wrap: wrap;width: 90%;">
                                @foreach ($announcement->mentions as $mention)
                                    @if ($mention !='empty' ) 
                                        <div style="background: #223f2e;color: white;margin-bottom: 5px;border-radius: 80px;width: fit-content;padding: 3px 12px 3px 12px;
                                        margin-right: 10px;
                                        font-size: 10px;"> @ {{$mention}}</div>
                                    @endif
                                @endforeach
                            </div>
                            <div >
                            
                                <i class="fas fa-reply-all" style="color: #1b3425;transform: rotatex(180deg);position: relative;top: 25%;left: -65%;cursor: pointer;
                                font-size: 18px;z-index: 8;"
                                    onclick="reply('{{Auth::user()->id}}' , {{$announcement->id}})"></i>
                                @if ($announcement->replies == 1)
                                    <i class="far fa-comments" style="position: relative;left: -45%;top: 25%;font-size: 18px;z-index: 8;cursor: pointer;"
                                    onclick="toggle_replies({{$announcement->id}} , {{Auth::user()->id}})"></i>
                                @endif
                                
                            </div>
                            
                            
                        </div>
                        <div style="font-size: 10px;display: flex;position: relative;right: 3%;top: -20px;justify-content: flex-end;">
                            <span > 
                                {{$announcement->note_created_at}}
                            </span>
                        </div>
                    </div>

                    
                    
                </div>
                @if ($announcement->attachment==0)
                    <div class="attachment_icon">
                        <i class="fas fa-paperclip" style="display: flex;height: 90%;align-items: center;align-items: center;" onclick="get_attchments({{$announcement->note_id}})"></i>
                    </div>
                @endif
                
            </div>

            <div style="display: none;width: 100%;flex-direction: column;" id="replies-{{ $announcement->id}}">
            </div>

            <div style="z-index: 25;" id="reply_container-{{$announcement->id}}" class="overlay">
                <div class="tasks_popup" style="height: 50%;margin: 170px auto;">
                    <div class="container">
                        <div class="title"><img style="width: 16%;" src="{{ asset('background-white.png') }}"
                                alt=""></div>
                    </div>
                    <a id='closee' class="closee" href="#">&times;</a>
                    <div class="container content" >
                        <form  method="POST" action="reply_to_announcement" enctype="multipart/form-data"  style="margin-top: 50px;display: flex;flex-direction: column;">
                            @csrf
                            <span class="details" style="font-weight: 500;">Reply Content</span>
                            <textarea maxlength="250" style="height: 90px;overflow: hidden;resize: none;width: 100%;background: transparent;border-radius: 8px;border: solid #c7d3ca 1px;
                            outline: none;margin-bottom: 15px;margin-top: 15px;padding: 5px;color: #494e53;font-size: 13px;" name="reply" id="reply"
                                cols="30" rows="2" required></textarea>
                                <input type="hidden" name="replier_name" id="replier_name" value="{{Auth::user()->id}}">
                                <input type="hidden" name="announcement_id_to_replies" id="announcement_id_to_replies" value="{{$announcement->id}}">
                            <div style="margin-bottom: 15px;display: flex;justify-content: flex-end;width: 80%;">
                                <button type="submit" style="width: 74%;border: none;background: linear-gradient(135deg, #142019, #296E45);color: #ffffff;border-radius: 8px;padding: 8px 1px 11px 0px;font-size: 18px;">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                                
                        </form>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
    
    <div style="z-index: 25;" id="tasks_popup" class="overlay">
        <div class="tasks_popup">
            <div class="container">
                <div class="title"><img style="width: 16%;" src="{{ asset('background-white.png') }}"
                        alt=""></div>
            </div>
            <a id='closee' class="closee" href="#">&times;</a>
            <div class="container content" >
                
                <form action="create_announcment" method="post"  id="create_announcment" enctype="multipart/form-data" onsubmit="return before_submit()">
                    @csrf
                    <input type="hidden" name="mentions" id="mentions">
                    <input type="hidden" name="type_of_submission" id="type_of_submission" value="0">
                    <input type="hidden" name="edit_announcement_id" id="edit_announcement_id" value="">
                    
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Content</span>

                            <span id="old_note" style="word-wrap: break-word;height: max-content;white-space: pre-line;display:none;" >
                                
                            </span>

                            <textarea maxlength="250" style="height: 90px;overflow: hidden;resize: none;" name="content" id="task"
                                cols="30" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="input-box dx-viewport demo-container" style="margin-bottom: 12px;">
                        <span class="details">Mentions&nbsp;&nbsp;
                            <span style="font-size: 12px;color: gray;" id="example_mentions">EX: @Park </span>
                            <span style="font-size: 12px;color: gray;display:none;" id="old_mentions" > </span>  
                        </span>
                        <div id="html-editor"></div>
                    </div>

                    <div class="input-box" style="margin-bottom: 12px;">
                        <span class="details">Files <span id="old_files" style="font-size: 12px;color: gray;display:none;"> ( this files will be added to the existance ones you already submit in the announcement )</span></span>
                            {{-- https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Microsoft_PowerPoint_2013-2019_logo.svg/1200px-Microsoft_PowerPoint_2013-2019_logo.svg.png --}} {{-- power point .pptx  .pptm  .ppt  --}}
                            {{-- https://www.freelogovectors.net/wp-content/uploads/2019/02/winrar_logo.png --}} {{-- rar .rar --}}
                            {{-- https://www.freeiconspng.com/thumbs/txt-file-icon/document-extension-file-file-format-filename-text-txt-icon--20.png --}} {{-- text .txt --}}
                            {{-- https://upload.wikimedia.org/wikipedia/commons/0/08/Microsoft_Word_logo_%282013-2019%29.png --}} {{-- word .doc .docx --}}
                            {{-- https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/119_Excel_logo_logos-512.png --}} {{-- excel .xls .xlsx --}}
                            {{--  https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png --}} {{-- pdf .pdf --}}
                            {{-- https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png --}} {{-- video --}}

                            {{-- https://www.sgatech.co.uk/resources/images/generic-file.png --}} {{-- UNKOWN FILE--}}

                        
                        <input id="files" type="file" multiple="multiple" name="files[]" {{-- accept="image/jpeg, image/png, image/jpg" --}}>{{-- text --}}
                        <div id="result" style="margin-top: 20px;justify-content: space-around;"> 
                            
                        </div>
                    </div>

                    <hr>

                    <div class="gender-details">
                        <input type="radio" name="priority" value="2" id="dot-1">
                        <input type="radio" name="priority" value="1" id="dot-2">
                        <input type="radio" name="priority" value="0" id="dot-3" checked>

                        <span class="gender-title">Priority</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: red;"
                                    class="gender">Urgent</span>
                            </label>
                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(239, 188, 0);"
                                    class="gender">Important</span>
                            </label>
                            <label for="dot-3">
                                <span class="dot three"></span>
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(29, 141, 1);"
                                    class="gender">Normal</span>
                            </label>

                        </div>
                    </div>

                    <div id="assign_submit" style="margin: 35px 0 15px;" class="button">
                        <input id="submit_note" type="submit" value="Submit">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div style="z-index: 25;" id="attachment_pop" class="overlay">
        <div class="tasks_popup">
            <a id='closee' class="closee" href="#">&times;</a>
            <div class="container content" >
                
                <div id="attachments_result" style="margin-top: 20px;justify-content: space-around;"> 
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var notes=[];

    $('.sticky-note').on('keydown paste', function(event) { 

        if($(this).text().length === 200 ) { 
            event.preventDefault();
        }
    });

    function sticky_keypress(element,id){
       
        notes[id] = document.getElementById(element.id).value;
        /* console.log(notes); */
    }

    function sticky_submit(id){

        if (notes[id] != null && notes[id].replace(/\s+/, "") != '') {
            $.ajax({
                    url: "submit_sticky_note",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id : id,
                        note: notes[id] 
                    },
                    success: function(response) {
                        /* console.log(response); */
                        location.reload(true);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your note has been saved!',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                });
        }
        

    }
</script>

<script>
    var html='';

    var employees = [
        {
            text: "Hyeonuk Park",
            team: "Management",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/park.jpeg",
            id: 8
        },
        {
            text: "John Seo",
            team: "Management",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/john.jpeg",
            id: 3
        },
        {
            text: "EunJung",
            team: "Logistics",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/EunJung.jpeg",
            id: 102
        },
        {
            text: "Junkyu",
            team: "Logistics",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/Junkyu.jpeg",
            id: 90
        },
        {
            text: "Mohsen",
            team: "Software",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/mohsen.jpeg",
            id: 1
        },
        {
            text: "NourAllah",
            team: "Software",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/nour.jpeg",
            id: 12
        },
       /*  {
            text: "Esraa",
            team: "CS",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/esraa.JPG",
            id: 2
        }, */
        {
            text: "Menna galal",
            team: "CS",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/menna.JPG",
            id: 6
        },
        {
            text: "Bassant",
            team: "CS",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/bassant.jpeg",
            id: 104
        },
        {
            text: "Samar",
            team: "CS",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/samar.jpeg",
            id: 103
        },
        {
            text: "Joongi",
            team: "Graphic Designer",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/Joongi.jpeg",
            id: 110
        },
        {
            text: "Ashrakat Gamal",
            team: "Content Writer",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/ashrakat.jpeg",
            id: 113
        },
        {
            text: "Mai Sayed",
            team: "Graphic Designer",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/mai.jpeg",
            id: 115
        },
        {
            text: "Maram Mohamed",
            team: "Video Editor",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/maram.jpeg",
            id: 118
        },
        {
            text: "Nehal Wael",
            team: "Customer Service Agent",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/nehal.jpeg",
            id: 117
        }
        
        /* {
            text: "Everyone",
            team: "Other",
            icon:
            "https://kshopinaexpress.com/public/uploads/profiles/anonymous.jpg",
            id: 0
        }, */
        
    ];  

    $('.closee').click(function(e) {

        $(this.parentElement.parentElement).hide();
        e.preventDefault();

    });
    
   
    $('.closee').click(function(){

        var e = jQuery.Event("keyup"); // or keypress/keydown
        e.keyCode = 27; // for Esc
        $(document).trigger(e); // trigger it on document

    });

    
    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // Esc
             
             $('.overlay').hide();

        }
    });

    $(".menu-off").click(function() {
        
        document.getElementById('edit_announcement_id').value='';
        $('#old_mentions').hide();
        $('#old_note').hide();
        $('#old_files').hide();
        
        $('#example_mentions').show();

        var editor = $("#html-editor")
        .dxHtmlEditor({
            mentions: [
                {
                dataSource: employees,
                searchExpr: "text",
                displayExpr: ({text, team }) => `${text} (${team})`,
                valueExpr:"id"
                }
            ]
        })
        .dxHtmlEditor("instance");

        $('#tasks_popup').show();

    });
    
    document.querySelector("#files").addEventListener("change", (e) => {
        //CHANGE EVENT FOR UPLOADING PHOTOS
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            //CHECK IF FILE API IS SUPPORTED
            const files = e.target.files; //FILE LIST OBJECT CONTAINING UPLOADED FILES
            
            html="";

            for (let i = 0; i < files.length; i++) {
                // LOOP THROUGH THE FILE LIST OBJECT
                
                if (files[i].type.match("image")){

                    const picReader = new FileReader(); // RETRIEVE DATA URI
                    picReader.addEventListener("load", function (event) {
                    // LOAD EVENT FOR DISPLAYING PHOTOS
                    const picFile = event.target;
                            
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 95px;width: auto;max-width: 140px;height: auto;min-height: 95px" src="'+picFile.result+'" >'+
                                '</div>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="image">'+
                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                    });
                    picReader.readAsDataURL(files[i]); //READ THE IMAGE
                    
                } else if(files[i].type.match("pdf")){
                    
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="pdf">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                    

                }else if(files[i].type.match("spreadsheetml.sheet") || files[i].type.match("csv") || files[i].type.match("excel")){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/119_Excel_logo_logos-512.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="excel">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }else if(files[i].type.match("word")){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Microsoft_Word_logo_%282013-2019%29.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="word">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }else if(files[i].type.match("plain") && files[i].name.match("txt")){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freeiconspng.com/thumbs/txt-file-icon/document-extension-file-file-format-filename-text-txt-icon--20.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="txt">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }else if(files[i].type.match("powerpoint") || files[i].type.match("presentation")){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Microsoft_PowerPoint_2013-2019_logo.svg/1200px-Microsoft_PowerPoint_2013-2019_logo.svg.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="powerpoint">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }else if(files[i].name.match("rar") || files[i].name.match("zip")){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freelogovectors.net/wp-content/uploads/2019/02/winrar_logo.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="compressed">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }
                else if(files[i].type.match("video") ){
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="video">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);
                }
                else{
                    html += '<div class="col result_files" style="margin-bottom: 15px;">'+
                                '<div style="width: 100%;display: flex;justify-content: center;">'+
                                    '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.sgatech.co.uk/resources/images/generic-file.png" >'+
                                '</div>'+
                                '<span style="text-align: center;overflow: hidden;font-size: 13px;margin-top: 5px;text-overflow: ellipsis;white-space: nowrap;">'+files[i].name+'</span>'+
                                '<input type="hidden" name="type['+i+']" id="type" value="other">'+

                                '<input type="text" name="side_note['+i+']" id="file_'+i+'" style="margin-top: 3px;width: 100%;border: 1px solid #4e4e4e61;outline: none;">'+
                            '</div>';
                            
                    $("#result").html("");
                    $("#result").html(html);

                }
                
            }
        } else {
            alert("Your browser does not support File API");
        }
    });

    var mentions = [];
    var old_array = [];

    var new_mentions_employees = [];


   /*  $(function () {

    }); */

    
    function edit_announcement(id){

        /* var editor = $("#html-editor")
        .dxHtmlEditor({
            mentions: [
                {
                dataSource: employees,
                searchExpr: "text",
                displayExpr: ({text, team }) => `${text} (${team})`,
                valueExpr:"id"
                }
            ]
        })
        .dxHtmlEditor("instance"); */
        
        type_announc = 1;
        html='';

        var old_mentions = document.getElementById('old_mentions');
        var old_note = document.getElementById('old_note');

        document.getElementById('type_of_submission').value = 1;
    
        $.ajax({
            url: "get_announcement_data",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {

                if ( response.length > 0) {

                    for (let i = 0 ; i < response.length ; i++){

                        if (i == 0 ) {

                            old_note.innerHTML = response[i].note;
                            if (response[i].user_name != 'empty') {

                                old_mentions.innerHTML= "@" + response[i].user_name + " &nbsp";
                                old_array.push(response[i].user_id);

                            } 
                            
                            document.getElementById('edit_announcement_id').value = response[i].id;

                        }else{
                            if (response[i].user_name != 'empty') {
                                
                                if (!old_mentions.textContent.includes(response[i].user_name)) {

                                    old_mentions.innerHTML += "@" + response[i].user_name + " &nbsp";
                                    
                                    
                                    old_array.push(response[i].user_id);

                                } 

                            } 

                        }
                    }
                    
                } else {

                    old_note.innerHTML = 'No message attached';
                    old_mentions.innerHTML = 'No one is mentioned';

                }
                

                var new_mentions_employees = employees.slice();

                old_array.forEach(element => {

                    for (let i = 0; i < new_mentions_employees.length; i++) {

                        if (element == new_mentions_employees[i].id) {
                            console.log('found');
                          
                            new_mentions_employees.splice(i,1);
                        } 
                        
                    }

                });

                var editor = $("#html-editor")
                    .dxHtmlEditor({
                        mentions: [
                            {
                            dataSource: new_mentions_employees,
                            searchExpr: "text",
                            displayExpr: ({text, team }) => `${text} (${team})`,
                            valueExpr:"id"
                            }
                        ]
                    })
                    .dxHtmlEditor("instance");

                $('#example_mentions').hide();
                
                $('#old_note').show();
                $('#old_mentions').show();
                $('#old_files').show();
                $('#tasks_popup').show();
                
            }
        });

        type_announc = 0;
    }

    function before_submit(){

        document.getElementById('assign_submit').disabled= true;
        
        document.getElementById("assign_submit").innerHTML = '<button class="loader_" style="align-items: center;justify-content: center;display: flex" disabled="disabled"><div class="loader"></div></button>';
        
        var mentions_data=$(".dx-mention");
        
        for (let i = 0; i < mentions_data.length; i++) {
            mentions.push(mentions_data[i].dataset.id);
        }

        $('#mentions').val(mentions);

        return true;
    }


    function get_attchments(note_id){
       var html="";

        $.ajax({
            url: "get_note_attachments",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: note_id
            },
            success: function(response) {
                console.log(response);
                
                for (let i = 0; i < response.length; i++) {
                
                    if (response[i].file_type=='image'){
                                
                        html += '<div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;width:100%;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center">'+
                                        '<img style="max-height: 95px;width: auto;max-width: 140px;height: auto;min-height: 95px" src=public/uploads/dashboard/'+response[i].file_new_name+'>'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                '</div>'+
                                ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                        
                        
                    } else if(response[i].file_type=="pdf"){
                        
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                       
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                        

                    }else if(response[i].file_type=="excel"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/119_Excel_logo_logos-512.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                       
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type== "word"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Microsoft_Word_logo_%282013-2019%29.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="txt" ){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freeiconspng.com/thumbs/txt-file-icon/document-extension-file-file-format-filename-text-txt-icon--20.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="powerpoint"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Microsoft_PowerPoint_2013-2019_logo.svg/1200px-Microsoft_PowerPoint_2013-2019_logo.svg.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="compressed"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freelogovectors.net/wp-content/uploads/2019/02/winrar_logo.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }
                    else if(response[i].file_type=="video" ){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }
                    else{
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.sgatech.co.uk/resources/images/generic-file.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);

                    }
                    
                }
             
                $('#attachment_pop').show();
            }
        });
    }
    
    function toggle_sticky_notes(){

        var x = document.getElementById('sticky_div');

        if (x.style.display === 'flex') {

            x.style.display = 'none';

        } else {

            x.style.display = 'flex';
            
        }
    }


    function reply(id_user_reply , announcement_id){

        $('#reply_container-'+announcement_id).show();

    }

    function toggle_replies( announcement_id , user_id){

        var html = "";
        $.ajax({
            url: "announcement_replies",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: announcement_id
            },
            success: function(response) {
                console.log(response);
                
                for (let i = 0; i < response.length; i++) {
                    
                    if (user_id == response[i].replied_by){

                            if (response[i].form_url ) {
                                $("div.reply_user").css( {'background-image': 'url(/public/'+response[i].form_url+')' }  );
                            } else {
                                $("div.reply_user").css( {'background-image': 'url(/public/uploads/profiles/anonymous.jpg)' }  );
                            }

                        html += '<div style="display: flex;width: 96%;justify-content: flex-start;align-items: center;"> '+
                            '<div class="reply me">'+response[i].reply+'</div>';
                            if (response[i].form_url != null ) {
                                html += '<div title="'+response[i].name+'" class="profile-image reply_user" style=" margin-right: 0px;background-image : url(/public/'+response[i].form_url+'); " >';
                            } else {
                                html +=  '<div title="'+response[i].name+'" class="profile-image reply_user" style="margin-right: 0px; background-image : url(/public/uploads/profiles/anonymous.jpg); " >';
                            }
                            
                            html +=  '</div>'+
                        '</div>'; 

                      
                    }else{

                        html += '<div style="display: flex;width: 100%;justify-content: flex-start;align-items: center;margin-left: 7%;" >';
                            if (response[i].form_url != null ) {
                                html += '<div title="'+response[i].name+'" class="profile-image reply_user" style="margin-right: 0px; background-image : url(/public/'+response[i].form_url+'); " >';
                            } else {
                                html +=  '<div title="'+response[i].name+'" class="profile-image reply_user" style="margin-right: 0px;background-image : url(/public/uploads/profiles/anonymous.jpg); " >';
                            }
                            
                            html +=  '</div>'+
                            '<div class="reply user">'+response[i].reply+'</div>'+
                        '</div>';
                       
                    }
                    $("#replies-"+announcement_id).html("");
                    $("#replies-"+announcement_id).html(html);
                } 

            }
        });

        var x = document.getElementById('replies-'+announcement_id);

        if (x.style.display === 'flex') {

            x.style.display = 'none';

        } else {
            
            x.style.display = 'flex';
            
        }
    }

    function  employees_files (employee_id){

         var html="";

        $.ajax({
            url: "get_employee_attachments",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: employee_id
            },
            success: function(response) {
                console.log(response);
                
                for (let i = 0; i < response.length; i++) {
                
                    if (response[i].file_type=='image'){
                                
                        html += '<div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;width:100%;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center">'+
                                        '<img style="max-height: 95px;width: auto;max-width: 140px;height: auto;min-height: 95px" src=public/uploads/dashboard/'+response[i].file_new_name+'>'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                '</div>'+
                                ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                        
                        
                    } else if(response[i].file_type=="pdf"){
                        
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                       
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                        

                    }else if(response[i].file_type=="excel"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/119_Excel_logo_logos-512.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                       
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type== "word"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Microsoft_Word_logo_%282013-2019%29.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+
                                    
                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="txt" ){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freeiconspng.com/thumbs/txt-file-icon/document-extension-file-file-format-filename-text-txt-icon--20.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="powerpoint"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Microsoft_PowerPoint_2013-2019_logo.svg/1200px-Microsoft_PowerPoint_2013-2019_logo.svg.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }else if(response[i].file_type=="compressed"){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.freelogovectors.net/wp-content/uploads/2019/02/winrar_logo.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }
                    else if(response[i].file_type=="video" ){
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);
                    }
                    else{
                        html += '<div class="row" style=" display: flex;justify-content: space-around;"><div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">'+
                                    '<div style="width: 100%;display: flex;justify-content: center;">'+
                                        '<img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.sgatech.co.uk/resources/images/generic-file.png" >'+
                                    '</div>'+
                                    '<a  href="public/uploads/dashboard/'+response[i].file_new_name+'" download="'+response[i].file_old_name+'"> <span style="margin-top: 3px;outline: none;display: flex;align-items: center;font-weight: 600;font-size: 12px;justify-content: center;">'+response[i].file_old_name+'</span></a>'+

                                    '</div>'+
                                    ' </div><div style="display: flex;justify-content: center;"> <span style="color: #79827d;font-size: 15px;"> <span style="font-weight: 500;">Note :</span>&nbsp;&nbsp;'+response[i].file_note+'</span></div> <hr>';

                                
                        $("#attachments_result").html("");
                        $("#attachments_result").html(html);

                    }
                    
                }
               
                $('#attachment_pop').show(); 
            }
        });
    }
    
    
</script>

@endsection