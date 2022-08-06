<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form style="margin: 100px; margin-left: 30%; margin-right: 30%;" method="post" action="/users/{{$user[0]->id}}">
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$user[0]->email}}">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    @error('email')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user[0]->name}}">
    </div>
    @error('name')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <div class="form-group" style="margin-top: 5px;">
        <label for="type">Type</label>
        <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="type" id="type">
            @foreach($types as $type)
                @if (old('type') == $type)
                    <option value="{{$type}}" selected>{{$type}}</option>
                @else
                    <option value="{{$type}}">{{$type}}</option>
                @endif
            @endforeach
        </select>
    </div>
{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}
    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
</form>

</table>

</body>
</html>
