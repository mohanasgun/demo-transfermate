<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/list.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h2>List Data</h2>
    <input type="text" id="myInput" onkeyup="listData()" placeholder="Search for author.." title="Type in a name">
    <table id="myTable" class="zigzag">
        <thead>
            <tr class="header">
                <th style="width:50%;">Author Name</th>
                <th style="width:50%;">Book Name</th>
            </tr>
        </thead>
        <tbody class="listBody" id="listBody"></tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    @include('list.load_list')
</body>

</html>
