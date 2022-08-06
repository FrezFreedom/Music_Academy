<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form style="margin: 100px; margin-left: 30%; margin-right: 30%;" method="post" action="/users">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="test@gmail.com">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    @error('email')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Ali Akbari">
    </div>
    @error('name')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <div class="form-group">
        <label for="name">Password</label>
        <input type="password" class="form-control" id="password" value="{{ old('password') }}" name="password">
    </div>
    @error('password')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <div class="form-group" style="margin-top: 5px;">
        <label for="type">Type</label>
        <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="type" id="type">
            @foreach($types as $type)
                <option value="{{$type}}" {{(old('type') == $type)?'selected':''}}>{{$type}}</option>
            @endforeach
        </select>
    </div>

    @forelse($abilities as $ability)
        <div class="form-check form-check-inline" style="margin-top: 5px;">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="{{$ability->name}}">
            <label class="form-check-label" for="flexCheckDefault">
                {{$ability->name}}
            </label>
        </div>
    @empty
        No Abilities Found!
    @endforelse

    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
</form>

</table>

</body>
</html>
