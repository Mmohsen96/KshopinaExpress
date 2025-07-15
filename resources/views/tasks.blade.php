@extends('layouts.staff_layout')

@section('content')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
    <style>
        .circle {
            background-color: #605b70;
            height: 100px;
            width: 100px;
            border-radius: 100px;
            box-shadow: 4px 4px 5px 2px rgb(141 141 141);
            align-items: center;
            justify-content: center;
            display: flex;
            color: #ca9b49;
            font-size: 48px;
        }

        .cover {
            display: flex;
            justify-content: center;
            align-content: center;
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

        /*  yasmoona w nour */
        #dot-urgent:checked~.category label .urgent,
        #dot-important:checked~.category label .important,
        #dot-normal:checked~.category label .normal {
            background: #CA9B49;
            border-color: #d9d9d9;
        }

        #dot-1:checked~.category label .one {
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

    @php
    $status = ['Received', 'On progress', 'Waiting', 'Solved'];
    @endphp


    <div class="container">



        <div class="floating-button-menu menu-off" style="display: flex;align-items: center;justify-content: center;">
            <div class="floating-button-menu-links">
                <a href="#one" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: rgb(29, 141, 1) ;border-color: rgb(29, 141, 1) ;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Normal</span>
                </a>
                <a href="#two" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color:  rgb(239, 188, 0) ;border-color:  rgb(239, 188, 0) ;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Important</span>
                </a>
                <a href="#three" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: red ;border-color: red ;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Urgent</span>
                </a>
            </div>
            <div class="floating-button-menu-label"><i class="fas fa-palette"></i></div>
        </div>

        <div class="floating-button-menu-close"></div>

        <div class="row row--top-40">

            <div class="column">
                <h2 class="row__title">ERP</h2>
            </div>

            <div>
                <button type="button" id="add_task" onclick='add_task(this)'
                    style="border-radius: 15px; position: relative; right: 1.8rem; font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: 2px; padding: 8px 25px 5px 25px;"
                    class="btn btn-primary">
                    {{-- <i class="fas fa-plus"></i> --}}
                    Assign task
                </button>
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

            <div
                style="display: flex;background: #1b3425; height: 70px; padding: 2.5% 2% 0% 1%; border-radius: 5px 5px 5px 5px;">
                <a href="tasks?page=1&filter=All" id="tasks"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                             font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                            @if (Route::current()->getName() == 'tasks') background: #ffffff; color: #1b3425;
                    @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    My tasks</a>
                <a href="assigned_tasks?page=1&filter=All" id="assigned_tasks"
                    style="width: 130px;margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                            font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                            @if (Route::current()->getName() == 'assigned') background: #ffffff; color: #1b3425;
                    @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    Assigned tasks</a>
                <a href="archived_tasks?page=1&filter=All" id="archived_tasks"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                                            font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                                            @if (Route::current()->getName() == 'tasks_archived') background: #ffffff; color: #1b3425;
                    @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    Archived</a>


            </div>

            <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff;">
                <div style="flex:20; padding: 15px 0px 0px 15px;" class="position-relative">
                    <i style="color: #1b3425;font-size: 15px;display: flex;position: absolute;top: 29px;left: 25px;"
                        class="fas fa-search"></i>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for order.."
                        title="Type a order number" autocomplete="off">
                    <div id="results" class="result col"
                        style=" display: none;  flex-basis: 0;  flex-grow: 1; max-width: 94%; max-height: 250px; overflow-x: hidden;
                                                overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                    </div>
                </div>

                <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;">
                    <button style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:20; color:#1b3425;"
                        class="@if ((isset($_GET['filter']) && $_GET['filter'] == 'All') || !isset($_GET['filter'])) selected @endif " id="All">All</button>
                    <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Normal') selected @endif " id="Normal"
                        style="flex:12;">Normal</button>
                    <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Important') selected @endif " id="Important"
                        style="flex:12;">Important</button>
                    <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Urgent') selected @endif " id="Urgent"
                        style="flex:12;border-radius: 0px 10px 10px 0px;border-right: 1px solid;">Urgent</button>
                </div>
            </div>

            <table class="table">
                <thead class="table__thead">
                    <tr style="background-color: #ffffff;">
                        <th class="table__th">Case</th>
                        <th class="table__th">Order Number</th>
                        <th class="table__th">In</th>
                        @if (Route::current()->getName() == 'assigned')
                            <th class="table__th">To</th>
                        @elseif (Route::current()->getName() == 'tasks_archived')
                            <th class="table__th">From</th>
                            <th class="table__th">To</th>
                        @else
                            <th class="table__th">From</th>
                        @endif
                        <th class="table__th">Priority</th>
                        <th class="table__th">Status</th>
                        <th class="table__th">At</th>
                        <th class="table__th">Deadline</th>
                        <th class="table__th">Details</th>
                    </tr>
                </thead>
                <tbody id="table">
                    @foreach ($orders as $order)
                        <tr class="table-row table-row--chris"
                            @if ($order->status == 2) @if (Route::current()->getName() == 'tasks')
                                    @if ($order->solved == 2)
                                        class="table-warning"
                                    @elseif($order->solved == 1)
                                        class="table-danger" @endif
                        @else
                            @if ($order->solved == 1) class="table-warning"
                                    @elseif ($order->solved == 2)
                                            class="table-danger" @endif
                            @endif
                    @endif>

                    <td data-column="upload_date" class="table-row__td" style="width: 90px;">
                        <div class="table-row__info">
                            <p class="table-row__name">
                                {{ $order->id }}
                            </p>
                        </div>
                    </td>

                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                        <div class="table-row__info">
                            <p class="table-row__name">
                                #{{ $order->order_number }}
                            </p>
                        </div>
                    </td>

                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 160px;">
                        <div class="table-row__info">
                            <p class="table-row__name">
                                {{ $order->system_name }}
                            </p>
                        </div>
                    </td>

                    @if (Route::current()->getName() == 'tasks_archived')
                        <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                            <div class="table-row__info">
                                <p class="table-row__name">
                                    {{ $order->user_from }}
                                </p>
                            </div>
                        </td>
                        <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                            <div class="table-row__info">
                                <p class="table-row__name">
                                    {{ $order->user_to }}
                                </p>
                            </div>
                        </td>
                    @else
                        <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                            <div class="table-row__info">
                                <p class="table-row__name">
                                    {{ $order->name }}
                                </p>
                            </div>
                        </td>
                    @endif

                    <td data-column="upload_date" class="table-row__td" style="width: 90px;">
                        <div class="table-row__info">
                            @if ($order->priority == 0)
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(29, 141, 1);"
                                    class="gender">Normal</span>
                            @elseif($order->priority == 1)
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(239, 188, 0);"
                                    class="gender">Important</span>
                            @else
                                <span
                                    style="text-decoration: underline;text-underline-position: under;text-decoration-color: red;"
                                    class="gender">Urgent</span>
                            @endif
                        </div>
                    </td>

                    <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                        @if (Route::current()->getName() == 'tasks')

                            @if ($order->status == 2 && $order->solved == 2)

                                Waiting
                            @else
                                <select name="status" id='status_{{ $order->id }}' onchange="press(this)"
                                    style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;outline-color:#dfdfdf;">
                                    <option value="" selected hidden>Select status</option>

                                    @if ($order->status == 2 && $order->solved == 1)
                                        <option id='status2_{{ $order->id }}' selected hidden value="2">Needs action
                                        </option>
                                    @endif

                                    <option id='status0_{{ $order->id }}'
                                        @if (isset($order->status) && $order->status == 0) selected @endif value="0">Received</option>
                                    <option id='status1_{{ $order->id }}'
                                        @if (isset($order->status) && $order->status == 1) selected @endif value="1">On progress</option>
                                    <option id='status2_{{ $order->id }}'
                                        @if (isset($order->status) && $order->status == 3) selected @endif value="3">Solved</option>

                                </select>

                            @endif
                        @else
                            @if ($order->status == 2 && $order->solved == 1)
                                Waiting
                            @elseif ($order->status == 2 && $order->solved == 2)
                                Needs action
                            @else
                                {{ $status[$order->status] }}

                            @endif
                        @endif
                    </td>

                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 160px;">
                        <div class="table-row__info">
                            <p class="table-row__name">
                                {{ date('M j, Y', strtotime($order->created_at)) }}
                            </p>
                        </div>
                    </td>

                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 160px;">
                        <div class="table-row__info">
                            <p class="table-row__name">
                                {{ date('M j, Y', strtotime($order->deadline)) }}
                            </p>
                        </div>
                    </td>

                    <td data-column="upload_date" class="table-row__td" id="actions" style="min-width: 145px;">
                        @if (Route::current()->getName() != 'tasks_archived')
                            <button id="case_{{ $order->id }}" onclick="reply(this)"
                                style="letter-spacing: .7px;font-size: 12px;background-color: #ca9b49;border-color: #ca9b49;padding-inline: 13px;display: inline-grid;"
                                class="btn btn-success btn-s">
                                Reply
                            </button>
                        @endif

                        <button id="{{ Route::current()->getName() }}_{{ $order->id }}" onclick="details(this)"
                            style="text-align: center;margin-right: 5px;padding: 9px;letter-spacing: .7px;font-size: 12px;border-color: #6c757d;padding-inline: 13px;display: inline-grid;"
                            class="{{ $order->order_number }} btn btn-s">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if (Route::current()->getName() == 'tasks')
                <div id="action" style="justify-content: end;width: 100%;display: flex;" class="row">

                    <button id="submit_fct" onclick='ajaxfunc(this)' type="button"
                        style="border-radius: 15px; position: relative; right: 1.8rem; font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: 2px; padding: 8px 25px 5px 25px;"
                        class="btn btn-primary">
                        Submit
                    </button>

                </div>
            @endif

            <div id="tasks_popup" class="overlay">
                <div class="tasks_popup">
                    <div class="container">
                        <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                                alt=""></div>
                    </div>
                    <a id='close' class="closee" href="#">&times;</a>
                    <div class="container content">


                        <form id="assign_form" method="POST" action="assign_reply" enctype="multipart/form-data">
                            @csrf
                            <input name='system_name' value="FCT" hidden readonly>
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Case number</span>
                                    <input value="#case_number" name="case_number" id="case_number" type="text"
                                        placeholder="Enter your name" readonly>
                                </div>

                                <div class="input-box">
                                    <span class="details">Comment</span>
                                    <textarea maxlength="250" style="height: 100px;overflow: hidden;resize: none;" name="task" id="task" cols="30" rows="3"
                                        required></textarea>
                                </div>
                                <div class="input-box">
                                    <input type="checkbox" name="mark_as" value="1" id="dot-1" hidden>
                                    <span class="details">Mark as solved</span>
                                    <div class="category">
                                        <label for="dot-1">
                                            <span class="dot one"></span>
                                            <span class="gender">Solved</span>
                                        </label>

                                    </div>
                                </div>
                                <div class="input-box">
                                    <span class="details">Image</span>
                                    <input id="image"
                                        style="margin-top: 5px;border: none;padding-left: 0px;border-radius: 0px;"
                                        name="image" type="file" placeholder="Enter the date">
                                </div>

                            </div>

                            <div id="assign_form_submit" style="margin: 35px 0 15px;" class="button">
                                <input type="submit" value="Submit">
                            </div>
                        </form>

                    </div>

                    <div>

                    </div>
                </div>
            </div>

            <div id="popup" class="overlay">
                <div style="width: 50%;" class="popup">
                    {{-- <div style="display: flex;justify-content: center;margin-bottom: 10px;align-items: center;"><div style="height: 60px;width: 60px;" class="circle"><h3 style="margin: 0;" id="pop_id" ></h3> </div></div> --}}
                    <h2 style="margin-bottom: 30px"><span style="font-size:26px;">Case </span> <span id="pop_id"></span>
                    </h2>
                    <a id='close' class="closee" href="#">&times;</a>
                    <div id="pop_priority">
                    </div>
                    <input value="{{ Auth::user()->id }}" type="text" id="user_id" readonly hidden>
                    <hr>
                    <div class="container content">
                        <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 8px;" class="icon fas fa-hashtag" data-feather="user"></i>
                            <span id="pop_order_number">order_number</span>
                        </div>
                        <div style="display: flex;align-items: baseline;justify-content: start;">
                            <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                class="row">
                                <i style="margin-right: 8px;" class="icon far fa-window-restore" data-feather="user"></i>
                                <span id="pop_system_name">system</span>
                            </div>
                        </div>
                        <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 8px;" class="icon fas fa-user" data-feather="user"></i>
                            <span id="pop_name">name</span>
                        </div>
                        <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                            class="row">
                            <i style="margin-right: 8px;" class="icon fas fa-calendar-day" data-feather="user"></i>
                            <span id="pop_deadline">deadline</span>
                        </div>
                        <hr>
                        <div class="row"
                            style="flex-wrap: nowrap;display: flex;align-items: flex-start;justify-content: space-between;">
                            <div style="width: 50%;flex-wrap: nowrap;margin-top: 15px;display: flex;align-items: start;justify-content: start;margin-left: 20px;"
                                class="row">
                                <i style="margin-right: 15px;" class="icon fas fa-comment-dots" data-feather="user"></i>
                                <textarea maxlength="250" style="width: 100%;padding: 5px 10px;border-color: #ebebeb;border-radius: 5px;height: 100px;overflow: auto;resize: none;"
                                    name="task" id="pop_comment" cols="30" rows="3" readonly></textarea>
                            </div>
                            <div id="pop_image_url"
                                style="width: 35%;margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;">
                            </div>

                        </div>
                        <hr>


                        <div style="display: flex;">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <div id="pop_replies"
                                style="width: 100%;display: inline-block;grid-column-gap: 0px;grid-template-columns: auto auto;">

                            </div>
                        </div>

                    </div>
                    <hr>
                    <div>

                        {{-- @if (Route::current()->getName() == 'confirmed' || Route::current()->getName() == 'edited')

                            <div style="margin-top: 40px;justify-content: center;display: flex;">
                                <div>
                                    <button id="#{{ $order->id }}" onclick="submit_order(this)"
                                        style="font-size: 14px;margin-right: 25px;background-color: #ca9b49;
                                                                                                            border-color: #ca9b49;letter-spacing: .6px;" type="button"
                                        class="btn btn-success">Confirm</button>
                                </div>
                                <div>
                                    <button id="##{{ $order->id }}" onclick="sendCorrectMail(this)"
                                        style="margin-right: 25px;font-size: 14px;letter-spacing: .6px;" type="button"
                                        class="btn btn-info">Send Mail</button>
                                </div>

                            </div>
                        @else
                            <div style="margin-top: 30px;justify-content: flex-end;display: flex;">
                                <button id="#{{ $order->id }}" onclick="ignore(this)"
                                    style="font-size: 14px;letter-spacing: .6px;" type="button"
                                    class="btn btn-danger">IGNORE</button>
                            </div>
                        @endif --}}





                    </div>



                </div>
            </div>



            <div class="pagination">
                <a href="#">&laquo;</a>
                <?php
                $orders_per_page = 15;
                $pages = ceil($number_of_orders[0]->NumberOfOrders / $orders_per_page);
                ?>
                @for ($i = 1; $i <= $pages; $i++)
                    @if ($_GET['page'] == $i)
                        @if (isset($_GET['filter']))
                            <a class='active'
                                href="?page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>
                        @else
                            <a class='active' href="?page={{ $i }}&filter=All">{{ $i }}</a>
                        @endif
                    @else
                        @if (isset($_GET['filter']))
                            <a href="?page={{ $i }}&filter={{ $_GET['filter'] }}">{{ $i }}</a>
                        @else
                            <a href="?page={{ $i }}&filter=All">{{ $i }}</a>
                        @endif
                    @endif


                @endfor


                <a href="#">&raquo;</a>
            </div>

            <div id="add_tasks_popup" class="overlay">
                <div class="tasks_popup">
                    <div class="container">
                        <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                                alt=""></div>
                    </div>
                    <a id='close' class="closee" href="#">&times;</a>
                    <div class="container content">


                        <form id="add_task_form" method="POST" action="add_task" enctype="multipart/form-data">
                            @csrf

                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Order number</span>
                                    <input name="order_number" id="order_number" type="text"
                                        placeholder="Enter order number" required>


                                </div>
                                <div class="input-box">
                                    <span class="details">Assign To</span>
                                    <select name="assign_to" id="assign_to" class="details" placeholder="Colleague">

                                    </select required>

                                </div>
                                <div class="input-box">
                                    <span class="details">System name</span>
                                    <select name="system_name" id="system_name" class="details"
                                        placeholder="system">
                                        <option value="facebook">Facebook</option>
                                        <option value="instgram">Instgram</option>
                                        <option value="whatsapp">Whatsapp</option>
                                        <option value="kakotalk">Kakotalk</option>
                                        <option value="emails">E-mails</option>
                                        <option value="other">other</option>
                                    </select required>

                                </div>
                                <div class="input-box">
                                    <span class="details">Deadline date</span>
                                    <input id="deadline" name="deadline" value="" type="date"
                                        min="{{ date('Y-m-d', time()) }}" placeholder="Enter the date" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">Comment</span>
                                    <textarea maxlength="250" style="height: 100px;overflow: hidden;resize: none;" name="task" id="task" cols="30" rows="3"
                                        required></textarea>
                                </div>

                                <div class="input-box">
                                    <span class="details">Image</span>
                                    <input id="image" style="margin-top: 5px;border: none;" name="image" type="file"
                                        placeholder="Enter the date">
                                </div>


                            </div>
                            <div class="gender-details">
                                <input type="radio" name="priority" value="2" id="dot-urgent">
                                <input type="radio" name="priority" value="1" id="dot-important">
                                <input type="radio" name="priority" value="0" id="dot-normal" checked>

                                <span class="gender-title">Priority</span>
                                <div class="category">
                                    <label for="dot-urgent">
                                        <span class="dot urgent"></span>
                                        <span
                                            style="text-decoration: underline;text-underline-position: under;text-decoration-color: red;"
                                            class="gender">Urgent</span>
                                    </label>
                                    <label for="dot-important">
                                        <span class="dot important"></span>
                                        <span
                                            style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(239, 188, 0);"
                                            class="gender">Important</span>
                                    </label>
                                    <label for="dot-normal">
                                        <span class="dot normal"></span>
                                        <span
                                            style="text-decoration: underline;text-underline-position: under;text-decoration-color: rgb(29, 141, 1);"
                                            class="gender">Normal</span>
                                    </label>

                                </div>
                                <div id="add_task_submit" style="margin: 35px 0 15px;" class="button">
                                    <input type="submit" value="Submit">
                                </div>
                        </form>

                    </div>


                </div>
            </div>

        </div>
    </div>

    <script>
        function tag(ele) {
            $(".swal2-input").val(ele.value);
        }
        $("#filters button").click(function() {


            if (this.id == "Normal") {
                window.location.href = "?page=1&filter=Normal";

            } else if (this.id == "Important") {
                window.location.href = "?page=1&filter=Important";

            } else if (this.id == "Urgent") {
                window.location.href = "?page=1&filter=Urgent";
            } else {
                window.location.href = "?page=1&filter=All";
            }
            selected = this.id;
        });


        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });

        var orders = new Object();
        var test = new Object();
        var order_number;
        var data;

        var url = window.location.protocol + "//" + window.location.host;

        function press(elemant) {
            order_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
            data = elemant.id.substring(0, elemant.id.indexOf("_"));


            test = new Object();

            if (orders[order_number] == null) {

                test[data] = elemant.value;

                orders[order_number] = test;

            } else {
                test = orders[order_number];

                test[data] = elemant.value;

                orders[order_number] = test;

            }
            console.log(orders);

        }

        function ajaxfunc(elemant) {


            if (Object.keys(orders).length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Nothing to submit!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $(elemant.parentElement).html(
                    '<div id="submit_tasks" style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;font-weight: 600;padding: 10px 25px 10px 25px; display: inline-block; margin-left: 20px; align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );

                $.ajax({
                    url: "task_status",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: orders,
                    },
                    success: function() {
                        location.reload(true);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your Task status has been updated',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                });
            }

        };


        /*  yasmona w nour  */
        function add_task(elemant) {
            var html = "";
            $.ajax({
                url: "get_users",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {


                    html += '<option value="" selected disabled hidden>Select colleague Name</option>';
                    response.forEach(element => {
                        html += '<option value="' + element.id + '">' + element.name + '</option>'
                    });


                    $('#assign_to').html(html);

                    $('#order_number').val(order_number);

                    $('#add_tasks_popup').show();
                }
            });
        }
        $(document).ready(function() {
            $("#add_task_form").on("submit", function() {
                $('#add_task_submit').html(
                    '<div id="add_task_submit" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            }); //submit

            $("#assign_form").on("submit", function() {
                $('#assign_form_submit').html(
                    '<div id="assign_form_submit" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );
            });
        });

        function reply(elemant) {
            case_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
            data = elemant.id.substring(0, elemant.id.indexOf("_"));

            $('#case_number').val(case_number);

            $('#tasks_popup').show();

        }

        function details(elemant) {
            var id = elemant.id.substring(elemant.id.indexOf("_") + 1);
            var route_name = elemant.id.substring(0, elemant.id.indexOf("_"));
            var html = "";

            $.ajax({
                url: "task_details",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    task: id,
                    route_name: route_name
                },
                success: function(response) {
                    $('#pop_id').html(response[0]['id']);
                    $('#pop_order_number').html(response[0]['order_number']);
                    $('#pop_system_name').html(response[0]['system_name']);
                    $('#pop_name').html(response[0]['name']);
                    let yourDate = new Date(response[0]['deadline']);

                    $('#pop_deadline').html(yourDate.toLocaleDateString("en-US", {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }));
                    /*                             <div class="card-img" style="background-image:asset("uploads/tasks/'+response[0]['image_url']+' );">
                     */
                    if (response[0]['image_url'] != "") {
                        $('#pop_image_url').html(
                            '<img style="height: max-content;width: 100%;" src="uploads/tasks/' +
                            response[0]['image_url'] + '" alt=""> ');
                    }


                    $('#pop_comment').html(response[0]['comment']);

                    if (response[0]['priority'] == 0) {
                        $('#pop_priority').html(
                            "<div style='width: 24px;justify-content: center;background-image:url({{ asset('green.png') }});height: 30px; background-repeat: inherit;color: white;top: 89px;position: absolute;left: 91%;z-index: 10;display: flex;'>N</div>"
                        );

                    } else if (response[0]['priority'] == 1) {
                        $('#pop_priority').html(
                            "<div style='width: 24px;justify-content: center;background-image:url({{ asset('yellow.png') }}); height: 30px; background-repeat: inherit;color: white;top: 89px;position: absolute;left: 91%;z-index: 10;display: flex;'>I</div>"
                        );

                    } else {
                        $('#pop_priority').html(
                            "<div style='width: 24px;justify-content: center;background-image:url({{ asset('red_band.png') }});height: 30px; background-repeat: inherit;color: white;top: 89px;position: absolute;left: 91%;z-index: 10;display: flex;'>U</div>"
                        );

                    }






                    $('#popup').show();
                    response.forEach(element => {

                        if (element.reply == null) {
                            html +=
                                '<div style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #ab1f3f;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"><span>' +
                                'No replies for this task yet' + '</span></div>';

                        } else {
                            if ($('#user_id').val() == element.user) {
                                html +=
                                    '<div class="column"><div class="row" style="margin-right: 0px;justify-content: end;font-size: 12px;align-items: end;">';
                                if (element.reply_image_url != "") {
                                    html += '<a target="blank" href="' + url +
                                        '/uploads/tasks/' + element.reply_image_url +
                                        '" style="margin-right: 5px;">#Attachment</a>';
                                }
                                html +=
                                    ' <div style="overflow-wrap: anywhere;max-width: 60%;position: sticky;left: 100%;font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #cb9d4c;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"><span>' +
                                    element.reply +
                                    '</span></div> </div> <span style="position: sticky;left: 87%;font-size: 10px;color: #646667;">' +
                                    element.reply_created_at + '</span></div>';

                            } else {
                                html +=
                                    '<div class="column"><div class="row" style="margin-left: 0px;font-size: 12px;align-items: end;">';

                                html +=
                                    '<div style="overflow-wrap: anywhere;max-width: 60%;font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #36304a;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 15px;"><span>' +
                                    element.reply +
                                    '</span></div>';
                                if (element.reply_image_url != "") {
                                    html += '<a target="blank" href="' + url +
                                        '/uploads/tasks/' + element.reply_image_url +
                                        '" style="margin-left: 5px;">#Attachment</a>';
                                }
                                html +=
                                    '</div><span style="position: sticky;left: 11%;font-size: 10px;color: #646667;">' +
                                    element.reply_created_at + '</span></div>';

                            }
                        }



                    });
                    $('#pop_replies').html(html);

                }
            });


            /*  $('#order_number').val(order_number);

             $('#popup').show(); */

        }
    </script>

    <script>
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
    </script>

@endsection
