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
                width: 100%;
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
            .container {
                    padding-left: 0px !important; 
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
    
        </style>
    
        <style>
    
            @media (min-width: 992px){
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
    
        @php
        $previous_order = '';
        @endphp
    
    
        <div class="container">
    
            <div class="row row--top-40">
    
                <div class="column">
                    <h2 class="row__title">Final Confirmation Table</h2>
                </div>
    
        {{--         <form action="/erp" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" id="export" name="action" value="export-fct"
                        style="border-radius: 15px; position: relative; right: 1.8rem; font-family: 'Bebas Neue', cursive; font-size: 17px; letter-spacing: 2px; padding: 8px 25px 5px 25px;"
                        class="btn btn-primary">
                        Export
                    </button>
                </form> --}}
    
            </div>
    
            <div class="row">
                <div class="col-md-3">
                    <div class="row stati turquoise" style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); ">
                        <div style="padding-left: 25px;text-align: left;">
                            <b style="color: #1b3425;">{{ $number_of_pending[0]->NumberOfOrders }}</b>
                            <span class="font-style"  style="color: #d2ac6a; margin-top: 5px;">Pending</span>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="row stati turquoise left" style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b style="color: #1b3425;">{{ $number_of_delivery[0]->NumberOfOrders }}</b>
                            <span class="font-style"  style="color: #d2ac6a; margin-top: 5px; width: 125%;" >Out for delivery</span>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="row stati bg-turquoise " style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;text-align: left;">
                            <b>{{ $number_of_delivered[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px; ">Delivered</span>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="row stati bg-turquoise left" style="border-top: 5px solid #e3ce88;box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%);">
                        <div style="padding-left: 25px;">
                            <b>{{ $number_of_refused[0]->NumberOfOrders }}</b>
                            <span class="font-style" style="color: #d2ac6a; margin-top: 5px;">Refused</span>
                        </div>
    
                    </div>
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
    
                <div style="display: flex;background: #1b3425; height: 70px; padding: 2.5% 2% 0% 1%; border-radius: 5px 5px 5px 5px;">
                    <a href="fct?store={{ $_GET['store'] }}&page=1&filter={{ $filter }}" id="fct"
                        style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                        font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                        @if (Route::current()->getName() == 'fct')
                            background: #ffffff; color: #1b3425;
                        @else
                            background-color: #1b3425;color: #d2ac6a;
                        @endif ">
                        FCT</a>
                    <a href="archived_fct?store={{ $_GET['store'] }}&page=1&filter={{ $filter }}" id="archived"
                        style="margin-right: 15px;cursor: pointer;text-align: center;justify-content: center;align-items: center;padding-top: 5px;width: 95px;padding-bottom: 5px;display: flex;border-radius: 15px 15px 0px 0px;
                        font-family: 'Bebas Neue', cursive; letter-spacing: 2px;
                         @if (Route::current()->getName() == 'fct_archived')
                         background: #ffffff; color: #1b3425;
                         @else
                         background-color: #1b3425;color: #d2ac6a;
                         @endif ">
                        Archived</a>
                </div>
    
                
                <div style="padding-bottom: 8px;display: flex;border-radius: 0px 0px 0px 0px;  background: #ffffff; margin-bottom: 20px;">
                    {{-- <div style=" padding: 15px 0px 0px 15px;" class="position-relative">
                        <i style="color: #1b3425;font-size: 15px;display: flex;position: absolute;top: 29px;left: 25px;"
                            class="fas fa-search"></i>
                        <input style="    width: 20rem;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for order.."
                            title="Type a order number" autocomplete="off">
                        <div id="results" class="result col"
                            style=" display: none;  flex-basis: 0;  flex-grow: 1; max-width: 94%; max-height: 250px; overflow-x: hidden;
                            overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                        </div>
                    </div> --}}
    
                    <div  class="expanding-search-form">
                        <div class="search-dropdown">
                          <button style="width: 75px;" class="button dropdown-toggle" type="button">
                            <span style="font-size: smaller;display: flex;justify-content: center;align-items: center;height: 100%;" class="toggle-active">Order No.
                                 <i class="fas fa-angle-down" style="padding: 0px 0px 0px 6px;font-size: 12px;"></i></span>
                            <span class="ion-arrow-down-b"></span>
                          </button>
    
                          <ul class="dropdown-menu">
                            <li class="menu-active" onclick="filter_search(this)" value="1" selected><a href="#"  id="search_order_number" >Order No.</a></li>
                            <li onclick="filter_search(this)" value="2"><a href="#"   id="search_traching_number" >HAWB</a></li>
                          </ul>
                        </div>
                        <input class="search-input" id="global-search" type="search" placeholder="Search" onkeyup="search_order(this)" autocomplete="off"
                        style="border: 1px solid black;margin-left: -5px;padding: 0.5rem;border-radius: 0px 8px 8px 0px;">
                        
                        {{-- <label class="search-label" for="global-search">
                                  <span class="sr-only">Global Search</span>
                        </label> --}}
                        
                        <div id="results" class="result col"
                        style="border-radius: 6px;padding-top: 10px;top: 46px;display: none;  flex-basis: 0;  flex-grow: 1; max-width: 100%; max-height: 250px; overflow-x: hidden;
                          overflow-y: scroll;  z-index: 10; position: absolute; background-color: #1B3425;   padding-bottom: 15px;">
                        </div>
                    </div>
    
                    <div id="filters" style="margin-right: 15px;margin-left: 35px; color:#fff; display: flex;    justify-content: flex-end;">
    
                    {{--     <button style="background-color: white;border-radius: 10px 0px 0px 10px;  flex:20; color:#1b3425;"
                            class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Egypt') selected @endif " id="Egypt">Egypt</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Saudi Arabia') selected @endif " id="KSA"
                            style="flex:12;">KSA</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Kuwait') selected @endif " id="Kuwait"
                            style="flex:12;">Kuwait</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Oman') selected @endif " id="Oman"
                            style="flex:12;">Oman</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Bahrain') selected @endif " id="Bahrain"
                            style="flex:12;">Bahrain</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Qatar') selected @endif " id="Qatar"
                            style="flex:12;">Qatar</button>
                        <button class="@if (isset($_GET['filter']) && $_GET['filter'] == 'Jordan') selected @endif " id="Jordan"
                            style="flex:12;">Jordan</button>
                        <button style="flex:12;border-radius: 0px 10px 10px 0px;border-right: 1px solid;"
                            class="@if (isset($_GET['filter']) && $_GET['filter'] == 'United Arab Emirates') selected @endif " id="UAE">UAE</button>
                    --}}
    
                            @if ((isset($_GET['store']) || !isset($_GET['store'])) && $_GET['store'] == 'origin')
                            <div style="margin-left: 35px;" class="position-relative">
                                <i style="color: #1b3425;font-size: 17px;display: flex;position: absolute;top: 13px;left: 12px;"
                                    class="fas fa-map-marker-alt"></i>
                                <select style="padding-left: 40px;width: 15rem;height: 44px;border-radius: 6px"
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
                    </div>
                </div>
    
                <table class="table">
                    <thead class="table__thead">
                        <tr style="background-color: #ffffff;">
                            <th class="table__th" style="width: 150px;">Order Number</th>
                            <th class="table__th">Phone number</th>
                            <th class="table__th">Hawb</th>
                            <th class="table__th">Reason</th>
                            <th class="table__th">Notes</th>
                            <th class="table__th">Final status</th>
                            @if (Route::current()->getName() == 'fct')
                            <th style="white-space: nowrap;" class="table__th">Reschedule At</th>
                            @endif
                            <th class="table__th">From</th>
                            <th class="table__th"></th>
                        </tr>
                    </thead>
                    <tbody id="table" class="table__tbody">
                        <input type="hidden" name="store" id="store_name_url" value="{{$_GET['store']}}" readonly>
                        @foreach ($orders as $order)
                            @if ($previous_order == '' || $order->order_number != $previous_order)
                                @php
                                    $previous_order = $order->order_number;
                                @endphp
    
                                <tr class="table-row table-row--chris">
                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
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
                                            </p>
                                        </div>
                                    </td>
    
                                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 160px;">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ $order->phone_number }}
                                            </p>
                                        </div>
                                    </td>
    
                                    @if (isset($_GET['store']) && $_GET['store'] != 'origin')
                                        <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                                            <div class="table-row__info">
                                                <p class="table-row__name">
                                                    {{ $order->international_awb }}
                                                </p>
                                            </div>
                                        </td>
                                    @else
                                        <td data-column="upload_date" class="table-row__td" style="width: 150px;">
                                            <div class="table-row__info">
                                                <p class="table-row__name">
                                                    {{ $order->domestic_awb }}
                                                </p>
                                            </div>
                                        </td>
                                    @endif
                                    
                                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 160px;">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ $order->last_status }}
                                            </p>
                                        </div>
                                    </td>
    
                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                        <div style="padding-top: 5px;overflow: hidden;resize: none;text-align: center;width: 210px;
                                        @if (!empty($order->notes))font-weight:bold; @endif
                                        background-color: transparent;  border:none; outline-color:#dfdfdf;color: black;" name="notes" id="notes_{{ $order->order_number }}"
                                        class="text" onkeyup="press(this)" contenteditable=true>{{ $order->notes }}</div>
                                    </td>
    
                                    <td data-column="upload_date" class="table-row__td" style="width: 100px;">
                                        <select name="status" id='status_{{ $order->order_number }}' onchange="press(this)"
                                            style="padding: 3px 3px 3px 3px;font-size: 15px;background-color: transparent;  border: 0.5px solid #6c757d;border-radius: 3px;outline-color:#dfdfdf;">
                                            <option value="" selected hidden>Select status</option>
                                            <option id='status4_{{ $order->order_number }}'
                                                @if (isset($order->last_update) && $order->last_update == 3) selected @endif value="3">Kshopina warehouse
                                            </option>
                                            <option id='status5_{{ $order->order_number }}'
                                                @if (isset($order->last_update) && $order->last_update == 4) selected @endif value="4">Out For Delivery
                                            </option>
                                            <option id='status6_{{ $order->order_number }}'
                                                @if (isset($order->last_update) && $order->last_update == 5) selected @endif value="5">Delivered</option>
                                            <option id='status7_{{ $order->order_number }}'
                                                @if (isset($order->last_update) && $order->last_update == 6) selected @endif value="6">Refused</option>
                                        </select>
                                    </td>
                                    @if (Route::current()->getName() == 'fct')
                                    <td  data-column="upload_date" class="table-row__td">      
                                                
                                        <input
                                         @if ($order->reschedule_date != NULL)
                                        value="{{date('Y-m-d', strtotime($order->reschedule_date))}}"
                                        style="border-radius: 18px; padding: 6% 18% 6% 10%; border: none; font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;  "
                                        @endif 
                                         style="border-radius: 18px; padding: 6% 18% 6% 10%; border: none; font-family: 'Bebas Neue', cursive;letter-spacing: 1px;font-size: 14px;  color: #426851;"
                                       type="date" name="reschedule_date" id="rescheduledate_{{ $order->order_number }}" onchange="press(this)" min='{{date('Y-m-d', time())}}' data-date-inline-picker="true" >
    
                                   </td>
                                   @endif
                                    <td data-column="upload_date" class="table-row__td" style="font-weight:bold;width: 140px;   white-space: nowrap;">
                                        <div class="table-row__info">
                                            <p class="table-row__name">
                                                {{ date('M j', strtotime($order->created_at)) }}
                                            </p>
                                        </div>
                                    </td>
    
                                    <td data-column="upload_date" class="table-row__td" style="height: 7rem;display: flex;justify-content: center;align-content: center;">
                                        <div class="table-row__info" id="arrow_id{{ $order->order_number }}" style="display: inherit;cursor: pointer;justify-content: center;flex-direction: column;">
                                            <i onclick="create_task(this)" id="assign_{{ $order->order_number }}"
                                                class="fas fa-chevron-right"></i>
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
                                <input name='system_name' value="FCT" hidden readonly>
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
                                        <textarea maxlength="250" style="height: 100px;overflow: hidden;resize: none;" name="task" id="task" cols="30" rows="3"
                                            required></textarea>
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
                            Page {{ $_GET['page'] }} of {{ceil($number_of_orders[0]->NumberOfOrders /15) }}
                        </p>
                @else
                    <a href="#">&laquo;</a>
                    <a href="#">&raquo;</a>
                @endif
    
            </div> 
    
          
            <script>
    
                /* var store_name_url= $('#store_name_url').val(); */
    
                function handleSelect(store_name, elm) {
                    window.location = window.location.pathname + "?store=" + store_name + "&page=1&filter=" + elm.value ;
                }
    
                function tag(ele) {
                    $(".swal2-input").val(ele.value);
                }
                $("#filters button").click(function() {
    
                    var storee = storeee.searchParams.get("store");
    
    
    
                    if (this.id == "Egypt") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Egypt";
    
                    } else if (this.id == "KSA") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Saudi Arabia";
    
                    } else if (this.id == "Kuwait") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Kuwait";
    
                    } else if (this.id == "Oman") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Oman";
    
                    } else if (this.id == "Bahrain") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Bahrain";
    
                    } else if (this.id == "Qatar") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Qatar";
    
                    } else if (this.id == "Jordan") {
                        window.location.href = "?store=" + storee + "&page=1&filter=Jordan";
    
                    } else {
                        window.location.href = "?store=" + storee + "&page=1&filter=United Arab Emirates";
    
                    }
                    selected = this.id;
                });
    
                var orders = new Object();
                var test = new Object();
                var order_number;
                var data;
                
    
                function press(elemant) {
    
                   /*  if(elemant == null && elemant == undefined)
                    {
                        this.target.addEventListener('paste',this.inPaste.bind(this),false);
                        this.target.addEventListener('change',this.changed.bind(this),false);
                        console.log('ops');
                    } */
                    
                    order_number = elemant.id.substring(elemant.id.indexOf("_") + 1);
                    data = elemant.id.substring(0, elemant.id.indexOf("_"));
    
                    /* if (data=="notes") {
                        var box = document.getElementById(elemant.id);
                        console.log(document.getElementById(elemant.id).textContent);
                    } */
                    test = new Object();
                    
    
                    if (orders[order_number] == null) {
    
                        if (data=="notes") {
                        test[data] = document.getElementById(elemant.id).textContent;
    
                        
                        }
                        else{
                            test[data] = elemant.value;
                        }
                        orders[order_number] = test;
    
                    } else {
                        test = orders[order_number];
    
                        if (data=="notes") {
                        test[data] = document.getElementById(elemant.id).textContent;
                        }
                        else{
                            test[data] = elemant.value;
                        }
                        orders[order_number] = test;
    
                    }
                    console.log(orders);
    
                }
    
    
                /* .on('input', '.emotion', function() {   
                    alert('done');
                }); */
    
    
                
    
                
    
                function ajaxfunc(elemant) {
                    console.log(Object.keys(orders));
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
                            '<div id="submit_fct" style="letter-spacing: .7px;font-size: 12px;background-color: #36304a;border-color: #36304a;font-weight: 600;padding: 10px 25px 10px 25px; display: inline-block; margin-left: 20px; align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>'
                        );
    
                        $.ajax({
                            url: "submit_fct",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                data: orders,
                                store: store_name_url
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
    
                var storeee;
                storeee = window.location.href;
                storeee = new URL(storeee);
    
    
    
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
            </script>
    
        <script>
             var search_filter=1;
             var store_name_url= $('#store_name_url').val();
    
            function filter_search (element){
                search_filter= element.value;
            }
    
            
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
                    'United Arab Emirates'
                ];
                var last_update = "";
                if ((value.replace(/\s/g, "")).length > 2) {
    
                    try {
                        ajaxx.abort();
                    } catch (error) {
    
                    }
    
                    setTimeout(function() {
    
                        ajaxx = $.ajax({
                            url: "search_fct",
                            type: "post",
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                content: value,
                                store: store_name_url,
                                filter: search_filter
                                /*  filter: search_filter */
                            },
                            success: function(response) {
                                console.log(response);
                                response.forEach(item => {
    
                                    if (item['last_update'] == 0 || item['last_update'] == 3 ) {
                                        Controller_url = 'fct';
                                        
                                    } else {
                                        Controller_url = 'archived_fct';
                                    } 
    
                                    //last_update
    
                                    if (item['last_update'] == 0) {
                                        last_update = "Pending";
                                    } else if (item['last_update'] == 4) {
                                        last_update = "OFD";
                                    } else if (item['last_update'] == 5) {
                                        last_update = "Delivered";
                                    }else if (item['last_update'] == 3) {
                                        last_update = "Kshopina Warehouse";
                                    } else {
                                        last_update = "Refused";
                                    }
    
                                    counter++;
    
                                    if (countries_routes.indexOf(item['country']) !== -1) {
                                        country = item['country'];
                                    } else {
                                        country = 'Others';
                                    }
    
                                    
                                    html1 += '<a href="' + Controller_url + '?store=' + item[
                                            'store'] + '&order_num=' + item['order_number'] +
                                        '&filter=' + country + '&page=1" target="blank" class="search-item"> ';
    
                                    html1 += '<div style="width: 100%;" class="search-result row">';
    
                                    html1 +=
                                        '                        <div  style="width: 100%;margin-left: 10px;" class="column">';
                                    
                                    if (search_filter == 1) {
                                        html1 +=
                                        '                            <div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                        item['order_number'] + '</div>';
                                    } else {
                                        html1 +=
                                        '                            <div  style="color: #b3883e;font-weight: 600;font-size: 16px;"> <i class="fas fa-hashtag"></i> ' +
                                        item['domestic_awb'] + ' / <span style="color: #918f8f;font-size: small;"> '+item['order_number']+'</span> </div>';
                                    }
                                            
                                    html1 +=
                                        '                            <div class="row" style="justify-content: space-between;margin: 3px 1px 0px 0px ;color: #918f8f;font-size: 13px;">';
    
                                    html1 +=
                                        '                                <div  style="margin-right: 25px; font-size: 14px; color: white; "><i class="fas fa-user-alt"></i>  ' +
                                            last_update + '</div>';
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
@endsection
    
