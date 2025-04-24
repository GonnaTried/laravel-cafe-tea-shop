<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access - 403 Forbidden</title>
    <!-- Link to Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <style>
        body {
            background-color: #1e1e1e;
            color: #f0f0f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box.dark {
            background-color: #2b2b2b;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .title.dark {
            color: #ff6b6b;
        }

        .subtitle.dark {
            color: #cccccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box dark">
            <div class="content has-text-centered">
                <h1 class="title is-1 dark">403 Forbidden</h1>
                <p class="subtitle is-4 dark">You do not have permission to access this page.</p>
                <a href="{{ url('/') }}" class="button is-primary is-large">Go to Homepage</a>
            </div>
        </div>
    </div>
</body>

</html>
