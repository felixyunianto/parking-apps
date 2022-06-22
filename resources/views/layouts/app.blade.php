<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', "Parking Apps")</title>

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

</head>

<body>
    @include('layouts.sidebar')
    <main>
        <h1>My Dashboard</h1>
        <p class="text">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum neque, suscipit obcaecati animi deserunt
            alias sed eveniet molestiae, officiis officia voluptas quam quis tempore aliquid ipsam expedita quae
            recusandae delectus possimus laudantium cupiditate aut quo a omnis. Placeat repellat, vitae porro, dicta
            esse tempora atque cupiditate unde, a ipsum excepturi!
        </p>
        <p class="copyright">
            &copy; 2022 <span>Parking Apps</span> All Rigths Reserved.
        </p>
    </main>
    <script src="{{ asset('assets/app.js') }}"></script>
</body>

</html>
