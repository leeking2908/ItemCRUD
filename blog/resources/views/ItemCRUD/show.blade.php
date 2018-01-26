@extends('layouts.default')
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Item</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('itemCRUD.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $item->title }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $item->description }}
        </div>
    </div>

    <div class="container">

        <div class="row">
            <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
            <script>
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
            </script>
            <hr>
            <!-- the comment box -->
            <div class="well">
                <h4><i class="fa fa-paper-plane-o"></i> Leave a Comment:</h4>
                <form action="{!! route('comment.post', [$item->id])!!}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" name="say" value="" class="btn btn-primary"><i class="fa fa-reply"></i> Submit</button>
                </form>
            </div>
            </script>
            <hr>
            <!-- the comments -->
            
            @foreach($comment as $key => $value)
            <p>{{$item->user->name}}</p>
            <p>{{$value->description}}</p>
            @endforeach
        </div>
    </div>

</div>
@endsection