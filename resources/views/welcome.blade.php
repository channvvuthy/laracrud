<form method="post" enctype="multipart/form-data" action="/upload">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="file" name="file">
    <input type="submit" value="submit">
</form>
