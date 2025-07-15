@extends('layouts.staff_layout')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
    <style>
        .entry:not(:first-of-type) {
            margin-top: 10px;
        }

        .glyphicon {
            font-size: 12px;
        }

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
            font-size: 1.4em;
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

        form .user-details .input-box,
        .group_input {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
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
            background: linear-gradient(135deg, #5f5386, #CA9B49);
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

        /*  .loader {
                                    border: 3px solid #f3f3f3;
                                    border-radius: 50%;
                                    border-top: 4px solid #1b3425;
                                    width: 15px;
                                    height: 15px;
                                    -webkit-animation: spin 2s linear infinite;
                                    animation: spin 2s linear infinite;
                                } */

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
            color: #e4bc34;
            text-decoration: none;
        }

        .create {
            color: #0056b3;
        }
    </style>


    <style>
        #myInput::placeholder {
            color: #296E45;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .not_active {
            margin-right: 15px;
            cursor: pointer;
            text-align: center;
            justify-content: center;
            align-items: center;
            padding-top: 5px;
            width: 95px;
            padding-bottom: 5px;
            display: flex;
            border-radius: 15px 15px 0px 0px;
            opacity: .99;
            background-color: #1b3425;
            color: #d2ac6a;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
        }

        .not_active:hover {
            color: #ffffff;
            text-decoration: none;
        }

        .active_verification {
            border-radius: 15px 15px 0px 0px;
            margin-right: 15px;
            cursor: pointer;
            text-align: center;
            justify-content: center;
            align-items: center;
            padding-top: 5px;
            width: 95px;
            padding-bottom: 5px;
            display: flex;
            border-radius: 15px 15px 0px 0px;
            background: #ffffff;
            color: #1b3425;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
        }

        .active_verification:hover {
            color: #1b3425;
        }

        .btn-primary.focus,
        .btn-primary:focus {
            color: #fff;
            background-color: #1b3425;
            border-color: #1b3425;
        }
    </style>

    <style>
        .email-form , .phone-form {
            display: inline-block;
        }

        .pseudo-search {
            display: flex;
            border: 2px solid #ccc;
            border-radius: 100px;
            transition: background-color 0.5 ease-in-out;
        }

        .pseudo-search input {
            border: 0;
            background-color: transparent;
            width: 240px;
            padding-left: 10px;
        }

        .pseudo-search input:focus {
            outline: none;
        }

        .pseudo-search button,
        .pseudo-search i {
            border: none;
            background: none;
            cursor: pointer;
        }

        .pseudo-search select {
            border: none;
        }

        .email_btn , .phone_btn {
            border-left: 2px solid #cccccc !important;
            color: green;
        }

        .pseudo-search input::placeholder {
            font-size: 14px;
        }

        .btn:focus {
            box-shadow: none !important;
        }
    </style>

    <style>
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
    </style>

    <style>
        .hover-container {
            position: relative;
        }

        .hover-target {
            position: relative;
        }

        .hover-popup {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            top: 70%;
            left: 5%;
            width: 60ch;
            margin: min(1rem, 20px);
            font-size: 0.8rem;
            background-color: #1b3425e8;
            color: white;
            border-radius: 8px;
            padding: 1.5em;
            z-index: 42;
            transform: scale(0);
            transition: transform 200ms ease;
            transform-origin: 8.2% -10px;
        }

        .hover-target:hover+.hover-popup,
        .hover-target:focus+.hover-popup,
        .hover-popup:hover {
            transform: scale(1);
        }

        .hover-popup :not(:first-child) {
            margin-top: 0rem;
        }

        .hover-popup span {
            color: rgb(222 ,100, 87);
            font-weight: 700;
        }

        .hover-popup::before {
            /* This is the triangle/arrow */
            content: "";
            position: absolute;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid #1b3425e8;
            top: -10px;
        }

        .hover-popup::after {
            /* This is merely here to expand the hoverable area, as a buffer between the "Hover me" text and the popup. */
            content: "";
            position: absolute;
            top: -1rem;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            ::before,
            ::after {
                animation-delay: -1ms !important;
                animation-duration: -1ms !important;
                animation-iteration-count: 1 !important;
                background-attachment: initial !important;
                scroll-behavior: auto !important;
                transition-duration: 0s !important;
                transition-delay: 0s !important;
            }
        }
    </style>


    <style>
        .content{
            padding-left: 30px;
            color: #53646f;
            font-size: 15px;
            font-weight: 400;
        }
        .not_editable_data_contain{
            border: 1px solid #cdc9cc;
            padding: 18px 0px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .editable_data_contain{
            border: 1px solid #cdc9cc;
            padding: 18px 50px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .details_td{
            border: solid 1px #cdc9cc !important;
            border-style: none solid solid solid !important;
        }
        .details_th{
            border: solid 1px #cdc9cc !important;
            border-style: solid !important;
        }

        .details_tr .details_th:first-child { border-top-left-radius: 8px; }
        .details_tr .details_th:last-child { border-top-right-radius: 8px;}
        /*.details_tr:first-child .details_td:first-child { border-top-left-radius: 8px; } */
        /*.details_tr:first-child .details_td:last-child { border-top-right-radius: 10px; }*/

        .details_tr:last-child .details_td:first-child { border-bottom-left-radius: 8px; }
        .details_tr:last-child .details_td:last-child { border-bottom-right-radius: 8px; }


        .details_tr:first-child .details_td { border-top-style: solid; }
        .details_tr .details_td:first-child { border-left-style: solid; }

        .details_th { border-top-style: solid; 
        }
        .details_tr .details_th:first-child { border-left-style: solid; }

       .actions_contain{
            background-color: white;
            display: flex;
            flex-direction: column;
            position: absolute;
            right: 70px;
            top: 40px;
            width: 140px;
            z-index: 1;
            border-radius: 8px;
            box-shadow: 0rem 0.25rem 1.125rem -0.125rem #1f212414, 0rem 0.75rem 1.125rem -0.125rem #1f212426;
            padding: 0px  !important;
       }
       .action_btn{
            border: none;
            background-color: transparent;
            padding: 7px 16px;
            font-weight: 500;
            color: #636464;
       }
       .action_btn:hover{
            background-color: #1111111f;
       }
        .actions_btn_icon{
            background-color: transparent;
            border: none;
            color: #1b3425;
            font-size: 18px;
            margin-right: 12px;
            cursor: pointer;

        }
        .actions_btn_icon:focus-visible,i:focus-visible,button:focus {
            outline: none;
            border: none;
        }

        .whatsapp_mark{
            height: 15px;
            width: 25px;
            display: inline-flex;
            background-position: center;
            background-size: cover;
        }
    </style>

    @php
    $previous_order = '';
    
    @endphp
    <div class="container">
        <div class="floating-button-menu menu-off" style="display: flex;align-items: center;justify-content: center;">
            <div class="floating-button-menu-links">
                <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: #ffdb0052;border-color: #ffdb0052;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span><b>3</b> days after FVM sent</span>
                </a>
                <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color:  #ff000014;border-color:  #ff000014;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span> <b>7</b> after FVM sent</span>
                </a>
            </div>
            <div class="floating-button-menu-label"><i class="fas fa-palette"></i></div>
        </div>

        <div class="floating-button-menu-close"></div>

            <div class="row row--top-40">
                <div class="column">
                    <h2 class="row__title">Verification</h2>
                </div>


                {{-- <form action="/first_verification_export?store={{ $_GET['store'] }}" method="post"
                    enctype="multipart/form-data">
                    @csrf --}}
                    <div>
                        <button type="submit" id="export" name="action" {{-- @if (Route::current()->getName() != 'tst') value="export" @else value="export-two" @endif --}}
                            style="border-radius: 15px;position: relative;right: 1.8rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;"
                            class="btn btn-primary" onclick="verification_export()">
                            Export
                        </button>
                    </div>
                    

                    <input value="store={{ $_GET['store'] }}" type="text" id="store" readonly hidden>
                {{--  </form> --}}


            </div>

            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="row stati turquoise  "
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;text-align: left;">
                            <b style="color: #1b3425;">{{ $number_of_FVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">FVM</span>
                        </div>
                        <div style="padding-right: 25px;">
                            <b>{{ $number_of_replied_FVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Replied</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati turquoise left"
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b style="color: #1b3425;">{{ $number_of_new_FVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">New FVM</span>
                        </div>
                        <div style="padding-right: 25px;text-align: right;">
                            <b>{{ $number_of_new_SVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">New SVM</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise "
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;text-align: left;">
                            <b>{{ $number_of_SVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">SVM</span>
                        </div>
                        <div style="padding-right: 25px;">
                            <b>{{ $number_of_replied_SVM[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Replied</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise left"
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b>{{ $number_of_confirmed_archived[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Confirmed</span>
                        </div>
                        <div style="padding-right: 25px;text-align: right;">
                            <b>{{ $number_of_canceled_archived[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Canceled</span>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-3">
                    <div class="row stati turquoise"
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;text-align: left;">
                            <b style="color: #1b3425;display: flex;align-items: center;">
                                @if ( strlen((string)$number_of_new_FVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_new_FVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_new_FVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">CONFIRMED</span>
                        </div>
                        <div style="padding-right: 25px;">
                            <b style="color: #1b3425;display: flex;align-items: center;justify-content: flex-end;">
                                @if ( strlen((string)$number_of_new_SVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_new_SVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_new_SVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">EDITED</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati turquoise left"
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b style="color: #1b3425;display: flex;align-items: center;">
                                @if ( strlen((string)$number_of_FVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_FVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_FVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">FVM</span>
                        </div>
                        <div style="padding-right: 25px;text-align: right;">
                            <b style="color: #1b3425;display: flex;align-items: center;justify-content: flex-end;">
                                @if ( strlen((string)$number_of_replied_FVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_replied_FVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_replied_FVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">SVM</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise "
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;text-align: left;">
                            <b style="display: flex;align-items: center;">
                                @if ( strlen((string)$number_of_SVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_SVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_SVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">ON HOLD</span>
                        </div>
                        {{-- <div style="padding-right: 25px;">
                            <b style="display: flex;align-items: center;justify-content: flex-end;">
                                @if ( strlen((string)$number_of_replied_SVM[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_replied_SVM[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_replied_SVM[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Replied</span>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row stati bg-turquoise left"
                        style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b style="display: flex;align-items: center;">
                                @if ( strlen((string)$number_of_confirmed_archived[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_confirmed_archived[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_confirmed_archived[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Confirmed</span>
                        </div>
                        <div style="padding-right: 25px;text-align: right;">
                            <b style="display: flex;align-items: center;justify-content: flex-end;">
                                @if ( strlen((string)$number_of_canceled_archived[0]->NumberOfOrders) > 3 )
                                    {{ round( $number_of_canceled_archived[0]->NumberOfOrders/1000 , 3) }} <h4 style="margin-bottom: 0px;margin-left: 3px;"> k </h4>
                                @else
                                    {{ $number_of_canceled_archived[0]->NumberOfOrders }}
                                @endif  
                            </b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Canceled</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 10px;">

                <div
                    style="display: flex; background: #1b3425; height: 70px; padding: 2.5% 1% 0% 1%; border-radius: 5px 5px 5px 5px;">
                    {{-- <a href="first_verification?store={{ $_GET['store'] }}&page=1&filter=All" id="pending"  
                        class="@if (Route::current()->getName() == 'pending') active_verification @else not_active @endif">
                        Pending</a> --}}
                    <a href="first_verification_confirmed?store={{ $_GET['store'] }}&page=1&filter=All" id="confirmed"
                        class="@if (Route::current()->getName() == 'confirmed') active_verification @else not_active @endif">
                        Confirmed</a>
                    <a href="first_verification_edited?store={{ $_GET['store'] }}&page=1&filter=All" id="edited"
                        class="@if (Route::current()->getName() == 'edited') active_verification @else not_active @endif">
                        Edited</a>
                    <div style="width: 80%;justify-content: flex-end;padding-left: 15px;display: flex;">
                        <a href="first_verification_FVM?store={{ $_GET['store'] }}&page=1&filter=All" id="fvm"
                            class="@if (Route::current()->getName() == 'FVM') active_verification @else not_active @endif">
                            FVM Pending</a>
                        <a href="first_verification_SVM?store={{ $_GET['store'] }}&page=1&filter=All" id="svm"
                            class="@if (Route::current()->getName() == 'SVM') active_verification @else not_active @endif">
                            SVM Pending</a>
                            <a href="first_verification_onHold?store={{ $_GET['store'] }}&page=1&filter=All" id="onhold"
                            class="@if (Route::current()->getName() == 'on_hold') active_verification @else not_active @endif">
                            On Hold</a>
                        <a href="first_verification_archived?store={{ $_GET['store'] }}&page=1&filter=All" id="archived"
                            class="@if (Route::current()->getName() == 'verification_archived') active_verification @else not_active @endif">
                            Archived</a>
                    </div>
                </div>


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


                <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff;">
                    <div style="flex:20; padding: 15px 0px 0px 15px;" class="position-relative">
                        <i style="color: #1b3425;font-size: 15px;display: flex;position: absolute;top: 29px;left: 25px;"
                            class="fas fa-search"></i>
                        <input type="text" id="myInput" onkeyup="search_order(this)" placeholder="Search for order.."
                            title="Type a order number" autocomplete="off" name="query">
                        <div id="results" class="result col"
                            style="padding-top: 15px;display: none;  flex-basis: 0;  flex-grow: 1; max-width: 94%; max-height: 250px; overflow-x: hidden;
                                                                                                                        overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                        </div>
                    </div>
                    <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;">
                        <button id="All" class="@if ((isset($_GET['filter']) && $_GET['filter'] == 'All') || !isset($_GET['filter'])) selected @endif "
                            style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:20;">
                            @if (Route::current()->getName() != 'pending')
                                All
                            @else
                                Newly Arrived
                            @endif
                        </button>

                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Normal') selected @endif " id="normal"
                            style="flex:20;">Normal</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Pre-order') selected @endif " id="preorder"
                            style="flex:20;">Pre-order</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Paid') selected @endif " id="Paid"
                            style="flex:20;border-radius: 0px 10px 10px 0px;border-right: 1px solid; ">Paid
                        </button>
                    </div>

                </div>
                
                @php
                    $status = ['Pending', 'Awaiting', 'Confirmed', 'Canceled'];
                    $status_colors = ['grey', 'yellow', 'green', 'red'];
                @endphp

                <div class="row " style="background-color: white;">
                    <div class="col-md-12">
                        <div class="table-container">

                            <table class="table">
                                <thead class="table__thead">
                                    <tr style="background-color: #ffffff;">
                                        
                                        <th class="table__th">Order Number</th>
                                        <th class="table__th">Name</th>
                                        {{-- <th class="table__th">Email</th> --}}
                                        @if (Route::current()->getName() != 'verification_archived')
                                            <th class="table__th">Date</th>
                                        @endif

                                        <th class="table__th">Country</th>
                                        <th class="table__th">Gateway</th>
                                        @if (Route::current()->getName() == 'FVM' || Route::current()->getName() == 'SVM')
                                            <th class="table__th">WhatsApp</th>

                                        @endif

                                        @if (Route::current()->getName() == 'verification_archived')
                                            <th class="table__th">status</th>
                                        @endif
                                        @if (Route::current()->getName() == 'FVM')
                                            <th class="table__th">Time Out</th>
                                        @endif

                                        @if (Route::current()->getName() == 'on_hold')
                                            <th class="table__th">Holded by</th>
                                        @endif
                                        <th class="table__th">Actions</th>
                                        @if (Route::current()->getName() == 'verification_archived')
                                            <th class="table__th">Taken by</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody class="table__tbody">
                                    @foreach ($orders as $order)
                                        @if (($previous_order == '' || $order->order_number != $previous_order) && $order->id != null)
                                            @php
                                                $previous_order = $order->order_number;
                                                
                                            @endphp

                                            @if (Route::current()->getName() == 'FVM' || Route::current()->getName() == 'SVM')
                                                <?php
                                                
                                                date_default_timezone_set('Africa/Cairo');
                                                $now = date('Y-m-d H:i:s', time());
                                                $date_of_fvm = date('Y-m-d H:i:s', strtotime($order->send_fvm_at));
                                                $date_of_svm = date('Y-m-d H:i:s', strtotime($order->send_svm_at));
                                                
                                                $datetime1 = new DateTime($now);
                                                $datetime2 = new DateTime($date_of_fvm);
                                                $datetime3 = new DateTime($date_of_svm);
                                                
                                                $difference_fvm = $datetime1->diff($datetime2);
                                                
                                                $days = $difference_fvm->d;
                                                $hours = $difference_fvm->h;

                                                $difference_svm = $datetime1->diff($datetime3);
                                                $days_svm = $difference_svm->d;
                                                $hours_svm = $difference_svm->h;

                                                ?>
                                            @endif
                                            <tr class="table-row table-row--chris"
                                                @if (Route::current()->getName() == 'FVM' )
                                                    @if ($days >= 3 && $days < 7) style="background-color: #ffdb0052" @elseif($days >= 7) style="background-color: #ff000014" @endif
                                                @elseif(Route::current()->getName() == 'SVM' )
                                                    @if ($days_svm >= 3 && $days_svm < 7) style="background-color: #ffdb0052" @elseif($days_svm >= 7) style="background-color: #ff000014" @endif
                                                @endif >

                                                <td data-column="order_number" class="table-row__td">
                                                    <div class="table-row__info">
                                                        @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'origin')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a> 

                                                    </div>
                                                </td>
                                                @elseif(isset($_GET['store']) && $_GET['store'] == 'plus_egypt')
                                                    <a style="color: #0062cc;"
                                                        href="https://kshopina-egypt.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                        target="_blank">#{{ $order->order_number }}</a>
                                                    </div>
                                                </td>
                                                @elseif (isset($_GET['store']) && $_GET['store'] == 'plus_kuwait')
                                                        <a style="color: #0062cc;"
                                                            href="https://kshopina-plus-kuwait.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                            target="_blank">#{{ $order->order_number }}</a>
                                                    </div>
                                                </td>
                                                @elseif (isset($_GET['store']) && $_GET['store'] == 'plus_ksa')
                                                        <a style="color: #0062cc;"
                                                            href="https://kshopina-plus.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                            target="_blank">#{{ $order->order_number }}</a>
                                                    </div>
                                                </td>
                                                @elseif (isset($_GET['store']) && $_GET['store'] == 'plus_uae')
                                                        <a style="color: #0062cc;"
                                                            href="https://kshopina-uae.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                            target="_blank">#{{ $order->order_number }}</a>
                                                    </div>
                                                </td>
                                                @endif

                                                @php

                                                    if ($_GET['store'] =='origin') {
                                                        $customer_history_status=['confirmed'=>0,'canceled'=>0,'pending'=>0,'visa'=>0];
                                                        foreach ($customer_history[$order->customer_id] as $key => $shopify_order) {
                                                            
                                                            if ($shopify_order->status == 'confirmed' && ($shopify_order->gateway =="Cash on Delivery (COD)" || $shopify_order->gateway =="manual")) {
                                                                $customer_history_status['confirmed'] += 1;
                                                            } elseif($shopify_order->status == 'canceled' && ($shopify_order->gateway =="Cash on Delivery (COD)" || $shopify_order->gateway =="manual")) {
                                                                $customer_history_status['canceled'] += 1;
                                                            }elseif ($shopify_order->status == 'pending' && ($shopify_order->gateway =="Cash on Delivery (COD)" || $shopify_order->gateway =="manual")) {
                                                                $customer_history_status['pending'] += 1;
                                                            }elseif ($shopify_order->financial_status=='paid' && ($shopify_order->gateway !="Cash on Delivery (COD)" && $shopify_order->gateway !="manual")) {
                                                                $customer_history_status['visa'] += 1;
                                                            }
                                                            
                                                        }
                                                    }
                                                    
                                                    
                                                @endphp

                                                <td data-column="order_name" class="hover-container table-row__td">

                                                    @if ($_GET['store'] =='origin')
                                                        @if ( $customer_history_status['canceled']   >   ($customer_history_status['confirmed'] + $customer_history_status['visa'] ) )

                                                            <i  style="margin-right: 0.6rem;color: #d32020;font-size: 8px;" class="fas fa-circle"></i>
                                                                
                                                        @endif
                                                        @if ( $customer_history_status['pending'] >= 3 )

                                                            <i  style="margin-right: 0.6rem;color: #ffd600;font-size: 8px;" class="fas fa-circle"></i>
                                                            
                                                        @endif
                                                    @endif

                                                    <div class="table-row__info hover-target">{{ $order->name }} 
                                                    </div>
                                                    

                                                    @if ($_GET['store'] =='origin')
                                                            
                                                            
                                                        <aside class="hover-popup">
                                                            <h2 style="font-size:1rem;">{{ $order->email }}</h2>
                                                            <div style="display: flex;align-items: center;justify-content: space-evenly;margin-top: 10px;margin-bottom: 5px;" class="column">
                                                                
                                                                <p style="margin: 5px;color: #1ab95f;font-weight: bolder;margin-bottom: 0rem;font-size: 15px;">
                                                                    Delivered : {{$customer_history_status['confirmed']}}
                                                                </p>
                                                                <p style="font-weight: bold;color: #d32020;margin: 5px;font-size: 15px;margin-bottom: 0rem;">
                                                                    Canceled : {{$customer_history_status['canceled']}}
                                                                </p>
                                                                <br>
                                                                <p style="margin: 5px;font-size: 15px;margin-top: 5px;margin-bottom: 0rem;">
                                                                    Pending : {{$customer_history_status['pending']}}
                                                                </p>
                                                                <p style="margin: 5px;margin-top: 5px;margin-bottom: 0rem;font-size: 15px;">
                                                                    Visa : {{$customer_history_status['visa']}}
                                                                </p>
                                                            </div>
                                                            
                                                        </aside>
                                                    @endif
                                                    
                                                </td>
                                    

                                                @if (Route::current()->getName() != 'verification_archived')
                                                    <td data-column="order_created_at" class="table-row__td">
                                                        <div class="table-row__info">
                                                            {{ $newDate = date('j / n / Y', strtotime($order->created_at)) }}</div>
                                                    </td>
                                                @endif
                                                <td data-column="order_country" class="table-row__td">
                                                    <div class="table-row__info">{{ $order->country }}
                                                </td>
                                                <td data-column="order_gateway" class="table-row__td">
                                                    <div class="table-row__info">{{ $order->gateway }} </div>
                                                </td>
                                                @if (Route::current()->getName() == 'FVM' || Route::current()->getName() == 'SVM')
                                                    <td data-column="message_status" class="table-row__td">
                                                        @if ($order->message_read == 1)
                                                            <div title="Seen" class="whatsapp_mark" style="
                                                                    background-image: url({{asset('seen.png')}});">
                                                            </div>

                                                            @elseif($order->message_delivered == 1)
                                                                <div title="Delivered" class="whatsapp_mark" style="
                                                                        background-image: url({{asset('delivered.png')}});">
                                                                </div>

                                                                
                                                            @elseif($order->message_sent == 1)
                                                                <div title="Sent" class="whatsapp_mark" style="
                                                                        background-image: url({{asset('sent.png')}});">
                                                                </div>
                                                                
                                                            @else
                                                                <div title="Failed" class="whatsapp_mark" style="
                                                                        background-image: url({{asset('fail.png')}});">
                                                                </div>
                                                                
                                                            @endif
                                                    </td>
                                                @endif

                                                @if (Route::current()->getName() == 'verification_archived')
                                                    @if ($order->verified == 3)
                                                        <td data-column="order_canceled" class="table-row__td">
                                                            <div class="table-row__info">Canceled</div>
                                                        </td>
                                                    @else
                                                        <td data-column="order_confirmed" class="table-row__td">
                                                            <div class="table-row__info">Confirmed </div>
                                                        </td>
                                                    @endif
                                                @endif
                                    
                                                @if (Route::current()->getName() == 'FVM')
                                                    <td data-column="order_gateway" class="table-row__td">
                                                        <div class="table-row__info">
                                                            {{ $days }} Days {{ $hours }} Hours
                                                        </div>
                                                    </td>
                                                @endif

                                                {{-- holded by --}}
                                                @if (Route::current()->getName() == 'on_hold')
                                                    <td data-column="order_gateway" class="table-row__td">
                                                        <div class="table-row__info">
                                                            {{ $order->fulfilled_by }}
                                                        </div>
                                                    </td>
                                                @endif

                                                @if (Route::current()->getName() != 'pending' && Route::current()->getName() != 'verification_archived')
                                                    <td id="actions" data-column="order_actions" class="table-row__td" style="width: 140px;">
                                                        <div class="table-row__info">
                                                            <div id="action{{ $order->id }}" style="width: max-content;display: flex;"
                                                                class="row">

                                                                <button class="actions_btn_icon" type="button" title="actions" onclick="show_actions('{{ $order->id }}')" >
                                                                    <i class="fas fa-ellipsis-h menu_icon" ></i>
                                                                </button>
                                                                <div id="menu_{{ $order->id }}" class="col actions_contain" style="display:none;" >
                                                                    @if ((Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited') && isset($_GET['filter']) && $_GET['filter'] != 'Pre-order')
                                                                        <button class="action_btn" id="{{ $order->order_number }}_"  onclick="preorder(this,'{{ $order->order_number }}')" 
                                                                            type="button" title="pre order" >Pre-order</button>
                                                                    @endif
                                                                    @if (Route::current()->getName() == 'on_hold')
                                                                        <button class="action_btn" onclick="hold_release(this,'{{ $order->order_number }}','{{ $order->store }}')" type="button"
                                                                            title="Release">Release</button>
                                                                    @elseif(Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited')
                                                                        <button class="action_btn" onclick="placed_on_hold(this,'{{ $order->order_number }}','{{ $order->store }}')" type="button"
                                                                            title="on hold">HOLD</button>
                                                                    @endif

                                                                    @if (Route::current()->getName() == 'FVM')

                                                                        <button class="action_btn" onclick="submit_order(this,'{{ $order->id }}')" type="button"
                                                                            title="Confirm Order">Confirm</button>
                                                                    @endif

                                                                    <button class="action_btn" style="color:#ce0808e6; " id="{{ $order->order_number }}" onclick="cancel(this)" type="button"
                                                                        title="cancel">Cancel</button>
                                                                </div>
                                                            {{--  @if ((Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited') && isset($_GET['filter']) && $_GET['filter'] != 'Pre-order')
                                                                    <button id="{{ $order->order_number }}_" style="font-weight: 600;color: #426851;margin-right: 5px;"
                                                                        onclick="preorder(this,'{{ $order->order_number }}')" type="button"
                                                                        class="btn btn-primary" title="pre order">
                                                                        Pre-Order
                                                                    </button>
                                                                @endif

                                                                @if (Route::current()->getName() == 'on_hold')
                                                                    <button style="margin-right: 5px;background-color: #e17f00;color: white;display: flex;align-items: center;border-color: transparent;"
                                                                        onclick="hold_release(this,'{{ $order->order_number }}','{{ $order->store }}')" type="button"
                                                                        class="btn btn-primary" title="Release">
                                                                        Release
                                                                    </button>
                                                                @elseif(Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited')
                                                                    <button style="margin-right: 5px;background-color: #e17f00;color: white;display: flex;align-items: center;border-color: transparent;"
                                                                        onclick="placed_on_hold(this,'{{ $order->order_number }}','{{ $order->store }}')" type="button"
                                                                        class="btn btn-primary" title="on hold">
                                                                        HOLD
                                                                    </button>
                                                                @endif --}}

                                                                {{-- <button style="margin-right: 5px;background-color: #ce0808e6;color: white;"
                                                                    id="{{ $order->order_number }}" onclick="cancel(this)" type="button"
                                                                    class="btn btn-primary" title="cancel">
                                                                    <i class="fas fa-ban"></i>
                                                                </button> --}}

                                                                {{-- @if (Route::current()->getName() == 'FVM')
                                                                    <button
                                                                        style="background-color: #328d32;border-color: #328d32;color: white;margin-right: 5px;"
                                                                        id="{{ $order->order_number }}" type="button"
                                                                        onclick="submit_order(this,'{{ $order->id }}')" class=" btn btn-primary">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                @endif --}}
                                                                {{-- @if (Route::current()->getName() == 'FVM')
                                                                    <button style="margin-right: 3px;" id="{{ $order->order_number }}" type="button"  onclick="sendMail(this)"
                                                                        class=" btn btn-primary">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </button>
                                                                @endif --}}
                                                                <button style="margin-right: 5px;margin-left: 5px;border: none;background: transparent;cursor: pointer;" 
                                                                    id="{{ $order->id }}" onclick="details(this)"
                                                                    type="button" class="{{ $order->order_number }} "  title="details">
                                                                    <i class="fas fa-info-circle" style="font-size: 18px; color: #ca9d48;"></i>
                                                                </button>

                                                                {{-- <div id="arrow_id{{ $order->order_number }}"
                                                                    style="display: inherit;cursor: pointer;justify-content: center;flex-direction: column;">
                                                                    <i onclick="create_task(this)" id="assign_{{ $order->order_number }}"
                                                                        class="fas fa-chevron-right"></i>
                                                                </div> --}}
                                                            </div>
                                                        </div>

                                                    </td>
                                                @elseif(Route::current()->getName() == 'verification_archived')
                                                    <td id="actions" data-column="order_actions" class="table-row__td">
                                                        <div class="table-row__info">
                                                            <div id="action{{ $order->id }}" style="width: max-content;display: inline-block;"
                                                                class="row">
                                                                <button style="margin-right: 5px;" id="{{ $order->id }}" onclick="details(this)"
                                                                    type="button" class="{{ $order->order_number }} btn btn-primary">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </td>
                                                @else
                                                    @if (isset($_GET['filter']) && $_GET['filter'] == 'All')
                                                        <td id="actions" data-column="order_actions" class="table-row__td">
                                                            <div class="table-row__info">
                                                                <div id="action{{ $order->id }}" style="width: max-content;display: inline-block;"
                                                                    class="row">
                                                                    <button id="{{ $order->order_number }}" onclick="preorder(this,'{{ $order->order_number }}')" type="button"
                                                                        class="btn btn-primary">
                                                                        Pre-order
                                                                    </button>
                                                                    {{-- <button id="#{{ $order->order_number }}" onclick="paid(this)" type="button"
                                                                        class="btn btn-primary">
                                                                        Paid
                                                                    </button> --}}
                                                                    <button style="margin-right: 5px;" id="{{ $order->id }}" onclick="details(this)"
                                                                        type="button" class="{{ $order->order_number }} btn btn-primary">
                                                                        <i class="fas fa-info-circle"></i>
                                                                    </button>
                                                                    {{-- <div id="arrow_id{{ $order->order_number }}"
                                                                        style="display: inherit;cursor: pointer;justify-content: center;flex-direction: column;">
                                                                        <i onclick="create_task(this)" id="assign_{{ $order->order_number }}"
                                                                            class="fas fa-chevron-right"></i>
                                                                    </div> --}}
                                                                </div>
                                                            </div>

                                                        </td>
                                                    @else
                                                        <td id="actions" data-column="order_actions" class="table-row__td">
                                                            <div class="table-row__info">
                                                                <div id="action{{ $order->id }}" style="width: max-content;display: inline-block;"
                                                                    class="row">
                                                                    <button id="{{ $order->order_number }}" style="margin-right: 5px;"
                                                                        onclick="sendMail(this)" type="button" class="btn btn-primary">
                                                                        Send FVM
                                                                    </button>
                                                                    <button style="margin-right: 5px;background-color: #ce0808e6;color: white;"
                                                                        id="{{ $order->order_number }}" onclick="cancel(this)" type="button"
                                                                        class="btn btn-primary">
                                                                        Cancel
                                                                    </button>
                                                                    @if ($_GET['filter'] == 'Paid')
                                                                        <button style="margin-right: 5px;" id="{{ $order->id }}" onclick="details(this)"
                                                                            type="button" class="{{ $order->order_number }} btn btn-primary">
                                                                            <i class="fas fa-info-circle"></i>
                                                                        </button>
                                                                    @endif

                                                                    {{-- <div id="arrow_id{{ $order->order_number }}"
                                                                        style="margin-left: 5px;display: inherit;cursor: pointer;justify-content: center;flex-direction: column;">
                                                                        <i onclick="create_task(this)" id="assign_{{ $order->order_number }}"
                                                                            class="fas fa-chevron-right"></i>
                                                                    </div> --}}
                                                                </div>
                                                            </div>

                                                        </td>
                                                    @endif
                                                @endif
                                                
                                                @if (Route::current()->getName() == 'verification_archived')
                                                    <td id="actions" data-column="order_actions" class="table-row__td">
                                                        <div class="table-row__info">{{ $order->action_taken_by }}</div>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

    
                    @foreach ($orders as $order)
                    
                        <div id="pop{{ $order->id }}" class="overlay">
                            <div class="popup" style="width: 55%;">
                                <h2 style="margin-bottom: 30px">#{{ $order->order_number }}</h2>
                                <a id='close' class="close" href="#">&times;</a>

                                <div class="container content">
                                     <div class="not_editable_data_contain">
                                        <div style="display: flex;align-items: center;justify-content: start;margin-left: 28px;"
                                            class="row">
                                            <i style="margin-right: 8px;color: #1b3425;" class="icon far fa-user" data-feather="user"></i>
                                            <span>{{ $order->name }}</span>
                                        </div>
                                        <div style="display: flex;align-items: center;justify-content: start;margin-left: 28px;"
                                            class="row">
                                            <i style="margin-right: 8px;color: #1b3425;" class="icon far fa-envelope" data-feather="user"></i>

                                            <span id="old_email{{ $order->id }}">{{ $order->email }}</span>

                                            <form class="email-form " action="edit_email" method="get">
                                                @csrf
                                                <div class="pseudo-search" id="new_email{{ $order->id }}">
                                                    <input style="font-size: 14px;" id="email_field{{ $order->id }}" name="new_email"
                                                        type="email" placeholder="Enter the new email..." autofocus required>

                                                    <input name="order_number" value="{{ $order->order_number }}" type="text" hidden
                                                        readonly>

                                                    <button style="padding: 5px;" class="fas fa-check email_btn" type="submit"></button>
                                                </div>

                                            </form>
                                            <button style="background-color: transparent;" type="button" class="btn  ">
                                                <a class="create"><i class="far fa-edit" style="color: #1b3425;"
                                                        onclick="edit_email('{{ $order->email }}','{{ $order->id }}')"></i></a>
                                            </button>

                                        </div>
                                        @if ($order->province != null || $order->province != '')
                                            <div style="display: flex;align-items: center;justify-content: start;margin-left: 28px;"
                                                class="row">
                                                <i style="margin-right: 8px;color: #1b3425;" class="icon fas fa-map-marker-alt" data-feather="user"></i>
                                                <span>{{ $order->province }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="editable_data_contain">
                                        <div style="position: absolute;left: 88%;">
                                            <button id="##{{ $order->id }}" onclick="send_correct_whatsApp_message(this)"  title="Send WhatsApp to edit Info."
                                                style="font-size: 18px;font-weight: 600;background-color: transparent;color: #1b3425;" type="button"
                                                class="btn "><i class="fas fa-paper-plane"></i></button>
                                        </div>
                                        <div>
                                            <div style="display: flex;align-items: baseline;justify-content: start;"
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid')) class="row" @endif>
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                                    {{-- <input onclick="checkBoxClicked(this)" type="checkbox" class="select-item checkbox"
                                                        name="select-item" value="C" /> --}}
                                                @endif
                                                <div style="margin-top: 8px;align-items: center;justify-content: start;margin-left: 25px;
                                                display: flex;flex-direction: row;"
                                                    class="row">
                                                    <i style="margin-right: 8px;color: #1b3425; " class="icon fas fa-globe-africa" data-feather="user"></i>
                                                    <span style="width:35rem;">{{ $order->country }}</span>
                                                </div>
                                            </div>
                                            <div style="display: flex;align-items: baseline;justify-content: start;"
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid')) class="row" @endif>
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                                    <input onclick="checkBoxClicked(this)" type="checkbox" class="select-item checkbox"
                                                        name="select-item" value="P" />
                                                @endif

                                                <div style="margin-top: 8px;align-items: center;justify-content: start;margin-left: 25px;
                                                     display: flex;flex-direction: row;"
                                                    class="row">
                                                    <i style="margin-right: 8px;color: #1b3425;" class="icon fab fa-whatsapp" data-feather="user"></i>

                                                    @php

                                                        $country_phone_codes = [
                                                            "UK"=> "44",
                                                            "USA"=> "1",
                                                            "Algeria"=> "213",
                                                            "Andorra"=> "376",
                                                            "Angola"=> "244",
                                                            "Anguilla"=> "1264",
                                                            "Antigua & Barbuda"=> "1268",
                                                            "Argentina"=> "54",
                                                            "Armenia"=> "374",
                                                            "Aruba"=> "297",
                                                            "Australia"=> "61",
                                                            "Austria"=> "43",
                                                            "Azerbaijan"=> "994",
                                                            "Bahamas"=> "1242",
                                                            "Bahrain"=> "973",
                                                            "Bangladesh"=> "880",
                                                            "Barbados"=> "1246",
                                                            "Belarus"=> "375",
                                                            "Belgium"=> "32",
                                                            "Belize"=> "501",
                                                            "Benin"=> "229",
                                                            "Bermuda"=> "1441",
                                                            "Bhutan"=> "975",
                                                            "Bolivia"=> "591",
                                                            "Bosnia Herzegovina"=> "387",
                                                            "Botswana"=> "267",
                                                            "Brazil"=> "55",
                                                            "Brunei"=> "673",
                                                            "Bulgaria"=> "359",
                                                            "Burkina Faso"=> "226",
                                                            "Burundi"=> "257",
                                                            "Cambodia"=> "855",
                                                            "Cameroon"=> "237",
                                                            "Canada"=> "1",
                                                            "Cape Verde Islands"=> "238",
                                                            "Cayman Islands"=> "1345",
                                                            "Central African Republic"=> "236",
                                                            "Chile"=> "56",
                                                            "China"=> "86",
                                                            "Colombia"=> "57",
                                                            "Comoros"=> "269",
                                                            "Congo"=> "242",
                                                            "Cook Islands"=> "682",
                                                            "Costa Rica"=> "506",
                                                            "Croatia"=> "385",
                                                            "Cuba"=> "53",
                                                            "Cyprus North"=> "90392",
                                                            "Cyprus South"=> "357",
                                                            "Czech Republic"=> "42",
                                                            "Denmark"=> "45",
                                                            "Djibouti"=> "253",
                                                            "Dominica"=> "1809",
                                                            "Dominican Republic"=> "1809",
                                                            "Ecuador"=> "593",
                                                            "Egypt"=> "20",
                                                            "El Salvador"=> "503",
                                                            "Equatorial Guinea"=> "240",
                                                            "Eritrea"=> "291",
                                                            "Estonia"=> "372",
                                                            "Ethiopia"=> "251",
                                                            "Falkland Islands"=> "500",
                                                            "Faroe Islands"=> "298",
                                                            "Fiji"=> "679",
                                                            "Finland"=> "358",
                                                            "France"=> "33",
                                                            "French Guiana"=> "594",
                                                            "French Polynesia"=> "689",
                                                            "Gabon"=> "241",
                                                            "Gambia"=> "220",
                                                            "Georgia"=> "7880",
                                                            "Germany"=> "49",
                                                            "Ghana"=> "233",
                                                            "Gibraltar"=> "350",
                                                            "Greece"=> "30",
                                                            "Greenland"=> "299",
                                                            "Grenada"=> "1473",
                                                            "Guadeloupe"=> "590",
                                                            "Guam"=> "671",
                                                            "Guatemala"=> "502",
                                                            "Guinea"=> "224",
                                                            "Guinea - Bissau"=> "245",
                                                            "Guyana"=> "592",
                                                            "Haiti"=> "509",
                                                            "Honduras"=> "504",
                                                            "Hong Kong"=> "852",
                                                            "Hungary"=> "36",
                                                            "Iceland"=> "354",
                                                            "India"=> "91",
                                                            "Indonesia"=> "62",
                                                            "Iran"=> "98",
                                                            "Iraq"=> "964",
                                                            "Ireland"=> "353",
                                                            "Israel"=> "972",
                                                            "Italy"=> "39",
                                                            "Jamaica"=> "1876",
                                                            "Japan"=> "81",
                                                            "Jordan"=> "962",
                                                            "Kazakhstan"=> "7",
                                                            "Kenya"=> "254",
                                                            "Kiribati"=> "686",
                                                            "Korea North"=> "850",
                                                            "Korea South"=> "82",
                                                            "Kuwait"=> "965",
                                                            "Kyrgyzstan"=> "996",
                                                            "Laos"=> "856",
                                                            "Latvia"=> "371",
                                                            "Lebanon"=> "961",
                                                            "Lesotho"=> "266",
                                                            "Liberia"=> "231",
                                                            "Libya"=> "218",
                                                            "Liechtenstein"=> "417",
                                                            "Lithuania"=> "370",
                                                            "Luxembourg"=> "352",
                                                            "Macao"=> "853",
                                                            "Macedonia"=> "389",
                                                            "Madagascar"=> "261",
                                                            "Malawi"=> "265",
                                                            "Malaysia"=> "60",
                                                            "Maldives"=> "960",
                                                            "Mali"=> "223",
                                                            "Malta"=> "356",
                                                            "Marshall Islands"=> "692",
                                                            "Martinique"=> "596",
                                                            "Mauritania"=> "222",
                                                            "Mayotte"=> "269",
                                                            "Mexico"=> "52",
                                                            "Micronesia"=> "691",
                                                            "Moldova"=> "373",
                                                            "Monaco"=> "377",
                                                            "Mongolia"=> "976",
                                                            "Montserrat"=> "1664",
                                                            "Morocco"=> "212",
                                                            "Mozambique"=> "258",
                                                            "Myanmar"=> "95",
                                                            "Namibia"=> "264",
                                                            "Nauru"=> "674",
                                                            "Nepal"=> "977",
                                                            "Netherlands"=> "31",
                                                            "New Caledonia"=> "687",
                                                            "New Zealand"=> "64",
                                                            "Nicaragua"=> "505",
                                                            "Niger"=> "227",
                                                            "Nigeria"=> "234",
                                                            "Niue"=> "683",
                                                            "Norfolk Islands"=> "672",
                                                            "Northern Marianas"=> "670",
                                                            "Norway"=> "47",
                                                            "Oman"=> "968",
                                                            "Palau"=> "680",
                                                            "Panama"=> "507",
                                                            "Papua New Guinea"=> "675",
                                                            "Paraguay"=> "595",
                                                            "Peru"=> "51",
                                                            "Philippines"=> "63",
                                                            "Poland"=> "48",
                                                            "Portugal"=> "351",
                                                            "Puerto Rico"=> "1787",
                                                            "Qatar"=> "974",
                                                            "Reunion"=> "262",
                                                            "Romania"=> "40",
                                                            "Russia"=> "7",
                                                            "Rwanda"=> "250",
                                                            "San Marino"=> "378",
                                                            "Sao Tome & Principe"=> "239",
                                                            "Saudi Arabia"=> "966",
                                                            "Senegal"=> "221",
                                                            "Serbia"=> "381",
                                                            "Seychelles"=> "248",
                                                            "Sierra Leone"=> "232",
                                                            "Singapore"=> "65",
                                                            "Slovak Republic"=> "421",
                                                            "Slovenia"=> "386",
                                                            "Solomon Islands"=> "677",
                                                            "Somalia"=> "252",
                                                            "South Africa"=> "27",
                                                            "Spain"=> "34",
                                                            "Sri Lanka"=> "94",
                                                            "St. Helena"=> "290",
                                                            "St. Kitts"=> "1869",
                                                            "St. Lucia"=> "1758",
                                                            "Sudan"=> "249",
                                                            "Suriname"=> "597",
                                                            "Swaziland"=> "268",
                                                            "Sweden"=> "46",
                                                            "Switzerland"=> "41",
                                                            "Syria"=> "963",
                                                            "Taiwan"=> "886",
                                                            "Tajikstan"=> "7",
                                                            "Thailand"=> "66",
                                                            "Togo"=> "228",
                                                            "Tonga"=> "676",
                                                            "Trinidad & Tobago"=> "1868",
                                                            "Tunisia"=> "216",
                                                            "Turkey"=> "90",
                                                            "Turkmenistan"=> "7",
                                                            "Turkmenistan"=> "993",
                                                            "Turks & Caicos Islands"=> "1649",
                                                            "Tuvalu"=> "688",
                                                            "Uganda"=> "256",
                                                            "Ukraine"=> "380",
                                                            "United Arab Emirates"=> "971",
                                                            "Uruguay"=> "598",
                                                            "Uzbekistan"=> "998",
                                                            "Vanuatu"=> "678",
                                                            "Vatican City"=> "379",
                                                            "Venezuela"=> "58",
                                                            "Vietnam"=> "84",
                                                            "Virgin Islands - British"=> "1284",
                                                            "Virgin Islands - US"=> "1340",
                                                            "Wallis & Futuna"=> "681",
                                                            "Yemen"=>"967",
                                                            "Zambia"=> "260",
                                                            "Zimbabwe"=> "263",
                                                        ];
                                                        
                                                        $phone_number = str_replace("+", "", $order->phone_number);
                                                        $phone_number = str_replace(" ", "", $phone_number);
                                                        $phone_number = str_replace("-", "", $phone_number);

                                                        $phone_number = str_replace("(", "", $phone_number);
                                                        $phone_number = str_replace(")", "", $phone_number);
                                                        $phone_number = str_replace(" ", "", $phone_number);

                                                        
                                                        for ($i=0; $i < strlen($phone_number) ; $i++) { 
                                                            if ($phone_number[$i] != '0') {
                                                                $phone_number = substr($phone_number, $i);
                                                                break;
                                                            }
                                                        }

                                                        if (isset($country_phone_codes[$order->country])) {
                                                            for ($i=0; $i < strlen($country_phone_codes[$order->country]) ; $i++) { 
                                                                if ($phone_number[$i] != $country_phone_codes[$order->country][$i]) {
                                                                    $phone_number = $country_phone_codes[$order->country] .$phone_number ;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        
                                         
                                                        
                                                    @endphp

                                                    <span  id="old_phone{{ $order->id }}"><a target="blank" href="https://wa.me/{{ $phone_number }}">{{ $order->phone_number }}</a>  </span>

                                                    <form class="phone-form" action="edit_phone" method="get">
                                                        @csrf
                                                        <div class="pseudo-search" id="new_phone{{ $order->id }}">
                                                            <input style="font-size: 14px;" id="phone_field{{ $order->id }}" name="new_phone"
                                                                type="text" placeholder="Enter the new phone number..." autofocus required>
        
                                                            <input name="order_number" value="{{ $order->order_number }}" type="text" hidden id="order_number_"
                                                                readonly>
        
                                                            <button style="padding: 5px;" class="fas fa-check phone_btn" type="submit"></button>
                                                        </div>
                                                    </form>
                                                    <button style="background-color: transparent;" type="button" class="btn">
                                                        <a class="create"><i class="far fa-edit" style="color: #1b3425;"
                                                                onclick="edit_phone('{{ $order->phone_number }}','{{ $order->id }}')"></i></a>
                                                    </button>
                                                    @if (Route::current()->getName() == 'FVM')
                                                        <button style="font-size: 10px;background-color: #cb9d48;color: white;border-radius: 30px;" 
                                                            onclick="resend_FVM('{{ $order->order_number }}',this , '{{ $order->id }}')" type="button" class="btn" title="resend FVM">
                                                            <span style="margin-right: 5px;font-size: 11px;"> FVM </span> <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>

                                            </div>

                                            <div style="display: flex;align-items: baseline;justify-content: start;"
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid')) class="row" @endif>
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                                    <input onclick="checkBoxClicked(this)" type="checkbox" class="select-item checkbox"
                                                        name="select-item" value="T" />
                                                @endif
                                                <div style="margin-top: 8px;align-items: center;justify-content: start;margin-left: 25px;
                                                display: flex;flex-direction: row;"
                                                    class="row">
                                                    <i style="margin-right: 15px;color: #1b3425;" class="icon fas fa-map-marker-alt" data-feather="user"></i>
                                                    <span style="width:35rem;" >{{ $order->city }}</span>
                                                </div>
                                            </div>

                                            <div style="display: flex;align-items: baseline;justify-content: start;"
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid')) class="row" @endif>
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                                    <input onclick="checkBoxClicked(this)" type="checkbox" class="select-item checkbox"
                                                        name="select-item" value="A" />
                                                @endif
                                                <div style="margin-top: 8px;align-items: center;justify-content: start;margin-left: 25px;
                                                display: flex;flex-direction: row;"
                                                    class="row">
                                                    <i style="margin-right: 8px;color: #1b3425;" class="icon fas fa-map-marked-alt" data-feather="user"></i>
                                                    <span style="width:35rem;">{{ $order->address }}</span>
                                                </div>
                                            </div>

                                            <div style="display: flex;align-items: baseline;justify-content: start;"
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid')) class="row" @endif>
                                                @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                                    <input onclick="checkBoxClicked(this)" type="checkbox" class="select-item checkbox"
                                                        name="select-item" value="R" />
                                                @endif
                                                <div style="margin-top: 8px;align-items: center;justify-content: start;margin-left: 25px;
                                                display: flex;flex-direction: row;"
                                                    class="row">
                                                    <i style="margin-right: 15px;color: #1b3425;" class="icon fas fa-building" data-feather="user"></i>
                                                    <span style="width:35rem;">{{ $order->apartment }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <div id="items{{ $order->id }}"  class="items_details"
                                            style="display: inline-block; width: 100%;">

                                        </div>
                                </div>


                                <div style="width: 100%">
                                    @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited' || (isset($_GET['filter']) && $_GET['filter'] == 'Paid'))
                                        <div style="margin-top: 5px;justify-content: center;display: flex;flex-direction: column;align-items: center;">
                                            <div>
                                                <button id="#{{ $order->id }}" onclick="submit_order(this,'{{ $order->id }}')"
                                                    style="font-size: 14px;letter-spacing: .8px;font-weight: 600;width: 300px;border-radius: 8px;margin-bottom: 10px;"
                                                    type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                            <div>
                                                <a target="blank" href="edit_manually?token={{ $order->token }}"
                                                    style="font-size: 14px;letter-spacing: .8px;font-weight: 600;background-color: #63646d;border-color: #63646d;
                                                    color: white;width: 300px;border-radius: 8px;margin-bottom: 10px;"
                                                    class="btn btn-primary">Edit</a>
                                            </div>
                                        </div>
                                    @else
                                        <div style="margin-top: 30px;justify-content: flex-end;display: flex;justify-content: center;">
                                            <button id="#{{ $order->id }}" onclick="ignore(this)"
                                                style="font-size: 14px;letter-spacing: .6px;background-color: #ce0808e6;border-color: #ce0808e6;color: white;
                                                width: 300px;border-radius: 8px;margin-bottom: 10px;" type="button"class="btn btn-primary">IGNORE</button>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                    @endforeach

                    <div id="tasks_popup" class="overlay">
                        <div class="tasks_popup">
                            <div class="container">
                                <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <a id='close' class="close" href="#">&times;</a>
                            <div class="container content">


                                <form id="assign_form" method="POST" action="assign_task" enctype="multipart/form-data">
                                    @csrf
                                    <input name='system_name' value="Verification" hidden readonly>
                                    <div class="user-details">
                                        <div class="input-box">
                                            <span class="details">Order number</span>
                                            <input value="#order_number" name="order_number" id="order_number" type="text"
                                                placeholder="Enter your name" readonly>

                                            {{-- <div style="width: 45%;"  class="column">
                                                        <span class="details">ID</span>
                                                        <input value="1" name="id" id="task_id" type="text" placeholder="Enter your name" required disabled>

                                                    </div>
                                                    <div style="width: 45%;"  class="column">
                                                        <span class="details">Order number</span>
                                                        <input value="#order_number" name="order_number" id="order_number" type="text" placeholder="Enter your name" required disabled>

                                                    </div> --}}
                                        </div>
                                        <div class="input-box">
                                            <span class="details">Assign To</span>
                                            <select name="assign_to" id="assign_to" class="details" placeholder="Colleague">

                                            </select required>

                                        </div>



                                        <div class="input-box">
                                            <span class="details">Comment</span>
                                            <textarea maxlength="250" style="height: 100px;overflow: hidden;resize: none;" name="task" id="task"
                                                cols="30" rows="3" required></textarea>
                                        </div>
                                        <div class="input-box">
                                            <span class="details">Deadline date</span>
                                            <input id="deadline" name="deadline" value="" type="date"
                                                min="{{ date('Y-m-d', time()) }}" placeholder="Enter the date" required>
                                        </div>
                                        <div class="input-box">
                                            <span class="details">Image</span>
                                            <input id="image" style="margin-top: 5px;border: none;" name="image" type="file"
                                                placeholder="Enter the date">
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

                <div class="pagination">

                    {{-- data --}}
                    <?php

                            $orders_per_page = 15;
                            $pages = ceil($number_of_orders[0]->NumberOfOrders / $orders_per_page);
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

                        @if ( $_GET['page'] > 10 )  

                            @if (isset($_GET['filter']))
                                <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter={{ $_GET['filter'] }}">&laquo;</a>
                            @else
                                <a href="?store={{ $_GET['store'] }}&page={{ ($count )-10 }}&filter=All">&laquo;</a>    
                            @endif
                            @elseif ( $_GET['page'] >= 1 && $_GET['page'] <= 10 )  

                                @if (isset($_GET['filter']))
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter={{ $_GET['filter'] }}">&laquo;</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{ ($count )}}&filter=All">&laquo;</a>    
                                @endif
                        @else

                            <a href="#">&laquo;</a>

                        @endif
                    
                        
                    {{-- numbers --}} 
                        @for ($i = $count; $i <=  $count2  ; $i++)
                            @if ($_GET['page'] == $i) 
                                @if (isset($_GET['filter']))
                                    <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter={{ $_GET['filter'] }}" > {{$i}}</a>
                                @else
                                    <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter=All" >{{$i}}</a>    
                                @endif
                            @else
                                @if (isset($_GET['filter']))
                                    <a href="?store={{ $_GET['store'] }}&page={{$i}}&filter={{ $_GET['filter'] }}" > {{$i}}</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{$i}}&filter=All" >{{$i}}</a>    
                                @endif
                            @endif
                        @endfor

                        {{-- left --}}
                            {{--  @if ($_GET['page'] != 1)
                                    
                                @if (isset($_GET['filter']))
                                    <a href="?store={{ $_GET['store'] }}&page={{ $_GET['page']-1 }}&filter={{ $_GET['filter'] }}" > {{$_GET['page']-1}}</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{ $_GET['page']-1 }}&filter=All" >{{$_GET['page']-1}}</a>    
                                @endif
                                
                            @endif --}}
                            
                        {{-- middle --}}
                            
                            {{--  @if (isset($_GET['filter'])) 

                                    <a class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter={{ $_GET['filter']}}" > {{ $_GET['page'] }}</a>
                                    @else
                                        <a class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter=All" >{{ $_GET['page'] }}</a>
                                    @endif
                            --}}
                            
                        {{-- right --}}
                            {{--  @if ($_GET['page'] != $pages )
                                
                                @if (isset($_GET['filter']))  
                                    <a href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] +1 }}&filter={{ $_GET['filter']}}" >{{$_GET['page']+1}}</a>
                                @else
                                    <a href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] +1 }}&filter=All" >{{$_GET['page']+1}}</a> 
                                @endif

                            @endif  --}}
                    {{-- numbers --}} 
                    {{-- ymen --}} 

                        @if ($_GET['page'] != $pages )

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
                            Page {{ $_GET['page'] }} of {{ceil($number_of_orders[0]->NumberOfOrders /15) }}
                        </p>
                    @else
                    <a href="#">&laquo;</a>
                    <a href="#">&raquo;</a>
                    @endif

                </div> 

                <div style="z-index: 4;" id="export_popup" class="overlay">
                    <div class="tasks_popup" style="margin: 150px auto;height: 40%;">
                        <div class="container">
                            <div class="title">
                                <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                            </div>
                        </div>
                        <a id='close' class="closee" href="#">&times;</a>
                            <form action="/first_verification_export?store={{ $_GET['store'] }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="container content"  style="margin-top: 2rem;display: flex;justify-content: center;height: 2.5rem;flex-direction: row;align-items: center;">
                                    <label for="from" style="margin-bottom: 0px;margin-right: 1rem;">From :</label>
                                    <input min="2022-02-24"  type="date" name="from" id="from_export_archived" required style=" border: 1px solid black;border-radius: 18px;    padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                                    <label for="to"style="margin-bottom: 0px;margin-right: 1rem;margin-left: 5rem;">To :</label>
                                    <input max="{{date("Y-m-d",strtotime('+1 days'))}}" type="date" name="to" id="to_export_archived" required style="border: 1px solid black;border-radius: 18px; padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                                </div>
                                <div style="margin-top: 25px;display: flex;justify-content: center;">
                                    <button {{-- onclick="export_archived(this,'{{ $_GET['store'] }}','{{ $_GET['archived'] }}')" --}} type="submit" class="btn btn-primary"
                                        style="border-radius: 15px;position: relative;top: 0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600; padding: 8px 40px 5px 40px;">
                                        Submit
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            

    <script>
        var current_menu_id='';

        $(document).on("click", function (ele) {

            if (ele['target'].className.search("menu_icon") == -1) {
                var dropdown_actions = document. getElementsByClassName('actions_contain'); 
                for (var i=0;i<dropdown_actions.length;i+=1){
                    dropdown_actions[i].style.display = 'none';
                }
                current_menu_id="";

            }/* else{
                show_actions(ele['target'].id);

            } */
            
            function show_actions(id){

                console.log(current_menu_id);

                if (current_menu_id == '') {
                    $('#menu_'+id ).show();
                    current_menu_id = id;


                } else {
                    $('#menu_'+id ).hide();
                    current_menu_id = "";

                }

            }
        });
        function show_actions(id){

            console.log(current_menu_id);

            if (current_menu_id == '') {
                $('#menu_'+id ).show();
                current_menu_id = id;


            } else {
                $('#menu_'+id ).hide();
                current_menu_id = "";

            }
        }


    </script>

    <script>
        function resend_FVM(order_number,elemant ,id){
            $(elemant).html(
                '<div style="align-items: center;justify-content: center;display: flex;"><div class="loader" style="border: 2px solid #f3f3f3;width: 15px;height: 15px;"></div></div>'
            );

            $.ajax({
                url: "resend_fvm_message",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_number: order_number,
                },
                success: function(response) {
                    if (response) {
                        
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'FVM message is resent now!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#pop'+id).hide();
                        
                    }
                    
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

        }
        function edit_phone(phone, id){

            $("#phone_field" + id).val(phone);
            $('#new_phone' + id).toggle();
            $('#old_phone' + id).toggle();

        }
    </script>

    <script>
        var problem = "";
        var storeee;
        storeee = window.location.href;
        storeee = new URL(storeee);

        function verification_export(){
            $('#export_popup' ).show();
        }

        function checkBoxClicked(checkbox) {

            if (checkbox.checked == true) {
                problem = problem + checkbox.value;
                console.log(problem);
            } else {
                problem = problem.replaceAll(checkbox.value, '');
                console.log(problem);
            }
        }
        $("#filters button").click(function() {

            var storee = storeee.searchParams.get("store");

            if (this.id == "All") {
                window.location.href = "?store=" + storee + "&page=1&filter=All";

            } else if (this.id == "normal") {
                window.location.href = "?store=" + storee + "&page=1&filter=Normal";

            } else if (this.id == "preorder") {
                window.location.href = "?store=" + storee + "&page=1&filter=Pre-order";

            } else {
                window.location.href = "?store=" + storee + "&page=1&filter=Paid";

            }
            selected = this.id;
        });

        function sendMail(elemant) {

            var id = (elemant.id);

            var storee = storeee.searchParams.get("store");

            $(elemant.parentElement).html(
                '<div id="' + id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            $.ajax({
                url: "verification_mail",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: id,
                    store: storee
                },
                success: function(response) {
                    if (elemant.id.substring(0, 1) == '#') {
                        $(elemant.id).html("Action taken");
                    } else {
                        $("#" + elemant.id).html("Action taken");
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function preorder(elemant, order_number) {

            $(elemant.parentElement.parentElement).html(
                '<div id="' + elemant.id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );
            $.ajax({
                url: "preorder",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order_number,
                },
                success: function(response) {
                    console.log(response);
                    if (elemant.id.substring(0, 1) == '#') {
                        $("#\\" + elemant.id).html("Action taken");
                    } else {
                        $("#" + elemant.id).html("Action taken");
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function paid(elemant) {
            $(elemant.parentElement.parentElement).html(
                '<div id="' + elemant.id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            $.ajax({
                url: "paid",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: elemant.id.substring(1),
                },
                success: function(response) {
                    if (elemant.id.substring(0, 1) == '#') {
                        $("#\\" + elemant.id).html("Action taken");
                    } else {
                        $("#" + elemant.id).html("Action taken");
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }
        $('.close').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });

        function details(elemant) {
            var id = (elemant.className);
            id = id.split(" ");
            Swal.fire({
                position: 'center',
                html: "<div style='overflow: hidden;align-items: center;justify-content: center;display: flex'><div class='loader'></div></div>",
                title: 'Please wait!',
                showConfirmButton: false,
            });

            $.ajax({
                url: "get_items",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: id[0],
                },
                success: function(response) {
                    var html = '';
                    /* response.forEach(element => {
                        elemant2 = JSON.parse(JSON.stringify(element));
                        order_id = elemant2.order_id;

                        html +=
                            '<div style="flex-wrap: nowrap;margin-left: 5px;align-items: center;justify-content: space-between;" class="row"><div style="flex: .8;margin-right: 10px;font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #36304a;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 20px;"><span>' +
                            elemant2.product_name + '</span></div> <div><span style="flex: .4;font-weight: 800;">'+elemant2.quantity +'</span> × '+elemant2.price + ' $</div> </div>';

                    });
                     */
                    swal.close();
                    html += '<table class="table" style="border-collapse: separate;border-spacing: 0;">'+
                        '<thead class="table__thead">'+
                            '<tr  class="details_tr">'+
                                '<th class="table__th details_th">Product Name</th> '+
                                '<th class="table__th details_th" style="min-width: 140px;">Variant Name</th> '+
                                '<th class="table__th details_th">Quantity</th> '+
                                '<th class="table__th details_th">Price</th> '+
                            '</tr>'+
                        '</thead>'+
                        '<tbody class="table__tbody">';
                            
                    response.forEach(element => {
                        elemant2 = JSON.parse(JSON.stringify(element));
                        order_id = elemant2.order_id;

                        html += '<tr class="table-row table-row--chris details_tr " style="border-bottom: none;">'+
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>' + elemant2.product_name + '</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>' + elemant2.variant_name + '</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>' + elemant2.quantity + '</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>' + elemant2.price + '$</div>'+
                                    '</td>'+
                                '</tr>';
                               
                    });    

                    html +=  '<tr class="table-row table-row--chris details_tr " style="border-bottom: none;">'+
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>-</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>-</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>-</div>'+
                                    '</td>' +
                                    '<td data-column="order_number" class="table-row__td details_td">' +
                                        '<div>' + response[0].total_price + '$</div>'+
                                    '</td>'+
                                '</tr>';
                                    
                                        
                    html +=  '</tbody>'+
                        '</table>';

                    $('#items' + elemant.id).html(html);
                    $('#pop' + elemant.id).show();
                    $('#new_email' + elemant.id).hide();
                    $('#new_phone' + elemant.id).hide();

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

        }

        function ignore(elemant) {
            $(elemant.parentElement).html(
                '<div id="' + elemant.id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            $.ajax({
                url: "ignore",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: elemant.id.substring(1),
                },
                success: function(response) {
                    $("#\\" + elemant.id).html("Action taken");

                    $('#action' + elemant.id.substring(1)).html("Action taken");


                    $('#pop' + elemant.id.substring(1)).hide();
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function cancel(elemant) {

            var storee = storeee.searchParams.get("store");

            if (elemant.id.substring(0, 1) == '#') {
                $id = elemant.id.substring(1);
            } else {
                $id = elemant.id;
            }
            $(elemant.parentElement.parentElement).html(
                '<div id="' + $id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            $.ajax({
                url: "cancel_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: $id,
                    store: storee,
                },
                success: function(response) {
                    if (elemant.id.substring(0, 1) == '#') {
                        $(elemant.id).html("Action taken");
                    } else {
                        $("#" + elemant.id).html("Action taken");
                    }
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

        }

        function send_correct_whatsApp_message(elemant) {

            $(elemant.parentElement.parentElement).html(
                '<div id="' + elemant.id.substring(2) +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            var id = (elemant.id);
            $.ajax({
                url: "send_correct_whatsApp_message",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: elemant.id.substring(2),
                    problem: problem
                },
                success: function(response) {
                    $("#\\" + elemant.id.substring(1)).html("Action taken");

                    $('#action' + elemant.id.substring(2)).html("Action taken");

                    $('#pop' + elemant.id.substring(2)).hide();
                    /*  $(elemant.parentElement.parentElement).html("Action taken"); */
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function submit_order(elemant, id) {

            $(elemant.parentElement.parentElement).html(
                '<div id="sub_' + id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            $.ajax({
                url: "submit_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: id,
                },
                success: function(response) {

                    if (response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Couldn't found on shopify!",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                    $("#sub_" + id).html("Action taken");

                    $('#action' + elemant.id.substring(1)).html("Action taken");

                    $('#pop' + elemant.id.substring(1)).hide();
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }


        function search_order(elemant) {

            var value = (elemant.value);
            var html1 = "";
            var counter = 0;
            var url = "";
            var Controller_url = "";

            if ((value.replace(/\s/g, "")).length > 2) {

                try {
                    ajaxx.abort();
                } catch (error) {

                }
                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "first_verification_order",
                        type: "post",
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            content: value
                            /*  filter: search_filter */
                        },
                        success: function(response) {
                            console.log(response);
                            response.forEach(item => {

                                if (item['verified'] == '0') {
                                    Controller_url = 'first_verification';
                                } else if (item['verified'] == '1') {
                                    Controller_url = 'first_verification_FVM';
                                } else if (item['verified'] == '2') {
                                    Controller_url = 'first_verification_confirmed';
                                } else if (item['verified'] == '3' || item['verified'] == '6') {
                                    Controller_url = 'first_verification_archived';
                                } else if (item['verified'] == '4') {
                                    Controller_url = 'first_verification_SVM';
                                } else if (item['verified'] == '5') {
                                    Controller_url = 'first_verification_edited';
                                }


                                counter++;

                                html1 += '<a href="' + Controller_url + '?page=1&store=' + item[
                                        'store'] + '&order_num=' + item['order_number'] +
                                    '" target="blank" class="search-item"> ';

                                html1 += '<div class="search-result row">';

                                html1 +=
                                    '                        <div  style="margin-left: 10px;" class="column">';
                                html1 +=
                                    '                            <div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                    item['order_number'] + '</div>';
                                html1 +=
                                    '                            <div class="row" style="margin: 3px 1px 0px 0px ;color: #918f8f;font-size: 13px;">';

                                html1 +=
                                    '                                <div  style="margin-right: 25px; font-size: 14px; color: white; "><i class="fas fa-user-alt"></i>  ' +
                                    item['name'] + '</div>';
                                html1 +=
                                    '                                <div><i class="fas fa-flag"></i>  ' +
                                    item['country'] + '</div>';
                                html1 += '                            </div>';
                                html1 += '                        </div>';
                                html1 += '                    </div> </a>';

                                if (counter != response.length) {
                                    html1 += '                    <hr class="product">';
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


        function specific_order(e) {
            var Controller_url;
            var data = e.id;


            var store = storeee.searchParams.get("store");

            var order_num = data.substring(0, data.indexOf("_"));
            var verified = data.substring(data.indexOf("-") + 1);


            if (verified == '0') {
                Controller_url = 'first_verification';
            } else if (verified == '1') {
                Controller_url = 'first_verification_FVM';
            } else if (verified == '2') {
                Controller_url = 'first_verification_confirmed';
            } else if (verified == '3' || verified == '6') {
                Controller_url = 'first_verification_archived';
            } else if (verified == '4') {
                Controller_url = 'first_verification_SVM';
            } else if (verified == '5') {
                Controller_url = 'first_verification_edited';
            }

            if (order_num !== null) {

                try {
                    ajaxxx.abort();
                } catch (error) {

                }
                setTimeout(function() {

                    ajaxxx = $.ajax({
                        url: Controller_url,
                        type: "get",
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            order_num: order_num,
                            store: store

                        },
                        success: function(response) {},
                        error: function(xhr) {

                        }

                    });
                }, 300);
            } else {
                $("#results").hide();
            }

            $(document).click(function() {
                $("#results").hide();
            });


        }

        var users = new Object();

        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });      

       
    </script>

    <script>
        function placed_on_hold(element,order_number,order_store) {
            element.disabled = true;
            $(element).html(
                '<div style="align-items: center;justify-content: center;display: flex"><div style="border: 3px solid #ffffff;border-top: 3px solid #000000;width: 15px;height: 15px;" class="loader"></div></div>'
            );

            $.ajax({
                url: "update_fulfilment_to_on_hold",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_number: order_number,
                    store:order_store
                },
                success: function(response) {

                    if (response[0]) {
                        $(element).html('Done');
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response[1],
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(element).html('Fail');
                    }
                    
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }
        function hold_release(element,order_number,order_store) {
            element.disabled = true;
            $(element).html(
                '<div style="align-items: center;justify-content: center;display: flex"><div style="border: 3px solid #ffffff;border-top: 3px solid #000000;width: 15px;height: 15px;" class="loader"></div></div>'
            );

            $.ajax({
                url: "update_fulfilment_to_release",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_number: order_number,
                    store:order_store
                },
                success: function(response) {

                    if (response[0]) {
                        $(element).html('Done');
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response[1],
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(element).html('Fail');
                    }
                    
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }   
        
    </script>

    <script>
        $('.close').click(function(){
            var e = jQuery.Event("keyup"); // or keypress/keydown
            e.keyCode = 27; // for Esc
            $(document).trigger(e); // trigger it on document
        });
    
        $(document).keyup(function(e) {
            if (e.keyCode === 27) { // Esc
                 
                 $('.overlay').hide();
                
            }
        });
    
        function edit_email(email, id) {

            $("#email_field" + id).val(email);
            $('#new_email' + id).toggle();
            $('#old_email' + id).toggle();
        }

        $(".menu-off").click(function() {

            $(this).removeClass("menu-off");
            $(this).addClass("menu-on");
            $('.floating-button-menu-close').addClass('menu-on');
        });
        $('.floating-button-menu-close').click(function() {
            $(this).addClass("menu-off");
            $(this).removeClass("menu-on");
            $('.floating-button-menu').toggleClass('menu-on');
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
    </script>
@endsection
