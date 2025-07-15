<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('mini_yellow.png') }}" style="font-size: 2rem;">
    <title>Rating</title>

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
        --bodyCopy: 15px;
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
        margin-top: 8rem;
    }


    .imgBlock {
        width: 100%;
        height: 15ch;
/*         background: url(https://raw.githubusercontent.com/hejkeikei/interactive-rating-component/16de82dee8e9299ac78d332cc3b5480da9bf435c/images/illustration-thank-you.svg) no-repeat center;
 */    }

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
<body>

<div id="thankYou" class="card">
    <div style="background: url({{asset('illustration-thank-you.svg')}}) no-repeat center" class="imgBlock"></div>
    <p style="margin-bottom: 5%; color:white;" class="message">
        You selected <span class="userValue">{{$rate}}</span> out of 5
    </p>

    <!-- Add rating here -->
    <h2 style="color: #ca9b49">Thank you!</h2>
    <p style="color:white;">
        We appreciate you taking the time to give a rating. If you ever need
        more support, don’t hesitate to get in touch!
    </p>
</div>
</body>

</html>
