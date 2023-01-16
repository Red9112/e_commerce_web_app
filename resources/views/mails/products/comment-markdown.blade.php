@component('mail::message')

# Mail with mardown method

Your product: **[{{$comment->commentable->name}}]({{route('product.show',['product'=>$comment->commentable->id])}})** was commented,

By: **[{{$comment->user->name}}]({{route('user.show',['user'=>$comment->user->id])}})**.

said:

@component('mail::panel')
{{$comment->commentaire}}
@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

