<!DOCTYPE html>
<html lang="{{ str_replace( "_", "-", app()->getLocale() ) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaravelTasks</title>

    <link rel="stylesheet" type="text/css" href="/css/app.css">

</head>

<body>

    <div class="container mx-auto">

        <header class="py-2">

            <h1 class="text-4xl font-bold">Laravel Tasks</h1>

        </header>

        <section class="page">

            @yield( "content" )

        </section>

        <footer></footer>

    </div>

</body>

</html>
