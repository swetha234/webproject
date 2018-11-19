$(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){
  var post_id = $(this).data('id');
  var users_id = $(this).data('id1');
    
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('fa-thumbs-up')){
  	action = 'unlike';
  }
    
    
  $.ajax({
  	url: 'my_global.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id,
        'users_id': users_id
  	},
  	success: function(data){
        console.log(data);
  		res = JSON.parse(data);
  		if (action == "like") {
  			$clicked_btn.removeClass('fa-thumbs-o-up');
  			$clicked_btn.addClass('fa-thumbs-up');
  		} else if(action == "unlike") {
  			$clicked_btn.removeClass('fa-thumbs-up');
  			$clicked_btn.addClass('fa-thumbs-o-up');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);

  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
  	}
  });		

});
    });

// if the user clicks on the dislike button ...
$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
    var users_id = $(this).data('id1');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
  	action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
  	action = 'undislike';
  }
  $.ajax({
  	url: 'my_global.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id,
        'users_id': users_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "dislike") {
  			$clicked_btn.removeClass('fa-thumbs-o-down');
  			$clicked_btn.addClass('fa-thumbs-down');
  		} else if(action == "undislike") {
  			$clicked_btn.removeClass('fa-thumbs-down');
  			$clicked_btn.addClass('fa-thumbs-o-down');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
  		
  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
  	}
  });	

});
    
  ///for archiving
    
    $(document).on('click','.arch', function(e){ 

  var topic_id = $(this).data('id');
  $clicked_btn = $(this);

   if ($clicked_btn.hasClass('fa-lock')) {
    action = 'archive';
    $(".sub-group").attr('disabled', 'disabled');
    $('.like-btn').prop('disabled', true);
    $('.dislike-btn').prop('disabled', true);
//    $(".submit_cmt").attr('disabled', 'disabled');
     
  } 
  else if($clicked_btn.hasClass('fa-key')){
    action = 'unarchive';
//    $(".submit_post").removeAttr("disabled");
    $('.like-btn').prop('disabled', false);
    $('.dislike-btn').prop('disabled', false);
//    $(".submit_cmt").removeAttr('disabled');

   
  }

   $.ajax({
    url: 'archive.php',
    type: 'get',
    data: {
      'action': action,
      'topic_id': topic_id
    },
    success: function(data){
     console.log(data);
      if (action == "archive") {
        $clicked_btn.removeClass('fa-lock');
        $clicked_btn.addClass('fa-key');
        
        
        // $(".dislike-btn").prop('disabled', true);
        


      } else if(action == "unarchive") {
        $clicked_btn.removeClass('fa-key');
        $clicked_btn.addClass('fa-lock');
         
         // $('.like-btn').prop('disabled', false);
         

      }
     
   }
  });
});
    ///for deleting posts
    $(document).on('click','.delete', function(e){ 
  var post_id = $(this).data('id');
  $.ajax({
    url:'delete.php',
    type: 'post',
    data:{ 'del':post_id},
    dataType: 'text',
    success: function(data){
//      console.log(data);
      $("#posts").remove();
        e.preventDefault() 
    }

  });

      
});

///for deleting users
    $(document).on('click','.delete', function(e){ 
  var members_user_id = $(this).data('id');
  $.ajax({
    url:'deleteusers.php',
    type: 'get',
    data:{ 'del':members_user_id},
    dataType: 'text',
    success: function(data){
//      console.log(data);
      $("#members").remove();
        e.preventDefault() 
    }

  });

      
});
    
  



  ///for searching names
    $(document).ready(function(){
  $("#search_text").on("keyup", function() {
   var txt = $(this).val();
      if(txt != '')
          {
            
          $.ajax({
              url:"search.php",
              method:"post",
              data:{'search':txt},
              dataType:"text",
              success:function(data)
              {
                  console.log(data);
                  $('#result').html(data);
              }  
          });
          }
      else
      {
          
//                  $('#result').html(data);
              }
          });
      });


//appending posts to global

$(document).ready(function (){
        
        $('#sub').click(function(e){ 
            var title = $('#title').val();
            
//          var messageData =$('#summernote').summernote('code');
//            var messageData = $('#summernote').val();
            var plainText =$($("#summernote").summernote("code")).text();

            var topicname= $('#topicname').val();
            
            e.preventDefault();
            $.ajax({
                method:"POST",
                url: "postg.php",
                data: { 
            'title' : title, 
            'summernote' : plainText,
            'topic' : topicname, 
           },
//                data: {'form':textareaValue},
//                data:$('#postform').serialize(),
//                dataType:"text",
                success: function(data){
                    console.log(data);
                    
                    $('#global_posts').html(data);
                    
                }
            }) ;
            
        });
    });
//appending posts to private groups

$(document).ready(function (){
        
        $('.sub-group').click(function(e){ 
            e.preventDefault();
            $.ajax({
                method:"POST",
                url: "postgroup.php",
                data:$('form').serialize(),
                dataType:"text",
                success: function(data){
//                     var obj = JSON.parse(data);
                    
                  console.log(data);
//                     str= "";
//                    obj['message'].forEach(function(e){
//                         str+= "<p>hi</p>";
//                        
//                        
//                  
//                    
//                    });
                    
                      
//                    $title=$("#title").val();
//                    $content=$("#content").val();
//                    $('#global_posts').html(" <div id='posts'> <p> <img src='user/user_images/' width='50', height='50' ></p><h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'></a></h3><p>Username:"+e['first_name']+" <a href='user_profile.php?topic_id=$users_id'></a><p>Topic: "+$title+"</p><p>Topic: "+$title+"</p><p>Content : "+$content+"</p><p>Posted Date:</p><br>")
                    
                    $('#group_posts').html(data);
                    
                }
            }) ;
            
        });
    });