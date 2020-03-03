<form method="post" action="{{route('verification.email.send')}}">
    @csrf
    <button type="submit">Coba</button>
</form>