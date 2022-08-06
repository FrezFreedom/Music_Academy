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

    <meta charset="utf-8" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<table class="table table-striped" style="margin: 50px;">

    <thead>
    <tr>
        <th>
            <form action="/users/create" method="get">
                <button class="btn btn-primary" type="submit" style="width: 100%;" >Create</button>
            </form>
        </th>
    </tr>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">Abilities</th>
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
                @if($user->type != "maestro")
                    No Abilities!
                @else
                    @forelse($user->abilities as $ability)
                        <span style="background: #87d37c;padding: 5px 10px 5px 10px;border: 1px solid none; border-radius: 10px; box-shadow: 1px 1px 5px grey;">{{$ability->name}}</span>
                    @empty
                        No Abilities!
                    @endforelse
                @endif
            </td>

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


{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $users->links() !!}
</div>

</body>
</html>
