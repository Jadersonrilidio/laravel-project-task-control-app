
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style>
        .title {
            border: 1px;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold; 
        }

        .subtitle {
            border: 1px;
            width: 100%;
            font-weight: bold;
            margin-bottom: 25px; 
        }

        .table {
            width: 100%;
        }
        
        .table th {
            text-align: left;
            background-color: gray;
        }

        .table td {
            text-align: left;
        }
        .row-0 {
            background-color: whitesmoke;
        }

        .row-1 {
            background-color: lightgray;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <h2 class="title">Task List</h2>

    <h3 class="subtitle">User: {{ $username }} </h3>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Task</th>
                <th>Deadline</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>

        <tbody>
            @foreach($taskCollection as $key => $task)
                <tr class="row-{{($key % 2)}}">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->deadline)) }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($task->created_at)) }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($task->updated_at)) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="page-break"></div>
    <h1>Page 2</h1>

</body>
</html>
