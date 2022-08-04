<!DOCTYPE html>
<html>
<head>
    <style>
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<table class="table table-striped" style="margin: 50px;">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">jobs</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>

            <td>
                <form action="/users/{{$user->id}}" method="get">
                    <button type="submit" class="btn btn-success">Show</button>
                </form>
                <form action="/users/{{$user->id}}/edit" method="get">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                <form action="/users/{{$user->id}}" method="post">
                    <button class="btn btn-danger" type="submit" >Delete</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </td>
            </td>
        </tr>
    @empty
        <p>No users</p>
    @endforelse
    </tbody>
</table>


<div class="pagination">
    <a href="#">&laquo;</a>
    @foreach(range(1, $count) as $page)
        <a href="/users?page={{$page}}">{{$page}}</a>
        @if($loop->iteration > 5)
            @break
        @endif
    @endforeach
    <a href="/users">&raquo;</a>
</div>


</body>
</html>
