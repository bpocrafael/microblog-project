@if ($searchResult instanceof App\Models\User)
    <x-user-component :user="$searchResult" />
@else
    <div class="container mt-5">
        <x-post-component :post=$searchResult :user="$authUser" />
    </div>
@endif
