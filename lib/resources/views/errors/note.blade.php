<style>
    .note-text{
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
        color: red;
    }
</style>
@if(Session::has('error'))
    <p class="note-text">{{Session::get('error')}}</p>
@endif

@if(Session::has('success'))
    <p><i class="fas fa-check"></i>{{Session::get('success')}}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
    <small class="form-text text-muted">{{ $error }}</small>
    @endforeach
@endif