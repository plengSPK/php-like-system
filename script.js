$(function() {
    // document ready
    $('.like-btn').click(function(){
        var post_id = $(this).data('id');

        $clicked_btn = $(this);
        if($clicked_btn.hasClass('far')){
            action = 'like';
        }else if($clicked_btn.hasClass('fa')){
            action = 'unlike';
        }

        $.ajax({
            url: 'index.php',
            type: 'post',
            data:{
                'action': action,
                'post_id': post_id
            },
            success: function(data){
                res = JSON.parse(data);

                if(action == 'like'){
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fa');
                }else if(action == 'unlike'){
                    $clicked_btn.removeClass('fa');
                    $clicked_btn.addClass('far');
                }

                // display number of like and dislike
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);

                // if user previously dislike this post, toggle back
                $clicked_btn.siblings('i.fa.fa-thumbs-down').removeClass('fa').addClass('far');

            }
        })
    });


    $('.dislike-btn').click(function(){
        var post_id = $(this).data('id');
        
        $clicked_btn = $(this);
        if($clicked_btn.hasClass('far')){
            action = 'dislike';
        }else if($clicked_btn.hasClass('fa')){
            action = 'undislike';
        }

        $.ajax({
            url: 'index.php',
            type: 'post',
            data:{
                'action': action,
                'post_id': post_id
            },
            success: function(data){
                res = JSON.parse(data);

                if(action == 'dislike'){
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fa');
                }else if(action == 'undislike'){
                    $clicked_btn.removeClass('fa');
                    $clicked_btn.addClass('far');
                }

                // display number of like and dislike
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);

                // if user previously like this post, toggle back
                $clicked_btn.siblings('i.fa.fa-thumbs-up').removeClass('fa').addClass('far');
            
            }
        })
    });

});