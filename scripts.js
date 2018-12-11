const getPostTemplate = (dp_value,topic_name,post_id, topic_id, title, content, userImage, userLastName,userId,session) =>  {
//  const userImage = session["user_image"];
 //const userLastName = session["last_name"];
  const session_userId = session["users_id"];
    
     if(dp_value != "0")
        {
            
            
             userImageNew  = 'user/user_images/'+userImage;
        }

        else{
           
            userImageNew = userImage;
        }
    
    if (session_userId == 21)
        {
             return `
    <div id='posts'> 
      <p>

        <img src=${userImageNew} width='50' height='50'/>
      </p>
      <h3>
        Group Name: 
        <a href='group_profile.php?topic_id=${topic_id}'>${topic_name}</a>
      </h3>
      <p>Username: <a href='my_profile.php?id=${userId}'>${userLastName}</a></p>
      <p>Topic: ${title}</p>
      <p><span>Content:</span><span>` + content + `</span></p>
      <p>Posted Date: ${Date(Date.now())}</p>
      <br> 
      <i class='fa fa-thumbs-o-up like-btn' data-id=${post_id} data-id1=${userId}></i> <span class='likes'> 0 </span>
    <i class='fa fa-thumbs-o-down dislike-btn' data-id=${post_id} data-id1=${userId}></i> <span class='dislikes'> 0 </span>
      <a href='single.php?post_id=${post_id}' style='float:right;'><button> See Replies or Reply to this </button></a>
      <i class='fa fa-trash delete' data-id='${post_id}' style='font-size:24px; color:black; float:right;'> </i>
    </div><br>`; 
        }
    else{
    return `
    <div id='posts'> 
      <p>
        <img src=${userImageNew} width='50' height='50'/>
      </p>
      <h3>
        Group Name: 
        <a href='group_profile.php?topic_id=${topic_id}'>${topic_name}</a>
      </h3>
      <p>Username: <a href='my_profile.php?id=${userId}'>${userLastName}</a></p>
      <p>Topic: ${title}</p>
      <p><span>Content:</span><span>` + content + `</span></p>
      <p>Posted Date: ${Date(Date.now())}</p>
      <br> 
      <i class='fa fa-thumbs-o-up like-btn' data-id=${post_id} data-id1=${userId}></i> <span class='likes'> 0 </span>
    <i class='fa fa-thumbs-o-down dislike-btn' data-id=${post_id} data-id1=${userId}></i> <span class='dislikes'> 0 </span>
      <a href='single.php?post_id=${post_id}' style='float:right;'><button> See Replies or Reply to this </button></a>
    </div><br>`;
    }

};



$(document).ready(function(){
    
    $.ajax({
        url: 'get_global_posts.php',
        type: 'get',
        type: "JSON",
        success: function(data){
            data = JSON.parse(data);
            const result = data.result;
            const session = data.session;
            const posts = data.posts;
//            ?const my_data = data.my_dat?a;
//            console.log(my_data);
//            console.log(posts);
//            console.log(session);
            for(i=0;i<posts.length; i++) {
            console.log(i);
            $('#global_posts').append(getPostTemplate(posts[i].dp_value,posts[i].topic_title,posts[i].post_id,posts[i].topic_id,posts[i].post_title,posts[i].post_content,posts[i].user_image,posts[i].last_name,posts[i].users_id,session));
            }
            //for loop on data
            
        }
        
    });
    
});




$(document).ready(function(){
$(document).on('click','.like-btn', function(){ 
// if the user clicks on the like button ...
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
$(document).on('click','.dislike-btn', function(){ 
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
    $(document).on('click','.deleteusers', function(e){ 
    var members_user_id = $(this).data('id1');
     var topic_id = $(this).data('id2');
  $.ajax({
    url:'deleteusers.php',
    type: 'post',
    data:{ 'users_id':members_user_id,
         'topic_id':topic_id},
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
     if(txt == ''){
         $('#result').empty();
     }
          });
      });


//appending posts to global

$(document).ready(function (){  
  $('#sub').click(function(e){ 
      const topic_id = $('#topicname').val();
      const topic_name = $('#topicname option:selected').text();
      const title = $('#title').val();
      const content = $("#summernote").val();
      
      e.preventDefault();
      $.ajax({
        method:"POST",
        url: "postg.php",
        type: "JSON",
        data: { 
          'title' : title, 
          'content' : content,
          'topic_id' : topic_id, 
        },
        success: function(data) {

       const session = JSON.parse(data).session;
            const post_id = JSON.parse(data).id;
                     const userImage = session['user_image'];
         const userLastName = session["last_name"];
        const userId = session["users_id"]; 
            const dp_value = session["dp_value"];
         $('#global_posts').prepend(getPostTemplate(dp_value,topic_name,id=post_id, topic_id, title, content,userImage, userLastName,userId,session));
        }
      }) ;   
  });
});
//appending posts to private groups

$(document).ready(function (){
        
        $('.sub-group').click(function(e){ 
    const topic_id = $('#topic_name_group').val();
      const topic_name = this.name;
      const title = $('#title').val();
      const content = $("#summernote").val();
            

            e.preventDefault();
            $.ajax({
                method:"POST",
                url: "postgroup.php",
                type: "JSON",
        data: { 
          'title' : title, 
          'content' : content,
          'topic_id' : topic_id, 
        },
                success: function(data){
//                    console.log(data);
//console.log(topic_id,topic_name,title,content);
       const session = JSON.parse(data).session;
            const post_id = JSON.parse(data).id;
            const userImage = session["user_image"];
         const userLastName = session["last_name"];
        const userId = session["users_id"];
        const dp_value = session["dp_value"];
        $('#group_posts').prepend(getPostTemplate(dp_value,topic_name,id=post_id, topic_id, title, content,userImage, userLastName,userId,session));
        }
            }) ;
            
        });
    });


//changing to default

$(document).on('click','.default', function(e){ 
e.preventDefault();
 $.ajax({ 

    url:'profilepicture.php',
    type: 'post',
    data:{ 'default':0},
    dataType: 'text',

    success: function(data){


    	console.log(data);
    	  location.reload();
    	
    }


 });

});
    
//gravatar

$(document).on('click','.gravatar', function(e){ 
e.preventDefault();
 $.ajax({ 

    url:'profilepicture.php',
    type: 'post',
    data:{ 'gravatar':1},

    dataType: 'text',

    success: function(data){


    	console.log(data);
    	  location.reload();
    	
    }


 });

});


//chat
$(document).on('keyup','.msg', function(e){ 
      var chat_userid = e.currentTarget.id;
      e.preventDefault();
      var msg = $(this).val();
    
    if(e.which ==13){
          $.ajax({ 
       
       url:'ajax.php',
       type:'post',
       data:{'msg':{'chat_userid':chat_userid, 'msg':msg}},
       dataType:'text',
       success:function(data){
           
           console.log(data);
           $(this).val('');
           location.reload();
           
       }
       
       });
        
    }
     
        
        
    
    });

//upload file

$(document).on('click', '.upload_file', function(e){ 
    e.preventDefault();
var property= document.getElementById("file").files[0];
  var file_name =property.name;
  var file_extension = file_name.split(".").pop().toLowerCase();
if(jQuery.inArray(file_extension,['pdf','docx','doc','xls','txt']) == -1)
  {
    alert("Invalid File");
  }
    
 var file_size=property.size;
  if(file_size > 2000000){

    alert("file size is very big");
  }
else{

    var form_data = new FormData();
    form_data.append("file",property);
     
  }
    
 $.ajax({
    url:'upload.php',
    type: 'post',
    data: form_data,
    contentType:false,
    cache:false,
    processData:false,

    success: function(data){
        
        console.log(data);
        location.reload();
    }
     
     
 });




});