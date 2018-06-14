@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user])
        </aside>
        
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">TimeLine <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id, 'microposts' => $microposts])}}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id, 'microposts' => $microposts]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('tasks/*/favoritings') ? 'active' : '' }}"><a href="{{ route('users.favoritings', ['id' => $user->id, 'microposts' => $microposts]) }}">Fovorites <span class="badge">{{ $count_favoritings }}</span></a></li>
            </ul>
            @if (Auth::user()->id == $user->id)
                  {!! Form::open(['route' => 'microposts.store']) !!}
                      <div class="form-group">
                          <label class="col-xs-6 control-label">Your Tweet</label>
                          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => "What's happening?", 'rows' => '2']) !!}
                          <br>{!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                      </div>
                  {!! Form::close() !!}
            @endif
            @if (count($microposts) > 0)
                @include('microposts.microposts', ['microposts' => $microposts])
            @endif
        </div>
    </div>
@endsection