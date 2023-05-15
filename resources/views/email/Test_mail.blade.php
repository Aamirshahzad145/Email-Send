<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<style>

</style>
<body>
    div @class(['p-4', 'font-bold' => true])>
        <h1>{{ $details['title'] }}</h1>
        <p>{{ $details['body'] }}</p>
        <p>{{ $details['email'] }}</p>
        <h3>{{ $details['button'] }}</h3>
        <a href="{{ $details ['url'] }}" target="_blank" style="background-color: #84CFAC; color: white; margin: 100px 100px 100px 100px; padding: 10px; text-decoration: none;">Verify Email</a>
        @component('mail::button', ['url' => $url. urlencode('verify email'),'slot' => 'Twitter','color' => 'red'])
            Verify Email
        @endcomponent
    
        <p style="color: brown">Thank you!</p>
    </div>
</body>
</html>