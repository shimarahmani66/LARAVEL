<html>
    <?php $i=1;?>
@foreach($a as $value)
<a href="{{$value}}">part {{$i}}: {{$value}}</a> <br>
<?php $i++;?>
@endforeach    
</html>

