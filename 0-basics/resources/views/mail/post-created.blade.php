<!DOCTYPE html>
<html>

<head>
    <title>{{ $post->title }}</title>
</head>

<body>
    <h1>Hello, {{ $post->author->name }}!</h1>
    <p>Congratulations, your post is live now.!!</p>
    <a href="{{ url('/blogs/' . $post->id) }}">View Post Here</a>
    <p>{{ $post->content }}</p>
</body>

</html>
