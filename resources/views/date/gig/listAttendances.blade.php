@extends('layouts.app')

@section('title'){{ trans('date.gig_listAttendances_title') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>{{ trans('date.gig_listAttendances_title') }}</h1>

            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-2d">
                        <div class="panel-heading">
                            &nbsp;
                        </div>

                        <div id="attendance-list" class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <td></td>

                                        @foreach($gigs as $gig)
                                            <td>{{ $gig->title }}
                                            <br>{{ $gig->start }}</td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($voices as $voice)
                                        <tr class="voice">
                                            <td>
                                                {{$voice->name}}
                                                <span class="pull-right">
                                                    <div class="btn btn-2d btn-toggle" data-voice="{{ $voice->name }}" data-status="hidden">
                                                        <i class="fa fa-caret-right"></i>
                                                    </div>
                                                </span>
                                            </td>
                                            @foreach($gigs as $gig)
                                                <td>{{ $gig->getAttendanceCount($voice) }}</td>
                                            @endforeach
                                        </tr>
                                        @foreach($voice->children as $sub_voice)
                                            <tr class="subvoice">
                                                <td>
                                                    {{$sub_voice->name}}
                                                    <span class="pull-right">
                                                        <div class="btn btn-2d btn-toggle super-voice-{{ $voice->name }}" data-voice="{{ str_replace(' ', '-', $sub_voice->name) }}" data-status="hidden">
                                                            <i class="fa fa-caret-right"></i>
                                                        </div>
                                                    </span>
                                                </td>
                                                @foreach($gigs as $gig)
                                                    <td>{{ $gig->getAttendanceCount($sub_voice) }}</td>
                                                @endforeach
                                            </tr>
                                            @foreach($sub_voice->users as $user)
                                                <tr class="user voice-{{ $voice->name }} voice-{{ str_replace(' ', '-', $sub_voice->name) }}">
                                                    <td>{{ $user->abbreviated_name }}</td>
                                                    @foreach($gigs as $gig)
                                                        @if($gig->isAttending($user) == 'yes')
                                                            <td class="attending">
                                                                <i class="fa fa-check"></i>
                                                            </td>
                                                        @elseif($gig->isAttending($user) == 'maybe')
                                                            <td class="maybe-attending">
                                                                <i class="fa fa-question"></i>
                                                            </td>
                                                        @elseif($gig->isAttending($user) == 'no')
                                                            <td class="not-attending">
                                                                <i class="fa fa-times"></i>
                                                            </td>
                                                            @else
                                                            <td class="unanswered">
                                                                <i class="fa fa-minus"></i>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-toggle").click(function () {
                var voice = $(this).data('voice');

                //TODO: Make this more beautiful.
                if ($(this).data("status") === "hidden") {
                    $(".voice-" + voice).show();
                    $(this).data("status", "display").find("i").removeClass("fa-caret-right").addClass("fa-caret-down");
                    $(".super-voice-" + voice).data("status", "display").find("i").removeClass("fa-caret-right").addClass("fa-caret-down");
                } else {
                    $(".voice-" + voice).hide();
                    $(this).data("status", "hidden").find("i").removeClass("fa-caret-down").addClass("fa-caret-right");
                    $(".super-voice-" + voice).data("status", "hidden").find("i").removeClass("fa-caret-down").addClass("fa-caret-right");
                }
            });
        });
    </script>
@endsection