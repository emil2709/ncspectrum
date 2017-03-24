
$(document).ready(function(){

  $('#search').on('keyup',function(){
      $search = $(this).val();
      $type = $('#type').val();
      $.ajax({
        type: 'get',
        url: '/search',
        data: {'search':$search,'type':$type},
        success:function(data)
        {
          $('#searchresult').html(data);
        }

      });
  });

  $('#updateAvatarToggle').click(function(){
      $(this).hide();
  });

  $('#updateAvatarCancel').click(function(){
      $('#updateAvatarToggle').delay(500).show(0);
  });

  $('#updateAvatarSave').click(function(){
      var filename = $('#avatar').val();
      if(filename == "")
      {
        return false;
      }
  });


});