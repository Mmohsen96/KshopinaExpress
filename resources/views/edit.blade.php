<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);
        }

        .container {
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        .container .title::before {
            content: "";
            position: absolute;
            left: 5px;
            bottom: 8px;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);
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
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input {
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
        .user-details .input-box input:valid {
            border-color: #CA9B49;
        }

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
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
            background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);
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
            background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);
        }

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(35deg, rgba(27, 52, 37, 0.9612219887955182) 35%, rgba(41, 110, 69, 0.9808298319327731) 100%);
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
    <?php
   
    ?>
    <div class="container">
        <div class="title"><img style="width: 23%;" src="{{ asset('background-white.png') }}" alt=""></div>
        <div class="content">
            <form method="POST" action="update_editing">
                @csrf
                <input name='access_token' style="display: none;" value="{{$_GET['token']}}">
                <input name='route_name' style="display: none;" value="{{Route::current()->getName()}}">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name - الاسم بالكامل</span>
                        <input value="{{$form_data['name']}}" name="name" type="text" placeholder="Enter your name" required disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number - رقم المحمول</span>
                        <input @if ($form_data_status['phone'] == 0) disabled
                        @else
                            style="border-color: #f31c1c;" @endif
                            value="{{ $form_data['phone'] }}" name="phone_number" type="text" placeholder="Enter your Number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Country - البلد</span>
                        <select @if ($form_data_status['country'] == 0) disabled
                        @else
                            style="border-color: #f31c1c;" @endif
                             name="country" id="formOrder" class="details" placeholder="Country">
                            <option value="" selected disabled hidden>Select your country</option>
                            <option @if ($form_data['country']=='Egypt') selected @endif value="Egypt">Egypt</option>
                            <option @if ($form_data['country']=='Kuwait') selected @endif value="Kuwait">Kuwait</option>
                            <option @if ($form_data['country']=='Saudi Arabia') selected @endif value="Saudi Arabia">Saudi Arabia</option>
                            <option @if ($form_data['country']=='United Arab Emirates') selected @endif value="United Arab Emirates">United Arab Emirates</option>
                            <option @if ($form_data['country']=='Oman') selected @endif value="Oman">Oman</option>
                            <option @if ($form_data['country']=='Jordon') selected @endif value="Jordon">Jordon</option>
                            <option @if ($form_data['country']=='Bahrain') selected @endif value="Bahrain">Bahrain</option>
                            <option @if ($form_data['country']=='Qatar') selected @endif value="Qatar">Qatar</option>
                        </select required>

                        {{-- <span class="details">Country</span>
                        <input type="text" placeholder="Enter your email" required> --}}
                    </div>
                    <div class="input-box">
                        <span class="details">City - المحافظة</span>
                        <input @if ($form_data_status['city'] == 0) disabled
                    @else
                        style="border-color: #f31c1c;" @endif name="city" value="{{ $form_data['city'] }}"
                            type="text" placeholder="Enter City in English" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Address - العنوان</span>
                        <input @if ($form_data_status['address'] == 0) disabled
                    @else
                        style="border-color: #f31c1c;" @endif
                            value="{{ $form_data['address'] }}" name="address" type="text" placeholder="Enter your Address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Apartment - العقار</span>
                        <input @if ($form_data_status['apartment'] == 0) disabled
                    @else
                        style="border-color: #f31c1c;" @endif
                            value="{{ $form_data['apartment'] }}" name="apartment" type="text" placeholder="Enter Apartment Number"
                            required>
                    </div>
                </div>
                <div class="gender-details">
                    <input @if ($form_data['payment']=='COD') checked @endif disabled type="radio" name="cod" id="dot-1">
                    <input @if ($form_data['payment']!='COD') checked @endif disabled type="radio" name="visa" id="dot-2">
                    <span class="gender-title">Payment</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Cash on delivery</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Visa</span>
                        </label>
                        {{-- <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label> --}}
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

</body>

</html>
