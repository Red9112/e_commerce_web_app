
 
 <form class="commentForm"  method="POST" action="{{$action}}" >
    @csrf
    <div class="form-outline mx-1 p-1">
    <label  class="addComment form-label btn btn-secondary mx-2 fw-bold" for="{{$id}}">Add Comment:</label>
    @auth
    <div id="comment" style="display: none">
        <textarea name="commentaire" class="form-control" id="{{$id}}" rows="4"></textarea>
        <button type="submit" class="btn btn-success btn-rounded my-1">+</button>
        </div>
    @endauth
    </div>
    </form>
    @guest
    <div id="signToAddCom" class="mx-1 p-1" style="display: none">
    <a href="{{route('login')}}" class="btn btn-warning">Sign In </a><strong> to add comment !</strong>
    </div>
    @endguest
    