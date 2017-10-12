@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="input_box">
            <form action="{{ url('launch') }}" method="post">
                <input type="text" name="discuss" autofocus>
                <input type="submit" value="发起讨论">
                {{ csrf_field() }}
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($contents as $content)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('comment' , ['id' => $content->id]) }}"><h2>{{ $content->content }}</h2></a>
                        @if(Auth::check() && Auth::user()->name == 'admin')
                            <a href="{{ url('delect' , ['id' => $content->id]) }}" style="float: right;color: red;">删除</a>
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="n_reply">
                            作者：<a href="#" title="主题作者" target="_blank" class="post_author">{{ $content->user }}</a>
                            <p class="time">发起时间：{{ $content->created_at }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="pull-right">
                {{--{{ $content->render() }}--}}
            </div>

        </div>
    </div>
</div>
@endsection
