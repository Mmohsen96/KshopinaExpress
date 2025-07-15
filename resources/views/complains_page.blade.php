
@extends('layouts.staff_layout')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="public/lib/css/emoji.css" rel="stylesheet">

@section('content')

    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #cda051;
            width: 30px;
            height: 30px;
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


        body {
            background-color: #ffffff;
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
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
            white-space: nowrap;
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
            width: 40%;
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
            color: white !important;
            background-color: #1b3425 !important;
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

        .font-style {
            font-family: 'Bebas Neue', cursive !important;
            font-size: 18px;
            letter-spacing: 3px;
        }

        .search-item:hover {
            color: transparent !important;
            text-decoration: none !important;
        }

        .sub_btn {
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
        }

        .search-result:hover {
            opacity: .5;
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

       /*  .user-details .input-box input:focus,
        .user-details .input-box input:valid,
        .user-details .input-box textarea:focus {
            border-color: #CA9B49;
        } */

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
            background: linear-gradient(135deg, #2d4837, #e7d472);



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
            background: linear-gradient(135deg, #2d4837, #e7d472);
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #2d4837, #e7d472);
        }

        form .button textarea:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(135deg, #1B3425, #CA9B49);
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
            font-size: 14px;
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
            background-color: #e3ce88 !important;
            border-color: #e3ce88 !important;
            color: #426851 !important;
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
        #myInput::placeholder {
            color: #296E45;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

    </style>

    <style>
        .complains_dropdown:focus-visible{
            outline: none;
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
            width: 40%;
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

        .discount_titles{
            font-weight: 500;
            padding: 0px 0px 10px 3px;
            flex-wrap: nowrap;
            align-items: center;
            margin: 0px;
            font-size: 14px;
        }
        .discount_code_title{
            flex: .64;
            margin-left: 1.7vw;
        }
        .discount_percent_title{
            flex: .3;
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
            width: 8px;
            height: 8px;
            border-radius: 50%;
            top: 10px;
            left: 33px;       
        }

        .badge-without-number.with-wave {
            animation-name: wave;
            animation-duration: 1s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes wave {
            0% {box-shadow: 0 0 0px 0px rgba(245, 66, 78, 0.5);}
            100% {box-shadow: 0 0 0px 10px rgba(245, 66, 78, 0);}
        }

        @keyframes changingShape {
            0% {transform:rotate(0);border-radius: 0;}
            50% {transform:rotate(360deg);border-radius: 50%;}
            100% {transform:rotate(720deg);border-radius: 0;}
        }
    </style>

    <style>

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }
        .expanding-search-form {
            position: relative;
            top: 1rem;
            margin-left: 1rem;
        }

        .expanding-search-form .search-label {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            border: 1px solid #1b3425;
            z-index: 2;
            cursor: pointer;
            border-radius: 10px;
            transition: 250ms all ease-in-out;
            margin-bottom: 1rem;
            width: 16.8rem;
            height: 2.8rem;
        }
        .expanding-search-form .search-label:focus ~ label {
            top: 19px;
        }
        .expanding-search-form .search-input {
            position: relative;
            top: 0;
            left: 5px;
            display: inline-block;
            height: 45px;
            width: 190px;
            float: left;
            border: 0;
            font-size: 16px;
            z-index: 2;
            box-shadow: none;
            border-radius: 0;
            transition: 250ms all ease-in-out;
        }
        .expanding-search-form .search-input:focus {
            outline: none;
        }
        .expanding-search-form .search-input:focus + .search-label {
            border-color: #1b3425;
        }
        .expanding-search-form .button {
            position: relative;
            top: 0;
            display: inline-block;
            float: left;
            color: #fff;
            border: 1px solid transparent;
            background-color: #1b3425;
            text-align: center;
            transition: 250ms all ease-in-out;
        }
        .expanding-search-form .button:hover {
            background-color: #CB9D48;
        }

        .expanding-search-form .dropdown-toggle:focus-visible ,
        .expanding-search-form .dropdown-toggle:focus{
            outline: none;
        }

        .expanding-search-form .search-dropdown {
            position: relative;
            top: 0;
            display: inline-block;
            float: left;
        }
        .expanding-search-form .search-dropdown.open .dropdown-menu {
            display: block;
        }
        .expanding-search-form .dropdown-toggle {
            height: 2.8rem;
            font-size: 12px;
            line-height: 34px;
            border-radius: 10px 0px 0px 10px;
            z-index: 3;
        }
        .expanding-search-form .dropdown-menu {
            position: absolute;
            top: calc(100% - 1px);
            display: none;
            margin: 0;
            padding: 5px;
            list-style: none;
            background-color: #fff;
            border: 1px solid #999;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
            z-index: 3;
            transition: 250ms all ease-in-out;
        }
        .expanding-search-form .dropdown-menu > li > a {
            display: block;
            padding: 4px 12px;
            color: #CB9D48;
            font-size: 14px;
            line-height: 20px;
            text-decoration: none;
            border-radius: 3px;
            transition: 250ms all ease-in-out;
        }
        .expanding-search-form .dropdown-menu > li > a:hover {
            color: #fff;
            background-color: #CB9D48;
        }
        .expanding-search-form .dropdown-menu > .menu-active {
            display: none;
        }
        .expanding-search-form .search-button:focus-visible,
        .expanding-search-form .search-button:focus{
            outline: none;
        }
        .expanding-search-form .search-button {
            height: 2.8rem;
            z-index: 3;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .expanding-search-form .search-button .icon {
            font-size: 20px;
        }

    </style>

    <style>
        textarea:focus-visible{
            outline: none;
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
            min-height: 8rem;
        }
        #result{
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px 0;
        }
    </style>

    <style>
        .ticket_buttons{
            height: 45px;
            margin: 35px 0 0;
            display: flex;
            justify-content: center;
        }
    </style>

    <style>
        .emoji-wysiwyg-editor{
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .emoji-wysiwyg-editor:focus-visible{
            outline: none;
        }
    </style>

    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> --}}

    @if ($message = Session::get('MESSAGE'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your ticket is opened now',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @elseif($message = Session::get('ERROR'))

        @if ($message == 'customer_email')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Customer email is required to open your ticket!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @elseif ($message == 'complaint_msg')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Complaint content is required to open your ticket!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @elseif($message == 'email_not_found')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'This email is not in our system!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @elseif($message == 'not_match')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'This order number is not related to this email!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif
    @endif

    <div class="container">

        <div class="row row--top-40">
            <div class="column">
                <h2 class="row__title">Complaints</h2>
            </div>

            <div>
                <button type="submit" id="export" name="action" 
                    style="border-radius: 15px;position: relative;right: 1.8rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;"
                    class="btn btn-primary"  onclick="open_ticket()">
                    Open Ticket
                </button>
            </div>
        </div>

        <div>
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif


            <div style="display: flex; background: #1b3425; height: 70px; padding: 2.5% 1% 0% 1%; border-radius: 5px 5px 5px 5px;">
                    <a href="complains_orders?page=1&filter=All" id="pending"
                        style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                color: #1b3425; font-family: 'Bebas Neue', cursive; letter-spacing: 2px;   
                                @if (Route::current()->getName() == 'complaint_pending') background: #ffffff;color: #1b3425;
                                    @else background-color: #1b3425;color: #d2ac6a; 
                                    @endif ">
                        Pending</a>
                    <a href="complains_special_orders?page=1&filter=All" id="special"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 120px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                color: #1b3425; font-family: 'Bebas Neue', cursive; letter-spacing: 2px;   
                                @if (Route::current()->getName() == 'complaint_special') background: #ffffff;color: #1b3425;
                                @else background-color: #1b3425;color: #d2ac6a;  
                                @endif ">
                        Special cases</a>
                    <a href="complains_by_CS?page=1&filter=All" id="complaint_cs"
                        style=" margin-right: 15px;cursor: pointer;text-align: center;
                                justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                opacity: .99;background-color: #1b3425;color: #d2ac6a; font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                                @if (Route::current()->getName() == 'complaint_CS') background: #ffffff; color: #1b3425;
                                @else background-color: #1b3425;color: #d2ac6a; 
                                @endif ">
                        Cs Tickets</a>

                <div style="align-items: center; width: 80%;justify-content: flex-end;padding-left: 15px;display: flex;">
                        <a href="complains_orders_archived?page=1&filter=All" id="archived"
                                style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 11px;width: 95px;padding-bottom: 0.5rem;display: flex;border-radius: 15px 15px 0px 0px;
                                    font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                                    @if (Route::current()->getName() == 'complaint_archived') background: #ffffff; color: #1b3425;
                                    @else background-color: #1b3425;color: #d2ac6a; 
                                    @endif ">
                        Archived</a>
                </div>

            </div>

            <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff;justify-content: space-between;">
                {{-- search nour --}}
                <div  class="expanding-search-form" style="margin-left: 2rem;margin-right: 1rem;" >
                    <div class="search-dropdown">
                      <button style="width: 75px;" class="button dropdown-toggle" type="button">
                        <span style="font-size: smaller;display: flex;justify-content: center;align-items: center;height: 100%;" class="toggle-active">Order No.
                             <i class="fas fa-angle-down" style="padding: 0px 0px 0px 6px;font-size: 12px;"></i></span>
                        <span class="ion-arrow-down-b"></span>
                      </button>

                      <ul class="dropdown-menu">
                        <li class="menu-active" onclick="filter_search(this)" value="1" selected><a href="#"  id="search_order_number" >Order No.</a></li>
                        <li onclick="filter_search(this)" value="2"><a href="#"   id="search_traching_number" >Complaint</a></li>
                      </ul>
                    </div>
                    <input class="search-input" id="global-search" type="search" placeholder="Search" onkeyup="search_complaints(this)" autocomplete="off"
                    style="border: 1px solid black;margin-left: -5px;padding: 0.5rem;border-radius: 0px 8px 8px 0px;">
                    
                    <div id="results" class="result col"
                    style="border-radius: 6px;padding-top: 10px;top: 46px;display: none;  flex-basis: 0;  flex-grow: 1; max-width: 100%; max-height: 250px; overflow-x: hidden;
                      overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                    </div>
                </div>

                <div style="display: flex;height: 3.4rem;">
                    <div style="margin-right: 15px;margin-left: 5px; align-items: flex-end;display: flex;">
                        <button type="button" onclick="customize_discounts()" id="customize" name="customize"
                            style="height: 70%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 15px;letter-spacing: 2px;font-weight: 600;padding: 0px 20px 0px 20px;"
                            class="btn btn-primary">
                            <i style="font-size: 12px;" class="fas fa-percent"></i> Discounts
                        </button>
                    </div>
    
                    <div style="margin-right: 15px;margin-left: 5px; align-items: flex-end;display: flex;">
                        <button type="button" onclick="customize_service_payments()" id="customize" name="customize"
                            style="height: 70%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 15px;letter-spacing: 2px;font-weight: 600;padding: 0px 20px 0px 20px;"
                            class="btn btn-primary">
                            <i style="font-size: 14px;margin-right: 2px;" class="fas fa-dolly"></i> Services/Payments
                        </button>
                    </div>

                    <div style="margin-right: 15px;margin-left: 5px; align-items: flex-end;display: flex;">
                        <button type="button" onclick="customize_faqs()" id="customize" name="customize"
                            style="height: 70%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 15px;letter-spacing: 2px;font-weight: 600;padding: 0px 20px 0px 20px;"
                            class="btn btn-primary">
                            <i style="font-size: 14px;margin-right: 2px;" class="fas fa-question"></i> Faqs
                        </button>
                    </div>
                </div>
                
                @if ( (Route::current()->getName() != 'complaint_special') && (Route::current()->getName() != 'complaint_CS'))

                    <div style="flex: 8;margin-right: 35px;margin-top: 10px;" class="position-relative complains_dropdown">
                        <i style="color: #1b3425;font-size: 17px;display: flex;position: absolute;top: 13px;left: 12px;"
                            class="fas fa-map-marker-alt"></i>
                        <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px"
                            name="complain_categories" id="complain_categories"
                            onchange="javascript:handleSelect(this)">

                            <option value="Select" disabled hidden selected>Select the category</option>
                            <option value="All" @if (isset($_GET['filter']) && $_GET['filter'] == 'All') selected @endif >ALL</option>

                            <option value="cancel_order" @if (isset($_GET['filter']) && $_GET['filter'] == 'cancel_order') selected @endif id="cancel_order">
                                Cancel order </option>

                            <option value="reschedule" @if (isset($_GET['filter']) && $_GET['filter'] == 'reschedule') selected @endif
                                id="reschedule">Rescheduling</option>

                            <option value="no_response" @if (isset($_GET['filter']) && $_GET['filter'] == 'no_response') selected @endif id="no_response">
                                No response</option>

                            <option value="customer_others" @if (isset($_GET['filter']) && $_GET['filter'] == 'customer_others') selected @endif id="customer_others">
                                Customer others</option>

                            <optgroup label="-----------------------------">
                            </optgroup>
                                
                            <option value="ask_about_product" @if (isset($_GET['filter']) && $_GET['filter'] == 'ask_about_product') selected @endif id="ask_about_product">
                                Inquiry about products</option>

                            <option value="Others" @if (isset($_GET['filter']) && $_GET['filter'] == 'Others') selected @endif id="Others">
                                Others</option>

                        </select>
                    </div>
                    
                @endif
                
            </div>


            <div class="container">
                <div class="row ">
                    <div class="col-md-12">

                    </div>
                </div>
                <div class="row " style="background-color: white;">
                    <div class="col-md-12">
                        <div class="table-container">
                            <table class="table">
                                <thead class="table__thead">
                                    <tr style="background-color: #ffffff;">
                                        <th class="table__th ">Complaint</th>
                                        <th class="table__th ">Order Number</th>
                                        <th class="table__th ">Name</th>
                                        <th class="table__th ">Country</th>
                                        @if (Route::current()->getName() == 'complaint_pending' || Route::current()->getName() == 'complaint_CS')
                                            <th class="table__th ">Time out</th>
                                        @endif
                                        <th class="table__th ">Actions</th>
                                        @if (Route::current()->getName() == 'complaint_archived'  )
                                            <th class="table__th ">Solved by</th>
                                            <th class="table__th ">Rate</th>

                                        @endif
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($complains as $complain)
                                        @if (Route::current()->getName() == 'complaint_pending'  || Route::current()->getName() == 'complaint_CS' )
                                            <?php
                                                
                                                date_default_timezone_set('Asia/Seoul');
                                                $now = date('Y-m-d H:i:s', time());
                                                $date_of_fvm = date('Y-m-d H:i:s', strtotime($complain->saved_at));
                                                
                                                $datetime1 = new DateTime($now);
                                                
                                                $datetime2 = new DateTime($date_of_fvm);
                                                
                                                $difference = $datetime1->diff($datetime2);
                                                
                                                $days = $difference->d;
                                                $hours = $difference->h;
                                            ?>
                                        @endif
                                        <tr    @if (Route::current()->getName() == 'complaint_pending' || Route::current()->getName() == 'complaint_CS' ) @if ($days >= 3 && $days < 7) style="background-color: #d3ff0033" @elseif($days >= 7) style="background-color: #ff000014" @endif
                                            @endif  class="table-row table-row--chris">
                                            <td class="table-row__td">
                                                <a target="blank"
                                                        href="complaint_ticket/{{ $complain->id }}?token={{ $complain->token }}">{{ $complain->id }}</a>

                                                </td>
                                            {{-- nouro --}}
                                            <td class="table-row__td" onclick="group_details({{ $complain->order_number }})">#{{ $complain->order_number }}</td>

                                            <?php
                                            $arr = explode('|', str_replace(' ', '', $complain->assign));
                                            ?>
                                        

                                            <td class="table-row__td">
                                                {{ $complain->name }}
                                            </td>


                                            <td class="table-row__td">{{ $complain->country }}</td>
                                            @if (Route::current()->getName() == 'complaint_pending' || Route::current()->getName() == 'complaint_CS')
                                                <td data-column="order_gateway" class="table-row__td">
                                                    <div class="table-row__info">
                                                        {{ $days }} Days {{ $hours }} Hours
                                                    </div>
                                                </td>
                                            @endif
                                            <td id="actions" class="table-row__td">
                                                @if ($complain->solved == 0)
                                                    <div style="display: inline-block;" class="row">

                                                        {{-- <button id="{{ $complain->id }}" onclick="solved(this)"
                                                            style=" border:none;
                                                            letter-spacing: .7px;font-size: 12px;background-color: #ca9b49;border-color: #6c757d; padding-inline: 13px;display: inline-grid;"
                                                            class="btn btn-info btn-primary">
                                                            Solved
                                                        </button> --}}
                                                        @if (  $complain->seen != 1 )
                                                             <div class="badge-without-number with-wave" id="wave_notification{{ $complain->id }}"></div>
                                                        @endif
                                                        {{-- nour --}}
                                                        <button id="{{ $complain->id }}"  onclick="details(this,'1')"
                                                            style=" border:none;padding: 9px;letter-spacing: .7px;font-size: 12px;border-color: #6c757d;padding-inline: 13px;display: inline-grid;"
                                                        class="btn btn-primary">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                        {{-- <div id="arrow_id{{ $complain->id }}"
                                                            style=" border:none;display: inline-block;cursor: pointer;justify-content: center;flex-direction: column;">
                                                            <i onclick="create_task(this)" id="assign_{{ $complain->id }}"
                                                                class="fas fa-chevron-right"></i>
                                                        </div> --}}
                                                    </div>
                                                @else
                                                    <div style="display: inline-block;" class="row">
                                                        <button id="{{ $complain->id }}" onclick="details(this,'')"
                                                            style=" border:none;margin-right: 8px;padding: 9px;letter-spacing: .7px;font-size: 12px;border-color: #6c757d;padding-inline: 13px;display: inline-grid;"
                                                        class="btn btn-primary">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                        {{-- <div id="arrow_id{{ $complain->id }}"
                                                            style="display: inline-block;cursor: pointer;justify-content: center;flex-direction: column;">
                                                            <i onclick="create_task(this)" id="assign_{{ $complain->id }}"
                                                                class="fas fa-chevron-right"></i>
                                                        </div> --}}
                                                    </div>
                                                @endif

                                            </td>

                                            @if (Route::current()->getName() == 'complaint_archived')
                                            <td class="table-row__td">
                                                {{$complain->solved_by}}
                                            </td>
                                            <td class="table-row__td">
                                                @if ($complain->rating == 0)
                                                    Not rated
                                                @else
                                                    {{$complain->rating}}/5 <i class="fa fa-star" aria-hidden="true"></i>
                                                @endif
                                                
                                            </td>
                                            
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        @foreach ($complains as $complain)
                            <div id="pop{{ $complain->id }}" class="overlay" style="z-index: 20;">
                                <div class="popup">
                                   
                               
                                        <h2 style="margin-bottom: 30px">#{{ $complain->order_number }}</h2>
                                       
                                        <a id='close' class="close" href="#">&times;</a>
                                        <div class="container content">
                                            <div style="display: flex;">
                                                <div style="width: 40%;">
                                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                                        class="row">
                                                        <i style="margin-right: 8px;" class="icon far fa-user" data-feather="user"></i>
                                                        <span>{{ $complain->name }}</span>
                                                       
                                                    </div>
                                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                                        class="row">
                                                        <i style="margin-right: 8px;" class="icon fas fa-map-marker-alt"
                                                            data-feather="user"></i>
                                                        <span>{{ $complain->country }}</span>
                                                     
                                                    </div>
                                                </div>
                                                <div  style="width: 60%;">
                                                    @if (isset($complain->whatsapp))
                                                        <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                                            class="row">
                                                            <i style="margin-right: 8px;" class="icon fab fa-whatsapp"
                                                                data-feather="user"></i>
                                                            <span>{{ $complain->whatsapp }}</span>
                                                        </div>
                                                    @endif
                                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                                        class="row">
                                                        <i style="margin-right: 8px;" class="icon far fa-envelope"
                                                            data-feather="user"></i>
                                                        <span>{{ $complain->email }}</span>
                                                     
                                                    </div>
                                                </div>
                                            </div>

                                            @if (Route::current()->getName() != 'complaint_CS' && Route::current()->getName() != 'complaint_archived' )
                                                <hr style="margin-bottom: 0rem;margin-top: 1rem;width: 50%;position: relative;">

                                                <div style="margin-top: 15px;display: grid;grid-template-columns: auto auto;justify-content: start;">

                                                    
                                                    @if ($complain->complain == 'customer_others' || $complain->complain == 'guest_others')
                                                        <div
                                                            style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                            <span>Others</span>
                                                        </div>
                                                    @elseif ($complain->special_case ==1)

                                                        @php
                                                            $complains = explode('|', $complain->complain);
                                                        @endphp

                                                        @foreach ($complains as $item)
                                                            <div
                                                            style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                            <span>{{$item}} item</span>
                                                            </div>
                                                        @endforeach
                                                        
                                                    @elseif ($complain->complain[0]=='0' || $complain->complain[0]=='1')

                                                        @if ($complain->complain[0] == '1')
                                                        <div
                                                            style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                            <span>Missing items</span>
                                                        </div>
                                                        @endif
                                                        @if ($complain->complain[1] == '1')
                                                            <div
                                                                style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                                <span>Wrong items</span>
                                                            </div>
                                                        @endif
                                                        @if ($complain->complain[2] == '1')
                                                            <div
                                                                style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                                <span>No response from courier company</span>
                                                            </div>
                                                        @endif
                                                        @if ($complain->complain[3] == '1')
                                                            <div
                                                                style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                                <span>Late Delivery</span>
                                                            </div>
                                                        @endif
                                                        @if ($complain->complain[4] == '1')
                                                            <div
                                                                style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                                <span>Others</span>
                                                            </div>
                                                        @endif
                                                        
                                                        @if (isset($complain->complain[5]) && $complain->complain[5] == '1')
                                                        <div
                                                            style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                            <span>Cancel Order</span>
                                                        </div>
                                                        @endif

                                                    @else 
                                                        <div
                                                            style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #1b3425;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">

                                                            <span>{{$complain->complain}}</span>
                                                        </div>
                                                    @endif
                                                    

                                                </div>
                                            @endif


                                            @if (Route::current()->getName() == 'complaint_special')
                                                <hr style="margin-bottom: 0rem;margin-top: 1rem;width: 50%;position: relative;">

                                                <h4 style="margin-left: -15px;font-size: 18px;color: #ca9b49;margin-top: 10px;">Attachments</h4>

                                                <div id="result" style="margin-top: 20px;justify-content: space-around;"> 
                                                    @php
                                                        $in=0;
                                                        $counter=0;
                                                    @endphp
                                                    @foreach ($complaints_files as $file)
                                                        @if ($file->id == $complain->id)

                                                            @if ($file->file_id != null && !empty($file->file_id))
                                                                @php    $in =1; $counter++;   @endphp 

                                                                @if ($file->file_type == 'image')
                                                                
                                                                    <div class="col result_files" style="margin-bottom: 15px;">
                                                                        <div style="width: 100%;display: flex;justify-content: center;">
                                                                            <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->complaint_id.'-'.$counter}}">
                                                                                <img style="max-height: 95px;width: auto;max-width: 100%;height: auto;" src="{{asset("uploads/complaints/$file->file_new_name")}}" >
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @elseif($file->file_type == 'video')
                                                                    <div class="col result_files" style="margin-bottom: 15px;">
                                                                        <div style="width: 100%;display: flex;justify-content: center;">
                                                                            <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->complaint_id.'-'.$counter}}">
                                                                                <img style="max-height: 64px;width: auto;max-width: 64px;height: auto;" src="https://www.pngall.com/wp-content/uploads/12/Video-PNG-Photo.png" >
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col result_files" style="margin-bottom: 15px;box-shadow: none;border: none;">
                                                                        <div style="width: 100%;display: flex;justify-content: center;">
                                                                            <a  href="public/uploads/complaints/{{$file->file_new_name}}" download="{{$file->complaint_id.'-'.$counter}}">
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
                                            

                                            <hr style="margin-bottom: 0rem;margin-top: 1rem;width: 50%;position: relative;">

                                            @if (isset($complain->message) && !empty($complain->message) )
                                           
                                                <div style=" @if ($complain->complaint_side == 1)  align-items: flex-start; @else align-items: flex-end; @endif flex-direction: column;font-weight: 600;margin-top: 20px;display: flex;margin-left: -22px;flex-wrap: nowrap;"
                                                class="row">
                                                    @if ($complain->complaint_side == 1)
                                                        <span style="@if ( preg_match('/[اأإء-ي]/ui', $complain->message) > 0) text-align: right; @else text-align: left; @endif margin-bottom: 10px;margin-left: 10px;width: 70%;word-wrap: break-word;background-color: #f7f6f3;
                                                            padding: 0.5rem;border-radius: 10px;font-weight: initial;">

                                                                @if ($complain->complain =='Rescheduling')
                                                                    Customer want to Reschedule the delivery date to : <span style="font-weight: 600;">{{ date('j M Y', strtotime($complain->message)) }}</span>
                                                                @else 
                                                                    {{ $complain->message }}
                                                                @endif
                                                        </span>
                                                    @else
                                                        <span style="@if ( preg_match('/[اأإء-ي]/ui', $complain->message) > 0) text-align: right; @else text-align: left; @endif  width: fit-content;word-wrap: break-word;background-color: #CB9D48;padding: 0.5rem;border-radius: 10px;font-weight: initial;white-space: pre-line;">
                                                            {{ $complain->message }}
                                                        </span>
                                                    @endif
                                                    
                                                   

                                                    <h5 style=" text-align: right;font-size: x-small;margin-top: 5px;color: #777777;margin-left: 10px;" > {{ $complain->saved_at}}</h5>
                                                    <input type="text" hidden readonly value="{{ $complain->message }}" name="message">
                                                </div>

                                            
                                            @endif

                                            <div id="replies{{ $complain->id }}">  
                                            </div>

                                            <div id="new_reply{{ $complain->id }}">  
                                            </div>
                                            <div style="margin-bottom: 20px;style=font-weight: 600;margin-top: 20px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">
                                                <span class="details" style=" font-family: 'Bebas Neue', cursive;font-weight: 700;letter-spacing: 2px;margin-right: 25px;margin-left: 10px;">reply</span>
                                                
                                                <div class="emoji-picker-container" style="width: 75%;">
                                                    <textarea data-emojiable="true" maxlength="4000" id="reply_{{$complain->id}}" style="border-radius: 8px;height: 100px;overflow: hidden;resize: none;" name="reply" cols="30" rows="1"></textarea>

                                                </div>
                                            
                                            </div>
                                            <div style="margin-left: 15px;" >

                                                <input id="solved_{{$complain->id}}" name="solved" type="checkbox"  value="1"  checked>

                                                
                                                <span class="gender-title">marked as solved </span>

                                            </div>

                                            <div style="font-weight: 600;margin-top: 20px;display: flex;align-items: center;justify-content: space-around;margin-left: 5px;">
                                                <button onclick="send_reply('{{$complain->id }}')" class="btn btn-primary" style="  width: 30%; font-size: 16px;    " type="button">submit</button>
                                            </div>

                                        </div>
                                </div>
                           
                            </div>
                        @endforeach

                        <div id="tasks_popup" class="overlay" style="z-index: 20;">
                            <div class="tasks_popup">
                                <div class="container">
                                    <div class="title"><img style="width: 23%;"
                                            src="{{ asset('kshopina-express_b.png') }}" alt=""></div>
                                </div>
                                <a id='close' class="closee" href="#">&times;</a>
                                <div class="container content">


                                    <form id="assign_form" method="POST" action="assign_task" enctype="multipart/form-data">
                                        @csrf
                                        <input name='system_name' value="Complaint" hidden readonly>
                                        <div class="user-details">
                                            <div class="input-box">
                                                <span class="details">Complaint number</span>
                                                <input value="#order_number" name="order_number" id="order_number"
                                                    type="text" placeholder="Enter your name" readonly>

                                            </div>
                                            <div class="input-box">
                                                <span class="details">Assign To</span>
                                                <select name="assign_to" id="assign_to" class="details"
                                                    placeholder="Colleague">

                                                </select required>

                                            </div>

                                            <div class="input-box">
                                                <span class="details">Comment</span>
                                                <textarea maxlength="1000" style="height: 100px;overflow: hidden;resize: none;" name="task" id="task" cols="30" rows="3"
                                                    required></textarea>
                                            </div>
                                            <div class="input-box">
                                                <span class="details">Deadline date</span>
                                                <input id="deadline" name="deadline" value="" type="date"
                                                    min="{{ date('Y-m-d', time()) }}" placeholder="Enter the date"
                                                    required>
                                            </div>
                                            <div class="input-box">
                                                <span class="details">Image</span>
                                                <input id="image" style="margin-top: 5px;border: none;" name="image"
                                                    type="file" placeholder="Enter the date">
                                            </div>
                                        </div>
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
                                            <input type="submit" value="Submit">
                                        </div>
                                    </form>

                                </div>

                                <div>

                                </div>
                            </div>
                        </div>
  
                    </div>

                </div>

                <div class="pagination">

                    {{-- data --}}
                        <?php
            
                            $orders_per_page = 15;
                            $pages = ceil($number_of_complains[0]->NumberOfOrders / $orders_per_page);
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
                                    <a  href="?page={{ ($count)-10 }}&filter={{ $_GET['filter'] }}" >&laquo;</a>
                                @else
                                    <a href="?page={{ ($count)-10 }}&filter=All" >&laquo;</a>    
                                @endif
                                    
                            @elseif ( $_GET['page'] >= 1 && $_GET['page'] < 10 )
        
                                @if (isset($_GET['filter']))
                                    <a  href="?page={{ ($count) }}&filter={{ $_GET['filter'] }}" >&laquo;</a>
                                @else
                                    <a href="?page={{ ($count) }}&filter=All" >&laquo;</a>    
                                @endif
                                    
                            @else
                
                                <a href="#">&laquo;</a>
                
                            @endif
                    
                        
                        {{-- numbers --}} 
                            @for ($i = $count; $i <=  $count2  ; $i++)

                                @if ($_GET['page'] == $i) 
                     
                                    @if (isset($_GET['filter']))
                                        <a class='active' href="?page={{ $_GET['page'] }}&filter={{ $_GET['filter'] }}" >{{$i}}</a>
                                    @else
                                        <a class='active' href="?page={{ $_GET['page'] }}&filter=All" >{{$i}}</a>    
                                    @endif
          
                                @else
                                        
                                    @if (isset($_GET['filter']))
                                        <a  href="?page={{$i}}&filter={{ $_GET['filter'] }}" > {{$i}}</a>
                                    @else
                                        <a  href="?page={{$i}}&filter=All" >{{$i}}</a>    
                                    @endif
                                    
                                @endif
                            @endfor
                        
                        {{-- ymen --}} 
            
                            @if ($_GET['page'] != $pages && $pages >0 )
        
                                    @if (isset($_GET['filter']))
                                        @if ($pages <=10 )   
                                            <a href="?page={{ $count2 }}&filter={{ $_GET['filter'] }}" >&raquo;</a>
                                        @else   
                                            <a href="?page={{ ($count )+10 }}&filter={{ $_GET['filter'] }}" >&raquo;</a>
                                        @endif
                                    @else
                                        @if ($pages <=10 ) 
                                            <a href="?page={{ $count2 }}&filter=All" >&raquo;</a> 
                                        @else  
                                            <a href="?page={{ ($count )+10 }}&filter=All" >&raquo;</a> 
                                        @endif
                                    @endif
                                    
                            @else
                
                                <a href="#">&raquo;</a>
                
                            @endif    
                        
                        {{-- text pages  --}}
                            <p style="float: left;margin-left: 15px;margin-top: 14px;color: #ca9c47d1;font-size: 10px;">
                                Page {{ $_GET['page'] }} of {{ceil($number_of_complains[0]->NumberOfOrders /15) }}
                            </p>
                    @else
                        <a href="#">&laquo;</a>
                        <a href="#">&raquo;</a>
                    @endif
        
                </div>

            </div>
        </div>
    </div>
    
    <div id="pop_customize_discounts" class="overlay" style="z-index: 20;">
        <div class="popup">
            <h2 style="margin-bottom: 30px"><i style="font-size: 25px;" class="fas fa-percent"></i> Discounts </h2>
            <a id='close' class="closee" href="#">&times;</a>
            <form action="update_discounts" method="post" enctype="multipart/form-data">
                @csrf
                <div style="margin-top: 40px;" class="container content">
                    
                    <div class="dynamic-wrap">
                        <div class="row entry input-group discount_titles">
                            <span  class="discount_code_title">Discount Code</span>
                            <span  class="discount_percent_title">Discount Percent</span>
                        </div>
                        <div id="discounts" class="discounts_form">
                           
                               
                            
                        </div>
                        <div id="deleted">

                        </div>
                    </div>
                    <hr>
                        
    
                </div>
                <div style="display: flex;align-content: center;justify-content: center;" id="submit_section">
                    <button type="submit" id="update_discounts" class="btn btn-primary"
                        style="border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Submit 
                    </button>
                </div>
            </form>

            <div>

            </div>
        </div>
    </div>

    <div id="pop_customize_services_payments" class="overlay" style="z-index: 20;">
        <div class="popup">
            <h2 style="margin-bottom: 30px"><i style="font-size: 25px;" class="fas fa-dolly"></i> Services And Payments </h2>
            <a id='close_compliments' class="closee" href="#">&times;</a>
            <form action="update_services_payments" method="post" enctype="multipart/form-data">
                @csrf
                <div style="margin-top: 40px;" class="container content">
                    
                    <div class="dynamic-wrap">
                        <div class="row entry input-group discount_titles">
                            <span  class="discount_code_title">Country </span>
                            <span  class="discount_percent_title">Payments </span>
                        </div>
                        <div id="services_payments" class="services_payments_form">
                            
                               
                            
                        </div>
                        <div id="deleted_services">

                        </div>
                    </div>
                    <hr>
                        
    
                </div>
                <div style="display: flex;align-content: center;justify-content: center;" id="submit_section">
                    <button type="submit" id="update_services_payments" class="btn btn-primary"
                        style="border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Submit 
                    </button>
                </div>
            </form>

            <div>

            </div>
        </div>
    </div>

    <div id="pop_faqs" class="overlay" style="z-index: 20;">
        <div class="popup">
            <h2 style="margin-bottom: 30px"><i style="font-size: 25px;" class="fas fa-question"></i> Faqs </h2>
            <a id='close_compliments' class="closee" href="#">&times;</a>
            <form action="update_faqs" method="post" enctype="multipart/form-data">
                @csrf
                <div style="margin-top: 40px;" class="container content">
                    
                    <div class="dynamic-wrap">
                        <div id="faqs" class="faqs_form">
                            
                           
                            
                        </div>
                        <div id="deleted_faqs">

                        </div>
                    </div>
                    <hr>
                        
    
                </div>
                <div style="display: flex;align-content: center;justify-content: center;" id="submit_section">
                    <button type="submit" id="update_services_payments" class="btn btn-primary"
                        style="border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                        Submit 
                    </button>
                </div>
            </form>

            <div>

            </div>
        </div>
    </div>

    <div id="pop_details" class="overlay" style="z-index: 20;">
        <div class="popup" style="width: 50%;">
            <h2 id="complaint_order_number" style="margin-bottom: 30px"></h2>
            <a id='close' class="closee" href="#">&times;</a>
            <div class="container content">
                <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                    class="row">
                    <i style="margin-right: 8px;" class="icon far fa-user" data-feather="user"></i>
                    <span id="Complaint_customer_name"></span>
                </div>
                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 8px;" class="icon fab fa-whatsapp" data-feather="user"></i>
                        <span id="complaint_customer_phone"></span>
                    </div>
                </div>

                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 8px;" class="icon far fa-envelope" data-feather="user"></i>
                        <span id="complaint_customer_email"> </span>
                    </div>
                </div>

                
                <hr>
            
                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 15px;" class="icon fas fa-globe-africa" data-feather="user"></i>
                        <span id="complaint_customer_country"></span>
                    </div>
                </div>

                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 15px;" class="icon fas fa-map-marker-alt" data-feather="user"></i>
                        <span id="complaint_customer_city"></span>
                    </div>
                </div>

                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 15px;" class="icon fas fa-map-marked-alt" data-feather="user"></i>
                        <span id="complaint_customer_address"></span>
                    </div>
                </div>

                <div style="display: flex;align-items: baseline;justify-content: start;">
                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 15px;" class="icon fas fa-building" data-feather="user"></i>
                        <span id="complaint_customer_appartment" style="width: 16rem;"></span>
                    </div>
                </div>

                <div style="display: flex;align-items: baseline;justify-content: start;">
                    
                    <div style="margin-top: 8px;display: inline-block;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 8px;" class="icon fas fa-map-marker-alt" data-feather="user"></i>
                        <span id="complaint_customer_province"></span>
                    </div>
                </div>

                

                
                <hr>
                <div style="margin-right: 5px;margin-left: 5px;align-items: flex-end;justify-content: space-between;" class="row">
                    <div style="width: 100%;">
                        <i class="fas fa-sitemap"></i>
                        <div id="items_details"
                            style="width: 95%;display: inline-block;grid-column-gap: 0px;grid-template-columns: auto auto;">

                        </div>
                    </div>
                </div>
                
                
            </div>
            <hr>

            <div style="display: flex;align-items: baseline;justify-content: start;">
                    
                <div style="display: flex;align-items: baseline;justify-content: center;width: 100%;"
                    class="row " id="order_status">
                    <div>This order in <span id="complain_order_status" style="font-weight: 600;color: #cb9d48;font-size: 20px;"></span> stage</div>
                    
                </div>
            </div>

            
        </div>
    </div>

    <div id="open_ticket" class="overlay" style="z-index: 20;">
        <div class="popup" style="width: 50%;">
            <h2 style="margin-bottom: 30px"> Ticket Details</h2>
            <a id='close' class="closee" href="#">&times;</a>
            <div class="container content">
                <form action="open_ticket" id="open_ticket" method="POST" enctype="multipart/form-data" >

                    @csrf

                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Customer Email</span>
                            <input  name="cust_email" type="email" placeholder="Enter customer email" required >
                        </div>
                    </div>

                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Customer order Number</span>
                            <input  name="cust_order_number" type="text" placeholder="Enter customer order number"  >
                        </div>
                    </div>

                    <div class="user-details">
                        <div class="input-box" style="width: 100%;">
                            <span class="details">Ticket body</span>
                        
                            <div class="emoji-picker-container" >
                                <textarea data-emojiable="true" maxlength="4000"  style="height: 110px;resize: none;padding-top: 8px;padding-right: 8px;padding-bottom: 8px;
                                overflow-y: overlay;border-radius: 8px;height: 100px;overflow: hidden;" name="cs_message" cols="30" rows="1" required></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="ticket_buttons">
                        <button style="font-size: 14px;letter-spacing: .6px;width: 300px;border-radius: 8px;margin-bottom: 10px;" 
                            type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>


    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
    <script>
        $(function() {
          // Initializes and creates emoji set from sprite sheet
          window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: 'public/lib/img',
            popupButtonClasses: 'fa fa-smile-o' // far fa-smile if you're using FontAwesome 5
          });
          // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
          // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
          // It can be called as many times as necessary; previously converted input fields will not be converted again
          window.emojiPicker.discover();
        });
      </script>
<script>

    $(document).ready(function() {
        $("#open_ticket").on("submit", function() {
            $('.ticket_buttons').html(
                '<div id="assign_submit" style="color: #426851 !important;width: 300px;border-radius: 8px;background-color: #e3ce88 !important;border-color: #e3ce88 !important;align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );
        }); //submit
    });

    function open_ticket(){

        $('#open_ticket').show();

    }

    function emoji_pop_up(){

        $.ajax({
            url: "https://emojihub.yurace.pro/api/all",
            type: "get",
            data: {
                
            },
            success: function(response) {
               console.log(response);
            }
                
        });
    }

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

</script>

<script>
    var selected;
    /* $("#filters button").click(function() {
        if (this.id == "All") {
            window.location.href = "?page=1&filter=All";

        } else if (this.id == "Korean") {
            window.location.href = "?page=1&filter=Korean";

        } else if (this.id == "Customer") {
            window.location.href = "?page=1&filter=Customer";

        } else if (this.id == "Logistic") {
            window.location.href = "?page=1&filter=Logistic";

        } else {
            window.location.href = "?page=1&filter=Other";

        }
        selected = this.id;
    }); */


    $('.close').click(function(e) {
        $(this.parentElement.parentElement).hide();
        e.preventDefault();

    });

    function solved(elemant) {

        swal({
            title: "Please wait!",
            text: " ",
            closeOnClickOutside: false,
            button: null,
            icon: "loader.gif",
        });

        var id = (elemant.id);
        $.ajax({
            url: "solved",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                order: id,
            },
            success: function(response) {
                swal.close();
                $(elemant.parentElement.parentElement).html("Action taken");
            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });



    }

    function details(elemant,seen) {
        var id = (elemant.id);
        var html = "";
        var arabic = /[\u0600-\u06FF]/;

        $('#wave_notification' + id).hide();
        $('#pop' + id).show();
        
        //nour          
        $.ajax({
            url: "get_replies",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                seen:seen
                
            },
            success: function(response) {
               console.log(response);
              
                for (let i = 0; i < response.length; i++) {
                        if(response[ i].side==0){
                            html += ' <div  style="font-weight: 600;margin-top: 6px;display: flex;align-content: flex-end; flex-direction: column; "class="row"> ';
                            html += '<span style="width: fit-content;word-wrap: break-word;background-color: #CB9D48;padding: 0.5rem;border-radius: 10px;font-weight: initial;white-space: pre-line;';
                            if (arabic.test(response[i].reply)) {
                                html += 'text-align: right;';
                            } else {
                                html += 'text-align: left;';
                            }
                            html += '">'+ response[i].reply+'</span> ' ;
                            html += '<h5 style=" text-align: right;font-size: x-small;margin-top: 5px;color: #777777;margin-left: 5px;    " > '+ response[i].replied_at +'</h5> </div>';
                        }
                                                            
                        if(response[i].side==1){
                            html += ' <div style="    align-items: flex-start; font-weight: 600;margin-top: 5px;display: flex;flex-wrap: nowrap; flex-direction: column;"class="row">';
                            html += ' <span style="width: fit-content;word-wrap: break-word;background-color: #f7f6f3;padding: 0.5rem;border-radius: 10px;font-weight: initial;white-space: pre-line;';
                            if (arabic.test(response[i].reply)) {
                                html += 'text-align: right;';
                            } else {
                                html += 'text-align: left;';
                            }
                            html += '">' + response[i].reply +'</span> ';
                            html += '<h5 style="    text-align: right;font-size: x-small;margin-top: 5px;color: #777777;margin-left: 5px;  " > '+ response[i].replied_at +'</h5> </div>';
                        }
                            
                

                    }

                    $('#replies'+id).html(html);
                   
                }
                
        });

    }

    var users = new Object();
    $('.closee').click(function(e) {
        $(this.parentElement.parentElement).hide();
        e.preventDefault();
    });

    function create_task(elemant) {
        order_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
        data = elemant.id.substring(0, elemant.id.indexOf("_"));
        var html = "";


        $(elemant.parentElement).html(
            '<div style="height:20px; width:20px;" class="loader"></div>'
        );

        try {
            ajaxx.abort();
        } catch (error) {

        }
        if (Object.keys(users).length == 0) {
            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "get_users",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    complete: function() {
                        $("#arrow_id" + order_number).html(
                            '<i onclick="create_task(this)" id="assign_' + order_number +
                            '"class="fas fa-chevron-right"></i>'
                        );
                    },
                    success: function(response) {
                        html +=
                            '<option value="" selected disabled hidden>Select the colleague</option>';
                        response.forEach(element => {
                            users[element.id] = element.name;

                            html += '<option value="' + element.id + '">' + element.name +
                                '</option>'
                        });


                        $('#assign_to').html(html);

                        $('#order_number').val(order_number);

                        $('#tasks_popup').show();
                    }
                });
            }, 10);
        } else {

            var users_key = Object.keys(users);
            html += '<option value="" selected disabled hidden>Select the colleague</option>';

            for (let i = 0; i < Object.keys(users).length; i++) {
                html += '<option value="' + users_key[i] + '">' + users[users_key[i]] +
                    '</option>'

            }
            $('#assign_to').html(html);

            $('#order_number').val(order_number);

            $('#tasks_popup').show();

            $("#arrow_id" + order_number).html('<i onclick="create_task(this)" id="assign_' + order_number +
                '"class="fas fa-chevron-right"></i>');
        }


    }

    $(document).ready(function() {
        $("#assign_form").on("submit", function() {
            $('#assign_submit').html(
                '<div id="assign_submit" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );
        }); //submit
    });

    function send_reply(id){
        
        var new_reply='';
        var reply = $('#reply_'+id).val();
        var solved=$('#solved_'+id).val();
        if ($('#solved_'+id).not(':checked').length) {
                solved=0;
            }
                                        
            
        $.ajax({
            url: "reply_complaint",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                reply:reply,
                solved:solved
            },
            success: function() {
                
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your reply has been sent!',
                    showConfirmButton: false,
                    timer: 1500
                    })

                    location.reload(true);  
                }
                
            
        });
        
        new_reply += ' <div  style="align-items: center;font-weight: 600;margin-top: 6px;display: flex;justify-content: flex-end;"class="row">';
        new_reply += ' <span style="width: fit-content;word-wrap: break-word;background-color: #CB9D48;padding: 0.5rem;border-radius: 10px;font-weight: initial;white-space: pre-line;">'+reply+'</span> </div>'   
        $('#new_reply'+id).html(new_reply); 

    }

</script>

<script>
        var storeee;
        storeee = window.location.href;
        storeee = new URL(storeee);

    function handleSelect(elm) {
        
        window.location = window.location.pathname +"?page=1&filter=" + elm.value 
        console.log( window.location);

    }

    function group_details(order_number) {
        var order_status ={ '0' : "varification" , '1' : "Fulfillment" , '2' : "Dispatching" , '3' : "Kshopina_Warehouse",
            '4' : "Delivery" , '5' : "Delivered" , '6' : "Refusing"
        }
       
        if (order_number) {
            
            Swal.fire({
                position: 'center',
                html: "<div style='overflow: hidden;align-items: center;justify-content: center;display: flex'><div class='loader'></div></div>",
                title: 'Please wait!',
                showConfirmButton: false,
            });

        $.ajax({
            url: "get_order_details",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
                order_number: order_number,
            },
            success: function(response) {

                var html = '';

                if (response.length !=0) {
                    $("#complaint_order_number").html("#"+ response[0].order_number);
                    $("#Complaint_customer_name").html(response[0].name);
                    $("#complaint_customer_email").html(response[0].email);
                    $("#complaint_customer_phone").html(response[0].phone_number);

                    $("#complaint_customer_country").html(response[0].country);
                    $("#complaint_customer_city").html(response[0].city);
                    $("#complaint_customer_address").html(response[0].address);
                    $("#complaint_customer_appartment").html(response[0].apartment);
                    $("#complaint_customer_province").html(response[0].province);
                    $("#complain_order_status").html(order_status[response[0].status]);
                } 
                
                response.forEach(element => {
                   // elemant2 = JSON.parse(JSON.stringify(element));
                   
                    html +=
                        '<div style="margin-right: 5px;margin-left: 5px;align-items: center;justify-content: space-between;" class="row"><div style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: 16rem;background-color: #36304a;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 20px;"><span>' +
                            element.product_name + '</span></div> <div><span style="font-weight: 800;">'+element.quantity +'</span> × '+element.total_price + ' EGP</div> </div>';

                });

                swal.close();
                $('#items_details').html(html);
                $('#pop_details').show();

            },
            error: function(xhr) {
                //Do Something to handle error
            }

        });

        } else {
            Swal.fire({
                position: 'center',
                html: "<div style='overflow: hidden;align-items: center;justify-content: center;display: flex'>No order number.</div>",
                title: 'This is general complaint!',
                showConfirmButton: false,
            });
        }

           
      
    
    }

</script>

<script>
    function customize_discounts(){

        var html = "";
        var html1 = "";
        

        $.ajax({
            url: "get_dicounts",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response);
               if (response.length ==0) {
                    html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                    html +=
                        '<input style="display: none;" class="id form-control" type="text" name="id[]" value="none" readonly/>';

                    html +=
                        '<div style="width: 5%;">'+
                                        '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="0" />'+
                                    '</div>';

                    html+= '<input class="form-control" name="discount_code[]" type="text" placeholder="Discount Code" required>';

                    html+= '<input style="flex: .4;" class="price form-control" type="text" name="percent[]" placeholder="Percent" required>';

                    html+= '<span class="input-group-btn">'+
                                        '<button class="btn btn-success btn-add" type="button">'+
                                            '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                        '</button></span>';
                    html +='</div>';


                } else {
                    
                    for (let i = 0; i < response.length; i++) {
                        html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                        html +=
                        '<input style="display: none;" class="id form-control" type="text" name="id[]" value="'+response[i]['id']+'" readonly/>';

                        if (response[i]['active'] == 0) 
                        {
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['id']+'" />'+
                                        '</div>';
                        }
                        else{
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['id']+'" checked="checked"/>'+
                                        '</div>';
                        }

                        html+= '<input class="form-control" value="'+response[i]['discount_code']+'" name="discount_code[]" type="text" placeholder="Discount Code" required>';

                        html+= '<input style="flex: .4;" class="price form-control" value="'+response[i]['discount_percent']+'" type="text" name="percent[]" placeholder="Percent" required>';

                        if (i== response.length -1) {

                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-success btn-add" type="button">'+
                                                '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                            '</button></span>';
                        
                        } else {
                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-remove btn-danger" type="button">'+
                                                '<i style="font-size: 14px;" class="fas fa-minus"></i>'+
                                            '</button></span>';
                        }
                        
                        html +='</div>';

                    }
                } 
           
                
                $("#discounts").html(html);
                $("#pop_customize_discounts").show();
               
            },
            error: function(xhr) {
                //Do Something to handle error
                console.log(error);
            }

        });
    }

    function customize_service_payments(){

        var html = "";
        var html1 = "";

    
         $.ajax({
            url: "get_services_payments",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response);
                if (response.length ==0) {
                    html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                    html +=
                        '<input style="display: none;" class="id form-control" type="text" name="id[]" value="none" readonly/>';

                    html +=
                        '<div style="width: 5%;">'+
                                        '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="0" />'+
                                    '</div>';

                    html+= '<input class="form-control" name="country[]" type="text" placeholder="Country" required>';

                    html+= '<div style="display: flex;align-items: center;justify-content: center;flex: .3;">'+
                                        '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="cod[]" value="0" />'+
                                        '<label style="margin-bottom:0px;font-size: 12px;width:  2vw;;margin-left: 0.2vw;" for="cod">COD</label>'+
                                        '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="pre_paid[]" value="0" />'+
                                        '<label style="margin-bottom:0px;font-size: 11px;width: 3vw;margin-right: 0.8vw;margin-left: 0.2vw;" for="cod">Pre Paid</label>'
                                    '</div>';


                    html+= '<span class="input-group-btn">'+
                                        '<button class="btn btn-success btn-add" type="button">'+
                                            '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                        '</button></span>';
                    html +='</div>';


                }else {
                    
                    for (let i = 0; i < response.length; i++) {
                        html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                        html +=
                        '<input style="display: none;" class="id form-control" type="text" name="id[]" value="'+response[i]['id']+'" readonly/>';

                        if (response[i]['active'] == 0) 
                        {
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['id']+'" />'+
                                        '</div>';
                        }
                        else{
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['id']+'" checked="checked" />'+
                                        '</div>';
                        }

                        html+= '<input class="form-control" value="'+response[i]['country']+'" name="country[]" type="text" placeholder="Country" required>';

                        html+= '<div style="display: flex;align-items: center;justify-content: center;flex: .3;">';

                            if (response[i]['cod'] == 0) 
                            {
                                    html +=  '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="cod[]" value="'+response[i]['id']+'" />';
                            } else {

                                html +=  '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="cod[]" value="'+response[i]['id']+'"  checked="checked" />';
                            }

                                html +=  '<label style="margin-bottom:0px;font-size: 12px;width:  2vw;;margin-left: 0.2vw;" for="cod">COD</label>';

                            if (response[i]['pre_paid'] == 0) {

                                html += '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="pre_paid[]" value="'+response[i]['id']+'" />';

                            } else {

                                html += '<input style="height: 10px;width: auto;margin-left: 0.5vw;" type="checkbox" class="active form-control check" name="pre_paid[]" value="'+response[i]['id']+'"  checked="checked" />';

                            }

                            html += '<label style="margin-bottom:0px;font-size: 12px;width: 3vw;margin-right: 0.8vw;margin-left: 0.2vw;" for="cod">Pre Paid</label>' + 
                            '</div>';

                        if (i== response.length -1) {

                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-success btn-add" type="button">'+
                                                '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                            '</button></span>';
                        
                        } else {
                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-remove btn-danger" type="button">'+
                                                '<i style="font-size: 14px;" class="fas fa-minus"></i>'+
                                            '</button></span>';
                        }
                        
                        html +='</div>';

                    }
                }  
           
                $("#services_payments").html(html);
                $("#pop_customize_services_payments").show();
            
            },
            error: function(xhr) {
                //Do Something to handle error
                console.log(error);
            }

        }); 
    }

 /* nour  new  */
     function customize_faqs(){

        var html = "";
        var html1 = "";

       
          $.ajax({
            url: "get_faqs",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response);
                if (response.length ==0) {

                    html += '<div  style="flex-wrap: nowrap; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                        html +=  '<input style="display: none;" class="id form-control" type="text" name="id[]" value="none" readonly/>';

                            html += '<div style="width: 7%;">';
                                html += '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="0" />';
                            html += '</div>';
                
                            html +=  '<div style="display: flex;align-items: center;justify-content: center;flex: .3;flex-direction: column;">';

                                html +=  ' <textarea name="questions[]" id="" cols="40" rows="4" placeholder="Question"  style="border-radius: 8px;resize: none;" ></textarea>';
                               
                                html +=  ' <div style="margin-top: 10px;" >';
                               
                                    html +=  '<textarea name="answers[]" id="" cols="40" rows="4" placeholder="Answer" style="border-radius: 8px;resize: none;"  ></textarea>';
                                    
                                html +=  '</div>';

                            html += '</div>';

                            html += '<span class="input-group-btn">';
                            
                                html += '<button class="btn btn-success btn-add" type="button" style="margin-left: 8px;">';
                                
                                    html += '<i style="font-size: 14px;" class="fas fa-plus"></i>';
                                    
                                html += '</button>';
                                
                            html += ' </span>';
                           
                            
                        html += '</div>';

                
                } else {
                    
                    for (let i = 0; i < response.length; i++) {
                        html += '<div  style="flex-wrap: nowrap; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                        html +=
                        '<input style="display: none;" class="id form-control" type="text" name="id[]" value="'+response[i]['id']+'" readonly/>';

                        if (response[i]['active'] == 0) 
                        {
                        
                            html +=
                            '<div style="width: 7%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="' + response[i]['id']+ '" />'+
                                        '</div>';
                        }
                        else{
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value=" '+response[i]['id']+ ' " checked="checked" />'+
                                        '</div>';
                        }

                        html +=  '<div style="display: flex;align-items: center;justify-content: center;flex: .3;flex-direction: column;">';

                                html +=  ' <textarea name="questions[]" id="" cols="40" rows="4" style="border-radius: 8px;resize: none;"   > ' + response[i]['question']+ '</textarea>';
                               
                                html +=  ' <div style="margin-top: 10px;" >';
                               
                                    html +=  '<textarea name="answers[]" id="" cols="40" rows="4" style="border-radius: 8px;resize: none;"  > ' + response[i]['answer']+ ' </textarea>';
                                    
                                html +=  '</div>';

                        html += '</div>';


                        if (i== response.length -1) {

                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-success btn-add" type="button"  style="margin-left: 8px;">'+
                                                '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                            '</button></span>';
                        
                        } else {
                            html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-remove btn-danger" type="button" style="margin-left: 8px;">'+
                                                '<i style="font-size: 14px;" class="fas fa-minus"></i>'+
                                            '</button></span>';
                        }
                        
                        html +='</div>';

                    }
                }  
           
                $("#faqs").html(html);
                $("#pop_faqs").show();
            
            }/* ,
            error: function(xhr) {
                //Do Something to handle error
                console.log(error);
            } */

        });  
    }
    

</script>

<script>
    $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var dynaForm = $('.dynamic-wrap .discounts_form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                var old_val=newEntry.find('.check').val();
                    
                newEntry.find('input').val('');

                newEntry.find('.check').val(parseInt(old_val)+1);
                newEntry.find('.id').val('none');

                
                dynaForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fas fa-minus"></i>');
            }).on('click', '.btn-remove', function(e) {
                console.log( );
                
                
                $("#deleted_services").append('<input name="deleted[]" type="text" value="'+$(this).parents('.entry:first')[0].firstChild.value +'" readonly hidden>')
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
</script>

<script>
    
    $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var dynaForm = $('.dynamic-wrap .services_payments_form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                var old_val=newEntry.find('.check').val();
                    
                newEntry.find('input').val('');

                newEntry.find('.check').val(parseInt(old_val)+1);
                newEntry.find('.id').val('none');

                
                dynaForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fas fa-minus"></i>');
            }).on('click', '.btn-remove', function(e) {
                console.log( );
                
                $("#deleted").append('<input name="deleted[]" type="text" value="'+$(this).parents('.entry:first')[0].firstChild.value +'" readonly hidden>')
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
    });
</script>

{{-- search nour --}}
<script>

    $('.dropdown-toggle').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.search-dropdown').toggleClass('open');
    });

    $('.dropdown-menu > li > a').click(function(e) {
    e.preventDefault();
    var clicked = $(this);
    clicked.closest('.dropdown-menu').find('.menu-active').removeClass('menu-active');
    clicked.parent('li').addClass('menu-active');
    clicked.closest('.search-dropdown').find('.toggle-active').html(clicked.html()+'<i class="fas fa-angle-down" style="padding: 0px 0px 0px 6px;font-size: 12px;"></i>');
    });

    $(document).click(function() {
    $('.search-dropdown.open').removeClass('open');
    });

</script>

<script>
    var search_filter = 1;
     function filter_search (element){
        search_filter= element.value;
        console.log(search_filter);
    }


      function search_complaints(elemant) {

            if (search_filter==0) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Choose between MAWB OR Order number!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            var value = (elemant.value);
            var html1 = "";
            var counter = 0;
            var url = "";
            var Controller_url = "";
           
            var filter_url = "";

          
            
            
            if ((value.replace(/\s/g, "")).length > 2) {

                try {
                    ajaxx.abort();
                } catch (error) {

                }
                setTimeout(function() {
                    
                    ajaxx = $.ajax({
                        url: "search_complaints",
                        type: "post",
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            content: value,
                            filter: search_filter
                        },
                        success: function(response) {
                            
                            console.log(response );
                            response.forEach(item => {

                                if (item['solved'] == 1) {
                                    Controller_url = 'complains_orders_archived';
                                } else if (  item['special_case'] == 1 ) {
                                    Controller_url = 'complains_special_orders';
                                }else {
                                    Controller_url = 'complains_orders'
                                }

                                

                                //category
                               
                                if (item['complain'] == 'Cancel order') {
                                    filter_url = "cancel_order";
                                } else if (item['complain'] == 'Rescheduling'){
                                    filter_url = "reschedule";
                                }else if (item['complain'] == 'No response or late delivery'){
                                    filter_url = "no_response";
                                }else if (item['complain'] == 'customer_others'){
                                    filter_url = "customer_others";
                                }else if (item['complain'] == 'Inquire about product'){
                                    filter_url = "ask_about_product";
                                }else if (item['complain'] == 'guest_others'){
                                    filter_url = "Others";
                                }else{
                                    filter_url = "All";
                                }

                                counter++;

                                html1 += '<a href="' + Controller_url + '?page=1&filter=' + filter_url +'&complaint_id='+ item['id'] +' " target="blank" class="search-item"> ';

                                html1 += '<div style="width: 100%;" class="search-result row">';

                                html1 +=
                                    '<div  style="width: 100%;margin-left: 10px;" class="column">';
                                
                                if (search_filter == 1) {
                                    html1 +=
                                    '<div style=" display: flex;align-items: flex-end;">  '+
                                        '  <div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                            item['order_number'] + 
                                         '</div>';
                                       html1 += '<span  style="color: #b3883e;font-weight: 600;font-size: 14px;margin-left: 0.5rem;"> (' +
                                       item['id'] + ')</span>' + 
                                    '</div>';
                                } else if(search_filter == 2) {
                                    html1 +=
                                    '<div style=" display: flex;align-items: flex-end;">  '+
                                        '  <div  style="color: #b3883e;font-weight: 600;font-size: 16px;">  ' +
                                            item['id'] + 
                                         '</div>';
                                       html1 += '<span  style="color: #b3883e;font-weight: 600;font-size: 14px;margin-left: 0.5rem;"> ( <i class="fas fa-hashtag"></i>' ;
                                      
                                       if (item['order_number'] != null) {
                                        html1 += item['order_number'] ;
                                       } else {
                                        html1 += 'General Complaint';
                                       }
                                       html1 += ')</span>' 
                                       + '</div>';
                                }

                                html1 +=
                                    '<div class="row" style="justify-content: space-between;margin: 3px 1px 0px 0px ;color: #918f8f;font-size: 13px;">';

                                html1 +=
                                    '<div  style="margin-right: 25px; font-size: 14px; color: white; "><i class="fas fa-user-alt"></i>  ' +
                                    item['name'] + '</div>';
                                html1 +=
                                    '<div><i class="fas fa-flag"></i>  ' +
                                    item['country'] + '</div>';
                                html1 += '</div>';
                                html1 += '</div>';
                                html1 += '</div> </a>';

                                if (counter != response.length) {
                                    html1 += '<hr class="product">';
                                }


                            });
                            $("#results").html("");
                            $("#results").html(html1);

                            if (response.length > 0) {
                                $("#results").show();
                            } else {
                                $("#results").hide();
                            }


                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }, 500);
            } else {
                $("#results").hide();
            }

            $(document).click(function() {
                $("#results").hide();
            });


        }

</script>


<script>


$(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var dynaForm = $('.dynamic-wrap .faqs_form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                var old_val=newEntry.find('.check').val();
                    
                newEntry.find('input').val('');

                newEntry.find('.check').val(parseInt(old_val)+1);
                newEntry.find('.id').val('none');

                
                dynaForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fas fa-minus"></i>');
            }).on('click', '.btn-remove', function(e) {
                console.log( );
                
                $("#deleted_faqs").append('<input name="deleted[]" type="text" value="'+$(this).parents('.entry:first')[0].firstChild.value +'" readonly hidden>')
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
});



</script>

<script src="public/lib/js/config.min.js"></script>
<script src="public/lib/js/util.min.js"></script>
<script src="public/lib/js/jquery.emojiarea.min.js"></script>
<script src="public/lib/js/emoji-picker.min.js"></script>
 @endsection
