<div class="form-group">
    <label for="title"> Your Title</label>
<input class="form-control" name="title" id="title" type="text" value="{{old('title',$post->title ?? null)}}">
</div>
<div class="form-group">
    <label for="content">Your Content</label>
    <input class="form-control" name="content" id="content" type="text" value="{{old('content',$post->content ?? null)}}">
</div>
<div class="form-group">
    <label for="active">Your Active</label>
    @if(!empty($post) )
    @if($post->active===1)
    <input class="form-control" name="active" id="active" type="text" value="{{old('active','true')}}">
    @else
    <input class="form-control" name="active" id="active" type="text" value="{{old('active','false')}}">
    @endif
    @endif
    @if(empty($post))
    <input class="form-control" name="active" id="active" type="text" value="{{old('active')}}">
    @endif
</div>

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li>
        {{$error}}
    </li>
    @endforeach
</ul>
@endif
