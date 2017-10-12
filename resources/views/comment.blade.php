@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="{{ url('comment' , ['id' => $content->id]) }}"><h2>{{ $content->content }}</h2></a></div>
                        <div class="panel-body">
                            {{--<p>{{ $content->content }}</p >--}}
                            <div class="content_box">
                                <ul>
                                    <li>
                                        @foreach($comments as $comment)
                                            <p>
                                                <a href="#">{{ $comment->user }}</a> : {{ $comment->neirong }}
                                                @if(Auth::check() && Auth::user()->name == 'admin')
                                                    -- <sub><a href="{{ url('delete_yanlun' , ['id' => $comment->id]) }}" style="color: red;font-size: 14px;">删除</a></sub>
                                                @endif
                                            </p>
                                        @endforeach

                                    </li>
                                </ul>
                            </div>
                            <div class="n_reply">
                                作者：<a href="#" title="主题作者" target="_blank" class="post_author">{{ $content->user }}</a>
                                <p class="time">发起时间：{{ $content->created_at }}</p>
                                <form action="{{ url('reply',['id' => $content->id])}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" name="comment">
                                    <input type="submit" value="评论">
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
