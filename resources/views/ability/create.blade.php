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
    <div class="form-group">
        <label for="name">Ability name</label>
        <input type="text" class="form-control" id="ability" name="ability" placeholder="Guitar">
    </div>
    @error('ability')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
</form>

</table>

</body>
</html>
