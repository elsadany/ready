<select class="form-control" name='{{$name}}' @if($required){{"required"}}@endif >
    <option value="">Choose One</option>
    @foreach($languages as $lang)
        @if($selected==$lang->id)
            <option value="{{$lang->id}}" selected  >{{$lang->name}}</option>
        @else
            <option value="{{$lang->id}}"   >{{$lang->name}}</option>
        @endif
    @endforeach
</select>