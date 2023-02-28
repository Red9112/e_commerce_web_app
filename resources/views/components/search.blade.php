<div class="col-lg-6 mb-2">
    <form class="d-flex" method="GET" action="{{ route($route) }}">
        <input class="form-control me-2" placeholder="search..."
            id="search" name="search" value="{{ request()->input('search') }}">
            {{$slot}}
        <button class="btn btn-outline-success" room="submit">Search</button>
    </form>
</div>
