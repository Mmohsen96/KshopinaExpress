 @extends('layouts.staff_layout')

 @section('content')

 <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
 <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
     <style>
         body {
             background-color: #dfdfdf;
         }

         .table {
             border-collapse: collapse;
             width: 100%;
             border-radius: 0px 0px 15px 15px;
             overflow: hidden;
             border-top: hidden;
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
             background-color: transparent;
         }

         .td {
             padding: 0.87rem !important;
             vertical-align: middle !important;
             font-size: 18px;


         }

         .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            height: 40px;
        }

        .pagination a.active {
            background-color: #ca9b49;
            color: white;
            border-radius: 20px;
            height: 40px;
        }

        .pagination a:hover:not(.active) {
            background-color: rgb(116, 112, 112);
            border-radius: 20px;
        }

         .dot {
             margin-right: 5px;
             height: 28px;
             width: 28px;
             border-radius: 50%;
             display: inline-block;
             display: inline-flex;
             justify-content: center;
             align-items: center;
             background-color: #000000;
             font-size: 14px;
             color: white;
         }

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
         }

         .popup h2 {
             margin-top: 0;
             color: #ca9b49;
             font-family: Tahoma, Arial, sans-serif;
         }

         .popup .close {
             position: absolute;
             top: 20px;
             right: 30px;
             transition: all 200ms;
             font-size: 30px;
             font-weight: bold;
             text-decoration: none;
             color: #333;
         }

         .popup .close:hover {
             color: #ca9b49;
         }

         .popup .content {
             max-height: 45%;
             overflow: auto;
         }

         @media screen and (max-width: 700px) {
             .box {
                 width: 70%;
             }

             .popup {
                 width: 70%;
             }
         }

         #myInput {
             border-radius: 6px;
             font-size: 16px;
             padding: 9px 0px 9px 40px;
             border: 1px solid #1b3425;
             background-color: #ffffff;
         }

         #myInput:focus-visible {
             border: 1px solid #c2a264;
             outline: none;
         }

         #myInput::placeholder {
             color: #296E45;
             font-size: 0.9rem;
             margin-bottom: 10px;
         }

         #filters {
             flex: 80;
             margin-top: 15px;
         }

         #filters button {
             color: #1b3425 cursor: pointer;
             border: 1px solid #1b3425;
             border-right: 0px;
             padding: 0px 1% 0px 1%;
             height: 44px;
             align-items: center;
             display: flex;
             justify-content: center;
             background-color: transparent;
             background-color: white;

         }

         #filters button:hover {
             background: #1b3425 !important;
             color: white;
         }

         .selected {
             background: #1b3425 !important;
             color: white !important;
         }

         .checked {
             text-decoration-line: line-through;
         }

         .stati {
             align-items: center;
             background: white;
             color: #1b3425;
             height: 6em;
             border: 1px solid #1b34253d;
             border-radius: 0px 0px 8px 8px;
             margin: 1em 0;
             -webkit-transition: margin 0.5s ease, box-shadow 0.5s ease;
             transition: margin 0.5s ease, box-shadow 0.5s ease;

         }

         .stati:hover {
             margin-top: 0.5em;

         }

         .stati i {
             font-size: 3.5em;
         }

         .stati div {
             width: 50%;
             display: block;
             float: right;
             text-align: right;
         }

         .stati div b {
             font-size: 2.2em;
             width: 100%;
             padding-top: 0px;
             margin-top: -0.2em;
             margin-bottom: -0.2em;
             display: block;
         }

         .stati div span {
             font-size: 1em;
             width: 100%;
             color: rgb(0, 0, 0, 0.8);
              !important;
             display: block;
         }

         .stati.left div {
             float: left;
             text-align: left;
         }

         .stati.bg-turquoise {
             background-color: #1b3425;
             color: white;
         }


         .btnn {
             background-color: #767676;
             border: none;
             color: white;
             padding: 7px 11px;
             font-size: 13px;
             cursor: pointer;
             margin-bottom: 5px;
             border-radius: 4px;
         }

         /* Darker background on mouse-over */

         .search-btnn {
             color: #1b3425;
             background-color: #ffffff;
             padding: 13px 51px;
             font-size: 15px;
             border: 1px solid #1b3425;
             border-radius: 10px;
         }

         .search-btnn:hover {
             border: 2px solid #c2a264;
             color: #1b3425;
         }

         .message-count {
             color: #fff;
             font-size: 10px;
             font-family: Arial, san-serif;
             font-weight: bold;
             position: relative;
             text-align: center;
             margin: 0;
             display: flex;
             justify-content: center;
             align-items: center;
             top: -18px;
         }

         .badge {
             position: absolute;
             right: 0px;
             top: -5px;
             z-index: 10;
             background-color: #ed2324;
             border-radius: 50%;
             width: 20px;
             height: 20px;
             text-align: center;
             padding: 5% 5%;
             position: relative;
             right: -80%;
             top: -9px;
             float: right;
             display: block;
         }

     </style>

     <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');

         /*----------------------------------------------------------
                                                                                                                                                                                                                                                                                                                            GENERAL
                                                                                                                                                                                                                                                                                                                            ----------------------------------------------------------*/
         * {
             margin: 0;
             padding: 0;
             font-family: 'Roboto', sans-serif;

         }

         html,
         body {
             display: table;
             height: 100%;
             width: 100%;
             background-color: white;
         }


         .row__title {
             font-family: 'Bebas Neue', cursive;
             color: #1b3425;
             font-weight: 700;
             font-size: 24px;
             letter-spacing: 1.4px;
             margin: 0;
             margin-bottom: 1rem;
             margin-top: 1rem;
             margin-left: 32px;
         }

         .row--top-40 {
             margin-top: 15px;
             justify-content: space-between;
         }

         .row--top-20 {
             margin-top: 20px;
         }

         .table__th {
             font-family: 'Bebas Neue', cursive;
             letter-spacing: 2px;
             text-align: center;
             color: #636464;
             font-weight: 600;
             font-size: 18px;
             text-transform: uppercase;
             cursor: pointer;
             border: 0 !important;
             padding: 15px 8px !important;
         }

         .table-row {
             border-bottom: 1px solid #e4e9ea;
             background-color: #fff;
         }

         .table__th:hover {
             color: #1b3425;

         }

         .table--select-all {
             width: 18px;
             height: 18px;
             padding: 0 !important;
             border-radius: 50%;
             border: 2px solid #becad2;
         }

         .table-row__td {
             text-align: center;
             padding: 12px 8px !important;
             vertical-align: middle !important;
             color: #53646f;
             font-size: 13px;
             font-weight: 400;
             position: relative;
             line-height: 18px !important;
             border: 0 !important;
         }

         .table-row__img {
             width: 36px;
             height: 36px;
             display: inline-block;
             border-radius: 50%;
             background-position: center;
             background-size: cover;
             background-repeat: no-repeat;
             vertical-align: middle;
         }

         .table-row__info {
             display: inline-block;
             vertical-align: middle;
         }

         .table-row__name {
             color: #53646f;
             font-size: 16px;
             font-weight: 400;
             line-height: 18px;
             margin-bottom: 0px;
         }

         .table-row__small {
             color: #9eabb4;
             font-weight: 300;
             font-size: 12px;
         }

         .table-row__policy {
             color: #53646f;
             font-size: 13px;
             font-weight: 400;
             line-height: 18px;
             margin-bottom: 0px;
         }

         .table-row__p-status {
             margin-bottom: 0;
             font-size: 13px;
             vertical-align: middle;
             display: inline-block;
             color: #9eabb4;
         }


         .table-row__status {
             margin-bottom: 0;
             font-size: 13px;
             vertical-align: middle;
             display: inline-block;
             color: #9eabb4;
         }


         .table-row__progress {
             margin-bottom: 0;
             font-size: 13px;
             vertical-align: middle;
             display: inline-block;
             color: #9eabb4;
         }

         .status:before {
             content: '';
             margin-bottom: 0;
             width: 9px;
             height: 9px;
             display: inline-block;
             margin-right: 7px;
             border-radius: 50%;
         }

         .status--red:before {
             background-color: #e36767;
         }

         .status--red {
             color: #e36767;
         }

         .status--blue:before {
             background-color: #3fd2ea;
         }

         .status--blue {
             color: #3fd2ea;
         }

         .status--yellow:before {
             background-color: #ecce4e;
         }

         .status--yellow {
             color: #ecce4e;
         }

         .status--green {
             color: #4baa38;
         }

         .status--green:before {
             background-color: #4baa38;
         }

         .status--orange {
             color: #ea8e3f;
         }

         .status--orange:before {
             background-color: #ea8e3f;
         }

         .status--dark_blue {
             color: #1815dc;
         }

         .status--dark_blue:before {
             background-color: #1815dc;
         }

         .status--purple {
             color: #b384ff;
         }

         .status--purple:before {
             background-color: #b384ff;
         }

         .status--grey {
             color: #969696;
         }

         .status--grey:before {
             background-color: #969696;
         }

         .table__select-row {
             appearence: none;
             -moz-appearance: none;
             -o-appearance: none;
             -webkit-appearance: none;
             width: 17px;
             height: 17px;
             margin: 0 0 0 5px !important;
             vertical-align: middle;
             border: 2px solid #beccd7;
             border-radius: 50%;
             cursor: pointer;
         }

         .table__select-row:hover {
             border-color: #c29746;
         }

         .table__select-row:checked {
             background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDI2IDI2IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNiAyNiIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CiAgPHBhdGggZD0ibS4zLDE0Yy0wLjItMC4yLTAuMy0wLjUtMC4zLTAuN3MwLjEtMC41IDAuMy0wLjdsMS40LTEuNGMwLjQtMC40IDEtMC40IDEuNCwwbC4xLC4xIDUuNSw1LjljMC4yLDAuMiAwLjUsMC4yIDAuNywwbDEzLjQtMTMuOWgwLjF2LTguODgxNzhlLTE2YzAuNC0wLjQgMS0wLjQgMS40LDBsMS40LDEuNGMwLjQsMC40IDAuNCwxIDAsMS40bDAsMC0xNiwxNi42Yy0wLjIsMC4yLTAuNCwwLjMtMC43LDAuMy0wLjMsMC0wLjUtMC4xLTAuNy0wLjNsLTcuOC04LjQtLjItLjN6IiBmaWxsPSIjMDFiOWQxIi8+Cjwvc3ZnPgo=);
             background-position: center;
             background-size: 7px;
             background-repeat: no-repeat;
             border-color: #c29746;
         }

         .table-row--overdue {
             width: 3px;
             background-color: #e36767;
             display: inline-block;
             position: absolute;
             height: calc(100% - 24px);
             top: 50%;
             left: 0;
             transform: translateY(-50%);
         }

         .table-row__edit {
             width: 46px;
             padding: 8px 17px;
             display: inline-block;
             background-color: #daf3f8;
             border-radius: 18px;
             vertical-align: middle;
             margin-right: 10px;
             cursor: pointer;
         }

         .table-row__bin {
             margin-left: 16px;
             width: 16px;
             display: inline-block;
             vertical-align: middle;
             cursor: pointer;
         }

         .table-row--red {
             background-color: #fff2f2;
         }

         @media screen and (max-width: 991px) {
             .table__thead {
                 display: none;
             }

             .table-row {
                 display: inline-block;
                 border: 0;
                 background-color: #fff;
                 width: calc(33.3% - 13px);
                 margin-right: 10px;
                 margin-bottom: 10px;
             }

             .table-row__img {
                 width: 42px;
                 height: 42px;
                 margin-bottom: 10px;
             }

             .table-row__td:before {
                 content: attr(data-column);
                 color: #9eabb4;
                 font-weight: 500;
                 font-size: 12px;
                 text-transform: uppercase;
                 display: block;
             }

             .table-row__info {
                 display: block;
                 padding-left: 0;
             }

             .table-row__td {
                 display: block;
                 text-align: center;
                 padding: 8px !important;
             }

             .table-row--red {
                 background-color: #fff2f2;
             }

             .table__select-row {
                 display: none;
             }

             .table-row--overdue {
                 width: 100%;
                 top: 0;
                 left: 0;
                 transform: translateY(0%);
                 height: 4px;
             }
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

         .btn-primary:focus {
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

         #delete:hover {
             background-color: #ce0808e6;
             border-color: #ce0808e6;
             color: white;
         }

         .loader {
             border: 3px solid #f3f3f3;
             border-radius: 50%;
             border-top: 4px solid #1b3425;
             width: 15px;
             height: 15px;
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

         .create:hover {
             color: white;
             text-decoration: none;
         }

         .create {
             color: #426851;
         }

     </style>

     <style>
         #formOrder1:focus-visible {
             outline: none;
         }

         .btn_table:hover {
             border-radius: 18px;
             font-size: 14px;
             background-color: #cb9d48e6;
             border-color: #cb9d48e6;
             color: #426851 !important;
         }

         .notify_numbers:hover {
             text-decoration: none !important;
         }

         .pre_alert:hover {
             text-decoration: none !important;
         }

         .pre_alert_word:hover {
             text-decoration: underline !important;
         }

     </style>

     <style>
         .variants_popup {
             margin: 70px auto;
             padding: 20px;
             background: #fff;
             border-radius: 5px;
             width: 40%;
             position: relative;
             transition: all 5s ease-in-out;
             height: 65%;
             overflow: auto;
         }

         .variants_popup .closee {
             position: absolute;
             top: 20px;
             right: 30px;
             transition: all 200ms;
             font-size: 30px;
             font-weight: bold;
             text-decoration: none;
             color: #333;
         }

         .content .user-details {
             display: flex;
             justify-content: space-between;
             margin: 40px 30px 12px 30px;
         }

         .variant {
             margin-left: 0px;
             width: 100%;
             justify-content: space-between;
             align-items: center;
             margin-bottom: 20px;
             color: #2e553d;
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

        .content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
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
            background: linear-gradient(135deg, #1B3425, #296E45);
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #142019, #296E45);
        }

        form .button textarea:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #142019, #296E45);
        }

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            form .category {
                width: 100%;
            }

            .content form .user-details {
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
    </style>

    <style>
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


       
        .dot {
            margin-right: 5px;
            height: 28px;
            width: 28px;
            border-radius: 50%;
            display: inline-block;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background-color: #000000;
            font-size: 14px;
            color: white;
        }

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

        .popup .closee {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .closee:hover {
            color: #ca9b49;
        }

        /* .popup .content {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        max-height: 45%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        overflow: auto;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }


        #myInput {
            border-radius: 6px;
            font-size: 16px;
            padding: 9px 0px 9px 40px;
            border: 1px solid #1b3425;
            background-color: #ffffff;
        }

        #myInput:focus-visible {
            border: 1px solid #c2a264;
            outline: none;
        }

        #filters {
            flex: 80;
            margin-top: 15px;
        }

        #filters button {
            color: #1b3425 cursor: pointer;
            border: 1px solid #1b3425;
            border-right: 0px;
            padding: 0px 1% 0px 1%;
            height: 44px;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: transparent;
            background-color: white;

        }

        #filters button:hover {
            background: #1b3425 !important;
            color: white;
        }

        .selected {
            background: #1b3425 !important;
            color: white !important;
        }

        .checked {
            text-decoration-line: line-through;
        }

        .stati {
            align-items: center;
            background: white;
            color: #1b3425;
            height: 6em;
            border: 1px solid #1b34253d;
            border-radius: 0px 0px 8px 8px;
            margin: 1em 0;
            -webkit-transition: margin 0.5s ease, box-shadow 0.5s ease;
            transition: margin 0.5s ease, box-shadow 0.5s ease;

        }

        .stati:hover {
            margin-top: 0.5em;

        }

        .stati i {
            font-size: 3.5em;
        }

        .stati div {
            width: 50%;
            display: block;
            float: right;
            text-align: right;
        }

        .stati div b {
            font-size: 2.2em;
            width: 100%;
            padding-top: 0px;
            margin-top: -0.2em;
            margin-bottom: -0.2em;
            display: block;
        }

        .stati div span {
            font-size: 1em;
            width: 100%;
            display: block;
        }

        .font-style {
            font-family: 'Bebas Neue', cursive !important;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .stati.left div {
            float: left;
            text-align: left;
        }

        .stati.bg-turquoise {
            background-color: #1b3425;
            color: white;
        }


        .tag {
            font-weight: 600;
            letter-spacing: .7px;
            font-size: 14px;
            background-color: #36304a;
            border-radius: 55px;
            padding: 6px 15px 6px 15px;
            border-color: #36304a;
            color: white;
            display: inline-grid;
            margin-right: 15px;
            margin-bottom: 15px;
        }

        .tag:hover {
            color: #ca9b49;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

     @if ($message = Session::get('error'))
         <script>
             Swal.fire({
                 position: 'center',
                 icon: 'error',
                 title: 'Select month you want to export first!',
                 showConfirmButton: false,
                 timer: 1500
             });
         </script>
     @endif


     <div class="container">

         <div class="row row--top-40" style="padding-bottom: 1rem;">

             <div class="column">
                 <h2 class="row__title">Products</h2>
             </div>

             {{-- <div>
                 <form action="export_products" method="post" style="display: flex;align-items: center;">
                     @csrf
                     <select
                         style="margin-right: 40px;padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;"
                         name="months" id="formOrder1" class="details" placeholder="market">
                         <option value="" selected hidden>Select month</option>
                         <option value="1">January</option>
                         <option value="2">February</option>
                         <option value="3">March</option>
                         <option value="4">April</option>
                         <option value="5">May</option>
                         <option value="6">June</option>
                         <option value="7">July</option>
                         <option value="8">August</option>
                         <option value="9">September</option>
                         <option value="10">October</option>
                         <option value="11">November</option>
                         <option value="12">December</option>
                     </select required>

                     <button
                         style="border-radius: 15px; position: relative; right: 1.8rem; font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: 2px; padding: 8px 25px 5px 22px;"
                         class="btn btn-primary" type="submit">
                         <i class="fas fa-file-export" style="margin-right: 10px;"></i>Export
                     </button>
                 </form>
             </div> --}}

         </div>


         <div>
             <div
                 style="display: flex;background: #1b3425; height: 70px; padding: 2.5% 2% 0% 1%; border-radius: 5px 5px 5px 5px;">
                 <a href="products?page=1&filter=All&store={{$_GET['store']}}" id="products"
                     style="cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 120px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                                                                                                font-family: 'Bebas Neue', cursive; letter-spacing: 2px;margin-right: 20px;
                                                                                                                     @if (Route::current()->getName() == 'products') background: #ffffff; color: #1b3425;
                         @else
                         background-color: #1b3425;color: #d2ac6a; @endif ">
                     All products</a>
                 <a href="pre_alert?page=1&filter=All&store={{$_GET['store']}}" id="products_expired" class="pre_alert"
                     style="padding-right: 16px;margin-right: 20px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 130px;padding-bottom: 5px;
                                                                                                                display: flex;border-radius: 15px 15px 0px 0px;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;
                                                                                                             @if (Route::current()->getName() == 'pre_alert') background: #ffffff; color: #1b3425;
                         @else
                         background-color: #1b3425;color: #d2ac6a; @endif ">
                     <div style="display: flex;position: relative;left: 105%;bottom: 25%; text-decoration:none;"
                         class='notify_numbers'>
                         <i class="fas fa-comment" style="color:#ed2324;font-size:26px;">
                             <div class="message-count">{{ $number_of_pre_alert[0]->NumberOfProducts }}</div>
                         </i>
                     </div>
                     <span class="pre_alert_word"
                         style="cursor: pointer;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;"> Pre Alert </span>
                 </a>
                 <a href="products_expired?page=1&filter=All&store={{$_GET['store']}}" id="products_expired"
                     style="margin-right: 20px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 140px;padding-bottom: 5px;
                                                                                                                display: flex;border-radius: 15px 15px 0px 0px;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;background-color: #1b3425; color: #d2ac6a;
                                                                                                                     @if (Route::current()->getName() == 'products_expired') background: #ffffff; color: #1b3425;
                         @else
                         background-color: #1b3425;color: #d2ac6a; @endif ">
                     Out of stock</a>


                 <div style="width: 70%;justify-content: flex-end;padding-left: 15px;display: flex;">
                     <a href="products_in?store={{$_GET['store']}}" id="products_in"
                         style="cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 60px;padding-bottom: 5px;
                                                                                                                display: flex;border-radius: 15px 15px 0px 0px;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;background-color: #1b3425; color: #d2ac6a;
                                                                                                                     @if (Route::current()->getName() == 'products_in') background: #ffffff; color: #1b3425;
                         @else
                         background-color: #1b3425;color: #d2ac6a; @endif ">
                         IN</a>

                            <a href="products_out?store={{$_GET['store']}}" id="products_out"
                            style="cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 60px;padding-bottom: 5px;
                                                                                                                    display: flex;border-radius: 15px 15px 0px 0px;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;background-color: #1b3425; color: #d2ac6a;
                                                                                                                        @if (Route::current()->getName() == 'products_out') background: #ffffff; color: #1b3425;
                            @else
                            background-color: #1b3425;color: #d2ac6a; @endif ">
                         OUT</a>
                    
                 </div>
             </div>

             @if (Route::current()->getName() == 'products_in' || Route::current()->getName() == 'products_out')
                 <div class="row row--top-20">
                     <div class="col-md-12">
                         <div class="table-container">
                             <form id="barcode_form">
                                 @csrf
                                 <div class="row"
                                     style="margin-bottom: 20px;width: 100%;display: flex;justify-content: center;">
                                     @if (Route::current()->getName() == 'products_in')
                                         <select onchange="source(this)" id='company'
                                             style="border: 1px solid #1b3425;padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;border-radius: 3px 0px 0px 3px;"
                                             name="company">
                                            <option value="" selected hidden>Choose the source..
                                            </option>
                                            <option value="New for stock">New for stock
                                            </option>
                                            <option value="Return item">Return item
                                            </option> 
                                            
                                             

                                         </select>
                                     @elseif (Route::current()->getName() == 'products_out')
                                        
                                         <select onchange="source(this)" id='company'
                                             style="border: 1px solid #1b3425;padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;border-radius: 3px 0px 0px 3px;"
                                             name="company">
                                             <option value="" selected hidden>Choose the market..
                                             </option>
                                             <option value="Kshopina Original">Kshopina Original
                                             </option>
                                             @if (isset($_GET['store']) && $_GET['store']=='plus_egypt')
                                                <option value="Amazon">Amazon
                                                </option>
                                                <option value="Jumia">Jumia
                                                </option>
                                                <option value="Noon">Noon
                                                </option>
                                                <option value="Offline">Offline
                                                </option>
                                                
                                            @endif
                                             
                                         </select>
                                    @endif


                                     @if (isset($_GET['store']) && $_GET['store']=='plus_egypt')
                                        <input type="text" class="form-control barcode" name="barcode" id="barcode"
                                        placeholder="BARCODE "
                                        style="border-radius: 0px 3px 3px 0px;width: 40%;border: 1px solid #1b3425;">
                                        @else
                                        <input type="text" class="form-control barcode" name="sku" id="sku"
                                            placeholder="SKU "
                                            style="border-radius: 0px 3px 3px 0px;width: 40%;border: 1px solid #1b3425;">
                                     @endif
                                     

                                        <select  id='discount' onchange="choose_discount(this)"
                                         style="display:none;margin-left: 2%;  border: 2px solid #1b3425;padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;border-radius: 3px 0px 0px 3px;"
                                         name="discount">
                                         <option value="" selected hidden>Choose the discount..
                                         </option>
                                         <option value="0" selected>0%
                                        </option>
                                         <option value="5">5%
                                         </option>
                                         <option value="7">7%
                                         </option>
                                         <option value="10">10%
                                         </option>
                                         <option value="13">13%
                                         </option>
                                         <option value="15">15%
                                         </option>
                                         <option value="18">18%
                                         </option>
                                         <option value="20">20%
                                         </option>
                                     </select>

                                     {{-- <input type="text" name="order_tag" id="order_tag" placeholder="# Order Reference" style="display:none;margin-left: 2%; 
                                     border: 1.5px solid #1b3425;padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;border-radius: 3px ;"> --}}

                                 </div>

                             </form>

                             <table class="table">
                                 <thead class="table__thead">
                                     <tr style="background-color: transparent;">
                                         <th class="table__th">Product name</th>
                                         <th class="table__th">Variant name</th>
                                         <th class="table__th">Quantity</th>
                                         @if (Route::current()->getName() == 'products_out')
                                             <th class="table__th"> price </th>
                                             <th class="table__th">Final price </th>
                                         @endif
                                         @if (Route::current()->getName() == 'products_out')
                                             <th class="table__th">Market</th>
                                         @else
                                             <th class="table__th">Source</th>
                                         @endif
                                         <th class="table__th">Adjust by</th>
                                         <th class="table__th"> Delete </th>

                                     </tr>
                                 </thead>
                                 <tbody id="table" class="table__tbody">


                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>

                 <div style="margin-top: 25px;display: flex;justify-content: flex-end;">
                     <button onclick="ajaxfunc(this,'{{ Route::current()->getName() }}')" type="button"
                         class="btn btn-primary"
                         style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                         Submit
                     </button>
                 </div>
             @else
                 <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff;">
                     <div style="flex:25;padding: 25px 0px 0px 15px;" class="position-relative">
                         <a href="search_products?store={{$_GET['store']}}" target="blank" class="btnn search-btnn"><i class="fas fa-search"></i>
                             Search</a>
                     </div>

                     <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;">
                         <button id="All" class="@if ((isset($_GET['filter']) && $_GET['filter'] == 'All') || !isset($_GET['filter'])) selected @endif "
                             style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:20; ">All</button>
                         <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Album') selected @endif " id="Albums"
                             style="flex:21;">Albums</button>
                         <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Posters') selected @endif " id="Posters"
                             style="flex:21;">Posters</button>
                         <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Cosmetics') selected @endif " id="Cosmetics"
                             style="flex:19;">Cosmetics</button>
                         <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Noodles') selected @endif " id="Noodles"
                             style="flex:12;border-radius: 0px 10px 10px 0px;border-right: 1px solid;">Noodles</button>

                     </div>
                    {{-- change --}}
                    @if ( Route::current()->getName() == 'products')
                        <div  style="flex: 16;margin-left: 35px;"  >
                            <button  type="submit" onclick="export_choose()"
                                style="position: relative; letter-spacing: 2px;font-size: 18px; background-color: #1b3425; color: #d2ac6a; display: inline-grid;border-color: transparent;
                                font-family: 'Bebas Neue', cursive;width: -webkit-fill-available;margin-top: 0.8rem;margin-right: 15px;"
                                class="btn btn-success btn-s">
                                Export
                            </button>
                        </div>
                    @endif
                     
                 </div>

                 <table class="table">
                     <thead class="table__thead">
                         <tr style="background-color: #ffffff;">
                             <th class="table__th">Cover</th>
                             <th class="table__th">Title</th>
                             <th class="table__th">Variants</th>
                             <th class="table__th">Product type</th>
                             <th class="table__th">Quantity</th>
                             <th class="table__th">Actions</th>
                         </tr>
                     </thead>

                     <tbody id="table" class="table__tbody">
                         @foreach ($products as $product)
                             <tr class="table-row table-row--chris">

                                 <td data-column="upload_date" class="table-row__td" style="width: 90px;">
                                     <div class="card-img"
                                         style="position: relative;background-position: center;height: 60px;background-size: contain;background-repeat: no-repeat;width: 100%;background-image:url({{ $product->product_cover_image }});">
                                 </td>

                                 <td data-column="upload_date" class="table-row__td" style="width: 250px;">
                                     <div class="table-row__info">
                                         <p class="table-row__name">
                                             {{ $product->product_title }}
                                         </p>
                                     </div>
                                 </td>
                                 <td data-column="upload_date" class="table-row__td" style="width: 130px;">
                                    <div class="table-row__info">
                                        <p class="table-row__name">
                                            {{ $product->number_of_variants }}
                                        </p>
                                    </div>
                                </td>
                                 <td data-column="upload_date" class="table-row__td" style="width: 130px;">
                                     <div class="table-row__info">
                                         <p class="table-row__name">
                                             {{ $product->product_type }}
                                         </p>
                                     </div>
                                 </td>
                                 
                                 <td data-column="upload_date" class="table-row__td" style="width: 130px;">
                                     <div class="table-row__info">
                                         <p class="table-row__name">
                                             {{ $product->quantity }} In stock
                                         </p>
                                     </div>
                                 </td>

                                 <td data-column="upload_date" class="table-row__td" style="width: 130px;">
                                     <div class="table-row__info" style="display: inline-block;">
                                         <button
                                             onclick="getVariants({{ $product->id }})" type="button"
                                             class="btn btn-primary">
                                             @if ($_GET['store']=='plus_egypt')
                                             <i style="color: black;" class="fas fa-barcode"></i></button>
                                             @else
                                             <i style="color: black;" class="fas fa-info-circle"></i></button>

                                             @endif
                                     </div>
                                 </td>

                                 {{-- <td class="td">{{ $order->kshopina_awb }}</td> --}}

                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             @endif
         </div>


        {{-- <div id="in_out_export_popup" class="overlay">
            <div class="tasks_popup" style="margin: 150px auto;height: 40%;">
                <div class="container">
                    <div class="title">
                        <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                    </div>
                </div>
                <a id='close' class="closee" href="#">&times;</a>
                    <div class="container content"  style="margin-top: 2rem;display: flex;justify-content: center;height: 2.5rem;flex-direction: row;align-items: center;">
                        <label for="from" style="margin-bottom: 0px;margin-right: 1rem;">From :</label>
                        <input min="2022-02-24"  type="date" name="from" id="from_export" required style=" border: 1px solid black;border-radius: 18px;    padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                        <label for="to"style="margin-bottom: 0px;margin-right: 1rem;margin-left: 5rem;">To :</label>
                        <input max="{{date("Y-m-d",time())}}" type="date" name="to" id="to_export" required style="border: 1px solid black;border-radius: 18px; padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                    </div>
                    <div style="margin-top: 25px;display: flex;justify-content: center;">
                        <button onclick="export_stock(this)" type="submit" class="btn btn-primary"
                            style="border-radius: 15px;position: relative;top: 0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600; padding: 8px 40px 5px 40px;">
                            Submit
                        </button>
                    </div>
            </div>
        </div> --}}

        <div id="choose_export_type" class="overlay">
            <div class="tasks_popup" style="margin: 150px auto;height: 55%;">
                <div class="container">
                    <div class="title">
                        <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                    </div>
                </div>
                <a id='close' class="closee" href="#">&times;</a>
                    <div class="container content"  style="margin-top: 1rem;display: flex;justify-content: flex-start;
                    height: 2.5rem;flex-direction: row;">
                        <div  style="width:100%;">
                            <h3 class="row__title" style="margin-left: 0px;" >
                                choose export template 
                            </h3>
                            <div style="display: flex;flex-direction: column;justify-content: space-between;" class="position-relative" >
                            
                                <i style="color:#1b3425;font-size:17px;display:flex;position:absolute;top:13px;left:12px;"class="far fa-file-alt"></i>
                                
                                <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px;outline: none;"
                                    name="export_template_type" id="export_template_type">
                                    <option value="Select" disabled hidden selected>Select the template</option>
                                    <option value="sales_report" id="sales_report"> Sales report </option>
                                    <option value="products_temp" id="products_temp"> Products </option>
                                </select>

                                <div class="container content" id="time_picker" style="margin-top: 2rem;justify-content: space-evenly;
                                    height: 2.5rem;flex-direction: row;margin-bottom: 2rem;align-items: center;display:none;">
                                    <label for="from" style="margin-bottom: 0px;margin-right: 1rem;">From :</label>
                                    <input min="2022-02-24"  max="{{date("Y-m-d",time())}}"    type="date" name="from" id="from_export" required style=" border: 1px solid black;border-radius: 18px;padding: 1.5% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;outline: none;">
                                    <label for="to"style="margin-bottom: 0px;margin-right: 1rem;margin-left: 5rem;">To :</label>
                                    <input max="{{date("Y-m-d",time())}}" type="date" name="to" id="to_export" required style="border: 1px solid black;border-radius: 18px;padding: 1.5% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;outline: none;">
                                </div>

                                <div style="display: flex;justify-content: center;margin: 18px;">
                                    <button type="submit" class="btn btn-primary" style="font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;
                                        font-weight: 600;padding: 8px 40px 5px 40px;" onclick="export_stock(this ,'{{ Route::current()->getName() }}' )">
                                        submit
                                    </button>
                                </div>
                            
                            </div>
                        </div>
                        {{-- onclick="export_stock(this)" --}}
                        
                    </div>
                    
            </div>
        </div>

         <div id="variants" class="overlay">
             <div class="variants_popup">
                 <div class="container">
                     <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                             alt=""></div>
                 </div>
                 <a id='close' class="closee" href="#">&times;</a>
                 <div class="container content">
                     <h1 id="product_name" style="font-size: 18px;margin-top: 40px;color: #cb9d4d;">Product name</h1>
                     <div class="user-details">
                         <div id="variants_list" style="width: 100%;" class="column">
                             <div class="variant row">
                                 <span class="details">Variants</span>

                                 <button style="margin-right: 5px;" id="" {{-- onclick="details(this)" --}} class="btn btn-primary">
                                    @if ($_GET['store']=='plus_egypt')
                                    <i class="far fa-save"></i>
                                             @endif
                                 </button>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>

         @if (Route::current()->getName() == 'products_in' || Route::current()->getName() == 'products_out')
         @else

            <div class="pagination">

                {{-- data --}}
                    <?php
        
                        $orders_per_page = 15;
                        $pages = ceil($number_of_products[0]->NumberOfProducts / $orders_per_page);
                        $current_page=$_GET['page']; 
                        $count=0; 
                        $count2=0;
        
                        if ($pages >10) {
                            $current_page2 = $current_page /10;
        
                            if ($current_page % 10 ==0) {
                                $count=$current_page -9;
                            }
                            else if ((int)$current_page2 !=0 ) {
                                $count=((int)$current_page2 *10) +1;
                            }else{
                                $count= 1;
                            }

                            $count2=$count+9;
                            if ($count2 > $pages) {
                                $count2=$count2-9;
                                $count2=$pages;
                            }
                        }else{
                            $count= 1;
                            $count2=$pages;
        
                        }
                        
                    ?>

                @if ( $pages > 0 )
                        
                    {{-- shmall --}} 
                    
                        @if ( $_GET['page'] > 10)  
            
                                    
                                @if (isset($_GET['filter']))
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter={{ $_GET['filter'] }}">&laquo;</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter=All">&laquo;</a>    
                                @endif
                                
                        
                        @elseif ( $_GET['page'] >= 1 && $_GET['page'] < 10 )

                                @if (isset($_GET['filter']))
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter={{ $_GET['filter'] }}">&laquo;</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter=All">&laquo;</a>    
                                @endif
                                
                        @else
            
                            <a href="#">&laquo;</a>
            
                        @endif
                
                    
                    {{-- numbers --}} 
                        @for ($i = $count; $i <=  $count2  ; $i++)
                            @if ($_GET['page'] == $i) 
                
                                @if (isset($_GET['filter']))
                                    <a class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter={{ $_GET['filter'] }}" > {{$i}}</a>
                                @else
                                    <a class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter=All" >{{$i}}</a>    
                                @endif
    
                            @else
                                    
                                @if (isset($_GET['filter']))
                                    <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter={{ $_GET['filter'] }}" > {{$i}}</a>
                                @else
                                    <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter=All" >{{$i}}</a>    
                                @endif
                                
                            @endif
                        @endfor
                    
                    {{-- ymen --}} 
        
                        @if ($_GET['page'] != $pages && $pages >0 )

                                @if (isset($_GET['filter']))
                                    @if ($pages <=10 )   
                                        <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter={{ $_GET['filter'] }}">&raquo;</a>
                                    @else   
                                        <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter={{ $_GET['filter'] }}">&raquo;</a>
                                    @endif
                                @else
                                    @if ($pages <=10 )
                                        <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter=All">&raquo;</a> 
                                    @else
                                        <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter=All">&raquo;</a> 
                                    @endif
                                @endif
                                
                        @else
            
                            <a href="#">&raquo;</a>
            
                        @endif    
                    
                    {{-- text pages  --}}
                        <p style="float: left;margin-left: 15px;margin-top: 14px;color: #ca9c47d1;font-size: 10px;">
                            Page {{ $_GET['page'] }} of {{ceil($number_of_products[0]->NumberOfProducts /15) }}
                        </p>
                @else
                    <a href="#">&laquo;</a>
                    <a href="#">&raquo;</a>
                @endif

            </div> 

         @endif

     </div>


     <script>
         if (document.getElementById("barcode") != null) {
             document.getElementById("barcode").focus();
         }
         var barcodes = new Object();
         var variants_id = new Object();
         var quantity = new Object();
         var discount = new Object();

         var current_quantity = new Object();
         var ajaxx;
         var source_name = '';
         var selected;


         $('.closee').click(function(e) {
             $(this.parentElement.parentElement).hide();
             e.preventDefault();
         });

         var store;
         store = window.location.href;
         store = new URL(store);
         store = store.searchParams.get("store");


         $("#filters button").click(function() {
             if (this.id == "All") {
                 window.location.href = "?page=1&filter=All&store="+store;

             } else if (this.id == "Albums") {
                 window.location.href = "?page=1&filter=Album&store="+store;

             } else if (this.id == "Posters") {
                 window.location.href = "?page=1&filter=Posters&store="+store;

             } else if (this.id == "Cosmetics") {
                 window.location.href = "?page=1&filter=Cosmetics&store="+store;

             } else {
                 window.location.href = "?page=1&filter=Noodles&store="+store;
             }
             selected = this.id;
         });

         function details(elemant) {
             var id = (elemant.id);

             $('#pop' + id).show();

         }

         function getVariants(product_id) {
             var html = "";
             $.ajax({
                 url: "get_variants",
                 type: "post",
                 data: {
                     _token: "{{ csrf_token() }}",
                     id: product_id,
                 },
                 success: function(response) {


                     $('#product_name').html(response[0][0].product_title);

                     response[1].forEach(element => {
                         html += '<div class="variant row">';
                         html += '        <span style="display: flex;width: 40%;" class="details">' + element.variant_title + '</span>';
                         html += '        <div style="width: 30%;display: flex;justify-content: center;" class="details">' + element.variant_quantity + '</div>';

                         if (response[0][0].store=='plus_egypt') {

                         html += '        <form style="width: 30%;display: flex;justify-content: flex-end;" action="download_variant_barcode" method="post"> @csrf'

                         html += '            <input value="' + element.id +
                             '" type="text" name="id" readonly hidden>'

                                html +=
                             '            <button type="submit" style="margin-right: 5px;" class="btn btn-primary">';
                                html += '            <i class="far fa-save"></i>'; 

                         html += '            </button> </form> ';
                                }
                         
                         html += '</div>';


                     });
                     $('#variants_list').html(html);

                     $('#variants').show();

                 },
                 error: function(xhr) {
                     //Do Something to handle error
                 }

             });

         }


         function source(elemant) {
             document.getElementById('company').disabled = true;

             if (store=='plus_egypt') {
                document.getElementById("barcode").focus();

             } else {
                document.getElementById("sku").focus();
 
             }
             source_name = elemant.value;

             if( source_name == 'Offline'){
                 $('#discount').show();
                 
             }/* else if(source_name == 'Kshopina Original'){
                $('#order_tag').show();

             } */
         }

         function choose_discount(elemant){
            document.getElementById("barcode").focus();
         }




         $("#barcode_form").submit(function(e) {
             e.preventDefault();
             var html = "";
            var bar="";
            if (store=='plus_egypt') {
                bar=$('#barcode').val();
            } else {
                bar=$('#sku').val();
            }


             if (source_name == '') {

                 Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Choose the source OR the market first!',
                     showConfirmButton: false,
                     timer: 1500
                 });
             } else {

                 if (barcodes[bar] == null) {
                     try {
                         ajaxx.abort();
                     } catch (error) {}

                     setTimeout(function() {

                       

                         ajaxx = $.ajax({
                             url: "scan_variant_barcode",
                             type: 'POST',
                             data: {
                                 _token: "{{ csrf_token() }}",
                                 sku_or_bar: bar,
                                 store:store
                             },
                             complete: function() {

                             },
                             success: function(response) {
                                $('#barcode').val('');

                                 if (response != null && response != []) {

                                    if (window.location.pathname == '/products_out' && response[
                                             0]['variant_quantity'] < 1) {
                                         Swal.fire({
                                             position: 'center',
                                             icon: 'error',
                                             title: 'Out of stock!',
                                             showConfirmButton: false,
                                             timer: 1500
                                         });
                                     }else if(window.location.pathname == '/products_in' && store != 'plus_egypt' && response.length >1 ){
                                        Swal.fire({
                                             position: 'center',
                                             icon: 'error',
                                             title: 'There is more than one product with same SKU!',
                                             showConfirmButton: false,
                                             timer: 2500
                                         });
                                     }
                                     else {

                                         barcodes[bar] = source_name;
                                         variants_id[bar]=response[0]['id'];

                                         quantity[bar] = 1;
                                         discount[bar] = $('#discount').val();
                                         final_price=Math.ceil(response[0]['variant_price']*(1-($('#discount').val()/100)));
                                         current_quantity[bar] = response[
                                             0]['variant_quantity'];

                                         html += '<tr class="table-row table-row--chris">';

                                         //product_name

                                         html +=
                                             '<td data-column="product_name" class="table-row__td"><div class="table-row__info"><p class="table-row__name">' +
                                             response[0]['product_title'] + '</p></div></td>';

                                         //variant_name

                                         html +=
                                             '<td data-column="variant_name" class="table-row__td"><div class="table-row__info"><p class="table-row__name">' +
                                             response[0]['variant_title'] + '</p></div></td>';

                                         // quantity
                                         html +=
                                             '<td data-column="quantity" class="table-row__td"><div class="table-row__info"><p id="quantity_' +
                                                bar +
                                             '" class="table-row__name">' +
                                             response[0]['variant_quantity'] + '</p></div></td>';


                                        if(window.location.pathname == '/products_out' && response[0]['variant_quantity'] >= 1)
                                        {
                                            //price
                                            html +=
                                                '<td data-column="quantity" class="table-row__td"><div class="table-row__info"><p id="quantity_' +
                                                bar +
                                                '" class="table-row__name">' +
                                                response[0]['variant_price'] + '</p></div></td>';

                                            //final price 
                                            html +=
                                                '<td data-column="quantity" class="table-row__td"><div class="table-row__info"><p id="quantity_' +
                                                    bar +
                                                '" class="table-row__name">' +
                                                final_price + '</p></div></td>';    
                                        }
                                        
                                         // source
                                         html +=
                                             '<td data-column="source" class="table-row__td"><div class="table-row__info"><p class="table-row__name">' +
                                             source_name + '</p></div></td>';

                                         // adjust_by
                                         html +=
                                             '<td data-column="quantity" class="table-row__td"><div class="table-row__info"><p id="adjust_' +
                                                bar +
                                             '" class="table-row__name">1</p></div></td>';

                                         //delete

                                         html +=
                                             '<td data-column="delete" class="table-row__td"><div class="table-row__info"><button type="button" onclick="delete_variant(this)" id="delete_' +
                                                bar +
                                             '"class="delete btn btn-primary"><i class="fas fa-trash-alt" style="font-weight: 500;"></i></button></div></td></tr>';


                                         document.getElementById('table').innerHTML += html;


                                         console.log(quantity);
                                         console.log(discount);

                                     }
                                 } else {
                                     $('#barcode').val('');
                                     Swal.fire({
                                         position: 'center',
                                         icon: 'error',
                                         title: 'Barcode not found!',
                                         showConfirmButton: false,
                                         timer: 1500
                                     });
                                 }

                             }
                         });


                     }, 500);

                 } else if (barcodes[bar] == 'deleted') {
                     $('#barcode').val('');
                     Swal.fire({
                         position: 'center',
                         icon: 'warning',
                         title: 'Variant already deleted before!',
                         showConfirmButton: false,
                         timer: 1500
                     });
                 } else {

                     if (window.location.pathname == '/products_out' && (quantity[bar] + 1) >
                         current_quantity[bar]) {
                         Swal.fire({
                             position: 'center',
                             icon: 'error',
                             title: 'Out of stock!',
                             showConfirmButton: false,
                             timer: 1500
                         });
                     } else {

                         quantity[bar] = quantity[bar] + 1;

                         $("#adjust_" + bar).html(quantity[bar]);

                     }
                     /*  Swal.fire({
                          position: 'center',
                          icon: 'warning',
                          title: 'Variant already added!',
                          showConfirmButton: false,
                          timer: 1500
                      }); */
                 }
             }

             if (store=='plus_egypt') {
                document.getElementById("barcode").focus();
                $('#barcode').val('');

             } else {
                document.getElementById("sku").focus();
                $('#sku').val('');

             }
         });


         function ajaxfunc(element, route_name) {

             if (Object.keys(barcodes).length == 0) {
                 Swal.fire({
                     position: 'center',
                     icon: 'warning',
                     title: 'Nothing to submit!',
                     showConfirmButton: false,
                     timer: 1500
                 });
             } else {

                 $(element.parentElement).html(
                     '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                 );
                 $.ajax({
                     url: "submit_variants_barcodes",
                     type: 'POST',
                     data: {
                         _token: "{{ csrf_token() }}",
                         variants: barcodes,
                         variants_id:variants_id,
                         quantity: quantity,
                         discount: discount,
                         route_name: route_name,
                         store:store

                     },
                     success: function() {
                         Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: 'Your work has been saved',
                             showConfirmButton: false,
                             timer: 1500
                         });
                         /* window.location.reload(); */
                     }

                 });
             }
         }


         function delete_variant(element) {

             variant_id = element.id.substring(element.id.indexOf("_") + 1);

             $(element.parentElement).html(
                 '<div id="loader' + variant_id +
                 '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
             );

             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#17a2b8',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
                 if (result.isConfirmed) {

                     var ele = document.getElementById("loader" + variant_id).parentElement
                         .parentElement.parentElement;
                     $(ele).hide();

                     barcodes[variant_id] = 'deleted';
                     variants_id[variant_id]='deleted';

                 } else {
                     var ele = document.getElementById("loader" + variant_id).parentElement;
                     $(ele).html(
                         '<button type="button" onclick="delete_variant(this)"id="delete_' + variant_id +
                         '" class="delete btn btn-primary"><i class="fas fa-trash-alt" style="font-weight: 500;"></i></button>'
                     )

                 }

                 if (store=='plus_egypt') {

                    document.getElementById("barcode").focus();
                    $('#barcode').val('');

                } else {

                    document.getElementById("sku").focus();
                    $('#sku').val('');

                }
             });


         }
     </script>

 {{-- change --}}  
    <script>
       
        function export_choose(){

           $('#choose_export_type' ).show();

        }

        $('#export_template_type').change(function(){ 
            
            /* sales_report */
            if($(this).val() == 'products_temp'){
           
                $('#time_picker').hide();
                $('#time_picker').hide();

            }else{
                $('#time_picker').css("display", "flex");
                $('#time_picker').show();
                $('#time_picker').show();

            }

        });

        var url_stock;
        url_stock = window.location.href;
        url_stock_test = new URL(url_stock);
        var store_name = url_stock_test.searchParams.get("store"); 
        var filter_name = url_stock_test.searchParams.get("filter"); 

        console.log(  [url_stock , url_stock.split("/")[3]]       );

        function export_stock(element ,route_name ){
            var export_type = $('#export_template_type').val();
            $(element.parentElement).html(
                 '<div id="loader" style="align-items: center;justify-content: center;display: flex;background-color: #ca9b49a8;padding: 8px 40px 5px 40px;border-radius: 20px;"><div class="loader"></div></div>'
             );

            if (export_type == 'products_temp') {
                
                $.ajax({
                        url: "export_products_filters",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            route_name: route_name,
                            store_name: store_name,
                            filter_name:filter_name

                        },
                        success: function(response) {
                    
                            console.log(JSON.stringify(response));
                            window.open(response, '_blank');
                            location.reload(); 

                        }
                    });

            } else {

                    var from_date=$('#from_export').val();
                    var to_date=$('#to_export').val();

                    console.log([from_date , to_date]);
                    $.ajax({
                        url: "export_sales_report",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            from: from_date,
                            to: to_date,

                        },
                        success: function(response) {
                            console.log(JSON.stringify(response));
                            window.open(response, '_blank');
                            location.reload(); 
                        }
                    });
            }



        }

       /*  function export_stock(elemant) {

                    var from_date=$('#from_export').val();
                    var to_date=$('#to_export').val();


                    $.ajax({
                        url: "export_stock",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            from: from_date,
                            to: to_date,

                        },
                        success: function(response) {
                            console.log(JSON.stringify(response));
                            window.open(response, '_blank');
                            location.reload();
                        }
                    });
        } */
    </script>

 @endsection
