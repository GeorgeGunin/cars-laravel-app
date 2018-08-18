
@if(Session::has('sm'))
<div class="row">
  <div class='col-md-12 message'>
    <div class="alert alert-success text-center" role="alert">
      <p>{{Session::get('sm')}}</p>
    </div>
  </div>
</div>
@endif

