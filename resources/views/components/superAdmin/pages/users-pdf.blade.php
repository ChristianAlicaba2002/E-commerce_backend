<!DOCTYPE html>
<html>

<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            color: #333;
            direction: rtl;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .date {
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            direction: ltr;
            font-size: 9px;
            table-layout: fixed;
        }

        th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            padding: 8px 4px;
            font-size: 10px;
            white-space: nowrap;
        }

        td {
            padding: 4px;
            font-size: 9px;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
            direction: ltr;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px 0;
        }

        @page {
            size: landscape;
            margin: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Users List Report</h1>
        <div class="date">Generated on: {{ date('F d, Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birth Month</th>
                <th>Birth Day</th>
                <th>Birth Year</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Password</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->birthMonth }}</td>
                    <td>{{ $user->birthDay }}</td>
                    <td>{{ $user->birthYear }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} Your Company Name - Confidential User Report
    </div>
</body>

</html>
