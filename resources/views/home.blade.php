@extends('layouts.app')

@section('content')
    <?php use \App\Http\Controllers\DateController ?> {{-- TODO: Yikes! --}}
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('home.dashboard') }}</h1>

            <div class="panel panel-2d">
                <div class="panel-heading">{{ trans('home.welcome_title', ['name' => $user->first_name ]) }}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="panel-heading  panel-heading-{{ $unanswered_panel['state'] }}">{{ trans('home.unanswered_heading') }}</div>
                            <div class="panel-element panel-element-background-icon panel-element-{{ $unanswered_panel['state'] }}">
                                <div class="panel-element-body">
                                    <div class="panel-element-main panel-element-main-number ">{{ $unanswered_panel['count']['total'] }}</div>
                                    @if(0 === $unanswered_panel['count']['total'])
                                        <p>{{ trans('home.unanswered_body_success') }}</p>
                                    @else
                                        <p>{{ trans('home.unanswered_body', $unanswered_panel['count']) }}</p>
                                        <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => ['birthday'], 'hideByStatus' => DateController::invertDateStatuses(['unanswered'])]) }}">{{ trans('home.to_unanswered') }}</a><br>
                                        <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => ['birthday'], 'hideByStatus' => DateController::invertDateStatuses(['unanswered', 'maybe-going'])]) }}">{{ trans('home.to_unanswered_maybe') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="panel-heading  panel-heading-{{ $next_gigs_panel['state'] }}">{{ trans('home.next_gigs_heading') }}</div>
                            <div class="panel-element panel-element-{{ $next_gigs_panel['state'] }}">
                                <div class="panel-element-body">
                                    <div class="panel-element-main panel-element-main-content ">{{ $next_gigs_panel['data'][0]->getStart()->diffForHumans() }}</div>
                                    {{ trans('home.next_gigs_body') }}
                                    <ul>
                                        @foreach($next_gigs_panel['data'] as $gig)
                                            <li><strong>{{ $gig->getStart()->formatLocalized('%a., %d. %b.') }}</strong>
                                                @if(false === $gig->isAllDay())
                                                    {{ trans('home.at_time') }} {{ $gig->getStart()->formatLocalized('%H:%M') }}
                                                @endif
                                                @if(true === $gig->hasPlace())
                                                    <a href="https://www.google.com/maps/search/{{ $gig->place }}/" style="padding:0;" title="{{ trans('date.address_search') }}" target="_blank">({{ str_shorten($gig->place, 10, '...') }})</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => DateController::invertDateTypes(['gig'])]) }}">{{ trans('home.to_gigs') }}</a>
                                </div>
                            </div>
                        </div><div class="clearfix visible-sm-block"></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="panel-heading  panel-heading-{{ $next_rehearsals_panel['state'] }}">{{ trans('home.next_rehearsals_heading') }}</div>
                            <div class="panel-element panel-element-{{ $next_rehearsals_panel['state'] }}">
                                <div class="panel-element-body">
                                    <div class="panel-element-main panel-element-main-content ">{{ $next_rehearsals_panel['data'][0]->getStart()->diffForHumans() }}</div>
                                    {{ trans('home.next_rehearsals_body') }}
                                    <ul>
                                        @foreach($next_rehearsals_panel['data'] as $rehearsal)
                                            <li><strong>{{ $rehearsal->getStart()->formatLocalized('%a., %d. %b.') }}</strong>
                                                @if(false === $rehearsal->isAllDay())
                                                    {{ trans('home.at_time') }} {{ $rehearsal->getStart()->formatLocalized('%H:%M') }}
                                                @endif
                                                @if(true === $rehearsal->hasPlace())
                                                    <a href="https://www.google.com/maps/search/{{ $rehearsal->place }}/" style="padding:0;" title="{{ trans('date.address_search') }}" target="_blank">({{ str_shorten($rehearsal->place, 10, '...') }})</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => DateController::invertDateTypes(['rehearsal'])]) }}">{{ trans('home.to_rehearsals') }}</a>
                                </div>
                            </div>
                        </div><div class="clearfix visible-md-block"></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="panel-heading  panel-heading-{{ $missed_rehearsals_panel['state'] }}">{{ trans('home.missed_rehearsals_heading') }}</div>
                            <div class="panel-element panel-element-{{ $missed_rehearsals_panel['state'] }}">
                                <div class="panel-element-main panel-element-body">
                                    <div class="panel-element-main panel-element-main-number ">{{ $missed_rehearsals_panel['count']['total'] }}</div>
                                    @if(0 === $missed_rehearsals_panel['count']['total'])
                                        <p>{{ trans('home.missed_rehearsals_body_success') }}</p>
                                    @else
                                        <p>{{ trans('home.missed_rehearsals_body', $missed_rehearsals_panel['count']) }}</p>
                                    @endif
                                    <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => DateController::invertDateTypes(['rehearsal'])]) }}">{{ trans('home.to_future_rehearsals') }}</a>
                                </div>
                            </div>
                        </div><div class="clearfix visible-lg-block"></div><div class="clearfix visible-sm-block"></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="panel-heading  panel-heading-{{ $next_birthdays_panel['state'] }}">{{ trans('home.next_birthdays_heading') }}</div>
                            <div class="panel-element panel-element-{{ $next_birthdays_panel['state'] }}">
                                <div class="panel-element-body">
                                    <div class="panel-element-main panel-element-main-number ">{{ $next_birthdays_panel['count'] }}</div>
                                {{ trans('home.upcoming_birthdays_body', ['count' => $next_birthdays_panel['count']])}}
                                    <ul>
                                    @foreach($next_birthdays_panel['data'] as $birthday)
                                        <li>{{ trans('home.birthday_name', ['name' => $birthday->getFirstName()]) }}
                                            <?php $diff = $today->diffInDays($birthday->getStart(), false) ?>
                                            @if($diff === 0)
                                                <strong>{{ trans('home.today') }}</strong>
                                            @elseif($diff === 1)
                                                <strong>{{ trans('home.tomorrow') }}</strong>
                                                @elseif($diff === -1)
                                                {{ trans('home.yesterday') }}
                                                @elseif($diff < 0)
                                                <em>{{ trans('home.past_in_days', ['days' => abs($diff)]) }}</em>
                                                @else
                                                {{ trans('home.future_in_days', ['days' => abs($diff)]) }}
                                            @endif
                                        </li>
                                    @endforeach
                                    </ul>
                                <a href="{{ route('date.index', ['view_type' => 'list', 'hideByType' => DateController::invertDateTypes(['birthday'])]) }}">{{ trans('home.to_birthdays') }}</a>
                                </div>
                            </div>
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
            // Override link functions for POST-links.
            $('a.btn-post').click(function (event) {
                event.preventDefault();

                // Request the url via post, include csrf-token and comment.
                $.post($(this).data('url'), {
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    // Success?
                    if (data.success) {
                        // Notify user.
                        $.notify(data.message, 'success');
                    } else {
                        // Warn user.
                        $.notify(data.message, 'danger');
                    }
                },
                'json');
            });
        });
    </script>
@endsection