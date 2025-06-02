<form wire:submit="logout" action="#" method="post">
    @csrf
    <img src="{{url('backend/img/logout.png')}}" alt="" style="width: 23px; 23px;">
    <button type="submit" class="btn btn-info">Logout</button>
</form>