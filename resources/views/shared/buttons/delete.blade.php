<div class="inner">
  <form action="{{route($routeName.'.destroy', [$id => $row])}}" method="POST">
      {{csrf_field()}}
      {{method_field('delete')}}
      <button type="submit" class="btn btn-primary">Delete</button>
  </form>
</div>
