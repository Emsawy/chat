<div class="inner">
  <form action="{{route($routeName.'.block', [$id => $row])}}" method="POST">
      <button type="submit" class="btn btn-primary">Block</button>
      <input type="hidden" name="blocked_id" value="{{$data->id}}">
      @csrf
  </form>
</div>
