<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          font-weight: 700;
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        @if (isset($status))
        <i class="checkmark" style="font-size: 255px;color: #da2b2b !important;">×</i> </div>
        <h1 style="color: #da2b2b !important;">{{$status}}</h1> <br>
        @else
        <i class="checkmark">✓</i> </div>
        <h1>Success</h1> 
        @endif
        
        <p>@if (isset($message))
            {{$message}}<br/><br/> {{$sub_message}}
        @else
        We received your complaint;<br/>we'll be in touch shortly!</p>
        @endif 
        
      </div>
    </body>
</html>