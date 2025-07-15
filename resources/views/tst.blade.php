@extends('layouts.staff_layout')

@section('content')
    
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

        .btn-primary:disabled {
            border-radius: 18px;
            font-size: 14px;
            background-color: #303030e6 !important;
            border-color: #303030e6 !important;
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

        #file:focus-visible {
            outline: none;
        }

        input:focus-visible {
            outline-color: #1b34256b;
            outline-style: double;
        }

        select:focus-visible {
            outline: none;
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
        .menu-children {
            display: none;
            width: 7.8rem;
            position: absolute;
            list-style: none;
            z-index: 10;
            background-color: #1b3425;
            padding: 0.5rem;
            border-radius: 2px 2px 8px 8px;
        }
        .menu-item-has-children:hover .menu-children {
            display: block;

        }
        .sub_filters:hover{
            color: #d2aa66;
            text-decoration: underline;
        }
        .sub_sub_filters:hover{
            color: white;
            text-decoration: underline;
        }

        .hide {
            display: none;
        }

        .myDIV:hover + .hide {
            display: block;
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

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }
        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            width: 20px;
            height: 15px;
        }
        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            width: 20px;
            height: 100%;
        }
        .wtree li:last-child:after {
            display: none;
        }
        .wtree li span {
            display: block;
            border: 1px solid #ddd;
            padding: 10px;
            color: #888;
            text-decoration: none;
        }

        .wtree li span:hover, .wtree li span:focus {
            background: #eee;
            color: #000;
            border: 1px solid #cb9d48;
        }
        .wtree li span:hover + ul li span, .wtree li span:focus + ul li span {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }
        .wtree li span:hover + ul li:after, .wtree li span:hover + ul li:before, .wtree li span:focus + ul li:after, .wtree li span:focus + ul li:before {
            border-color: #aaa;
        }
        .variant_card{
            cursor: pointer;
            border-radius: 10px;
            margin-top: 30px;
        }
        .variant_card:hover{
            box-shadow: 0 0 3px #9b9b9b, 0 0 5px #1b3425;
            padding: 10px;

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
            width: 10rem;
            background-color: #f7f6f3;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            text-align: center;
            color: #636464;
            font-weight: 600;
            font-size: 16px;
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
            top: -25px;
            left: 90%;
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


    @php
    $previous_order = '';
    $country_to_store = ['Egypt' => 'Plus Egypt', 'Saudi Arabia' => 'Plus Ksa', 'Kuwait' => 'Plus KW','United Arab Emirates'=>'UAE',
        'Bahrain'=>'Bahrain','Qatar'=>'Qatar','Oman'=>'Oman','Jordan'=>'Jordan' , 'Iraq' => 'Iraq' ];
    $original_status = ['Verified' , 'Fulfilled' , 'Dispatched' , 'Kshopina_Warehouse' , 'Delivery', 'Delivered', 'Refused'];
    $status_colors = ['grey', 'blue' , 'dark_blue', 'yellow', 'orange', 'green', 'red'];

    $category = ['Normal', 'Pre-order', 'Paid'];
    $country_currency=['Egypt'=>'EGP','Saudi Arabia'=> 'SAR','Kuwait'=>'KWD','United Arab Emirates'=> 'AED','Bahrain'=> 'BHD','Qatar'=> 'QAR', 'Oman'=> 'OMR', 'Jordan'=> 'JOD'];

    @endphp
    
    <div class="container">

        <div class="floating-button-menu menu-off" style="display: flex;align-items: center;justify-content: center;">
            <div class="floating-button-menu-links">
                <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: #f241416e;border-color: #f241416e;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Canceled</span>
                </a>
                <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: #ca9b49a8;border-color: #ca9b49a8;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Re-delivery after cancelation</span>
                </a>
                <a href="#" style=" display: flex;flex-direction: row; align-items: center;">
                    <div style="margin: 0px 10px 5px 0px;background-color: #126dd075;border-color: #126dd075;height: 30px;width: 30px;"
                        class="tag">
                    </div>
                    <span>Holding in FCT</span>
                </a>
            </div>
            <div class="floating-button-menu-label"><i class="fas fa-palette"></i></div>
        </div>

        <div class="floating-button-menu-close"></div>

        <div class="row row--top-40">

            <div class="column">
                <h2 class="row__title" style="font-weight: 600;">Total Sales Table</h2>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="row stati turquoise "
                    style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                    <div style="padding-left: 25px;text-align: left;">
                        <b style="color: #1b3425;">{{ $number_of_verified[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px;">Verified</span>
                    </div>
                    <div style="padding-right: 25px;">
                        <b>{{ $number_of_fulfiled[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Fulfilled</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row stati turquoise left"
                    style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                    <div style="padding-left: 25px;">
                        <b style="color: #1b3425;">
                            @if ($_GET['store'] == 'origin')
                            {{ $number_of_dispatched[0]->NumberOfOrders }}
                            @else 
                             {{0}}
                            @endif
                         </b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Dispatched</span>
                    </div>
                    <div style="padding-right: 25px;text-align: right;">
                        <b>
                             @if ($_GET['store'] == 'origin')
                             {{ $number_of_in_warehouse[0]->NumberOfOrders }}
                            @else 
                             {{0}}
                             @endif
                        </b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">In Warehouse</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row stati bg-turquoise "
                    style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                    <div style="padding-left: 25px;text-align: left;">
                        <b>{{ $number_of_delivery[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Delivery</span>
                    </div>
                    <div style="padding-right: 25px;">
                        <b>{{ $number_of_canceled[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px;">Canceled</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row stati bg-turquoise left"
                    style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                    <div style="padding-left: 25px;">
                        <b>{{ $number_of_delivered[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px;">Delivered</span>
                    </div>
                    <div style="padding-right: 25px;text-align: right;">
                        <b>{{ $number_of_refused[0]->NumberOfOrders }}</b>
                        <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Refused</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px;">

            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert" style="margin-right: 10px;">×</button>
                    <strong>{{ $message }}</strong> 
                    @php
                       $status = Session::get('status');
                       $failed = $status['failed'];
                    @endphp
                   @if ($failed != 0)
                     <a href="{{'/public/uploads/import_errors/' . Session::get('file_name') }}" target="blank" id="failure_file"> ( Reasons of failures ) </a>
                   @endif
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            

            @if ( $_GET['store'] == 'plus_kuwait')
                @php
                    $filter ='Kuwait';
                @endphp
             @elseif ( $_GET['store'] ==  'plus_egypt')
                @php
                $filter ='Egypt';
                @endphp
             @elseif ( $_GET['store'] ==  'plus_ksa')
                @php
                $filter ='Saudi%20Arabia';
                @endphp
            @elseif ( $_GET['store'] ==  'plus_uae')
                @php
                $filter ='United%20Arab%20Emirates';
                @endphp
            @else 
                @php
                $filter ='Egypt';
                @endphp
            @endif

            <div
                style="display: flex; background: #1b3425; height: 70px; padding: 2.5% 2% 0% 1%; border-radius: 5px 5px 5px 5px;">
                <a href="verified?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}" id="pending"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                          font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                            @if (Route::current()->getName() == 'verified') background: #ffffff; color: #1b3425;
                        @else
                        background-color: #1b3425;color: #d2ac6a; @endif ">
                    Verified</a>
                <a href="on_process?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}" id="on_process"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 110px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                         font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                         @if (Route::current()->getName() == 'on_process') background: #ffffff; color: #1b3425;
                    @else
                    background-color: #1b3425;color: #d2ac6a; @endif ">
                    On process</a>
                <a href="fulfilled?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}" id="fulfilled"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                         font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                         @if (Route::current()->getName() == 'fulfilled') background: #ffffff; color: #1b3425;
                    @else
                    background-color: #1b3425;color: #d2ac6a; @endif ">
                    Fulfilled</a>
                <a href="tst?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}" id="confirmed"
                    style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                         font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                         @if (Route::current()->getName() == 'tst') background: #ffffff; color: #1b3425;
                    @else
                    background-color: #1b3425;color: #d2ac6a; @endif ">
                    TST</a>
                    
                    <div style="align-items: center; width: 80%;justify-content: flex-end;padding-left: 15px;display: flex;">
                        @if ($_GET['store'] == 'origin')
                            <a href="orders_by_awb?store=origin&filter={{ $_GET['filter'] }}&category=all" id="awbs"
                            style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 11px;width: 95px;padding-bottom: 0.5rem;display: flex;border-radius: 15px 15px 0px 0px;
                                font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                                @if (Route::current()->getName() == 'orders_by_awb') background: #ffffff; color: #1b3425;
                            @else
                            background-color: #1b3425;color: #d2ac6a; @endif ">
                            AWBs</a>
                        @endif
                       

                        <a href="bulk?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category=normal" id="edited"
                            style="cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 11px;
                                width: 125px;padding-bottom: 0.5rem;display: flex;border-radius: 15px 15px 0px 0px;font-family: 'Bebas Neue', cursive;letter-spacing: 2px;
                                @if (Route::current()->getName() == 'bulk') background: #ffffff; color: #1b3425;
                            @else
                            background-color: #1b3425;color: #d2ac6a; @endif  ">
                            Bulk Orders</a>

    
                        <li id="menu-item-749" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children has-sub open" style="list-style: none;">
                            <a href="archived?store={{ $_GET['store'] }}&page=1&filter={{ $_GET['filter'] }}&category=normal&archived=0"   
                            style="cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 11px;
                            width: 125px;padding-bottom: 0.5rem;display: flex;border-radius: 15px 15px 0px 0px;
                            @if( Route::current()->getName() == 'archived' || isset($_GET['archived'])) background: #ffffff; color: #1b3425;
                            @else  background-color: #1b3425; color: #d2ac6a;
                            @endif">
                                <span style="font-family: 'Bebas Neue', cursive;letter-spacing: 2px;" id="archived_filter">
                                    @if ((isset($_GET['archived']) && $_GET['archived'] == 0)    ) Delivered
                                    @elseif ((isset($_GET['archived']) && $_GET['archived'] == 1)   ) All Refused
                                    @elseif ( (isset($_GET['archived']) &&  $_GET['archived'] == 2)  ) Non-returned
                                    @else Archived
                                    @endif
                                </span>
                            </a>
                            <ul class="menu-children">
                                <li   class="menu-item menu-item-type-post_type menu-item-object-page" style="text-align: left;margin-left: 1rem;">
                                    <a href="archived?store={{ $_GET['store'] }}&page=1&filter={{ $filter}}&category=normal&archived=0" class="sub_filters" onclick="archived_D(this)" >
                                        <span style="font-family: 'Bebas Neue', cursive;letter-spacing: 2px;color: #d2ac66;" >Delivered</span>
                                    </a>
                                </li>
                                <li id="refused_filter" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children has-sub open" style="list-style: none;text-align: left;margin-left: 1rem;">
                                    <a href="archived?store={{ $_GET['store'] }}&page=1&filter={{ $filter}}&category=normal&archived=1" class="myDIV" style="cursor: pointer;padding-top: 12px;
                                    width: 90px;padding-bottom: 0.5rem;display: flex;border-radius: 15px 15px 0px 0px;
                                    background-color: #1b3425;color: #d2ac6a; ">
                                        <span style="font-family: 'Bebas Neue', cursive;letter-spacing: 2px;">Refused</span>
                                    </a>
                                    @if (isset($_GET['store']) && $_GET['store'] =='origin')
                                        <ul class="hide"  id="refused_options">
                                            <li style="text-align: left;margin-left: 1rem;list-style: none;"  >
                                                <a href="archived?store={{ $_GET['store'] }}&page=1&filter={{ $filter}}&category=normal&archived=1" class="sub_sub_filters" >
                                                    <span style="font-family: 'Bebas Neue', cursive;letter-spacing: 2px;color: white; font-size:11px;">ALL</span>
                                                </a>
                                            </li>
                                            <li  style="text-align: left;margin-left: 1rem;list-style: none;">
                                                <a href="archived?store={{ $_GET['store'] }}&page=1&filter={{ $filter}}&category=normal&archived=2" class="sub_sub_filters">
                                                    <span style="font-family: 'Bebas Neue', cursive;letter-spacing: 2px;color: white; font-size:11px;">Non-returned</span>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif 
                                    <span class="holder"></span>
                                </li>
                            </ul>
                            <span class="holder"></span>
                        </li>
                    </div>
            </div>

            @if (Route::current()->getName() != 'bulk')
            
           
                @if (Route::current()->getName() != 'orders_by_awb' )
               
                    <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff;">

                        <div  class="expanding-search-form">
                            <div class="search-dropdown">
                            <button style="width: 75px;" class="button dropdown-toggle" type="button">
                                <span style="font-size: smaller;display: flex;justify-content: center;align-items: center;height: 100%;" class="toggle-active">Order No.
                                    <i class="fas fa-angle-down" style="padding: 0px 0px 0px 6px;font-size: 12px;"></i></span>
                                <span class="ion-arrow-down-b"></span>
                            </button>

                            {{-- <select class="dropdown-menu" onchange="filter_search(this)"
                                style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;"
                                name="search_filter">
                                <option selected value="1">Order No. </option>
                                <option value="2">Traking No. </option>
                                
                            </select> --}}

                            <ul class="dropdown-menu">
                                <li class="menu-active" onclick="filter_search(this)" value="1" selected><a href="#"  id="search_order_number" >Order No.</a></li>
                                <li onclick="filter_search(this)" value="2"><a href="#"   id="search_traching_number" >MAWB</a></li>
                                <li onclick="filter_search(this)" value="3"><a href="#"   id="search_traching_number" >HAWB</a></li>
                            </ul>
                            </div>
                            <input class="search-input" id="global-search" type="search" placeholder="Search"  onkeyup="search_order(this)" autocomplete="off" 
                            style="border: 1px solid black;margin-left: -5px;padding: 0.5rem;border-radius: 0px 8px 8px 0px;">
                            
                       
                            <div id="results" class="result col"
                            style="border-radius: 6px;padding-top: 10px;top: 46px;display: none;  flex-basis: 0;  flex-grow: 1; max-width: 100%; max-height: 250px; overflow-x: hidden;
                            overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                            </div>
                        </div>

                        <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;">

                            @if (Route::current()->getName() != 'archived')
                                <button style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:11;"
                                    class="@if (isset($_GET['category']) && $_GET['category'] == 'all') selected @endif " id="all">All</button>
                                <button class="@if (isset($_GET['category']) && $_GET['category'] == 'normal') selected @endif " id="normal"
                                    style="flex:11;">Normal</button>
                                <button class="@if (isset($_GET['category']) && $_GET['category'] == 'pre order') selected @endif " id="pre_order"
                                    style="flex:11;">Pre-Order</button>
                                <button class="@if (isset($_GET['category']) && $_GET['category'] == 'paid') selected @endif " id="paid"
                                    style="flex:11;border-radius: 0px 10px 10px 0px;border-right: 1px solid;">Paid</button>

                            @else
                                <button style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:11;"
                                    class="@if (isset($_GET['category']) && $_GET['category'] == 'normal') selected @endif " id="normal">Normal</button>
                        
                                <button class="@if (isset($_GET['category']) && $_GET['category'] == 'pre order') selected @endif " id="pre_order"
                                    style="flex:11;">Pre-Order</button>
                                <button class="@if (isset($_GET['category']) && $_GET['category'] == 'paid') selected @endif " id="paid"
                                    style="flex:11;border-radius: 0px 10px 10px 0px;border-right: 1px solid;">Paid</button>

                            @endif
                        
                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'origin')
                                <div style="flex:22;margin-left: 35px;" class="position-relative">
                                    <i style="color: #1b3425;font-size: 17px;display: flex;position: absolute;top: 13px;left: 12px;"
                                        class="fas fa-map-marker-alt"></i>
                                    <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px"
                                        name="locations" id="locations"
                                        onchange="javascript:handleSelect('{{ $_GET['store'] }}',this)">

                                        <option value="Select" disabled hidden selected>Select the country</option>
                                        <option value="All" @if (isset($_GET['filter']) && $_GET['filter'] == 'All') selected @endif >ALL</option>
                                        <option value="Egypt"@if (isset($_GET['filter']) && $_GET['filter'] == 'Egypt') selected @endif id="Egypt">
                                            Egypt </option>
                                        <option value="Saudi Arabia" @if (isset($_GET['filter']) && $_GET['filter'] == 'Saudi Arabia') selected @endif
                                            id="KSA">Saudi Arabia</option>
                                        <option value="Kuwait" @if (isset($_GET['filter']) && $_GET['filter'] == 'Kuwait') selected @endif id="Kuwait">
                                            Kuwait</option>
                                        <option value="Oman" @if (isset($_GET['filter']) && $_GET['filter'] == 'Oman') selected @endif id="Oman">
                                            Oman</option>
                                        <option value="Bahrain" @if (isset($_GET['filter']) && $_GET['filter'] == 'Bahrain') selected @endif
                                            id="Bahrain">Bahrain</option>
                                        <option value="Qatar" @if (isset($_GET['filter']) && $_GET['filter'] == 'Qatar') selected @endif id="Qatar">
                                            Qatar</option>
                                        <option value="Jordan" @if (isset($_GET['filter']) && $_GET['filter'] == 'Jordan') selected @endif id="Jordan">
                                            Jordan</option>
                                        <option value="United Arab Emirates"
                                            @if (isset($_GET['filter']) && $_GET['filter'] == 'United Arab Emirates') selected @endif id="UAE">United Arab Emirates
                                        </option>
                                        <option value="Iraq" role="separator"
                                            @if (isset($_GET['filter']) && $_GET['filter'] == 'Iraq') selected @endif id="Iraq">Iraq
                                        </option>
                                        <optgroup label="-----------------------------">
                                        </optgroup>
                                        {{-- <option value=""disabled > _____________ </option> --}}
                                        <option value="Others" @if (isset($_GET['filter']) && $_GET['filter'] == 'Others') selected @endif id="Others">
                                            Others</option>

                                    </select>
                                </div>
                            @endif
                            @if (Route::current()->getName() == 'tst' || Route::current()->getName() == 'verified'  || Route::current()->getName() == 'on_process' )
                                <div  style="flex:10;margin-left: 35px;"  >
                                    <button type="submit" id="export" name="action" value="export" onclick="export_options()"
                                        style="position: relative;
                                    letter-spacing: 2px;font-size: 18px; background-color: #1b3425; color: #d2ac6a; display: inline-grid;border-color: transparent;font-family: 'Bebas Neue', cursive;     width: -webkit-fill-available;"
                                        class="btn btn-success btn-s">
                                        Export
                                    </button>
                                </div>
                            @endif
                            {{--  archived  --}}
                                @if (Route::current()->getName() == 'archived')
                                    <div  style="flex:10;margin-left: 35px;"  >
                                        <button type="submit" id="export" name="action" value="export" onclick="archived_export()"
                                            style="position: relative;
                                        letter-spacing: 2px;font-size: 18px; background-color: #1b3425; color: #d2ac6a; display: inline-grid;border-color: transparent;font-family: 'Bebas Neue', cursive;     width: -webkit-fill-available;"
                                            class="btn btn-success btn-s">
                                            Export
                                        </button>
                                    </div>
                                @endif
                            {{--  archived  --}}
                        </div>
                        
                    </div>

                    <table class="table">

                        <thead class="table__thead">
                            <tr style="background-color: #ffffff;">
                                @if ((Route::current()->getName() != 'tst' && Route::current()->getName() != 'archived' ) && $_GET['store'] == "origin" && $_GET['filter'] != "All" && $_GET['filter'] != "Others" )
    
                                    <th class="table__th" style="white-space: nowrap;"></th>
                                @endif
    
                                    <th class="table__th" style="white-space: nowrap;">Order Number</th>
    
                                    @if (Route::current()->getName() != 'archived')
                                        @if ($_GET['store'] != "origin")
                                            <th class="table__th">Price</th>
                                            @if (Route::current()->getName() != 'tst')
                                                <th class="table__th">KMEX.NO</th>
                                            @endif
                                        @else
                                            <th class="table__th">Dollar</th>
                                            @if (Route::current()->getName() != 'tst')
                                                <th class="table__th">Currency</th>
                                                <th class="table__th">KMEX.NO</th>
                                            @endif
                                        @endif
                                    @endif
                                    
    
                                    @if (Route::current()->getName()!='on_process' && Route::current()->getName()!='verified')
                                        @if ($_GET['store'] == "origin")
                                    
                                    
                                        <th class="table__th">MAWB</th>
                                        @else
                                        <th class="table__th">HAWB</th>
                                        @endif                                
                                    @endif
                                
                                
                                    @if (Route::current()->getName() == 'tst' || Route::current()->getName() == 'archived')
                                        @if ($_GET['store'] == "origin")
                                        <th class="table__th">HAWB</th>
                                        @endif
                                    
                                        <th class="table__th">Company</th>
                                        @if (Route::current()->getName() == 'tst' && Route::current()->getName() != 'archived')
                                            <th class="table__th">KMEX.NO</th>
                                        @endif
                                    @endif

                                    <th class="table__th">Status</th>
                                    @if (Route::current()->getName() == 'verified' && isset($_GET['category']) && $_GET['category'] == "pre order" )
                                    <th class="table__th">release date</th>
                                    @endif
                                    @if (Route::current()->getName() != 'tst' && Route::current()->getName() != 'archived' && isset($_GET['category']) && $_GET['category'] !="pre order")
                                        <th class="table__th">Last Action</th>
                                    @endif
                                    @if (Route::current()->getName() == 'archived' && (isset($_GET['store']) && $_GET['store'] == "origin")  
                                    && (isset($_GET['archived']) && $_GET['archived'] == 2 )) 

                                        <th class="table__th ">RTO date</th>

                                    @endif
    
                                    <th class="table__th ">Actions</th>
                               
                            </tr>
                        </thead>
    
                        <tbody id="table" class="table__tbody">
                           
                           
                                @foreach ($orders as $order)
                                    @if ($previous_order == '' || $order->order_number != $previous_order)
                                        @php
                                            $previous_order = $order->order_number;
                                            $currency_country=['Saudi Arabia'=> 'SAR','Kuwait'=> 'KWD','Jordan'=>'JOD',
                                            'Bahrain'=> 'BHD','Oman'=>'OMR','Egypt'=> 'EGP','Qatar'=>'QAR','United Arab Emirates'=>'AED']
                                        @endphp
    
                                        <tr class="table-row table-row--chris"
                                            @if ($order->actions == 1) style="background-color: #f241416e;"
                                            @elseif ($order->actions == 2) style="background-color: #ca9b49a8;"
                                            @elseif ($order->actions == 3) style="background-color: #126dd075;" @endif>
    
                                            @if ( (Route::current()->getName() != 'tst' && Route::current()->getName() != 'archived' )  && $_GET['store'] == "origin"  && $_GET['filter'] != "All" && $_GET['filter'] != "Others")
                                                <td data-column="upload_date" class="table-row__td" style="font-size: 12px;width: 150px;font-weight: 500;">
                                                    
                                                    @if (isset($availability[$order->order_number]) )
                                                        <span style="font-size: 15px;font-weight:800;">{{count($availability[$order->order_number])}}</span> 
                                                        out of  <span style="font-size: 15px;font-weight:800;">{{$number_of_items[$order->order_number]}}</span>  at  {{$country_to_store[$order->country]}}
                                                    @else
    
                                                    <span style="font-size: 15px;font-weight:800;">0</span>  out of  <span style="font-size: 15px;font-weight:800;">{{$number_of_items[$order->order_number]}}</span>  at  {{$country_to_store[$order->country]}}
                                                    @endif
                                                </td>
                                            @endif
    
                                            <td data-column="upload_date" class="table-row__td" style="width: 130px;">
                                                <div class="table-row__info">
                                                    <p class="table-row__name">
                                                        @if (Route::current()->getName() == 'archived' && $_GET['archived'] == 2) 
                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'origin')
                                                                <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                    href="https://kshopina.myshopify.com/admin/orders/{{ $order->shopify_id }}"
                                                                    target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
                                                            

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_egypt')
                                                                <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                    href="https://kshopina-egypt.myshopify.com/admin/orders/{{ $order->shopify_id }}"
                                                                    target="_blank">#{{ $order->order_number }}</a>
                                                            @endif

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_kuwait')
                                                                <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                    href="https://kshopina-plus-kuwait.myshopify.com/admin/orders/{{ $order->shopify_id }}"
                                                                    target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
            
                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_ksa')
                                                                <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                    href="https://kshopina-plus.myshopify.com/admin/orders/{{ $order->shopify_id }}"
                                                                    target="_blank">#{{ $order->order_number }}</a>
                                                            @endif

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_uae')
                                                                <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                    href="https://kshopina-uae.myshopify.com/admin/orders/{{ $order->shopify_id }}"
                                                                    target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
                                                        @else
                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'origin')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
                                                            

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_egypt')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina-egypt.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a>
                                                            @endif

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_kuwait')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina-plus-kuwait.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
            
                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_ksa')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina-plus.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a>
                                                            @endif

                                                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'plus_uae')
                                                            <a style="font-size: 15px;font-weight: 700;color: #0062cc;"
                                                                href="https://kshopina-uae.myshopify.com/admin/orders/{{ $order->order_id }}"
                                                                target="_blank">#{{ $order->order_number }}</a>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            @if (Route::current()->getName() != 'archived')
                                                @if ($_GET['store'] != "origin")
                                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                        <div class="table-row__info">
                                                            <p class="table-row__name">
                                                                {{ $order->total_price }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    @if (Route::current()->getName() != 'tst')
                                                        <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                            <div class="table-row__info">
                                                                <a class="table-row__name" target="blank"
                                                                    style="color: #004eff;margin-right: 10px;"
                                                                    href="tracking/{{ $order->kshopina_awb }}">
                                                                    {{ $order->kshopina_awb }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @endif
                                                @else
                                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                        <div class="table-row__info">
                                                            <p class="table-row__name">
                                                                {{ $order->total_price }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    @if (Route::current()->getName() != 'tst')
                                                        <td data-column="upload_date" class="table-row__td">
                                                            <div class="table-row__info">
                                                                <p class="table-row__name">
                                                                    {{ $order->currency }}

                                                                    @if (isset($currency_country[$order->country]) )
                                                                        <span style="font-size: 13px;font-weight: 900;">{{$currency_country[$order->country]}}</span> 
                                                                    @else
                                                                        <span style="font-size: 13px;font-weight: 900;">$</span> 
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                            <div class="table-row__info">
                                                                <a class="table-row__name" target="blank"
                                                                    style="color: #004eff;margin-right: 10px;"
                                                                    href="tracking/{{ $order->kshopina_awb }}">
                                                                    {{ $order->kshopina_awb }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                            <input value="{{ $order->status }}" type="text"
                                                id="status-{{ $order->order_number }}" readonly hidden>
    
                                            @if (Route::current()->getName()!='on_process'  && Route::current()->getName()!='verified')
                                                    
                                                    @if ($_GET['store'] != "origin")
                                                        <td data-column="upload_date" class="table-row__td">
                                                            <div style="flex-wrap: nowrap;justify-content: center;align-items: center;" class="row">
                                                                <input @if ($order->actions == 3) disabled @endif
                                                                value="{{ $order->international_awb }}"
                                                                style="text-align: center;width: 120px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                                    @if (!empty($order->international_awb)) background-color: transparent; font-weight:bold; @endif  "
                                                                type="text" name="awb" id="awb_{{ $order->order_number }}"
                                                                onkeyup="press(this)">
                                                                @if (!empty($order->international_awb))
                                                                    
                                                                    @if ($order->domestic_company == "GLT")
                                                                        <a href="https://www.gltmena.com/trackorder/{{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    @elseif($order->domestic_company == "IMEPRESS")
                                                                        <a href="https://imepressexpress.com/track-order/" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    @elseif($order->domestic_company == "OCS")
                                                                        <a href="http://www.ocskuwait.com/tracking.html?tracksearch={{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    @elseif($order->domestic_company == "SMSA") 
                                                                        <a href="https://www.smsaexpress.com/trackingdetails?tracknumbers%5B0%5D={{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                        {{-- <form method="post" action="https://sdm.smsaexpress.com/track.aspx" class="inline" target="_blank">
                                                                            <input type="hidden" name="awbNo" value="{{$order->international_awb}}">
                                                                            <button style="border: none;background: transparent;" type="submit" name="btnLoad" value="Get Tracking" >
                                                                                <i style="color:#004eff" class="fas fa-link"></i>
                                                                            </button>
                                                                        </form> --}}
                                                                    @elseif($order->domestic_company == "DHL")
                                                                        <a href="https://www.dhl.com/eg-en/home/tracking/tracking-express.html?submit=1&tracking-id={{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    @elseif($order->domestic_company == "CUBE SHIP")
                                                                        <a href="https://cube.dispatchex.com" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    @elseif($order->domestic_company == "SHIPA")
                                                                    <a href="https://tracking.shipadelivery.com/?bc={{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    
                                                                    @elseif($order->domestic_company == "RSA")
                                                                        <a href="https://www.rsa.global/tracking/detail?tracking_no={{$order->international_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                    
                                                                    @elseif($order->domestic_company == "NAQEL") 
                                                                        <form method="post" action="https://www.naqelexpress.com/en/ae/tracking/" class="inline" target="_blank">
                                                                            <input type="hidden" name="csrfmiddlewaretoken" value="vtxvUDNXkgtwl9zqyNIwqczRuc0VlTYeIg8iiYA8FR6uZPbxfOC7ksyOo9maQfRO">
                                                                            <input type="hidden" name="waybills" value="{{$order->international_awb}}">

                                                                            <button style="border: none;background: transparent;" type="submit" name="btnLoad" >
                                                                                <i style="color:#004eff" class="fas fa-link"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                
                                                                
                                                                @endif
                                                            </div>
                                                            
                                                        </td>
                                                    @else
                                                            <td data-column="upload_date" class="table-row__td">
                                                                <input @if ($order->actions == 3) disabled @endif
                                                                    value="{{ $order->international_awb }}"
                                                                    style="text-align: center;width: 120px; border-width: 1px;border-radius: 4px;padding: 2px 0px;  border-color: transparent;@if (!empty($order->international_awb)) background-color: transparent; font-weight:bold; @endif "
                                                                    type="text" name="awb" id="awb_{{ $order->order_number }}"
                                                                    onkeyup="press(this)">
                                                            </td>
                                            
                                                    @endif
    
                                            @endif
    
                                            @if (Route::current()->getName() != 'tst' && Route::current()->getName() != 'archived' )
                                                <?php
                                                if (isset($order->status)) {
                                                    if ($order->on_process == 1) {
                                                        $archived_status = 'On process';
                                                    } elseif ($order->status == 0) {
                                                        $archived_status = 'Verified';
                                                    } elseif ($order->status == 1) {
                                                        $archived_status = 'Fulfilled';
                                                    } elseif ($order->status == 2) {
                                                        $archived_status = 'Dispatched';
                                                    } elseif ($order->status == 3) {
                                                        $archived_status = 'Kshopina warehouse';
                                                    } elseif ($order->status == 4) {
                                                        $archived_status = 'Delivery';
                                                    } elseif ($order->status == 5) {
                                                        $archived_status = 'Delivered';
                                                    } elseif ($order->status == 6) {
                                                        $archived_status = 'Refused';
                                                    }
                                                }
                                                if ($order->actions == 1) {
                                                    $archived_status = 'Canceled';
                                                }
                                                ?>
                                                <td data-column="upload_date" class="table-row__td">
                                                    <input disabled value="{{ $archived_status }}"
                                                        style="text-align: center;width: 120px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                                    @if (!empty($archived_status)) background-color: transparent; font-weight:bold; @endif  "
                                                        type="text" name="status" id="status_{{ $order->order_number }}"
                                                        onkeyup="press(this)">
                                                </td>
                                                    {{-- wrong --}}
                                            @endif

                                            @if (Route::current()->getName() == 'tst' || Route::current()->getName() == 'archived')
                                                @if ($_GET['store'] == "origin")
                                                    <td data-column="upload_date" class="table-row__td">
                                                        <div style="flex-wrap: nowrap;justify-content: center;align-items: center;" class="row">
                                                            <input @if ($order->actions == 3) disabled @endif
                                                            value="{{ $order->domestic_awb }}"
                                                            style="text-align: center;width: 120px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                                @if (!empty($order->domestic_awb)) background-color: transparent; font-weight:bold; @endif  "
                                                            type="text" name="lwb" id="lwb_{{ $order->order_number }}"
                                                            onkeyup="press(this)">
                                                            @if (!empty($order->domestic_awb))
                                                            
                                                                @if ($order->domestic_company == "GLT")
                                                                    <a href="https://www.gltmena.com/trackorder/{{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "IMEPRESS")
                                                                    <a href="https://imepressexpress.com/track-order/" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "OCS")
                                                                    <a href="http://www.ocskuwait.com/tracking.html?tracksearch={{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "SMSA") 
                                                                    {{-- <form method="post" action="https://sdm.smsaexpress.com/track.aspx" class="inline" target="_blank">
                                                                        <input type="hidden" name="awbNo" value="{{$order->domestic_awb}}">
                                                                        <button style="border: none;background: transparent;" type="submit" name="btnLoad" value="Get Tracking" >
                                                                            <i style="color:#004eff" class="fas fa-link"></i>
                                                                        </button>
                                                                    </form> --}}
                                                                    <a href="https://www.smsaexpress.com/trackingdetails?tracknumbers%5B0%5D={{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "DHL")
                                                                    <a href="https://www.dhl.com/eg-en/home/tracking/tracking-express.html?submit=1&tracking-id={{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "CUBE SHIP")
                                                                        <a href="https://cube.dispatchex.com" target="_blank" rel="noopener noreferrer">
                                                                            <i style="color:#004eff" class="fas fa-link"></i></a>
                                                                @elseif($order->domestic_company == "SHIPA")
                                                                    <a href="https://tracking.shipadelivery.com/?bc={{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>

                                                                @elseif($order->domestic_company == "RSA")
                                                                    <a href="https://www.rsa.global/tracking/detail?tracking_no={{$order->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                                        <i style="color:#004eff" class="fas fa-link"></i></a>

                                                                @elseif($order->domestic_company == "NAQEL") 
                                                                    <form method="post" action="https://www.naqelexpress.com/en/ae/tracking/" class="inline" target="_blank">
                                                                        <input type="hidden" name="csrfmiddlewaretoken" value="vtxvUDNXkgtwl9zqyNIwqczRuc0VlTYeIg8iiYA8FR6uZPbxfOC7ksyOo9maQfRO">
                                                                        <input type="hidden" name="waybills" value="{{$order->domestic_awb}}">

                                                                        <button style="border: none;background: transparent;" type="submit" name="btnLoad" >
                                                                            <i style="color:#004eff" class="fas fa-link"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            
                                                        
                                                            @endif
                                                        </div>
                                                        
                                                    </td>
                                                @endif
                                                @if (Route::current()->getName() == 'archived')
                                                    <td data-column="upload_date" class="table-row__td">
                                                        <input disabled value="{{ $order->domestic_company }}"
                                                            style="text-align: center;width: 120px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                            @if (!empty($order->domestic_company)) background-color: transparent; font-weight:bold; @endif  "
                                                            type="text" name="company"
                                                            id="company_{{ $order->order_number }}" onkeyup="press(this)">
                                                    </td>
                                                @else
                                                    <td data-column="upload_date" class="table-row__td">
                                                        <select @if ($order->actions == 3) disabled @endif
                                                            onchange="press(this)" id='company_{{ $order->order_number }}'
                                                            style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;"
                                                            name="company">
                                                            
                                                            <option value="" selected hidden>Select Company</option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'K-PACKET') selected @endif
                                                                value="K-PACKET">K-PACKET
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'GLT') selected @endif
                                                                value="GLT">GLT
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'IMEPRESS') selected @endif
                                                                value="IMEPRESS">IMEPRESS
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'CUBE SHIP') selected @endif
                                                                value="CUBE SHIP">CUBE SHIP
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'SMSA') selected @endif
                                                                value="SMSA">
                                                                SMSA
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'NAQEL') selected @endif
                                                                value="NAQEL">NAQEL
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'RSA') selected @endif
                                                                value="RSA">RSA
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'ARAMEX') selected @endif
                                                                value="ARAMEX">
                                                                ARAMEX</option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'SHIPA') selected @endif
                                                                value="SHIPA">SHIPA
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'FEDEX') selected @endif
                                                                value="FEDEX">FEDEX
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'ECMS') selected @endif
                                                                value="ECMS">ECMS 
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'KANGAROO ') selected @endif
                                                                value="KANGAROO ">KANGAROO 
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'GENACOM ') selected @endif
                                                                value="GENACOM ">GENACOM 
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'OCS') selected @endif
                                                                value="OCS">OCS
                                                            </option>
                                                            <option @if (isset($order->domestic_company) && $order->domestic_company == 'DHL') selected @endif
                                                                value="DHL">DHL
                                                            </option>
                                                            
                                                        </select>
                                                    </td>
                                                @endif
    
                                                @if (Route::current()->getName() == 'tst' && Route::current()->getName() != 'archived')
                                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                        <div class="table-row__info">
                                                            <a class="table-row__name" target="blank"
                                                                style="color: #004eff;margin-right: 10px;"
                                                                href="tracking/{{ $order->kshopina_awb }}">
                                                                {{ $order->kshopina_awb }}
                                                            </a>
                                                        </div>
    
                                                    </td>
                                                @endif

                                                @if (Route::current()->getName() == 'archived')
                                                    <?php
                                                    if (isset($order->status)) {
                                                        if ($order->status == 0) {
                                                            $archived_status = 'Verified';
                                                        } elseif ($order->status == 1) {
                                                            $archived_status = 'Fulfilled';
                                                        } elseif ($order->status == 2) {
                                                            $archived_status = 'Dispatched';
                                                        } elseif ($order->status == 3) {
                                                            $archived_status = 'Kshopina warehouse';
                                                        } elseif ($order->status == 4) {
                                                            $archived_status = 'Delivery';
                                                        } elseif ($order->status == 5) {
                                                            $archived_status = 'Delivered';
                                                        } elseif ($order->status == 6) {
                                                            $archived_status = 'Refused';
                                                        }
                                                    }
                                                    if ($order->actions == 1) {
                                                        $archived_status = 'Canceled';
                                                    }
                                                    ?>
                                                    <td data-column="upload_date" class="table-row__td">
                                                        <input disabled value="{{ $archived_status }}"
                                                            style="text-align: center;width: 120px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                                    @if (!empty($archived_status)) background-color: transparent; font-weight:bold; @endif  "
                                                            type="text" name="status"
                                                            id="status_{{ $order->order_number }}" onkeyup="press(this)">
                                                    </td>
                                                @else
                                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                                        <select @if ($order->actions == 3 || ($order->country =='Saudi Arabia' && strtoupper($order->domestic_company) == 'GLT') 
                                                            || ($order->country =='Kuwait' && strtoupper($order->domestic_company) == 'SHIPA') 
                                                            || ($order->country =='Saudi Arabia' && strtoupper($order->domestic_company) == 'SHIPA') 
                                                            || ($order->country =='United Arab Emirates' && strtoupper($order->domestic_company) == 'GLT') 
                                                            || ($order->country =='Egypt' && strtoupper($order->domestic_company) =='SMSA') 
                                                            || ($order->country =='Bahrain' && strtoupper($order->domestic_company) =='SMSA') 
                                                            || ($order->country =='Saudi Arabia' && strtoupper($order->domestic_company) =='SMSA') 
                                                            || ($order->country =='Bahrain' && strtoupper($order->domestic_company) =='RSA')
                                                            || ($order->country =='Kuwait' && strtoupper($order->domestic_company) =='RSA')
                                                        /*  || ($order->country =='Oman' && strtoupper($order->domestic_company) =='RSA') */
                                                            || ($order->country =='Qatar' && strtoupper($order->domestic_company) =='RSA')
                                                            || ($order->country =='United Arab Emirates' && strtoupper($order->domestic_company) =='RSA')
                                                            ) disabled @endif name="status"
                                                                id='status_{{ $order->order_number }}' onchange="press(this)"
                                                                style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;border: 0.5px solid #6c757d;border-radius: 3px;outline-color:#dfdfdf;">
                                                            <option value="" selected hidden>Select status</option>
                                                            
                                                            @if ( $_GET['store'] == 'origin' )
                                                                
                                                    
                                                                <option id='status2_{{ $order->order_number }}'
                                                                    @if (isset($order->status) && $order->status == 2) selected @endif value="2">
                                                                    Dispatched
                                                                </option>
                                                                <option id='status3_{{ $order->order_number }}'
                                                                    @if (isset($order->status) && $order->status == 3) selected @endif value="3">
                                                                    In
                                                                    Warehouse
                                                                </option>

                                                            @endif
                                                            <option id='status4_{{ $order->order_number }}'
                                                                @if (isset($order->status) && $order->status == 4) selected @endif value="4">
                                                                Out For
                                                                Delivery
                                                            </option>
                                                            <option id='status5_{{ $order->order_number }}'
                                                                @if (isset($order->status) && $order->status == 5) selected @endif value="5">
                                                                Delivered</option>
                                                            <option id='status6_{{ $order->order_number }}'
                                                                @if (isset($order->status) && $order->status == 6) selected @endif value="6">
                                                                Refused
                                                            </option>
                                                        </select>
                                                    </td>
                                                @endif
                                            @endif
    
                                            <?php 
                                                date_default_timezone_set('Africa/Cairo');
                                                $now = date('Y-m-d', time());
                                                
                                                $release_date = date('Y-m-d', strtotime($order->release_date));
                                            ?>
                                            
                                            @if(Route::current()->getName() == 'verified' && $_GET['category'] == "pre order")
                                                <td  data-column="upload_date" class="table-row__td">      
                                                <input @if ($order->release_date != NULL) value="{{$release_date}}" 
                                                        style="border-radius: 18px; padding: 6% 18% 6% 10%; border: none; font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px; @if(  $now >= $release_date ) color:red; @else color:black; @endif " 
                                                    @else 
                                                        style="border-radius: 18px; padding: 6% 18% 6% 10%; border: none; font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;  color: #426851;" 
                                                    @endif 
                                                        type="date" name="release_date" id="releasedate_{{ $order->order_number }}" onchange="press(this)" data-date-inline-picker="true" >  
                                                </td> 
                                            @endif
    
                                            @if (Route::current()->getName() != 'tst' && Route::current()->getName() != 'archived' && isset($_GET['category']) && $_GET['category'] !="pre order")
                                                <td data-column="upload_date" class="table-row__td">
                                                    <input value="{{ $order->last_action }}"
                                                        style="text-align: center;width: 100px;border-width: 1px;border-radius: 4px;padding: 2px 0px;border-color: transparent;
                                                            @if (!empty($order->last_action)) background-color: transparent; font-weight:bold; @endif  background-color: transparent;  "
                                                        type="text" name="lastaction"
                                                        id="lastaction_{{ $order->order_number }}" onkeyup="press(this)">
                                                </td>
                                            @endif


                                            @if (Route::current()->getName() == 'archived' && (isset($_GET['store']) && $_GET['store'] == "origin")  
                                                && (isset($_GET['archived']) && $_GET['archived'] == 2 )) 
        
                                                <td data-column="upload_date" class="table-row__td">{{date('Y-m-d ', strtotime($order->fct_updated_at))}}
                                                </td>
                                            @endif
                                            
                                            <td id="actions" data-column="upload_date" class="table-row__td">
                                                <div id="action">
                                                    @if (Route::current()->getName() == 'verified')
                                                        <button style="margin-right: 5px;" id="on_process_{{ $order->id }}"
                                                            onclick="move_to_on_process({{ $order->id }})"
                                                            class="{{ $order->order_number }} btn btn-primary">
                                                            On process
                                                        </button>
                                                    @endif
                                                    @if (Route::current()->getName() == 'on_process')
                                                        <button style="margin-right: 5px;" id="fulfill_{{ $order->id }}"
                                                            onclick="mark_as_fulfilled({{ $order->id }})"
                                                            class="{{ $order->order_number }} btn btn-primary">
                                                            Fulfill
                                                        </button>
                                                    @endif
                                                    @if (isset($_GET['archived']) && $_GET['archived'] == 2 && isset($_GET['filter']) && ( $_GET['filter']!='All' ) )
                                                        <button style="margin-right: 5px;" id="restock_{{ $order->order_id }}"
                                                            class="{{ $order->order_number }} btn btn-primary"
                                                            onclick="restock({{ $order->order_number }},{{ $order->order_id }})">
                                                            <i class="fas fa-boxes" ></i>
                                                        </button>
                                                    @endif
                                                    @if (isset($availability[$order->order_number]))
                                                    @php
                                                        $availability[$order->order_number][0]->product_title= preg_replace("/'/i", '"', $availability[$order->order_number][0]->product_title);
                                                    @endphp
                                                    <button style="margin-right: 5px;" id="{{ $order->id }}"
                                                        onclick='details(this,<?php echo json_encode($availability[$order->order_number]) ?> )'
                                                        class="{{ $order->order_number }} btn btn-primary">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    @else
                                                    <button style="margin-right: 5px;" id="{{ $order->id }}"
                                                        onclick="details(this,[])"
                                                        class="{{ $order->order_number }} btn btn-primary">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    @endif
                                                    
                                                    <div id="arrow_id{{ $order->order_number }}"
                                                        style="display: inline-block;cursor: pointer;justify-content: center;flex-direction: column;">
                                                        <i onclick="create_task(this)" id="assign_{{ $order->order_number }}"
                                                            class="fas fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            </td>
    
                                        </tr>
                                    @endif
                                @endforeach
    
                           
                        </tbody>
    
                    </table>
                    <div style="margin-top: 25px;display: flex;justify-content: flex-end;">
                        <button onclick="ajaxfunc(this)" type="button" class="btn btn-primary"
                            style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                            Submit
                        </button>
                    </div>
                @else 
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                    {{-- <audio  id="ostor">
                        <source src="{{asset('ostor.mp3')}}">
                    </audio>
                    <audio  id="mot2kda">
                        <source src="{{asset('mot2kda.mp3')}}">
                    </audio>
                    <audio  id="bra7a">
                        <source src="{{asset('bra7a.mp3')}}">
                    </audio>

                    <script>
                        function play(element){
                            document.getElementById(element).play();
                        }

                        function play2(element,link){
                            document.getElementById(element).play();
                            console.log("DSVDS");
                            var delayInMilliseconds = 2000; //1 second

                            setTimeout(function() {
                                window.location=link;
                            }, delayInMilliseconds);
                        }
                        
                    </script> --}}

                    <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;justify-content: space-between;">
                      
                        <div style="width: 15%;">
                            <div style="border-radius: 3px;width: 100%;border: 1px solid #1b3425;height: 38px;margin-top: 5px;display: flex;align-items: center;padding: 5px;justify-content: center;">
                                <span style="color: #1b3425;font-size: 15px;font-weight: 800;"> <span style="font-size: 13px;font-weight: 700;color: #1b3425;">TOTAL HAWB :</span> {{count($map_of_awb)}}</span> 
                            </div>
                        </div>
                        <form id="search_awb_form" style="width: 50%;">
                            @csrf
                            <div class="row"
                                style="margin-bottom: 20px;width: 100%;display: flex;justify-content: center;margin-top: 5px;">
                                                                
    
                                <input type="text" class="form-control barcode" name="awb_value" id="awb_value"
                                placeholder="AWB "
                                style="border-radius: 3px;width: 70%;border: 1px solid #1b3425;">
    
    
                            </div>
    
                        </form>

                        <div style="margin-left: 35px;width: 25%;" class="position-relative">
                            <i style="color: #1b3425;font-size: 17px;display: flex;position: absolute;top: 13px;left: 12px;"
                                class="fas fa-map-marker-alt"></i>
                            <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px"
                                name="locations" id="locations"
                                onchange="javascript:handleSelect('{{ $_GET['store'] }}',this)">
    
                                <option value="Select" disabled hidden selected>Select the country</option>
                                <option value="All" @if (isset($_GET['filter']) && $_GET['filter'] == 'All') selected @endif >ALL</option>
                                <option value="Egypt"@if (isset($_GET['filter']) && $_GET['filter'] == 'Egypt') selected @endif id="Egypt">
                                    Egypt </option>
                                <option value="Saudi Arabia" @if (isset($_GET['filter']) && $_GET['filter'] == 'Saudi Arabia') selected @endif
                                    id="KSA">Saudi Arabia</option>
                                <option value="Kuwait" @if (isset($_GET['filter']) && $_GET['filter'] == 'Kuwait') selected @endif id="Kuwait">
                                    Kuwait</option>
                                <option value="Oman" @if (isset($_GET['filter']) && $_GET['filter'] == 'Oman') selected @endif id="Oman">
                                    Oman</option>
                                <option value="Bahrain" @if (isset($_GET['filter']) && $_GET['filter'] == 'Bahrain') selected @endif
                                    id="Bahrain">Bahrain</option>
                                <option value="Qatar" @if (isset($_GET['filter']) && $_GET['filter'] == 'Qatar') selected @endif id="Qatar">
                                    Qatar</option>
                                <option value="Jordan" @if (isset($_GET['filter']) && $_GET['filter' ] == 'Jordan') selected @endif id="Jordan">
                                    Jordan</option>
                                <option value="United Arab Emirates"
                                    @if (isset($_GET['filter']) && $_GET['filter'] == 'United Arab Emirates') selected @endif id="UAE">United Arab Emirates
                                </option>
                                <option value="Iraq" role="separator"
                                    @if (isset($_GET['filter']) && $_GET['filter'] == 'Iraq') selected @endif id="Iraq">Iraq
                                </option>
                                <optgroup label="-----------------------------">
                                </optgroup>
                                {{-- <option value=""disabled > _____________ </option> --}}
                                <option value="Others" @if (isset($_GET['filter']) && $_GET['filter'] == 'Others') selected @endif id="Others">
                                    Others</option>
    
                            </select>
                        </div>
                    </div>

                    <table class="table">

                        <thead class="table__thead">
                            <tr style="background-color: #ffffff;">
                                
                                <th class="table__th" style="width: 4rem;"></th>

                                <th class="table__th" style="width: 14rem;">MAWB </th>
                                <th class="table__th" style="max-width: 145px;min-width: 145px;">Orders count</th>
                                <th class="table__th" style="width: 14rem;">Dispatching date</th>
                                <th class="table__th" style="width: 14rem;">Expected date</th>
                                <th class="table__th" style="width: 14rem;">Airway</th>
                                <th class="table__th" style="width: 14rem;">Note</th>

                                <th class="table__th" style="width: 14rem; padding-left: 20px !important;" colspan="2">Actions</th>
                                    
                            </tr>
                        </thead>
    
                        <tbody id="table" class="table__tbody">

                          

                            @foreach ($map_of_awb as $international_awb => $order_array)
                            
                                @php
                                    $found=0;
                                    date_default_timezone_set('Africa/Cairo');
                                    $now = date('Y-m-d', time());
                                    
                                    $expected_date = date('Y-m-d ', strtotime($order_array[0]->expected_date));
                                @endphp
                                
                                <tr class="table-row table-row--chris" id="{{ $international_awb }}"  >  
                                    
                                    <td data-column="upload_date" class="table-row__td" id="arrow_{{ $international_awb }}" onclick="toggle(this.id,'#row_{{ $international_awb }}');" aria-expanded="false" >
                                        <i style="font-size: 12px;color: #898989;" class="fas fa-arrow-right"></i>
                                    </td>

                                    <td data-column="upload_date" class="table-row__td">
                                        @if (isset($map_of_awb_data[$international_awb]))
                                                        
                                            @if ( $map_of_awb_data[$international_awb]->airway == 'FedEX')
                                                <a href="https://www.fedex.com/fedextrack/?trknbr={{$international_awb}}" target="_blank" rel="noopener noreferrer">
                                                    {{$international_awb}}</a>
                                            @elseif($map_of_awb_data[$international_awb]->airway == 'Aramex')
                                                <a href="https://www.aramex.com/eg/en/track/results?ShipmentNumber={{$international_awb}}" target="_blank" rel="noopener noreferrer">
                                                    {{$international_awb}}</a>
                                            @elseif($map_of_awb_data[$international_awb]->airway == 'ECMS')
                                                <a href="https://consignee.ecmsglobal.com/brige/showtracking?lang=en&trackingno={{$international_awb}}" target="_blank" rel="noopener noreferrer">
                                                    {{$international_awb}}</a>
                                            @elseif($map_of_awb_data[$international_awb]->airway == 'K-PACKET')
                                                <a href="https://www.tracking-status.com/k-packet-tracking-tazas/?tn={{$international_awb}}" target="_blank" rel="noopener noreferrer">
                                                    {{$international_awb}}</a>
                                            @else
                                            {{$international_awb}}
                                            
                                            {{-- @elseif($map_of_awb_data[$international_awb]->airway == 'Etihad')
                                                <form method="post" action="https://www.etihadcargo.com/services/EtihadCargoTracknTrace/services/dynamic/trackandtrace" class="inline"  name="trackAndTraceEnquiry">
                                                    <input type="hidden" name="awbNum" value="{{$international_awb}}">
                                                    <input type="hidden" name="carrier" value="EY-V3">
                                                    <input type="hidden" name="mode" value="only">

                                                    <button style="border: none;background: transparent;" type="submit" >
                                                        {{$international_awb}}
                                                    </button>
                                                </form> --}}
                                            @endif
                                        @else
                                        {{$international_awb}}

                                        @endif


                                    </td>

                                    <td data-column="upload_date" class="table-row__td">
                                        {{count($order_array)}}
                                    </td>

                                    <td data-column="upload_date" class="table-row__td">
                                        <input @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->dispatched_date != null ) value="{{date('Y-m-d', strtotime($map_of_awb_data[$international_awb]->dispatched_date))}}" @endif
                                        style="border: 1px solid #9a9a9a;
                                        border-radius: 18px;
                                        padding: 2% 7% 2% 7%;
                                        font-family: 'Bebas Neue', cursive;
                                        letter-spacing: 1px;
                                        font-size: 14px;
                                        color: black;" type="date" name="dispatching" id="dispatching_{{$international_awb}}" onchange="add_data('dispatched_date','{{$international_awb}}',this)">
                                    </td>

                                    <td data-column="upload_date" class="table-row__td">
                                        <input @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->expected_date != null ) value="{{date('Y-m-d', strtotime($map_of_awb_data[$international_awb]->expected_date))}}" @endif
                                        style="border: 1px solid #9a9a9a;
                                        border-radius: 18px;
                                        padding: 2% 7% 2% 7%;
                                        font-family: 'Bebas Neue', cursive;
                                        letter-spacing: 1px;
                                        font-size: 14px;color: black;
                                        @if (  $expected_date <= $now && isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->expected_date != null) margin-top: 8px; @endif
                                        " type="date" name=" " id="expected_{{$international_awb}}" onchange="add_data('expected_date','{{$international_awb}}',this)">
                                        @if (  $expected_date <= $now && isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->expected_date != null)
                                            <div class="badge-without-number with-wave" ></div>
                                        @endif
                                    </td>
                                    
                                    <td data-column="upload_date" class="table-row__td">
                                        <select onchange="add_data('airway','{{$international_awb}}',this)" id='airway_{{$international_awb}}'
                                            style="padding: 2% 7% 2% 7%;font-size: 13px;background-color: transparent;  border: 1px solid #9a9a9a;border-radius: 18px;height: 30.25px;
                                            font-weight: 500;"
                                            name="airway">
                                            <option value="" selected hidden>Select company</option>
                                             
                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'K-PACKET') selected @endif
                                                value="K-PACKET">K-PACKET
                                            </option>

                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'Etihad') selected @endif
                                                value="Etihad">Etihad
                                            </option>

                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'FedEX') selected @endif
                                                value="FedEX">FedEX
                                            </option>
                                            
                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'Aramex') selected @endif
                                                value="Aramex">
                                                Aramex
                                            </option>
                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'ECMS') selected @endif
                                                value="ECMS">
                                                ECMS 
                                            </option>

                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'RSA') selected @endif
                                                value="RSA">
                                                RSA 
                                            </option>

                                            <option @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->airway == 'DHL') selected @endif
                                                value="DHL">
                                                DHL 
                                            </option>
                                           
                                        </select>
                                    </td>

                                    <td data-column="upload_date" class="table-row__td" style="width: 14rem;">
                                        <div style="padding-top: 5px;overflow: hidden;resize: none;text-align: center;width: 13rem;
                                        @if (isset($map_of_awb_data[$international_awb]) && !empty($map_of_awb_data[$international_awb]->note)) font-weight:bold; @endif
                                        background-color: transparent;  border:none; outline-color:#dfdfdf;color: black;" name="notes" id="note_{{ $international_awb }}"
                                        class="text" onkeyup="add_data('note','{{$international_awb}}' ,this)" contenteditable=true>
                                        @if (isset($map_of_awb_data[$international_awb]) && $map_of_awb_data[$international_awb]->note != null)  {{$map_of_awb_data[$international_awb]->note}} @endif
                                        </div>
                                        
                                    </td>
                                    
                                    <td data-column="upload_date" class="table-row__td" colspan="2">
                                        <button style="margin-right: 5px;background-color: #42890a;border-color: #68ce18;margin-left: 20px;" onclick="remove_from_awbs(this,'{{$international_awb}}')"
                                            type="button" class=" btn btn-primary" id="button_{{$international_awb}}">
                                            <i class="fas fa-check" style="color :white;"></i>
                                        </button>
                                    </td>
                                </tr>
                                    <tr id="row_{{preg_replace('/\s+/', '', $international_awb) }}" class=" sub_row hidden">
                                        <th class="sub_head"></th>

                                        <th class="sub_head">Order Number</th>
                                        <th class="sub_head">Dollar</th>
                                        <th class="sub_head">Currency</th>
                                        <th class="sub_head">Category</th>
                                        <th class="sub_head">HAWB</th>
                                        <th class="sub_head">Company</th>
                                        <th class="sub_head">Status</th>

                                    
                                    </tr>
                                 @foreach ($order_array as $index => $values)

                                    <tr id="row_{{preg_replace('/\s+/', '', $international_awb)}}" class="table-row table-row--chris sub_row hidden">

                                        <td style="color: #000000" class="sub_inf"></td>

                                        @php
                                            $Controller_url = 'tst';

                                            if (isset($country_to_store[$values->country]) ) {
                                                $country = $values->country;
                                            } else {
                                                $country = 'Others';
                                            }

                                            //category

                                            if ($values->category == 0) {
                                                $cetegory = "normal";
                                            } else if ($values->category == 1) {
                                                $cetegory = "pre order";
                                            } else if ($values->category == 2) {
                                                $cetegory = "paid";
                                            } else {
                                                $cetegory = "normal";
                                            }
                                        @endphp

                                        <td style="color: #000000" class="sub_inf"><a href="https://kshopinaexpress.com/tst?page=1&store=origin&order_num={{$values->order_number}}&filter={{$country}}&category={{$cetegory}}" target="_blank" rel="noopener noreferrer">
                                            #{{$values->order_number}} </a>  </td>
                                        <td style="color: #000000" class="sub_inf">{{$values->total_price}} $</td>
                                        <td style="color: #000000" class="sub_inf"> {{$values->currency}} @if (isset($country_currency[$values->country]) )
                                            {{$country_currency[$values->country]}}
                                        @else
                                            $
                                        @endif </td>
                                        <td style="color: #000000" class="sub_inf"> {{ $category[$values->category]}}</td>

                                        <td style="color: #000000" class="sub_inf">
                                            @if (empty($values->domestic_awb) ) 
                                                N/A
                                             @else 
                                            
                                                @if ($values->domestic_company == "K-PACKET")
                                                    <a href="https://www.tracking-status.com/k-packet-tracking-tazas/?tn={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>

                                                @elseif ($values->domestic_company == "GLT")
                                                    <a href="https://www.gltmena.com/trackorder/{{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>

                                                @elseif($values->domestic_company == "OCS")
                                                    <a href="http://www.ocskuwait.com/tracking.html?tracksearch={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>

                                                @elseif($values->domestic_company == "SMSA")
                                                    <a href="https://www.smsaexpress.com/trackingdetails?tracknumbers%5B0%5D={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>
                                                
                                                @elseif($values->domestic_company == "DHL")
                                                    <a href="https://www.dhl.com/eg-en/home/tracking/tracking-express.html?submit=1&tracking-id={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>
                                                
                                                @elseif($values->domestic_company == "SHIPA")
                                                    <a href="https://tracking.shipadelivery.com/?bc={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>

                                                @elseif($values->domestic_company == "RSA")
                                                    <a href="https://www.rsa.global/tracking/detail?tracking_no={{$values->domestic_awb}}" target="_blank" rel="noopener noreferrer">
                                                        {{$values->domestic_awb}}</a>
                                                @else
                                                        {{$values->domestic_awb}}
                                                @endif
                                                    
                                             @endif </td>

                                        <td style="color: #000000" class="sub_inf">{{$values->domestic_company}}</td>


                                        <td style="color: #000000;width: 14rem;" class="sub_inf">
                                            @if ($values->status ==0 && $values->actions==1)
                                            <p class="table-row__p-status status status--{{ $status_colors[6] }}">
                                                Canceled
                                            </p>
                                            @else
                                            <p class="table-row__p-status status status--{{ $status_colors[$values->status] }}">
                                                {{$original_status[$values->status]}}
                                            </p>
                                            @endif
                                            
                                        </td>
                                        
                                    </tr>       

                                @endforeach
                            @endforeach
                           
                            
                        </tbody>
    
                    </table>
                    <div style="margin-top: 25px;display: flex;justify-content: flex-end;">
                        <button onclick="submit_awb_data(this)" type="button" class="btn btn-primary" id="submit_awb_data"
                            style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                            Submit
                        </button>
                    </div>
                @endif


                @foreach ($orders as $order)
                    @php
                        if ($order->country == 'Egypt') {
                            $country_currency = 'EGP';
                            $arabic_currency = 'جنيه مصري';
                        } elseif ($order->country == 'Saudi Arabia') {
                            $country_currency = 'SAR';
                            $arabic_currency = 'ريال سعودي';
                        } elseif ($order->country == 'United Arab Emirates') {
                            $country_currency = 'AED';
                            $arabic_currency = 'درهم اماراتي';
                        } elseif ($order->country == 'Bahrain') {
                            $country_currency = 'BHD';
                            $arabic_currency = 'دينار بحريني';
                        } elseif ($order->country == 'Kuwait') {
                            $country_currency = 'KWD';
                            $arabic_currency = 'دينار كويتي';
                        } elseif ($order->country == 'Oman') {
                            $country_currency = 'OMR';
                            $arabic_currency = 'ريال عماني';
                        } elseif ($order->country == 'Jordan') {
                            $country_currency = 'JOD';
                            $arabic_currency = 'دينار اردني';
                        } elseif ($order->country == 'Qatar') {
                            $country_currency = 'QAR';
                            $arabic_currency = 'ريال قطري';
                        } else {
                            $country_currency = 'USD';
                            $arabic_currency = 'دولار';
                        }
                    @endphp
                    <div style="z-index: 4;" id="pop{{ $order->id }}" class="overlay">
                        <div class="popup">
                            <h2 style="margin-bottom: 30px">#{{ $order->order_number }}</h2>
                            <a id='close' class="closee" href="#">&times;</a>
                            <div class="container content">
                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fas fa-money-bill-wave"
                                            data-feather="user"></i>
                                        <span>{{ $order->currency }}&nbsp;{{ $country_currency }}</span>
                                    </div>
                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fas fa-comment-dots"
                                            data-feather="user"></i>
                                        <span>{{ $order->last_action }}</span>
                                    </div>
                                    <hr>
                                <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                    class="row">
                                    <i style="margin-right: 8px;" class="icon far fa-user" data-feather="user"></i>
                                    <span>{{ $order->name }}</span>
                                </div>
                                <div style="display: flex;align-items: baseline;justify-content: start;">

                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fab fa-whatsapp"
                                            data-feather="user"></i>
                                        <span>{{ $order->phone_number }}</span>
                                    </div>
                                </div>

                                <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                    class="row">
                                    <i style="margin-right: 8px;" class="icon far fa-envelope" data-feather="user"></i>
                                    <span>{{ $order->email }}</span>
                                </div>
                                <hr>
                                <div style="display: flex;align-items: baseline;justify-content: start;">
                                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fas fa-globe-africa"
                                            data-feather="user"></i>
                                        <span>{{ $order->country }}</span>
                                    </div>
                                </div>

                                <div style="display: flex;align-items: baseline;justify-content: start;">
                                    <div style="margin-top: 15px;display: flex;align-items: center;justify-content: start;margin-left: 28px;"
                                        class="row">
                                        <i style="margin-right: 15px;" class="icon fas fa-map-marker-alt"
                                            data-feather="user"></i>
                                        <span>{{ $order->city }}</span>
                                    </div>
                                </div>

                                <div style="display: flex;align-items: baseline;justify-content: start;">
                                    <div style="margin-top: 8px;display: inline-block;align-items: center;justify-content: start;margin-left: 25px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fas fa-map-marked-alt"
                                            data-feather="user"></i>
                                        <span>{{ $order->address }}</span>
                                    </div>
                                </div>

                                <div style="display: flex;align-items: baseline;justify-content: start;">
                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 26px;"
                                        class="row">
                                        <i style="margin-right: 15px;" class="icon fas fa-building"
                                            data-feather="user"></i>
                                        <span>{{ $order->apartment }}</span>
                                    </div>
                                </div>



                                @if ($order->province != null || $order->province != '')
                                    <hr>
                                    <div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 25px;"
                                        class="row">
                                        <i style="margin-right: 8px;" class="icon fas fa-map-marker-alt"
                                            data-feather="user"></i>
                                        <span>{{ $order->province }}</span>
                                    </div>
                                @endif
                                <hr>
                                <i class="fas fa-sitemap"></i>
                                <div id="items{{ $order->id }}"
                                    style="display: inline-block;grid-column-gap: 0px;grid-template-columns: auto auto;">

                                </div>
                            </div>
                            <hr>
                            <div>

                                @if (Route::current()->getName() == 'verified')
                                    <div style="margin-top: 40px;justify-content: center;display: flex;">
                                        <div>
                                            <button id="#{{ $order->order_number }}" onclick="cancel(this)"
                                                style="letter-spacing: .7px;font-size: 12px;padding-inline: 13px;display: inline-grid;"
                                                class="btn btn-danger btn-s">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    @if (Route::current()->getName() != 'archived')
                                        <div style="margin-top: 40px;justify-content: center;display: flex;">

                                            <button id="{{ $order->order_number }}" onclick="return_to_confirm(this)"
                                                style="margin-right: 15px; letter-spacing: .7px;font-size: 12px;padding-inline: 13px;display: inline-grid;"
                                                class="btn btn-info btn-s">
                                                Return to confirm
                                            </button>
                                            <button id="&{{ $order->order_number }}" onclick="send_to_fct(this,'{{$order->store}}')"
                                                style="margin-right: 15px;background-color: #636363;border-color: #636363;letter-spacing: .7px;font-size: 12px;"
                                                class="btn btn-danger btn-s">
                                                Send to FCT
                                            </button>
                                            @if (Route::current()->getName() == 'on_process')
                                            
                                                <button id="#{{ $order->order_number }}" onclick="cancel(this)"
                                                    style="letter-spacing: .7px;font-size: 12px;padding-inline: 13px;display: inline-grid;"
                                                    class="btn btn-danger btn-s">
                                                    Cancel
                                                </button>
                                            @else
                                            {{-- TO AVOID ADDING ORDER TO FCT --}}
                                                <button id="#{{ $order->order_number }}" onclick="cancel_tst(this)"
                                                    style="letter-spacing: .7px;font-size: 12px;padding-inline: 13px;display: inline-grid;"
                                                    class="btn btn-danger btn-s">
                                                    Cancel
                                                </button>
                                            @endif
                                            

                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

                <div style="z-index: 4;" id="tasks_popup" class="overlay">
                    <div class="tasks_popup">
                        <div class="container">
                            <div class="title"><img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"
                                    alt=""></div>
                        </div>
                        <a id='close' class="closee" href="#">&times;</a>
                        <div class="container content">
                            <form id="assign_form" method="POST" action="assign_task" enctype="multipart/form-data">
                                @csrf
                                <input name='system_name' value="TST" hidden readonly>
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Order number</span>
                                        <input value="#order_number" name="order_number" id="order_number"
                                            type="text" placeholder="Enter your name" readonly>

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

                <div style="z-index: 4;" id="export_popup" class="overlay">
                    <div class="tasks_popup" style="margin: 150px auto;     height: 50%;">
                        <div class="container">
                            <div class="title">
                                <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                            </div>
                        </div>
                        <a id='close' class="closee" href="#">&times;</a>
                    
                            
                            <div class="container content"  style="margin-top: 2rem;">
                                    <div >
                                        <h3 class="row__title" style="margin-left: 0px;" >
                                            choose export template 
                                        </h3>
                                        <div style="flex:22;" class="position-relative">
                                        
                                            <i style="color:#1b3425;font-size:17px;display:flex;position:absolute;top:13px;left:12px;"class="far fa-file-alt"></i>
                                            
                                            <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px"
                                                name="export_template_type" id="export_template_type">
                                                <option value="Select" disabled hidden selected>Select the template</option>
                                                <option value="kmex_temp"id="kmex_temp"> Kmex </option>
                                                <option value="sku_temp" id="sku_temp">Product Sku's</option>
                                            </select>
                                        
                                        </div>
                                    </div>
        
                                    @if (Route::current()->getName() == 'verified')
                                        <div style="margin-top: 2rem;"> 
                                            <input type="checkbox" id="add_on_process" name="add_on_process" value="1" style="" >
                                            <label for="add_on_process" id="add_on_process_label"> Add to on_process</label>
                                        </div>
                                    @endif
                            
                            </div>
                            <div style="margin-top: 25px;display: flex;justify-content: flex-end;">
                                <button onclick="export_with_filters(this,'{{ $_GET['store'] }}','{{ $_GET['filter'] }}','{{ $_GET['category'] }}','{{Route::current()->getName()}}')" type="submit" class="btn btn-primary" 
                                    style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                                    Submit
                                </button>
                            </div>
                    </div>
                </div>   
                
                @if (Route::current()->getName() != 'orders_by_awb' )
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
                            
                            @if ( $_GET['page'] > 10)  
                
                                    @if (isset($_GET['archived']))            
                                        @if (isset($_GET['filter']))
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&laquo;</a>
                                        @else
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&laquo;</a>    
                                        @endif
                                    @else
                                        @if (isset($_GET['filter']))
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">&laquo;</a>
                                        @else
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count)-10 }}&filter=All&category={{ $_GET['category'] }}">&laquo;</a>    
                                        @endif
                                    @endif
                            
                            @elseif ( $_GET['page'] >= 1 && $_GET['page'] < 10 )
                            
                                    @if (isset($_GET['archived']))            
                                        @if (isset($_GET['filter']))
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&laquo;</a>
                                        @else
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&laquo;</a>    
                                        @endif
                                    @else
                                        @if (isset($_GET['filter']))
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">&laquo;</a>
                                        @else
                                            <a href="?store={{ $_GET['store'] }}&page={{ ($count) }}&filter=All&category={{ $_GET['category'] }}">&laquo;</a>    
                                        @endif
                                    @endif
                            @else
                
                                <a href="#">&laquo;</a>
                
                            @endif
                        
                            
                            {{-- numbers --}} 
                                @for ($i = $count; $i <=  $count2  ; $i++)
                                    @if ($_GET['page'] == $i) 

                                        @if (isset($_GET['archived']))            
                                            @if (isset($_GET['filter']))
                                                <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}"> {{$i}}</a>
                                            @else
                                                <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">{{$i}}</a>    
                                            @endif
                                        @else
                                            @if (isset($_GET['filter']))
                                                <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">{{$i}}</a>
                                            @else
                                                <a  class='active' href="?store={{ $_GET['store'] }}&page={{ $_GET['page'] }}&filter=All&category={{ $_GET['category'] }}">{{$i}}</a>    
                                            @endif
                                        @endif
                                            
                                    @else
                                        @if (isset($_GET['archived']))            
                                            @if (isset($_GET['filter']))
                                                <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}"> {{$i}}</a>
                                            @else
                                                <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">{{$i}}</a>    
                                            @endif
                                        @else
                                            @if (isset($_GET['filter']))
                                                <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">{{$i}}</a>
                                            @else
                                                <a  href="?store={{ $_GET['store'] }}&page={{$i}}&filter=All&category={{ $_GET['category'] }}">{{$i}}</a>    
                                            @endif
                                        @endif
 
                                    @endif
                                @endfor
                            
                            {{-- ymen --}} 
                
                            @if ($_GET['page'] != $pages )

                                    @if (isset($_GET['archived'])) 
                                    
                                        @if (isset($_GET['filter']))
                                            @if ($pages <=10 )
                                                <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&raquo;</a>
                                            @else
                                                <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&raquo;</a>
                                            @endif
                                        @else
                                            @if ($pages <=10 )
                                                <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&raquo;</a> 
                                            @else
                                                <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter=All&category={{ $_GET['category'] }}&archived={{ $_GET['archived'] }}">&raquo;</a> 
                                            @endif
                                        @endif
                                    @else

                                        @if (isset($_GET['filter']))
                                            @if ($pages <=10 )
                                                <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">&raquo;</a>
                                            @else
                                                <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter={{ $_GET['filter'] }}&category={{ $_GET['category'] }}">&raquo;</a>
                                            @endif
                                        @else
                                            @if ($pages <=10 )
                                                <a href="?store={{ $_GET['store'] }}&page={{ $count2 }}&filter=All&category={{ $_GET['category'] }}">&raquo;</a> 
                                            @else
                                                <a href="?store={{ $_GET['store'] }}&page={{ ($count )+10 }}&filter=All&category={{ $_GET['category'] }}">&raquo;</a> 
                                            @endif
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
                @endif     
                

            @else
                <div
                    style="display: flex;flex-wrap: wrap;flex-direction: column;border: solid 1px #c8cecb;border-radius: 10px;margin-top: 1rem;padding: 2rem 1rem;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 10%);">
                    <div
                        style="display: flex;justify-content: center;align-items: center;margin-bottom: 1rem;margin-right: 10px;">
                        <h3 class="row__title" style="margin-top: 0rem; margin-bottom: 0rem;margin-right: 3rem;">
                            Download
                        </h3>
                        @if ($_GET['store'] == "origin")
                            <a style="font-size: 15px;margin-left: 3rem;" href="{{ url(asset('tst_template.xlsx')) }}">
                                TST template
                            </a>
                        @else
                            <a style="font-size: 15px;margin-left: 3rem;" href="{{ url(asset('tst_Plus_models_template.xlsx')) }}">
                                TST template
                            </a>
                        @endif

                    </div>
                  
                    <form action="/erp" method="post" enctype="multipart/form-data"
                        style="display: flex;flex-direction: column;align-items: center;">
                        @csrf

                        <div>
                            <input style="width: 220px;color: black;margin-left: 3rem;" type="file" id="file"
                                name="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet " />
                            <button type="submit" id="import" name="action" value="import"
                                style="margin-right: 2rem;letter-spacing: 2px;font-size: 18px;background-color: #1b3425;color: #d2ac6a; display: inline-grid;border-color: transparent;font-family: 'Bebas Neue', cursive;"
                                class="btn btn-success btn-s">
                                Import
                            </button>
                        </div>
                           <input  name="store" type="text" hidden readonly value="{{$_GET['store']}}">
                        {{-- <hr
                            style="padding: 1rem;width: 50%;border-top: 1px solid rgb(200 206 203);margin-bottom: 0rem;margin-top: 2rem;">

                        <div style="display: flex;padding-top: 0rem;align-items: center;">
                            <h4 class="row__title" style="margin-bottom: 0.2rem;margin-top: 0.2rem; margin-right: 3rem;">
                                Choose your system
                            </h4>
                            <select id='system'
                                style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;"
                                name="system">
                                <option value="" selected hidden required>Select System</option>
                                <option value="confirmed_system">Confirmed
                                </option>
                                <option value="tst_system">TST
                                </option>
                            </select>
                        </div> --}}



                        <div style="display: flex;flex-direction: row;align-items: center;position: relative;">


                            @error('file')
                                <script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Please Enter Your File',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                </script>
                            @enderror

                            @error('file-two')
                                <script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Please Enter Your File',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                </script>
                            @enderror

                            {{-- <div>
                                <button type="submit" id="export" name="action" value="export"
                                    style="margin-top: 10px;position: relative;margin-left: 2.5rem;
                                letter-spacing: 2px;font-size: 18px; background-color: #1b3425; color: #d2ac6a; display: inline-grid;border-color: transparent;font-family: 'Bebas Neue', cursive;"
                                    class="btn btn-success btn-s">
                                    Export
                                </button>
                            </div> --}}

                        </div>

                    </form>
                </div>
            @endif

        </div>

        <div style="z-index: 4;" id="export_popup" class="overlay">
            <div class="tasks_popup" style="margin: 150px auto;     height: 50%;">
                <div class="container">
                    <div class="title">
                        <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                    </div>
                </div>
                <a id='close' class="closee" href="#">&times;</a>
            
                    
                    <div class="container content"  style="margin-top: 2rem;">
                            <div >
                                <h3 class="row__title" style="margin-left: 0px;" >
                                    choose export template 
                                </h3>
                                <div style="flex:22;" class="position-relative">
                                
                                    <i style="color:#1b3425;font-size:17px;display:flex;position:absolute;top:13px;left:12px;"class="far fa-file-alt"></i>
                                    
                                    <select style="padding-left: 40px;width: 100%;height: 44px;border-radius: 6px"
                                        name="export_template_type" id="export_template_type">
                                        <option value="Select" disabled hidden selected>Select the template</option>
                                        <option value="kmex_temp"id="kmex_temp"> Kmex </option>
                                        <option value="sku_temp" id="sku_temp">Product Sku's</option>
                                    </select>
                                
                                </div>
                            </div>

                            @if (Route::current()->getName() == 'verified')
                                <div style="margin-top: 2rem;"> 
                                    <input type="checkbox" id="add_on_process" name="add_on_process" value="1" style="" >
                                    <label for="add_on_process" id="add_on_process_label"> Add to on_process</label>
                                </div>
                            @endif
                    
                    </div>
                    <div style="margin-top: 25px;display: flex;justify-content: flex-end;">
                        <button onclick="export_with_filters(this,'{{ $_GET['store'] }}','{{ $_GET['filter'] }}','{{ $_GET['category'] }}','{{Route::current()->getName()}}')" type="submit" class="btn btn-primary" 
                            style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">
                            Submit
                        </button>
                    </div>
            </div>
        </div>

        @if (Route::current()->getName()=='archived')
            
        
            {{-- archived --}}
            <div style="z-index: 4;" id="archived_export_popup" class="overlay">
                <div class="tasks_popup" style="margin: 150px auto;     height: 40%;">
                    <div class="container">
                        <div class="title">
                            <img style="width: 23%;" src="{{ asset('kshopina-express_b.png') }}"alt="">
                        </div>
                    </div>
                    <a id='close' class="closee" href="#">&times;</a>
                        <div class="container content"  style="margin-top: 2rem;display: flex;justify-content: center;height: 2.5rem;flex-direction: row;align-items: center;">
                            <label for="from" style="margin-bottom: 0px;margin-right: 1rem;">From :</label>
                            <input min="2022-02-24"  type="date" name="from" id="from_export_archived" required style=" border: 1px solid black;border-radius: 18px;    padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                            <label for="to"style="margin-bottom: 0px;margin-right: 1rem;margin-left: 5rem;">To :</label>
                            <input max="{{date("Y-m-d",time())}}" type="date" name="to" id="to_export_archived" required style="border: 1px solid black;border-radius: 18px; padding: 1% 3% 1% 3%;font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;color: black;">
                        </div>
                        <div style="margin-top: 25px;display: flex;justify-content: center;">
                            <button onclick="export_archived(this,'{{ $_GET['store'] }}','{{ $_GET['archived'] }}')" type="submit" class="btn btn-primary"
                                style="border-radius: 15px;position: relative;top: 0.5rem;font-family: 'Bebas Neue', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600; padding: 8px 40px 5px 40px;">
                                Submit
                            </button>
                        </div>
                </div>
            </div>
            {{-- archived --}}



            <div style="z-index: 4;" id="return_pop" class="overlay">
                <div style="height: 85%;" class="row">
                    <div style="border-right: 1px #aeaeaec7 dotted;border-radius: 5px 0px 0px 5px;margin-right: 0px;" class="popup">
                        <h2 style="margin-bottom: 30px;font-size: 1.5rem;" id="return_order_number">#11111</h2>
                       {{--  <a id='close' class="closee" href="#">&times;</a> --}}
                        <div class="container content">
    
                            
                            <ul style="margin-left: 20px;" class="wtree">
                              <li>
                                <span style="color: #000;">ITEMS</span>
                                <ul style="margin-left: 20px;" id="return_items">
                                    <li>
                                      <span>
                                        <div style="margin: 0;justify-content: space-between;" class='row'>
                                            <div>dsds</div>
                                            <div>aaaa</div>
                                        </div>
                                      </span>
                                      
                                    </li>
                                    <li>
                                      <span>Nivel 2</span>
                                    </li>
                                    <li>
                                      <span>Nivel 2</span>
                                    </li>
                                    <li>
                                      <span>Nivel 2</span>
                                    </li>
                                    <li>
                                      <span>Nivel 2</span>
                                    </li>
                                  </ul>
                              </li>
                              
                              
                            </ul>

                            <div style="margin:60px 0px 5px 0px;display: flex;justify-content: center;" id="remove"> 
                                
                            </div>
                        </div>
                        

                    </div>

                    <div style="border-radius: 0px 5px 5px 0px;margin-left: 0px;" class="popup">
                        <h2 style="margin-bottom: 30px;margin-right: 50px;font-size: 1.5rem;" id="product_name">No item selected</h2>
                        <a style="z-index: 30;" id='close' class="return_close" href="#">&times;</a>
                        <div class="container content">
                            <div id="product_info" style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;display:none; " class="row" >

                                <span style="font-weight: 600;">NO. of variants :&nbsp;</span>
                                <span id="number_of_variants">100</span>
                            </div>
                            <hr>
                            
                            <div id="variants_body">
                                
                            </div>
                            <div style="margin:60px 0px 5px 0px;display: flex;justify-content: flex-end;" id="created_variant_button"> 

                            </div>
                            
                        </div>
                        <div id="loader_" style="display: none;"><div style="align-items: center;justify-content: center;display:flex;position: absolute;width: 100%;height: 100%;z-index: 20;
                            top: 0;left: 0;background: #1b3425cf; "><div style="width: 20vh;height: 20vh;" class="loader"></div></div></div>

                    </div>
                </div>
                
            </div>
            {{-- <i style="margin-right: 8px;" class="fas fa-money-bill-wave" data-feather="user"></i> --}}
            {{-- <i style="margin-right: 8px;" class="icon fas fa-hashtag" data-feather="user"></i> --}}

        @endif
    </div>


    <script>
        var country_currency={'Egypt':'EGP','Saudi Arabia': 'SAR','Kuwait':'KWD','United Arab Emirates': 'AED','Bahrain': 'BHD','Qatar': 'QAR', 'Oman': 'OMR', 'Jordan': 'JOD'};
        var orders = new Object();
        var statuss = new Object();
        var reasons = new Object();
        var test = new Object();
        var queue = new Object();

        var international_awbs = new Object();

        var release_dates = new Object();
        var search_filter=1;
        var order_number;
        var data;
        reasons['first'] = 'first';
        var variants_number=0;

        var url;
        url = window.location.href;
        url = new URL(url);
        var store_name = url.searchParams.get("store");
        var country = url.searchParams.get("filter");
        var archived = url.searchParams.get("archived");


         function handleSelect(store, elm) {
            if ( url.searchParams.get("archived") == null ) {

                window.location = window.location.pathname + "?store=" + store + "&page=1&filter=" + elm.value +
                "&category=" + url.searchParams.get("category") ;
            } else {

                window.location = window.location.pathname + "?store=" + store + "&page=1&filter=" + elm.value +
                "&category=" + url.searchParams.get("category") + "&archived="  + url.searchParams.get("archived");
            }

        }

        function tag(ele) {
            $(".swal2-input").val(ele.value);
        }

        $("#filters button").click(function() {

            if ( archived == null ) {
                if (this.id == "normal") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=normal";

                } else if (this.id == "pre_order") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=pre order";

                } else if (this.id == "paid") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=paid";

                } else if (this.id == "all") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=all";
                }
            } else {
                if (this.id == "normal") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=normal&archived=" + archived;

                } else if (this.id == "pre_order") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=pre order&archived=" + archived;

                } else if (this.id == "paid") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=paid&archived=" + archived;

                }else if (this.id == "all") {
                    window.location.href = "?store=" + store_name + "&page=1&filter=" + country + "&category=all&archived=" + archived;

                }
            }

            selected = this.id;
        });


        function press(elemant) {
            order_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
            data = elemant.id.substring(0, elemant.id.indexOf("_"));

            statuss[order_number] = $('#status-' + order_number).val();
            release_dates[order_number] = $('releasedate' + order_number).val();


            if (data == 'status' && elemant.value == 6) {
                Swal.fire({
                    title: "Refused!",
                    text: "Write the reason of cancelation",
                    input: 'text',
                    footer: '<div style="justify-content: center;" class="row"><button value="Late delivery" class="tag" onclick="tag(this)">Late delivery</button><button value="Not enough COD" onclick="tag(this)" class="tag" >Not enough COD</button><button value="Travelling" onclick="tag(this)" class="tag" >Travelling</button><button value="Change of plan" onclick="tag(this)" class="tag" >Change of plan</button><button value="Death in family" onclick="tag(this)" class="tag" >Death in family</button><button value="Requesting Future Delivery" onclick="tag(this)" class="tag" >Requesting Future Delivery</button></div>',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    allowEscapeKey: false,
                    preConfirm: (value) => {
                        if (value == "") {
                            Swal.showValidationMessage(
                                `Please fill in the field`
                            );
                            return false;
                        } else if (value.length > 100) {
                            Swal.showValidationMessage(
                                `There is a limit of characters (up to 100)`
                            );
                            return false;
                        } else {
                            return value;
                        }
                    },
                }).then((result) => {
                    if (result.value) {

                        test = new Object();
                        reasons[order_number] = result.value;

                        if (orders[order_number] == null) {

                            test[data] = elemant.value;

                            orders[order_number] = test;

                        } else {
                            test = orders[order_number];

                            test[data] = elemant.value;

                            orders[order_number] = test;

                        }
                        console.log(reasons);

                    }
                });
            } else {
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
                    '<div id="submit_two" style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;font-weight: 600;padding: 10px 25px 10px 25px; display: inline-block; margin-left: 20px; align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                );

                $.ajax({
                    url: "submit_tst",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: orders,
                        status: statuss,
                        reasons: reasons ,
                        store :store_name
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload(true);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                });
            }

        };


        function send_to_fct(elemant,store) {


            Swal.fire({
                title: "FCT!",
                text: "Write the reason ",
                input: 'text',
                footer: '<div style="justify-content: center;" class="row"><button value="No service area" class="tag" onclick="tag(this)">No service area</button></div>',
                allowOutsideClick: false,
                showCancelButton: false,
                allowEscapeKey: false,
                preConfirm: (value) => {
                    if (value == "") {
                        Swal.showValidationMessage(
                            `Please fill in the field`
                        );
                        return false;
                    } else if (value.length > 100) {
                        Swal.showValidationMessage(
                            `There is a limit of characters (up to 100)`
                        );
                        return false;
                    } else {
                        return value;
                    }
                },
            }).then((result) => {
                if (result.value) {
                    $(elemant.parentElement.parentElement).html(
                        '<div id="' + elemant.id +
                        '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                    );

                    $.ajax({
                        url: "send_to_fct",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            reason: result.value,
                            order_number: elemant.id.substring(1),
                            store:store
                        },
                        success: function() {
                            location.reload(true);
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }
                    });
                }
            });
        }


        function details(elemant,items) {
            
            var id = (elemant.className);
            id = id.split(" ");
            var ex_items = new Object();

            items.forEach(element => {
                ex_items[element['origin_variant_id']]=element;
            });
            console.log(ex_items);
            
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
                    response.forEach(element => {
                        elemant2 = JSON.parse(JSON.stringify(element));
                        order_id = elemant2.order_id;

                        if (ex_items[elemant2.variant_id] == null ) {

                            html +=
                            '<div style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #36304a;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"><span>' +
                            elemant2.product_name + '</span></div>';
                            
                        } else {
                            html +=
                            '<div style="font-size: 15px;padding: 2px 18px 2px 18px;color: #ffebeb;border-radius: 8px;width: fit-content;background-color: #187a00;margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 5px;"><span>' +
                            elemant2.product_name + '</span></div>';
                        }
                        

                    });
                    Swal.close();
                    $('#items' + elemant.id).html(html);
                    $('#pop' + elemant.id).show();
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function move_to_on_process(id) {

            document.getElementById("on_process_" + id).disabled = true;
            document.getElementById("on_process_" + id).innerHTML = '<div id="loader_' + id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';

            $.ajax({
                url: "move_to_on_process",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: id,
                    store: store_name,
                },
                success: function(response) {

                    document.getElementById("on_process_" + id).innerHTML = "Action taken";

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order has been moved to on process orders',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        // NON_RETURNED
        function restock(order_number,id) {
           
           document.getElementById("restock_" + id).disabled = true;
           document.getElementById("restock_" + id).innerHTML = '<div id="loader_' + id +
               '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';


               $.ajax({
                   url: "products_search_data",
                   type: "post",
                   data: {
                       _token: "{{ csrf_token() }}",
                       order_number: order_number,
                   },
                   success: function(response) {

                    if (response.lenght != 0) {

                        var html = '';
                        $('#variants_body').html('');
                        $('#product_info').hide();
                        $('#product_name').html('No item selected');
                        $('#created_variant_button').hide();
                        console.log(response);

                        response.forEach(product => {

                            order_id = product['order_id'];

                            html +=
                                    '<li>'+
                                    '<span style="cursor: pointer;" id="'+product["variant_id"]+'"'+
                                    'onclick="get_similar_item(\''+product['unique_barcode']+'\','+'\''+product["variant_sku"]+'\','+product["price"]+','+product["quantity"]+',&quot;'+product["product_title"].replaceAll('"', '\'')+'&quot;,'+product["product_id"]+','+product["variant_id"]+')">' + 
                                        '<div style="margin: 0;justify-content: space-between;flex-wrap: nowrap;" class="row">'+
                                            '<div style="max-width: 85%;">'+product["product_title"]; 
                                                if ( product["variant_title"]  != "Default Title" ) {
                                                    html += ' - '+product["variant_title"];
                                                }
                                                html +='</div>';
                                            '<div style="width: fit-content;color: #cb9d48;font-weight: 600;">'+product["quantity"]+' QTY</div>'+
                                        '</div>'+
                                        
                                    '</li>' ;
                        });


                           $('#return_items').html(html);
                           $('#return_order_number').html('#'+order_number);

                           $('#remove').html('<button type="button" onclick="remove_from_non_return('+id+')" class="btn btn-primary"'+
                                           'style="background-color: #a33b12;border-color: #a33b12;color: #ffffff;border-radius: 15px;position: relative;'+
                                           'font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">'+
                                           'Mark as Restocked'+
                                           '</button>');

                           

                           $('#return_pop').show();

                           document.getElementById("restock_" + id).innerHTML = '<i class="fas fa-boxes" ></i>';
                           document.getElementById("restock_" + id).disabled = false;


                    } else {
                        $('.results').hide(); 
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Order Number not found!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                        
                   },
                   error: function(xhr) {
                       //Do Something to handle error
                   }

           });

           
       }

        function remove_from_non_return(id)
        {
            document.getElementById('remove').firstChild.disabled= true;
            document.getElementById("remove").firstChild.innerHTML = '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';


            $.ajax({
                    url: "return_to_stock",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order_id: id,
                        store: store_name,
                    },
                    success: function(response) {
                        document.getElementById("restock_" + id).innerHTML = "Action taken";

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Order had been marked as returned',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#return_pop").hide();

                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
        }

        function get_similar_item(barcode,sku,price,qty,product_name,product_shopify_id,variant_shopify_id){

            if (country != 'All' || country != 'Others') {
                
                $.ajax({
                    url: "get_similar_item_by_barcode",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        barcode: barcode,
                        country: country,
                    },
                    success: function(response) {
                        var html='';
                        var length=0;
                        length=response.length - 1;
                        variants_number=response.length;

                        queue['item']=variant_shopify_id;

                        if (response.length>0)
                        {
                            response.forEach(element => {
                                
                            html += '<div  onclick="add_qty('+element['sql_variant_id']+','+qty +')"  class="variant_card" > ';

                            if (element['variant_title']=='Default Title') {
                                html += '<input type="hidden" name="variant_id" id="shopify_variant_id" value="'+element['variant_id']+'">';
                            }

                            html +=     '<h2 style="margin-left: 5px;font-size: 1.4rem;" id="variant_name"> '+element['variant_title']+'</h2>'+
                                        '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                            '<div style="margin-inline: 0px;" class="row">'+
                                                '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                                '<span id="sku">'+element['variant_sku']+'</span>'+
                                            '</div>'+
                                            '<div style="margin-inline: 0px;" class="row">'+
                                                '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                                '<span id="price">'+element['variant_price']+'&nbsp; '+country_currency[country]+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                            '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                            '<span id="qty">'+element['variant_quantity']+'</span>'+
                                        '</div>'+
                                    '</div>';

                        
                            if (length > 0) {
                                html += '<hr>';

                                length=length-1;
                            }

                            $('#product_name').html(element['product_title']);
                            $('#number_of_variants').html(element['number_of_variants']);
                            $('#product_info').show();

                                if ((variants_number==1 && element['variant_title'] =='Default Title') || variants_number > 1 ) {

                                    $('#created_variant_button').html('<button onclick="create_new_variant(\''+
                                            element['unique_barcode']+ '\','+
                                            '\''+element['shopify_product_id']+ '\','+
                                            '\''+element['variant_sku']+
                                            '\','+element['variant_price']+','+qty+','+variants_number+')" type="button" class="btn btn-primary"'+
                                            'style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">'+
                                            'Create new variant'+
                                        '</button>');

                                    $('#created_variant_button').show();

                                }
                            
                            });


                            /* else{
                                        $('#product_name').html("Not Found!");
                                        $('#number_of_variants').html("0");

                                        $('#product_info').show();
                                    } */
                        }else{

                            $("#product_name").html('<input style="width: 99%;color: #cb9d48;margin-left: 5px;font-size: 1.4rem;" type="text" name="product_name" id="new_product_name" value="'+product_name+'">')
                            $('#number_of_variants').html("1");
                            $('#product_info').show();


                            html += '<div style="margin-top: 30px" > '+
                                        '<h2 style="margin-left: 5px;font-size: 1.4rem;" id="variant_name">Default Title</h2>'+
                                        '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                            '<div style="width: 50%;margin-inline: 0px;" class="row">'+
                                                '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                                '<input style="width: 60%;color: #cb9d48;margin-left: 5px;" type="text" name="new_variant_sku" id="new_variant_sku" value="'+sku+'">'+
                                            '</div>'+
                                            '<div style="width: 50%;margin-inline: 0px;" class="row">'+
                                                '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                                '<input style="width: 60%;color: #cb9d48;margin-left: 5px;" type="number" name="new_variant_price" id="new_variant_price" value="'+price+'">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                            '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                            '<input style="color: #cb9d48;margin-left: 5px;" type="text" name="new_variant_qty" id="new_variant_qty" value="'+qty+'">'+
                                        '</div>'+
                                    '</div>';

                            $('#variants_body').append(html);

                            $("#created_variant_button").html('<button onclick="submit_new_product(this,'+product_shopify_id+','+variant_shopify_id+')" type="button" class="btn btn-primary"'+
                                                'style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">'+
                                                'Submit'+
                                            '</button>');

                            $('#created_variant_button').show();
                    
                        }
                        
                        
                        $('#variants_body').html(html);
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }

                });
            } 
        }   

        function add_qty(id,qty){
            
            $("#variants_body").html("Loading....");
            $('#created_variant_button').hide();
            $('#loader_').show();

            $.ajax({
                url: "return_qty_to_stock",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    qty:qty,
                    country:country
                },
                success: function(response) {
                    /* document.getElementById("restock_" + id).innerHTML = "Action taken"; */

                    $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order had been returned to '+country+' stock',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#loader_').hide();
                    $('#variants_body').html('');
                    $('#product_info').hide();
                    $('#product_name').html('No item selected');

                     item_done=1;

                },
                error: function(xhr) {
                    //Do Something to handle error
                }
            });

        }

        function create_new_variant(barcode,shopify_product_id,sku,price,qty,length){
            
            var html="";
            var new_sku="";
            var new_variant_qty = qty ;

            if (length==1) {
                new_sku = sku+'-'+'2';

                $("#sku").html($("#sku").text()+'-1');
                    document.getElementById('variants_body').firstChild.removeAttribute("onclick");
                    document.getElementById('variants_body').firstChild.removeAttribute("class");

                $("#variant_name").html('<input style="color: #cb9d48;margin-left: 5px;font-size: 1.4rem;" type="text" name="variant_name" id="default_variant_name" value="'+$("#variant_name").text()+'">')

            } else if(sku.lastIndexOf("-") != -1) {
                var last_index=sku.lastIndexOf("-");
                new_sku = sku.substr(0,last_index) +'-'+ (parseInt(sku.substr(last_index+1)) +1);
            }else{
                new_sku=sku;
            }

            /* if (last_index==-1) {
                new_sku = sku+'-'+'2'
            }else{
                new_sku = sku.substr(0,last_index) +'-'+ (parseInt(sku.substr(last_index+1)) +1);
            } */

            html+="<hr>";
            
            html += '<div style="margin-top: 30px" > '+
                                    '<input style="color: #cb9d48;margin-left: 5px;font-size: 1.4rem;" type="text" name="variant_name" id="new_variant_name">'+
                                    '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                        '<div style="margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                            '<span >'+new_sku+'</span>'+
                                        '</div>'+
                                        '<div style="margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                            '<span >'+price+'&nbsp; '+country_currency[country]+'</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                        '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                        '<input style="color: #cb9d48;margin-left: 5px;font-size: 1.4rem;" type="text" value='+qty+' name="new_variant_qty" id="new_variant_qty">'+
                                       /*  '<span >'+qty+'</span>'+ */
                                    '</div>'+
                                '</div>';

                                
                 /* new_variant_qty = $('#new_variant_qty').value;
                console.log(new_variant_qty); */

                /* if ($("#variant_name").text()=='Default Title') {

                    $("#sku").html($("#sku").text()+'-1');
                    document.getElementById('variants_body').firstChild.removeAttribute("onclick");
                    document.getElementById('variants_body').firstChild.removeAttribute("class");

                    $("#variant_name").html('<input style="color: #cb9d48;margin-left: 5px;font-size: 1.4rem;" type="text" name="variant_name" id="default_variant_name" value="'+$("#variant_name").text()+'">')
                } */

                $('#variants_body').append(html);

                $("#created_variant_button").html('<button onclick="submit_new_variant(\''+
                shopify_product_id+ '\',\''+new_sku+ '\','+price+','+new_variant_qty+','+barcode+')" type="button" class="btn btn-primary"'+
                                    'style="border-radius: 15px;position: relative;right: 1.5rem;top: -0.5rem;font-family: \'Bebas Neue\', cursive;font-size: 17px;letter-spacing: 2px;font-weight: 600;padding: 8px 25px 5px 25px;">'+
                                    'Submit'+
                                '</button>');

                $('#created_variant_button').show();

        }

        function submit_new_variant(shopify_product_id,sku,price,qty,barcode){

            document.getElementById('created_variant_button').firstChild.disabled= true;
            document.getElementById("created_variant_button").firstChild.innerHTML = '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';

            var default_variant=['Empty'];
            if (typeof(document.getElementById('default_variant_name')) !='undefined' && document.getElementById('default_variant_name') !=null) {

                default_variant=[$("#default_variant_name").val(),$("#shopify_variant_id").val(),$("#sku").text()];
            } 

            $.ajax({
                url: "create_new_variant",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    shopify_product_id: shopify_product_id,
                    variant_name: $("#new_variant_name").val(),
                    sku:sku,
                    price:price,
                    qty:$("#new_variant_qty").val(),
                    default_variant:default_variant,
                    country:country,
                    barcode:barcode
                },
                success: function(response) {
                    // document.getElementById("restock_" + id).innerHTML = "Action taken"; 

                    $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});

                    if (response=='Success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Variant had been added',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'variant did not create!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    
                    /*$("#return_pop").hide(); */

                    $('#variants_body').html('');
                    $('#product_info').hide();
                    $('#product_name').html('No item selected');
                    $('#created_variant_button').hide();

                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function submit_new_product(element,product_shopify_id,variant_shopify_id){

            document.getElementById('created_variant_button').firstChild.disabled= true;
            document.getElementById("created_variant_button").firstChild.innerHTML = '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';
                
            $.ajax({
            url: "create_new_product_return",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                product_id:product_shopify_id,
                variant_id:variant_shopify_id,
                product_name:$("#new_product_name").val(),
                sku:$("#new_variant_sku").val(),
                price:$("#new_variant_price").val(),
                qty:$("#new_variant_qty").val(),
                country:country
            },
            success: function(response) {
            console.log(response);

            $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});

            if (response=='Fail') {
                Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Can not dublicate!',
                        showConfirmButton: false,
                        timer: 1500
                    });
            } else {
                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Product had been dublicated',
                        showConfirmButton: false,
                        timer: 1500
                    });
            }
            
                /*$("#return_pop").hide();
                */

                $('#variants_body').html('');
                $('#product_info').hide();
                $('#product_name').html('No item selected');
                $('#created_variant_button').hide();

            },
            error: function(xhr) {
                //Do Something to handle error
            }

            });

        }
        
        function mark_as_fulfilled(id) {
            document.getElementById("fulfill_" + id).disabled = true;
            document.getElementById("fulfill_" + id).innerHTML = '<div id="loader_' + id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';

            $.ajax({
                url: "fulfill_order",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: id,
                    store: store_name,
                },
                success: function(response) {
                    document.getElementById("fulfill_" + id).innerHTML = "Action taken";

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order has been moved to on fulfilled orders',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    //Do Something to handle error
                }

            });
        }

        function return_to_confirm(elemant) {

            $id = elemant.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $(elemant.parentElement.parentElement).html(
                        '<div id="' + $id +
                        '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                    );

                    $.ajax({
                        url: "return_to_confirmed",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order: $id,
                            store: store_name,
                        },
                        success: function(response) {
                            if (elemant.id.substring(0, 1) == '#') {
                                $(elemant.id).html("Action taken");
                            } else {
                                $("#" + elemant.id).html("Action taken");
                            }
                            location.reload(true);
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Order has been returned to confirmed orders',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }
            });

        }

        function cancel_tst(elemant) {

            if (elemant.id.substring(0, 1) == '#') {
                $id = elemant.id.substring(1);
            } else {
                $id = elemant.id;
            }
            $(elemant.parentElement.parentElement).html(
                '<div id="' + $id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            Swal.fire({
                title: "Canceled!",
                text: "Write the reason of cancelation",
                input: 'text',
                footer: '<div style="justify-content: center;" class="row"><button value="Late delivery" class="tag" onclick="tag(this)">Late delivery</button><button value="Not enough COD" onclick="tag(this)" class="tag" >Not enough COD</button><button value="Travelling" onclick="tag(this)" class="tag" >Travelling</button><button value="Change of plan" onclick="tag(this)" class="tag" >Change of plan</button><button value="Death in family" onclick="tag(this)" class="tag" >Death in family</button><button value="Requesting Future Delivery" onclick="tag(this)" class="tag" >Requesting Future Delivery</button></div>',
                allowOutsideClick: false,
                showCancelButton: false,
                allowEscapeKey: false,
                preConfirm: (value) => {
                    if (value == "") {
                        Swal.showValidationMessage(
                            `Please fill in the field`
                        );
                        return false;
                    } else if (value.length > 100) {
                        Swal.showValidationMessage(
                            `There is a limit of characters (up to 100)`
                        );
                        return false;
                    } else {
                        return value;
                    }
                },
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "cancel_tst",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order: $id,
                            store: store_name,
                            reason: result.value
                        },
                        success: function(response) {
                            if (elemant.id.substring(0, 1) == '#') {
                                $(elemant.id).html("Action taken");
                            } else {
                                $("#" + elemant.id).html("Action taken");
                            }
                            location.reload(true);
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Order has been canceled',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });
                }
            });

        }

        function cancel(elemant) {

            var reason = '';

            if (elemant.id.substring(0, 1) == '#') {
                $id = elemant.id.substring(1);
            } else {
                $id = elemant.id;
            }
            $(elemant.parentElement.parentElement).html(
                '<div id="' + $id +
                '" style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
            );

            Swal.fire({
                title: "Canceled!",
                text: "Write the reason of cancelation",
                input: 'text',
                footer: '<div style="justify-content: center;" class="row"><button value="Late delivery" class="tag" onclick="tag(this)">Late delivery</button><button value="Not enough COD" onclick="tag(this)" class="tag" >Not enough COD</button><button value="Travelling" onclick="tag(this)" class="tag" >Travelling</button><button value="Change of plan" onclick="tag(this)" class="tag" >Change of plan</button><button value="Death in family" onclick="tag(this)" class="tag" >Death in family</button><button value="Requesting Future Delivery" onclick="tag(this)" class="tag" >Requesting Future Delivery</button></div>',
                allowOutsideClick: false,
                showCancelButton: false,
                allowEscapeKey: false,
                preConfirm: (value) => {
                    if (value == "") {
                        Swal.showValidationMessage(
                            `Please fill in the field`
                        );
                        return false;
                    } else if (value.length > 100) {
                        Swal.showValidationMessage(
                            `There is a limit of characters (up to 100)`
                        );
                        return false;
                    } else {
                        return value;
                    }
                },
            }).then((result) => {

                if (result.value) {
                    $.ajax({
                        url: "cancel_confirmed",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order: $id,
                            store: store_name,
                            reason: result.value,
                        },
                        success: function(response) {
                            if (elemant.id.substring(0, 1) == '#') {
                                $(elemant.id).html("Action taken");
                            } else {
                                $("#" + elemant.id).html("Action taken");
                            }
                            location.reload(true);
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Order has been canceled',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr) {
                            //Do Something to handle error
                        }

                    });

                }


            });
        }

        var users = new Object();

        $('.closee').click(function(e) {
            $(this.parentElement.parentElement).hide();
            e.preventDefault();
        });
        
        $('.return_close').click(function(e) {
            $(this.parentElement.parentElement.parentElement).hide();
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

        function search_order(elemant) {

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
            var country = "";
            var countries_routes = ['Egypt', 'Saudi Arabia', 'Kuwait', 'Oman', 'Bahrain', 'Qatar', 'Jordan',
                'United Arab Emirates','Iraq'
            ];
            var cetegory = "";
            var archive_status ='';

            if ((value.replace(/\s/g, "")).length > 2) {

                try {
                    ajaxx.abort();
                } catch (error) {

                }
                setTimeout(function() {

                    ajaxx = $.ajax({
                        url: "search_tst_order",
                        type: "post",
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            content: value,
                            store: store_name,
                            filter: search_filter
                            /*  filter: search_filter */
                        },
                        success: function(response) {
                            console.log(response);
                            response.forEach(item => {

                                if (item['status'] == 0 && item['actions'] == 0 ) {
                                    if (item['on_process'] == 1) {
                                        Controller_url = 'on_process';
                                    } else {
                                        Controller_url = 'verified';
                                    }
                                }else if (item['status'] == 1 && item['actions'] == 0 && (item['international_awb'] == null || item['international_awb'] == "")) {
                                    Controller_url = 'fulfilled';
                                } else if (item['status'] == 5  || (item['status'] == 6 && ( item['last_update'] == 5 || item['last_update'] == 6 ))){
                                    Controller_url = 'archived';
                                }else {
                                    Controller_url = 'tst';
                                }

                                if (countries_routes.indexOf(item['country']) !== -1) {
                                    country = item['country'];
                                } else {
                                    country = 'Others';
                                }
 
                                //category

                                if (item['category'] == 0) {
                                    cetegory = "normal";
                                } else if (item['category'] == 1) {
                                    cetegory = "pre order";
                                } else if (item['category'] == 2) {
                                    cetegory = "paid";
                                } else {
                                    cetegory = "normal";
                                }

                                counter++;
                                if (Controller_url != 'archived' ) {
                                    html1 += '<a href="' + Controller_url + '?page=1&store=' + item[
                                        'store'] + '&order_num=' + item['order_number'] +
                                    '&filter=' + country + '&category=' + cetegory +
                                    '" target="blank" class="search-item"> ';
                                } else {
                                    if (item['status'] == 5) {
                                        archive_status = 0;
                                    } else{
                                        if (item['return_to_stock'] == 0 ) {
                                            archive_status = 2;
                                        } else {
                                            archive_status = 1;
                                        }
                                    }
                                    html1 += '<a href="' + Controller_url + '?page=1&store=' + item[
                                        'store'] + '&order_num=' + item['order_number'] +
                                    '&filter=' + country + '&category=' + cetegory +'&archived='+archive_status+'" target="blank" class="search-item"> ';
                                }
                                

                                html1 += '<div style="width: 100%;" class="search-result row">';

                                html1 +=
                                    '<div  style="width: 100%;margin-left: 10px;" class="column">';
                                
                                if (search_filter == 1) {
                                    html1 +=
                                    '<div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                    item['order_number'] + '</div>';
                                } else if(search_filter == 2) {
                                    html1 +=
                                    '<div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                    item['international_awb'] + ' / <span style="color: #918f8f;font-size: small;"> '+item['order_number']+'</span> </div>';
                                }else{
                                    html1 +=
                                    '<div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                    item['domestic_awb'] + ' / <span style="color: #918f8f;font-size: small;"> '+item['order_number']+'</span> </div>';
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

        function filter_search (element){
            search_filter= element.value;
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

<script>
    function export_options(){
        $('#export_popup' ).show();
    }

    function archived_export(){
        $('#archived_export_popup' ).show();
    }

    $('#export_template_type').change(function(){ 
        if($(this).val() == 'sku_temp'){
           console.log("did it");
           $('#add_on_process').hide();
           $('#add_on_process_label').hide();
        }else{
            $('#add_on_process').show();
           $('#add_on_process_label').show();
        }
    });

    function export_with_filters(elemant,store,filter,category,route_name) {

        var template=$('#export_template_type').val();
        var add_on_process=$('#add_on_process').val();
        if ($('#add_on_process').not(':checked').length) {
            add_on_process=0;
        }
                                        
        var data=[];

        if (route_name=='verified'){
            data =[store,filter,category,route_name,template,add_on_process];
        }else{
            data =[store,filter,category,route_name,template];
        }
 
        $.ajax({
            url: "export_tst",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                data: data
    
            },
            success: function(response) {
                /* console.log(response); */
                console.log(JSON.stringify(response));
                window.open(response, '_blank');
                location.reload();

            }
        });
    }

    function export_archived(elemant,store,archived) {

        var from_date=$('#from_export_archived').val();
        var to_date=$('#to_export_archived').val();
        if (!from_date || !to_date) {
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Date field is empty!',
            showConfirmButton: false,
            timer: 1500
            });

        }else{

                $.ajax({
                url: "export_archived",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    from: from_date,
                    to: to_date,
                    store:store,
                    archived:archived
                },
                success: function(response) {
                    console.log(JSON.stringify(response));
                    window.open(response, '_blank');
                    location.reload();

                }
            });
        }



    }

</script>

<script type="text/javascript">

    var archived_filter= document.getElementById("archived_filter");

      $(document).ready(function() {
        document.getElementById("refused_filter").addEventListener("mouseenter", mouseEnter);
        document.getElementById("refused_filter").addEventListener("mouseleave", mouseLeave);
        
        if( store_name == 'origin' ){
            document.getElementById("refused_options").addEventListener("mouseenter", mouseEnter);
            document.getElementById("refused_options").addEventListener("mouseleave", mouseLeave);
        }
       


        function mouseEnter (){
            $('#refused_options').show();
        }

        function mouseLeave() {
            currency_tab = setTimeout(function() {
                $('#refused_options').hide();
            }, 200);

        }
    });


    function archived_D(element){
        console.log(element.innerText);
        archived_filter.innerHTML = localStorage.element.innerText;

    }
</script>

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

</script>

<script>

    function toggle(btnID, eIDs) {

        console.log(btnID , eIDs);
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

            document.getElementById(btnID).style.WebkitTransitionDuration='.5s';
            document.getElementById(btnID).style.webkitTransform = 'rotate(90deg)';

            /* if ($("#user_id").val() == 2) {
                play('bra7a');
            } */
        /*$('#arrow_'+btnID).html('<i style="font-size: 12px;color: #898989;" class="fas fa-arrow-down"></i>'); */ 
        } else {
            // Loop through the rows and hide them
            for (var i = 0; i < theRows.length; i++) {
                theRows[i].classList.add("hidden");
                theRows[i].classList.remove("shown");
            }
            // Now set the button to collapsed
            theButton.setAttribute("aria-expanded", "false");

            document.getElementById(btnID).style.WebkitTransitionDuration='.5s';
            document.getElementById(btnID).style.webkitTransform = 'rotate(0deg)';

        /*$('#arrow_'+btnID).html('<i style="font-size: 12px;color: #898989;" class="fas fa-arrow-right"></i>');*/     
     }
    }

    function add_data(date_type,international_awb,element) {

        test = new Object();
        console.log(international_awb);
        if (international_awbs[international_awb] == null) {

            if (date_type != 'note') {

                test[date_type] = element.value;

            } else {

                test[date_type] = document.getElementById(element.id).textContent;

            }
           
        } else {

            test = international_awbs[international_awb];

            if (date_type != 'note') {

                test[date_type] = element.value;

            } else {

                test[date_type] = document.getElementById(element.id).textContent;

            }
            
        }
        international_awbs[international_awb] = test;

        console.log(international_awbs);
    }
    function submit_awb_data(element){
        /* if ($("#user_id").val() == 2) {
            play('mot2kda');
        } */
        if (Object.keys(international_awbs).length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Nothing to submit!',
                    showConfirmButton: false,
                    timer: 1500
                })
        } else {
            $(element).html('<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>');
            document.getElementById('submit_awb_data').disabled=true;

            $.ajax({
                url: "submit_awb_data",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    awbs: international_awbs
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    }); 

                    location.reload(true);

                }
            });
        }
        
    }

    function remove_from_awbs(e,element){

        $(e).html('<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>');
        /* if ($("#user_id").val() == 2) {
            play('mot2kda');
        } */
        Swal.fire({
                title: "Arrived!",
                text: "Do you want to stop following up with the shipment ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "remove_from_awbs",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            awb: element
                        },
                        success: function(response) {
                            console.log(response);

                            $(e).html(
                                '<i class="fas fa-check" style="color :white;"></i>'
                            );
                            document.getElementById('button_'+element).disabled=true;

                            document.getElementById('dispatching_'+element).disabled=true;
                            document.getElementById('expected_'+element).disabled=true;
                            document.getElementById('airway_'+element).disabled=true;

                            


                        }
                    });

                }else{
                    $(e).html(
                        '<i class="fas fa-check" style="color :white;"></i>'
                    );
                }
            });
        
    }
    
    
</script>

@endsection
