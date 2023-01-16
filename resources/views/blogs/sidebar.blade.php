{{--cardcomponent  --}}
@auth
<x-card 
:collection="collect($mostBlogsCreators)" 
header="Most Active Users">
</x-card>
<x-card 
:collection="collect($mostActiveUsersThisMonth)" 
header="Most active users this month :">
</x-card>
<x-card 
:collection="collect($mostCommentedBlogs)" 
header="Most commented blogs :">
</x-card>
<x-card  
header="slot">
In case of available slot
</x-card>
@endauth
@guest
<x-card
style="color: brown"  
header="slot">
Data available just for users
</x-card>  
@endguest



