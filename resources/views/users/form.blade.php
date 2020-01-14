<div class="row">

  <div class="form-group col-md-12">
      <label class="col-md-12">Full Name</label>
      <div class="col-md-12">
          <input type="text" name='name' value="{{ old('name') ?? $row->name }}" placeholder="Johnathan Doe" class="form-control form-control-line">
      </div>
      @include('shared.row-error', ['name' => 'name'])
  </div>

  <div class="form-group col-md-12">
      <label for="example-email" class="col-md-12">Email</label>
      <div class="col-md-12">
          <input type="email" name="email" value="{{ old('email') ?? $row->email }}" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
      </div>
      @include('shared.row-error', ['name' => 'email'])
  </div>

  <div class="form-group col-md-12">
      <label class="col-md-12">Password</label>
      <div class="col-md-12">
          <input type="password" name="password" value="{{ old('password') }}" value="password" class="form-control form-control-line">
      </div>
      @include('shared.row-error', ['name' => 'password'])
  </div>

</div>
@csrf
