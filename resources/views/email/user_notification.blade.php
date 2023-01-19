<!DOCTYPE html>
<html>

<head>
    <title>Animal Message</title>
</head>

<body>
    <h1>Animal Name: {{ $animal_name }} !</h1>
    <h2>Animal Name: {{ $animal_type }} !</h2>
    <h3>Age: {{ $age }}</h3>
    <h4>Gender: {{ $gender }}</h4>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>
