<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1> Hello miss </h1>

    <p> This is a test </p>

    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
        </tr>

        @foreach($customerData as $custData)
        <tr>
            <td>{{ $custData->cust_id }}</td>
            <td>{{ $custData->cust_name }}</td>
            <td>{{ $custData->cust_address }}</td>
        </tr>

        @endforeach
</table>

</body>
</html>