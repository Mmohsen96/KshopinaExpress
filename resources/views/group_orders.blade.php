@extends('layouts.staff_layout')

@section('content')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
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
            background-color: #f9f9f9;
        }

        .td {
            padding: 0.87rem !important;
        }

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #ca9b49;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: rgb(116, 112, 112);
            border-radius: 5px;
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

        #myInput::placeholder {
            color: #296E45;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        #filters {
            flex: 15;
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
            letter-spacing: 2px;
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
            margin-right: 10px;
            margin-bottom: 10px
        }

        .tag:hover {
            color: #ca9b49;
            text-decoration: none;
            cursor: pointer;
        }
        .unactive-tag{
            background-color: #898989;
        }
    </style>

    <style>
        .container {
            padding-left: 0px !important;
            padding-right: 0px;
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
            white-space: nowrap;
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
        .active:focus{
            box-shadow: 0 0 0 0.1rem rgb(255 255 255 / 0%) !important;

        }

    </style>

    <style>
        @media (min-width: 992px) {
            .container {
                max-width: 1070px;
            }
        }


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

        .expanding-search-form .search-label:focus~label {
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

        .expanding-search-form .search-input:focus+.search-label {
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

        .expanding-search-form .dropdown-toggle:focus-visible,
        .expanding-search-form .dropdown-toggle:focus {
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

        .expanding-search-form .dropdown-menu>li>a {
            display: block;
            padding: 4px 12px;
            color: #CB9D48;
            font-size: 14px;
            line-height: 20px;
            text-decoration: none;
            border-radius: 3px;
            transition: 250ms all ease-in-out;
        }

        .expanding-search-form .dropdown-menu>li>a:hover {
            color: #fff;
            background-color: #CB9D48;
        }

        .expanding-search-form .dropdown-menu>.menu-active {
            display: none;
        }

        .expanding-search-form .search-button:focus-visible,
        .expanding-search-form .search-button:focus {
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
        .group_popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 50%;
            position: relative;
            transition: all 5s ease-in-out;
            height: 80%;
            overflow: auto;
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
        tr.hidden {
            display: none;
        }

        .filter_button {
            border: none;
            background-color: white;
        }

        .filter_button:focus-visible,
        .filter_button:focus {
            border: none;
            outline: none;
        }

        .sub_row {
            background-color: #f7f6f3;
            position: relative;
            border-bottom: hidden;
        }

        .sub_head {
            background-color: #f7f6f3;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            text-align: center;
            color: #636464;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            border: 0 !important;
            padding: 6px 14px !important;
        }

        .sub_inf {
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

    </style>
    <div class="container">

        <div class="row row--top-40">

            <div class="column">
                <h2 class="row__title">Group Orders</h2>
            </div>

        </div>


        <div style="margin-top: 10px;">
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



            <div style="display: flex;background: #1b3425; height: 70px; padding: 2.5% 2% 0% 1%; border-radius: 5px 5px 5px 5px;">
                <a href="group_orders?page=1&filter=All" id="group_orders"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 115px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                    font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                    @if (Route::current()->getName() == 'group_orders') background: #ffffff; color: #1b3425;
                    @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    Orders </a>
                <a href="confirmed_group_orders?page=1&filter=All" id="confirmed_group_orders"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 140px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                    font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                    @if (Route::current()->getName() == 'confirmed_group_orders') background: #ffffff; color: #1b3425;
                    @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    Confirmed Groups</a>
                {{-- <a href="archived_group_orders?page=1&filter=All" id="archived_group_orders"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                    font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                    @if (Route::current()->getName() == 'archived_group_orders') background: #ffffff; color: #1b3425;
                    @else
                    background-color: #1b3425;color: #d2ac6a; @endif ">
                    Archived</a> --}}

            </div>
        </div>
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
            <div style="margin-right: 15px;margin-left: 35px; align-items: flex-end;display: flex;">
                <button type="button" onclick="customize_cities()" id="customize" name="customize"
                    style="height: 70%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 15px;letter-spacing: 2px;font-weight: 600;padding: 0px 20px 0px 20px;"
                    class="btn btn-primary">
                    <i style="font-size: 12px;" class="fas fa-city"></i> Cities
                </button>
            </div>
            <div style="margin-right: 15px;margin-left: 5px; align-items: flex-end;display: flex;">
                <button type="button" onclick="customize_products()" id="customize" name="customize"
                    style="height: 70%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 15px;letter-spacing: 2px;font-weight: 600;padding: 0px 20px 0px 20px;"
                    class="btn btn-primary">
                    <i style="font-size: 12px;" class="fas fa-boxes"></i> Products
                </button>
            </div>
        </div>

        @php
            $status = ['Pending', 'Awaiting', 'Confirmed', 'Canceled'];
            $status_colors = ['grey', 'yellow', 'green', 'red'];
            
        @endphp

        <table class="table">
            <thead class="table__thead">
                <tr style="background-color: #ffffff;">
                    @if (Route::current()->getName() == 'group_orders')
                        <th class="table__th" style="width: 150px;">Order Number</th>
                        <th class="table__th">Email</th>
                        <th class="table__th">Date</th>
                        <th class="table__th">City</th>
                        <th class="table__th">Total Price</th>
                        {{-- <th class="table__th">Tracking Number</th> --}}
                        <th class="table__th">Status</th>
                        <th class="table__th">Actions</th>
                        <th class="table__th"></th>
                    @endif
                    @if (Route::current()->getName() == 'confirmed_group_orders')
                        <th class="table__th" style="width: 150px;">Group ID</th>
                        <th class="table__th">No. of members</th>
                        <th class="table__th">City</th>
                        <th class="table__th">Status</th>
                        <th class="table__th">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody id="table" class="table__tbody">

                @if (Route::current()->getName() == 'group_orders')
                    @foreach ($orders as $order)
                        <tr class="table-row table-row--chris" >
                            <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">{{ $order->group_orders_id }}
                            </td>
                            <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">{{ $order->email }}
                            </td>
                            <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">{{ date('M j', strtotime($order->created_at)) }}
                            </td>
                            <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">{{ $order->city }}
                            </td>
                            <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">{{ $order->final_price }}
                            </td>
                            {{-- <td data-column="order_country" class="table-row__td">
                                <div class="table-row__info">
                                    @if ($order->tracking_url == null)
                                        {{ $order->tracking_number }}
                                    @elseif($order->tracking_url[0] == 'h' &&
                                        $order->tracking_url[1] == 't' &&
                                        $order->tracking_url[2] == 't' &&
                                        $order->tracking_url[3] == 'p')
                                        <a style="color: #0062cc; font-weight: 500;" href="{{ $order->tracking_url }} "
                                            target="_blank">{{ $order->tracking_number }}</a>
                                    @else
                                        <a style="color: #0062cc; font-weight: 500;" href="https://{{ $order->tracking_url }} "
                                            target="_blank">{{ $order->tracking_number }}</a>
                                    @endif

                            </td> --}}
                            <td data-column="order_country" class="table-row__td">
                                <p class="table-row__p-status status status--{{ $status_colors[$order->status] }}">
                                    {{ $status[$order->status] }}
                                </p>
                            </td>
                            <td data-column="order_country" class="table-row__td">
                                <button style="margin-right: 5px;" id="{{ $order->group_orders_id }}"
                                    onclick="review_before_send('{{ $order->group_orders_id }}')" type="button" class="btn btn-primary">
                                    <i class="fas fa-cog"></i>
                                </button>
                            </td>
                            {{-- <td data-column="order_country" class="table-row__td">
                                <button style="margin-right: 5px;" id="{{ $order->group_orders_id }}"
                                    onclick="group_details(this)" type="button" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                <button style="margin-right: 5px;" id="{{ $order->group_orders_id }}"
                                    onclick="add_tracking(this)" type="button" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td> --}}
                        </tr>
                    @endforeach
                @endif

                @if (Route::current()->getName() == 'confirmed_group_orders')

                    @for ($i = 0; $i < count($confirmed_group_orders); $i++)
                        @php
                            $group_id = sprintf("%02d", $confirmed_group_orders[$i]->group_id);

                            $group_city_id = sprintf("%02d", $confirmed_group_orders[$i]->group_city_id);

                            $group_number_id = $group_city_id.$group_id;

                            $found=0;
                        @endphp

                        <tr style="cursor: pointer;" class="table-row table-row--chris" id="{{ $group_number_id }}"  onclick="toggle(this.id,'#row_{{ $group_number_id }}');">
                            <td data-column="order_group_number_id" class="table-row__td">
                                <div class="table-row__info">
                                    <p class="table-row__name"><a href="/group_order?group_id=G{{ $group_number_id }}" target="blank">G{{ $group_number_id }}</a> </p>
                                </div>
                            </td>
                            <td data-column="order_NumberOfMembers" class="table-row__td">
                                <div class="table-row__info">
                                    <p class="table-row__name">{{ $confirmed_group_orders[$i]->NumberOfMembers }}</p>
                                </div>
                            </td>
                            <td data-column="order_NumberOfMembers" class="table-row__td">
                                <div class="table-row__info">
                                    <p class="table-row__name">{{ $confirmed_group_orders[$i]->city}}</p>
                                </div>
                            </td>
                            <td data-column="order_NumberOfMembers" class="table-row__td">
                                <div class="table-row__info">
                                    @if ($confirmed_group_orders[$i]->NumberOfMembers ==15)
                                    <p class="table-row__name">Completed</p>
                                    @else
                                    <p class="table-row__name">Not completed yet</p>

                                    @endif
                                </div>
                            </td>
                            <td data-column="order_NumberOfMembers" class="table-row__td">
                                <div class="table-row__info">
                                    <button style="margin-right: 5px;" id="{{  $group_number_id }}"
                                        onclick="download_group('{{  $group_number_id }}')" type="button" class="btn btn-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <a  href="" download id="file"> </a>

                    
                        @foreach ($members_data_each as $key_id => $values)
                            @foreach ($values as $data )
                            
                                @if ($key_id == $group_number_id)
                                    @if ($found == 0 || $found == $data->group_orders_id)
                                        <tr id="row_{{$key_id }}" class=" sub_row hidden">
                                            <th class="sub_head">Order ID</th>
                                            <th class="sub_head">Cust. Name</th>
                                            <th class="sub_head">Cust. Email</th>
                                            <th class="sub_head">Cust. Number</th>
                                            <th class="sub_head">Cust. Address</th>
                                            <th class="sub_head">Cust. Rank</th>
                                            <th class="sub_head">Total Price</th>
                                            <th class="sub_head">Actions</th>
                                        </tr>
                                        @php
                                            $found = $data->group_orders_id ;
                                        @endphp
                                    @endif
                                    <tr id="row_{{$key_id}}" class="table-row table-row--chris sub_row hidden">
                                        <td style="color: #000000" class="sub_inf">{{ $data->group_orders_id }}</td>
                                        <td style="color: #000000" class="sub_inf">{{ $data->customer_name }}</td>
                                        <td style="color: #000000" class="sub_inf"> {{ $data->email }} </td>
                                        <td style="color: #000000" class="sub_inf">{{ $data->contact_number }}</td>
                                        <td style="color: #000000" class="sub_inf">{{ $data->address }}</td>
                                        <td style="color: #000000" class="sub_inf">{{ $data->customer_rank }}</td>
                                        <td style="color: #000000" class="sub_inf">{{ $data->final_price }}</td>
                                        <td style="color: #000000" class="sub_inf">
                                            <button style="margin-right: 5px;" id="{{ $data->group_orders_id }}"
                                                onclick="group_details('{{ $data->group_orders_id }}')" type="button" class="btn btn-primary">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach

                    @endfor

                @endif

            </tbody>
        </table>
      
        <div id="group_popup" class="overlay">
            <div class="group_popup">
                <div class="container">
                    <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                            alt="">
                    </div>
                </div>
                <a id='close' class="closee" href="#">&times;</a>
                <div style="margin-top: 40px;" class="container content">
                    <form action="send_group_order_mail" method="post" enctype="multipart/form-data" onsubmit="submit_form(this)">
                        @csrf
    
                        <div class="dynamic-wrap">
                            <input type="hidden" name="id" readonly id="id">
                            <div style="font-weight: 600;padding: 0px 0px 10px 3px;flex-wrap: nowrap;align-items: center; margin:0px;" class="row entry input-group">
                                <span style="flex: .6;">Product Name</span>
                                <span style="flex: .2;">EGP</span>

                                <span style="flex: .2;">QTY</span>

                            </div>
                            <div id="order_form" >
                                
                                {{-- <div class="entry input-group">
                                    <input class="form-control" name="name[]" type="text" placeholder="Product Name"
                                        required>
                                    <input style="flex: .3;" class="price form-control" type="number" name="price[]"
                                         onchange="price_changed(0)" placeholder="Price" required>
                                    <input style="flex: .3;" class="qty form-control" type="number" name="qty[]"
                                         onchange="price_changed(0)" placeholder="QTY" required>
    
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-add" type="button">
                                            <i style="font-size: 14px;" class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div> --}}
                                
                            </div>
    
                        </div>
                        <hr>
                        <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 45px 0 12px 0;">
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Name</span>
    
                                <input id="customer_name" style="height: 40px" class="group_input_style" type="text" name="customer_name" placeholder="Customer name" readonly>
    
                            </div>
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Email</span>
    
                                <input id="customer_email" style="height: 40px" class="group_input_style" type="email" name="email" value="@gmail.com" placeholder="Email" readonly>
    
                            </div>
                            
                        </div>
                        <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 0px 0 12px 0;">
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Contact number</span>
    
                                <input id="customer_phone" style="height: 40px" class="group_input_style" type="text" name="phone" placeholder="Customer phone number" readonly>
    
                            </div>
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Address</span>
    
                                <input id="customer_address" style="height: 40px" class="group_input_style" type="text" name="address" placeholder="Address" readonly>
    
                            </div>
                            
                        </div>
                        <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 0px 0 12px 0;">
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Cities</span>
        
                                <select style="height: 40px" onchange="city_selected(this)" class="group_input_style" name="city" id="city"
                                class="details" placeholder="City">
                                <option value="" selected disabled hidden>Select the City</option>
                            </select required>
        
                            </div>
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Shipping rate</span>
    
                                <input id="shipping_rate" style="height: 40px" class="group_input_style" type="text" name="rate" readonly>
    
                            </div>
                            
                        </div>
    
                        
                        <hr style="border-top: 2px solid rgb(27 52 37 / 58%);">
                        <div style="display: flex;flex-wrap: wrap;justify-content: space-between;margin: 45px 0 12px 0;">
                            
                            <div style="margin-bottom: 0px;" class="group_input input-box">
                                <span class="details">Final price</span>
    
                                <input style="height: 40px" class="group_input_style" type="text" name="final_price" id="final_price"
                                    value="0" readonly>
    
                            </div>
                        </div>
                        <div id="send_mail_button" style="display: flex;flex-wrap: wrap;justify-content: end;margin: 45px 10px 12px 0px">
                            <button type="submit" id="create_group_order" name="create_group_order"
                                style="height: 80%;border-radius: 15px;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 7px 30px 5px 30px;"
                                class="btn btn-primary">
                                Send Mail
                            </button>
                        </div>
                    </form>
    
                </div>
    
                <div>
    
                </div>
            </div>
        </div>

        <div id="pop_customize_city" class="overlay">
            <div class="popup">
                <h2 style="margin-bottom: 30px"><i style="font-size: 25px;" class="fas fa-cog"></i> Cities </h2>
                <a id='closee' class="closee" href="#">&times;</a>
                <div class="container content">
                   
                    <div style="justify-content: center;display: flex;flex-wrap: wrap;" id="cities"
                        style="display: inline-block;grid-column-gap: 0px;grid-template-columns: auto auto;">

                    </div>
                </div>
                <hr>

                <div style="display: flex;align-content: center;justify-content: center;" id="submit_section">
                </div>

            </div>
        </div>


        <div id="pop_customize_products" class="overlay">
            <div class="popup">
                <h2 style="margin-bottom: 30px"><i style="font-size: 25px;" class="fas fa-cog"></i> Products </h2>
                <a id='close' class="closee" href="#">&times;</a>
                <form action="update_group_product" method="post" enctype="multipart/form-data" onsubmit="products_submit(this)">
                    @csrf
                    <div style="margin-top: 40px;" class="container content">
                        
                        <div class="dynamic-wrap">
    
                            <div id="product" class="products_form">
                                    
                                    {{-- <div  style="flex-wrap: nowrap;align-items: center; margin:0px;" class="row entry input-group">
                                        <div style="width: 5%;">
                                            <input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="0" checked="checked"/>
                                        </div>
                                        <input class="form-control" name="name[]" type="text" placeholder="Product Name" required>

                                        <input style="flex: .3;" class="price form-control" type="text" name="price[]" placeholder="Price" required>
    
                                        <input style="flex: .3;" class="qty form-control" type="text" name="sku[]"placeholder="SKU" required>
        
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-add" type="button">
                                                <i style="font-size: 14px;" class="fas fa-plus"></i>
                                            </button>
                                        </span>
                                    </div> --}}
                                
                            </div>
                            <div id="deleted">

                                 </div>
                        </div>
                        <hr>
                            
        
                    </div>
                    <div style="display: flex;align-content: center;justify-content: center;" id="submit_section_product">
                        <button type="submit" id="update_group_product" name="update_group_product" class="btn btn-primary"
                                    style="border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                                    Submit </button>
                    </div>
                </form>

                <div>
    
                </div>
            </div>
        </div>
    

        <div id="pop_details" class="overlay">
            <div class="popup">
                <h2 id="group_orders_id" style="margin-bottom: 30px"></h2>
                <a id='close' class="closee" href="#">&times;</a>
                <div class="container content">
                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 8px;" class="icon far fa-user" data-feather="user"></i>
                        <span id="customer_name_details"></span>
                    </div>
                    <div style="display: flex;align-items: baseline;justify-content: start;">
                        <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 8px;" class="icon fab fa-whatsapp" data-feather="user"></i>
                            <span id="contact_number_details"></span>
                        </div>
                    </div>

                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                        class="row">
                        <i style="margin-right: 8px;" class="icon far fa-envelope" data-feather="user"></i>

                        <span id="customer_email_details"></span>

                    </div>
                    <hr>
                
                    <div style="display: flex;align-items: baseline;justify-content: start;">
                        
                        <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 15px;" class="icon fas fa-map-marker-alt" data-feather="user"></i>
                            <span id="customer_city_details"></span>
                        </div>
                    </div>

                    <div style="display: flex;align-items: baseline;justify-content: start;">
                        
                        <div style="margin-top: 8px;display: inline-block;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 8px;" class="icon fas fa-map-marked-alt" data-feather="user"></i>
                            <span id="customer_address_details"></span>
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
                <div style="display: flex;align-content: center;justify-content: center;" >
                    <button onclick="left_the_group(this)" type="button" id="update_group_product" name="update_group_product" class="btn btn-primary"
                                style="background-color: #d53232;border-color: #ec0e0e;color: #ffffff;border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                                Kick out </button>
                </div>
            </div>
        </div>



        @if (Route::current()->getName() == 'group_orders')
            @foreach ($orders as $order)
                

                
                <div id="tracking_pop{{ $order->group_orders_id }}" class="overlay">
                    <div class="popup" style="height: 45%; margin: 170px auto;">
                        <h2 style="margin-bottom: 45px">#{{ $order->group_orders_id }}</h2>
                        <a id='close' class="closee" href="#">&times;</a>
                        <div class="container content" style="padding-left: 0;">
                        
                            <div style="margin-top: 8px;display: flex;align-items: center;justify-content: center;margin-left: 5px;"
                                class="row">
                                <div class="input-group mb-3">
                                
                                    <input id="tracking_number{{ $order->group_orders_id }}" name="tracking_number" type="text" style="padding: 1.375rem 0.75rem;" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Tracking Number">
                                </div>
                                <div class="input-group mb-3">    
                                    <input id="tracking_url{{ $order->group_orders_id }}" name="tracking_url" type="text"  style="padding: 1.375rem 0.75rem;"  class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="URL">
                                </div>
                                <button type="submit" id="{{ $order->group_orders_id }}" 
                                style="margin-top: 10px; border-radius: 15px;position: relative;font-family: 'Bebas Neue', cursive;font-size: 20px;letter-spacing: 2px;font-weight: 600;padding: 8px 30px 5px 30px;"
                                class="btn btn-primary tracking_submit{{ $order->group_orders_id }}" onclick="submit__group_tracking(this)">
                                submit
                            </button>
                            </div>
                

                

                            

                            
                        
                            
                        </div>
            
                        
                    </div>
                </div>
            
            @endforeach
        @endif

        <div class="pagination">
            <a href="#">&laquo;</a>
            <?php

                $orders_per_page = 15;
                if (isset($number_of_orders)) {
                    $pages = ceil($number_of_orders / $orders_per_page);
                } else {
                    $pages = 0;
                }
            
            ?>

            @for ($i = 1; $i <= $pages; $i++)

                @if ($_GET['page'] == $i)
                    @if (isset($_GET['filter']))
                        <a class='active'
                            href="?page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>
                    @else
                        <a class='active'
                            href="?page={{ $i }}&filter=All">{{ $i }}</a>
                    @endif
                @else
                    @if (isset($_GET['filter']))
                        <a
                            href="?page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>
                    @else
                        <a
                            href="?page={{ $i }}&filter=All">{{ $i }}</a>
                    @endif
                @endif

            @endfor
    
            <a href="#">&raquo;</a>
        </div>
    </div>

    <script>
        $(function() {
                $(document).on('click', '.btn-add', function(e) {
                    e.preventDefault();

                    var dynaForm = $('.dynamic-wrap .products_form:first'),
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
    
    <script>
        var cities = new Object();
        var changes = new Object();
        var deleted =new Object();
        
        $('.closee').click(function(e) {
                $(this.parentElement.parentElement).hide();
                e.preventDefault();
        });

        function customize_cities(){

            var html = "";
            var html1 = "";

            $.ajax({
                url: "get_zones",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    
                    response.forEach(element => {
                        if (element['active'] == 0) {
                            html +=
                            '<div onclick="chnage_cities(this)" class ="tag unactive-tag" id="'+element['id'] + '"><span>' +
                                element['city'] + '</span></div>';
                        } else {
                            html +=
                            '<div onclick="chnage_cities(this)" class ="tag" id="'+element['id'] + '"><span>' +
                                element['city'] + '</span></div>';
                        }
                        
                        cities[element['id']]=element['active']
                    });

                    html += '<hr>';
                    html1 += '<button onclick="submit_cities(this)" type="button" class="btn btn-primary"'+
                                'style="border-radius: 15px;font-family: Bebas Neue, cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">'+
                                'Submit </button>';
                          
                                
                    $("#submit_section").html(html1);

                    $("#cities").html(html);
                    $("#pop_customize_city").show();

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

        }

        function customize_products(){

            var html = "";
            var html1 = "";

            $.ajax({
                url: "get_group_products",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    
                    if (response.length ==0) {
                        html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                        html +=
                            '<input style="display: none;" class="id form-control" type="text" name="id[]" value="none" readonly/>';

                        html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="0" />'+
                                        '</div>';

                        html+= '<input class="form-control" name="name[]" type="text" placeholder="Product Name" required>';

                        html+= '<input style="flex: .3;" class="price form-control" type="text" name="price[]" placeholder="Price" required>';

                        html+= '<input style="flex: .3;" class="qty form-control" type="text" name="sku[]"placeholder="SKU" required>';

                        html+= '<span class="input-group-btn">'+
                                            '<button class="btn btn-success btn-add" type="button">'+
                                                '<i style="font-size: 14px;" class="fas fa-plus"></i>'+
                                            '</button></span>';
                        html +='</div>';


                    } else {
                        
                        for (let i = 0; i < response.length; i++) {
                            html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;margin-bottom: 10px;" class="row entry input-group">';

                            html +=
                            '<input style="display: none;" class="id form-control" type="text" name="id[]" value="'+response[i]['product_id']+'" readonly/>';

                        if (response[i]['active'] == 0) 
                        {
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['product_id']+'" />'+
                                        '</div>';
                        }
                        else{
                            html +=
                            '<div style="width: 5%;">'+
                                            '<input style="height: 16px;" type="checkbox" class="active form-control check" name="active[]" value="'+response[i]['product_id']+'" checked="checked"/>'+
                                        '</div>';
                        }

                        html+= '<input class="form-control" value="'+response[i]['product_title']+'" name="name[]" type="text" placeholder="Product Name" required>';

                        html+= '<input style="flex: .3;" class="price form-control" value="'+response[i]['price']+'" type="text" name="price[]" placeholder="Price" required>';

                        html+= '<input style="flex: .3;" class="qty form-control" value="'+response[i]['sku']+'" type="text" name="sku[]"placeholder="SKU" required>';

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
                    
                          

                    $("#product").html(html);

                    $("#pop_customize_products").show();

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function products_submit(element){
            $('#submit_section_product').html('<div style= "height:20px; width:20px;" class="loader")></div>');

        }

        function chnage_cities(element){

            $(element).toggleClass("unactive-tag");

            if (cities[element.id] ==0) {
                cities[element.id]='1';
                changes[element.id]='1';
            } else {
                cities[element.id]='0';
                changes[element.id]='0';

            }

            console.log(changes);
        }

        function submit_form(form){
            
            $('#send_mail_button').html('<div style= "height:20px; width:20px;" class="loader")></div>');

           
        }

        function submit_cities(element){
            var e=element.parentElement;
            $(element.parentElement).html(
                    '<div style="height:20px; width:20px;" class="loader"></div>'
                );

            $.ajax({
                url: "change_zones_status",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    new_status:changes
                },
                success: function(response) {
                    
                    $(e).html( "Updated");
                    location.reload(true);

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }
                                
        function review_before_send(id){
            var html = "";

            $.ajax({
                url: "get_group_order",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                    id:id
                },
                success: function(response) {
                    
                    var order_with_products=response;
                    var final_price=0;
                
                    for (let i = 0; i < order_with_products.length; i++) {
                        html += '<div  style="flex-wrap: nowrap;align-items: center; margin:0px;" class="row entry input-group">';


                        html+= '<input class="form-control" value="'+order_with_products[i]['product_name']+'" name="name[]" type="text" placeholder="Product Name" readonly>';

                        html+= '<input style="flex: .3;" class="price form-control" value="'+order_with_products[i]['product_price']+'" type="text" name="price[]" placeholder="Price" readonly>';

                        html+= '<input style="flex: .3;" class="qty form-control" value="'+order_with_products[i]['product_qty']+'" type="text" name="sku[]"placeholder="SKU" readonly>';
                        final_price += order_with_products[i]['product_price'] * order_with_products[i]['product_qty'];

                        if (i== order_with_products.length -1) {

                            $("#customer_name").val(order_with_products[i]['customer_name']);
                            $("#customer_email").val(order_with_products[i]['email']);
                            $("#customer_phone").val(order_with_products[i]['contact_number']);
                            $("#customer_address").val(order_with_products[i]['address']);
                            $("#id").val(order_with_products[i]['group_orders_id']);


                            $("#city").html("<option value= '"+order_with_products[i]['group_city_id']+"' selected readonly >"+order_with_products[i]['city']+"</option>");

                            $("#shipping_rate").val(order_with_products[i]['shipping_rate'] + " EGP");

                            final_price += parseInt(order_with_products[i]['shipping_rate']);
                            
                            $("#final_price").val(final_price + " EGP");

                        }
                        
                        html +='</div>';

                        }

                    $("#order_form").html(html);
                    

                    $('#group_popup').show();

                    
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });



        }

        function group_details(orderr) {

            var id = orderr;
            Swal.fire({
                position: 'center',
                html: "<div style='overflow: hidden;align-items: center;justify-content: center;display: flex'><div class='loader'></div></div>",
                title: 'Please wait!',
                showConfirmButton: false,
            });

            $.ajax({
                url: "get_group_order",
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response) {
                    var html = '';

                    if (response.length !=0) {
                        $("#group_orders_id").html("#"+response[0].group_orders_id);
                        $("#customer_name_details").html(response[0].customer_name);
                        $("#customer_email_details").html(response[0].email);
                        $("#contact_number_details").html(response[0].contact_number);
                        $("#customer_address_details").html(response[0].address);
                        $("#customer_city_details").html(response[0].city);
                    } 
                    
                    response.forEach(element => {
                        elemant2 = JSON.parse(JSON.stringify(element));
                        order_id = elemant2.order_id;
                        console.log(elemant2);

                        html +=
                            '<div style="margin-right: 5px;margin-left: 5px;align-items: center;justify-content: space-between;" class="row"><div style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #36304a;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 20px;"><span>' +
                            elemant2.product_name + '</span></div> <div><span style="font-weight: 800;">'+elemant2.product_qty +'</span> × '+elemant2.product_price + ' EGP</div> </div>';

                    });
                    swal.close();
                    $('#items_details').html(html);
                    $('#pop_details').show();

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });

        }

        function left_the_group(e){
            
            var e=e;
            $(e.parentElement).html(
                    '<div style="height:20px; width:20px;" class="loader"></div>'
                );
                
            $.ajax({
                url: "left_group_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $("#group_orders_id").html().substring(1),
                },
                success: function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order left the group',
                        showConfirmButton: false,
                        timer: 1500
                });

                   
                $(e).html( "Updated");
                location.reload(true);

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function add_tracking(number){

            $('#tracking_pop' + number.id).show();

        }

        function submit__group_tracking(id_number){

            var id= id_number.id
            var tracking_number=$('#tracking_number'+id).val()
            var tracking_url=$('#tracking_url'+id).val()


            if( tracking_number.length == 0){
                Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Tracking Number Field is required",
                            showConfirmButton: false,
                            timer: 1500
                        });
            }else{

                $('.tracking_submit'+id).text('');
                $('.tracking_submit'+id).prop('disabled', true);
                $('.tracking_submit'+id).addClass('buttonload');
                $('.tracking_submit'+id).append('<i class="fa fa-spinner fa-spin"></i> Loading');

                $.ajax({
                    url: "add_group_tracking",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        tracking_number:tracking_number,
                        tracking_url:tracking_url
                    },
                    success: function(response) {
                        console.log(JSON.stringify(response));
                        location.reload(true);
                    }
                });
            } 
        }
        
        function download_group(group_number_id){
            html1='';

                $.ajax({
                    url: "group_order_data",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: group_number_id,
                    },
                    success: function(response) {
console.log(response);
                        window.open(response, '_blank');
                        location.reload();
                      
                    }
                });
        }

    </script>

    <script>

        function toggle(btnID, eIDs) {
            // Feed the list of ids as a selector
            var theRows = document.querySelectorAll(eIDs);
            // Get the button that triggered this
            var theButton = document.getElementById(btnID);
            // If the button is not expanded...
            if (theButton.getAttribute("aria-expanded") == "false") {
                // Loop through the rows and show them
                for (var i = 0; i < theRows.length; i++) {
                    theRows[i].classList.add("shown");
                    theRows[i].classList.remove("hidden");
                }
                // Now set the button to expanded
                theButton.setAttribute("aria-expanded", "true");
                // Otherwise button is not expanded...
            } else {
                // Loop through the rows and hide them
                for (var i = 0; i < theRows.length; i++) {
                    theRows[i].classList.add("hidden");
                    theRows[i].classList.remove("shown");
                }
                // Now set the button to collapsed
                theButton.setAttribute("aria-expanded", "false");
            }
        }
    </script>
@endsection

