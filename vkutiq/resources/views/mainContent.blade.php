@extends('home')

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainContainer">
    <div class="row mainContent">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 mainVideoContainer">
            <div class="mainContainerTitle">ИЗБОР НА РЕДАКТОРА</div>
            <div class="row">
                <div class="mainVideosContainer col-lg-2 col-md-2 col-sm-2 col-xs-12">
                @for ( $currVideo = 0 ; $currVideo < 4 ; $currVideo++ )
                    @if(!isset($mainVideos[$currVideo]))
                    <div class="mainVideos missingVideo">No content</div></a>
                    @else
                    <a href="/{{$mainVideos[$currVideo]->storage_id}}">
                        <div class="mainVideos">
                            {{$mainVideos[$currVideo]->name}}
                        </div>
                    </a>
                    @endif
                @endfor
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2">
                </div>

                <div class="mainVideo col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    @if(!empty($mainVideos))
                    <p class="mainVideoTitle">{{$mainVideos[0]->name}}</p>
                    <video width="640" height="400" controls>
                        <source src="/storage/videos/{{$mainVideos[0]->storage_id}}.mp4" type="video/mp4">
                        <source src="/storage/videos/{{$mainVideos[0]->storage_id}}.ogg" type="video/ogg">
                    </video>
                    @else
                    <p class="mainVideoTitle">No content</p>
                    <video width="640" height="400" class="missingVideo" controls>
                        <source src="" type="video/mp4">
                        <source src="" type="video/ogg">
                    </video>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 exclusiveVideoContainer">
            <div class="row">
            <div class="exclusiveContainerTitle">ТРЕНД ВИДЕА</div>
            @for ( $currVideo = 0 ; $currVideo < 2 ; $currVideo++ )
                @if(isset($trendingVideos[$currVideo]))
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 exclusiveVideoBox">
                    <video width="320" height="200" class="exclusiveVideo" controls>
                        <source src="/storage/videos/{{$trendingVideos[$currVideo]->storage_id}}.mp4" type="video/mp4">
                        <source src="/storage/videos/{{$trendingVideos[$currVideo]->storage_id}}.ogg" type="video/ogg">
                    </video>
                </div>
                @else
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 exclusiveVideoBox">
                    <video width="320" height="200" class="exclusiveVideo missingVideo" controls>
                            <source src="" type="video/mp4">
                            <source src="" type="video/ogg">
                    </video>
                </div>
                @endif
            @endfor
        </div>
        </div>
    </div>
</div>
@endsection