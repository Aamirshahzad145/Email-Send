<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<style>
    body {
        background-color: rgb(221, 221, 221);
    }
    .container{
        background-color: rgb(255, 255, 255);
        max-width: 50%;
        position: absolute;
        top: 20%;
        left: 20%;
        margin: -20px 0 0 -20px;
        padding: 5%;
        border-radius: 2%;
        border-color: #5cbd51;
        border-style: double;
    }
    .paragraph {
        text-decoration: none;
        font-style: normal;
        font-family: 'Times New Roman', Times, serif;
        color: rgb(81, 81, 81);
        font-size: medium;
    }
    .email{
        text-align: center;
        font-size: large;
        font-weight: bold;
        color: rgba(62, 56, 254, 0.843);
    }
    .heading-3{
        text-align: center;
        color: #ae7a1b;
        font-style: oblique;
        font-weight: bold;
    }
    .h3:hover {
        color: #ed438a;
    }
    .btn-center{
        text-align: center;
    }
    .button{
        background-color: #5cbd51;
        color: white;
        text-decoration: none;
        padding: 10px 20px 10px 20px;
        border-radius: 10px;
    }
    .hover:hover {
        background-color: #ae7a1b;
        color: white;
    }
    .footer{
        text-align: end;
        color: rgb(218, 47, 47);
        font-size: large;
    }
</style>
<body>
    <div class="container" style="background-color: rgb(255, 255, 255);
    max-width: 100%; position: absolute; top: 20%; left: 20%; margin: -20px 0 0 -20px; padding: 5%;
    border-radius: 2%; border-color: #5cbd51; border-style: double;">
        <h1 style="text-align: center;">{{ $details['title'] }}</h1>
        <p class="paragraph" style="text-decoration: none; font-style: normal; font-family: 'Times New Roman', Times, serif;
        color: rgb(81, 81, 81);
        font-size: medium;">{{ $details['body'] }}</p>
        <p class="email" style="text-align: center;
        font-size: large;
        font-weight: bold;
        color: rgba(62, 56, 254, 0.843);">{{ $details['email'] }}</p>
        <h3 class="heading-3 h3" style="text-align: center;
        color: #ae7a1b;
        font-style: oblique;
        font-weight: bold;">{{ $details['button'] }}</h3>
        <div class="btn-center">
            <a class="button hover" href="{{ $details['url'] }}" target="_blank" style="background-color: #5cbd51; color: white; text-decoration: none;
            padding: 10px 20px 10px 20px; border-radius: 10px;">Verify Email</a>
        </div>
        <p class="footer" style="text-align: end; color: rgb(218, 47, 47); font-size: large;">Thank you!</p>
    </div>
</body>
</html>
