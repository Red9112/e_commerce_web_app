<div id="componentError">
    @if (session()->has('status'))
    <h3 class="alert alert-warning ">
      {{session()->get('status')}}  </h3>   
      @endif  
      @if (session()->has('failed')) 
      <h3 class="alert alert-danger ">
        {{session()->get('failed')}}</h3>   
        @endif 
      </div>