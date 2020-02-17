// import { url } from "inspector";


var postId = 0;

$('.like').on('click' , function(event) {
   event.preventDefault();
   console.log(event);
    // postId = event.target.parentNode.dataset['id'];
    postId = event.target.dataset.id;
    // console.log(postId);
    var islike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url :'http://127.0.0.1:8000/like',
        data : {islike: islike, postId: postId, _token: token}
    })
    .done(function () {
        console.log('sent');
        event.target.innerText = islike ? event.target.innerText == 'like' ? 'you like this post' : 'like' : event.target.innerText == 'dislike' ? 'you dislike this post' : 'dislike'
        if(islike){
            event.target.nextElementSibling.innerText = 'dislike';
        }
        else {
            event.target.previousElementSibling.innerText = 'like';
        }
    })
    .fail(function (){
        console.log('failed');
    })
})
