<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th style="width: 11%;">{{ trans('form.first_name') }}</th>
            <th style="width: 12%;">{{ trans('form.last_name') }}</th>
            <th style="width: 30%;">{{ trans('form.email') }}</th>
            <th style="width: 18%;">{{ trans('form.phone') }}</th>
            <th style="width: 25%;">{{ trans('form.address') }}</th>
            <th style="width: 4%;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="user-row">
                <td class="first-name">{{ $user->first_name }}</td>
                <td class="last-name">{{ $user->last_name }}</td>
                <td>{{ $user->email }} <a href="mailto:{{ $user->email }}" title="{{ trans('user.send_mail') }}" class="pull-right text-large"><i class="far fa-envelope-open"></i></a></td>
                <td>{{ $user->phone }} <a href="tel:{{ $user->phone }}" title="{{ trans('user.call_phone') }}" class="pull-right text-large"><i class="fa fa-phone"></i></a></td>
                <td>{{ $user->address_street . ' ' . $user->address_city }} <a href="https://www.google.com/maps/search/{{ $user->address_street . ' ' . $user->address_city }}/" title="{{ trans('user.address_search') }}" target="_blank" class="pull-right text-large"><i class="far fa-map"></i></a></td>
                @if(Auth::user()->isAdmin() || Auth::user()->id == $user->id)
                    <td class="text-center"><a href="{{ route('user.update', $user->id) }}" title="{{ trans('user.edit') }}" class="btn btn-xs btn-2d"><i class="fa fa-pencil-alt"></i></a></td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>