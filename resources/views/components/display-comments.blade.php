<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>

<div class="blogIndex card-header border border-light rounded">
    <strong><h3>Comments :</h3></strong>
        </div>
    <div class="collapse show" >
      <div class="card-body ">
          @foreach ($comments as $comment)
          <h4>{{$comment->commentaire}}</h4>
      <x-created  :date="$comment->created_at" :name="$comment->user->name" :userid="$comment->user->id" ></x-created>
          <hr>
          @endforeach
    </div>
    </div>