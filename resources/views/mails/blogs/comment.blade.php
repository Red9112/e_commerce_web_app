<p>
    a comment was posted for your Blog : 
<h3>
<a href="{{route('blog.show',['blog'=>$comment->commentable->id])}}">{{$comment->commentable->title}}</a>
</h3>
</p>
<p>
    By the user : 
<h3>
<a href="{{route('user.show',['user'=>$comment->user->id])}}">{{$comment->user->name}}</a>
</h3>
</p>
<p>
    said:
    <h5>{{$comment->commentaire}}</h5>
</p>
