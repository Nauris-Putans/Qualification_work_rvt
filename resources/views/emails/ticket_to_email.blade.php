<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Ticket Information</title>
</head>
<body>
    <p>
        Fullname: {{ ucwords($data['fullname']) }}
    </p>

    <p>
        Email: {{ $data['email'] }}
    </p>

    <p>
        Date: {{ now() }}
    </p>

    <p>
        Priority: {{ $data['priority'] }}
    </p>

    <p>
        Category: {{ $data['category'] }}
    </p>

    <hr>

    <h1 class="text-center" style="text-align:center;">
        {{ $data['title'] }}
    </h1>

    <p>
        {{ $data['message'] }}
    </p>

</body>
</html>
