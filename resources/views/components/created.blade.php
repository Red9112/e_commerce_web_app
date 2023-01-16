<p>{{empty(trim($slot)) ? 'created_at:':$slot }}
<strong> {{$date}}
{!!isset($name)?', By : <a class="text-decoration-none" href="'.route('user.show', ['user' => $userid]).'">'.$name.'</a>':null!!} 
</strong>
</p>

     