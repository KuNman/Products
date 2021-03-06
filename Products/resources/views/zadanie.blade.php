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
        <a href="#" style="text-decoration: none"><div data-toggle="modal" data-target="#myModal" class="list-group-item">{{ $name }}</div></a>
    @endforeach
</div>
<a href="/zadanie/add" style="text-decoration: none;"><div class="add new"><button type="button" class="btn btn-success">New product</button></div></a>
<div id="myModal" class="modal fade" role="dialog">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <div class="modal-description">Description :
                    <div>
                        <textarea readonly class="form-control" id="desc" rows="4" maxlength="255" type="textarea"></textarea>
                    </div>
                </div>

                    <div class="modal-date">Date :
                        <input class="form-control" id="modal-date" readonly type="datetime-local" value="" id="example-datetime-local-input">
                    </div>
                    <div class="modal-date">Updated :
                        <input class="form-control" id="modal-update" readonly type="datetime-local" value="" id="example-datetime-local-input">
                    </div>
                    <div class="modal-prices">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td class="normal">Normal</td>
                                <td class="hot">Hot</td>
                                <td class="sale">Sale</td>
                            </tr>
                            <tr>
                                <td class="normal-value"></td>
                                <td class="hot-value"></td>
                                <td class="sale-value"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-prices"></div>
                <div class="modal-created"></div>
            <div class="modal-footer">
                <p>Click name or desc to edit and then press Modify</p>
                <button type="button" class="btn btn-warning">Modify product</button>
                <button type="button" class="btn btn-danger">Delete product</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endif

@if(!empty($add) && !empty($date) && !empty($pricesnames))
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="add_form">
        <div class="form-group row">
        <label for="example-text-input" class="col-form-label">Name:</label>
        <div>
            <input class="form-control" id="name" required type="text" minlength="1" maxlength="30">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-text-input" class="col-form-label">Description:</label>
        <div>
            <textarea class="form-control" id="desc" rows="4" maxlength="255" type="textarea"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="example-number-input" class="col-form-label">Price:</label>
        <div>
            <input class="form-control" id="price" required type="number" value="0" max="1000" step="0.5">
        </div>
            <select id="price_name" sclass="custom-select" id="inlineFormCustomSelect">
                @foreach($pricesnames as $priceName)
                <option value="{{ $priceName }}">{{ $priceName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label for="example-datetime-local-input" class="col-form-label">Date:</label>
            <div>
                <input class="form-control" id="date" disabled type="datetime-local" value="{{$date}}" id="example-datetime-local-input">
            </div>
        </div>
        <div class="add new">
            <button type="button" class="btn btn-success">Add</button>
            <div class="spacer">  </div>
            <button type="button" class="btn btn-warning back">Back</button>
        </div>
    </div>
@endif

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="{!! asset('js/zadanie.js') !!}"></script>
</html>
