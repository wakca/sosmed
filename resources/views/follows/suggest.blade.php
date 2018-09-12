@if(Auth::check())
<div class='panel panel-default'>
    <div class='panel-heading'>Orang yg mungkin anda kenal <a title='Refresh' href='javascript:void(0)' onclick='refreshSuggestion()' class='pull-right'><span class='glyphicon glyphicon-refresh'></span></a></div>
    <div class='panel-body suggest'>
        @include('follows.random')
    </div>
</div>
@endif
@section('script2')
<script type='text/javascript'>
   function follow(id) {
      $followBtn = $("#user-"+id).find("#follow-btn");
      $.ajax({
        url:'/follow/'+id,
        type:'GET',
        dataType:'json',
        success:function(data){
            if (data.status == 'following') {
                $followBtn.removeClass('btn-default').addClass('btn-primary').text('Following');
            }
            else{
                $followBtn.removeClass('btn-primary').addClass('btn-default').text('+ Follow');
            }
        }
      });
   }
   
   function refreshSuggestion() {
        $(".suggest").hide().load('/follow/suggest').fadeIn('slow');
   }
</script>
@endsection