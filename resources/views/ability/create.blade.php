<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form style="margin: 100px; margin-left: 30%; margin-right: 30%;" method="post" action="/ability">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group" style="margin-top: 5px;">
        <label for="type">Type</label>
        <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="maestro" id="maestro">
            @foreach($maestros as $maestro)
                <option value="{{$maestro->id}}">{{$maestro->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Abilities List</label>
        <input type="text" class="form-control" id="abilities" name="abilities" placeholder="Guitar Setar Piano">
        <small id="emailHelp" class="form-text text-muted">Write abilities seperated with spaces!</small>
    </div>
    @error('abilities')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
</form>

</table>

</body>
</html>
