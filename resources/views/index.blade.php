<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Tags System Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>
</head>
<body class="">
    <div class="container">
        <h1>Add post</h1>

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif

        <form action="{{ url('create-post') }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-3">
                <input type="text" class="form-control" name="title_name" placeholder="Enter title">
                @if ($errors->has('title_name'))
                <span class="text-danger">{{ $errors->first('<title></title>') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="content" placeholder="Enter content"></textarea>
                @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <input class="form-control" type="text" data-role="tagsinput" name="tags">
                @if ($errors->has('tags'))
                <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
            </div>

            <div class="d-grid">
                <button class="btn btn-info btn-submit">Submit</button>
            </div>
        </form>

        <div class="alert alert-primary mt-5 text-center">
            Post Collection
        </div>

        @if($posts->count())
        @foreach($posts as $key => $post)
        <h3>{{ $post->title_name }}</h3>
        <p>{{ $post->content }}</p>
        <div>
            <strong>Tag:</strong>
            @foreach($post->tags as $tag)
            <label class="label label-info">{{ $tag->name }}</label>
            @endforeach
        </div>
        @endforeach
        @endif
        @php
$string = '#deutschland <div align="center"> #auto <img width="100%" src="/assets/contentimages/navy%20action%20game.jpg" alt="" /> #Flug </div> 
Naval Action is a hardcore, realistic, and #beautifully detailed naval combat sandbox immersing players into the experience of the most beautiful period of naval history - when #sailing ships ruled the seas.   ';

function get_hashtags($string, $str = 1) {
    preg_match_all('/#(\w+)/',$string,$matches);
    isset($keywords) ? $keywords :$keywords='';
    $i = 0;
    if ($str) {
        foreach ($matches[1] as $match) {
            $count = count($matches[1]);
            $keywords .= "$match";
            $i++;
            if ($count > $i) $keywords .= ", ";
        }
    } else {
        foreach ($matches[1] as $match) {
            $keyword[] = $match;
        }
        $keywords = $keyword;
    }
    return $keywords;
}
echo get_hashtags($string);
        @endphp
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</body>
</html>