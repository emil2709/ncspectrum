
$(document).ready(function(){

  // Functions triggered on load
  $("#welcome").hide().fadeIn(3000);

  // Interactive functions
  $(function(){

    	$(".sortable").sortable({
       		revert: true,
          connectWith: ".connectedSortable"
     	});

     	$(".draggable").draggable({
       		connectToSortable: ".sortable",
       		revert: "invalid",
          refreshPositions: true
     	});

     	$("ul, li").disableSelection();

      $( ".tabs" ).tabs();

      $('#search').on('keyup',function(){
        $search = $(this).val();
        $type = $('#type').val();
        console.log($type);
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


    });

});