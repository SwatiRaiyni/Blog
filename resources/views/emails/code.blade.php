{{-- <!DOCTYPE html>
<html>
<head>
    <title>About two factor authentication varification</title>
</head>
<body>
        <div class="py-12" style="background-color: #F3F4F6; min-height:100vh">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1> Hello {{ $details['name'] }}</h1>
                        <p>{{ $details['title'] }}</p>
                        <p>Your code is : {{ $details['code'] }}</p>
                        <p> The code will expire in 5 minute. </p>
                        <p> If you have not message tried to login , ignore this message </p>
                        <p>Thanks</p>

                    </div>
                </div>
            </div>
        </div>
</body>
</html>
 --}}
 @component('mail::message')
# Hello {{ $details['name'] }}
{{ $details['title'] }}<br>
Your 2 Factor code is: <b>{{ $details['code']}}</b><br>
The code will expire in 5 minute.<br>
If you have not message tried to login , ignore this message<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
