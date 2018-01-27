<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/css/tether.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/zadanie.css') }}">
    <title>Zadanie rekrutacyjne</title>
</head>

<body>
<div class="header">Zadanie rekrutacyjne dla MyLead, 27.01.2018, knejman56@gmail.com.</div>
@if (!empty($names))
<div class="list-group">
    <div class="list-group-item active">All products</div>
    @foreach ($names as $name)
        <a href="#" style="text-decoration: none"><div class="list-group-item">{{ $name  }} </div></a>
    @endforeach
</div>
<a href="/zadanie/add" style="text-decoration: none;"><div class="add new"><button type="button" class="btn btn-success">New product</button></div></a>
@endif

@if(!empty($add))
    <div class="form-group row">
        <label for="example-text-input" class="col-2 col-form-label">Text</label>
        <div class="col-10">
            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">Search</label>
        <div class="col-10">
            <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
        </div>
    </div>
@endif

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>
