<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student Result</h1>

    <h2>Student Information</h2>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
    </table>

    <h2>Result</h2>
    <table>
        <tr>
            <th>Subject</th>
            <th>Marks</th>
        </tr>
        @foreach ($results as $result)
            <tr>
                <td>{{ $result->subject->name }}</td>
                <td>{{ $result->marks }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>