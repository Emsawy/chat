<div class="card">
  <h5 class="card-header"> Message Box </h5>
  <div class="card-body">
    <form action="{{route($routeName.'.message', [$id => $row])}}" method="POST">
        <div class="form-group">
          <textarea name = "message" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
        <input type="hidden" name="target_id" value="{{$data->id}}">
        @csrf
    </form>
    @include('shared.row-error', ['name' => 'message'])
  </div>
</div>
