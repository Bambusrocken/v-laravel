@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <h2 style="margin-top: 0">Showing list 〜 {{ $list->name }}</h2>
            </div>
            @auth
                <div class="pull-right">
                    @if ($list->user_id == Auth::user()->id)
                        <a href="{{ route('list/add', ['uuid' => $list->uuid]) }}" class="btn btn-default">Add account</a>
                    @else
                        @if (!Auth::User()->subscriptions()->get()->contains('user_list_id', $list->id))
                            <a href="{{ route('list/subscribe', ['uuid' => $list->uuid]) }}" class="btn btn-success">Subscribe</a>
                        @else
                            <a href="{{ route('list/unsubscribe', ['uuid' => $list->uuid]) }}" class="btn btn-danger">Unsubscribe</a>
                        @endif
                    @endif
                </div>
                <div class="clearfix"></div>
            @endauth

            @if ($accounts->isEmpty())
                <b>Sowwy, it looks like this list is empty.</b>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Game bans</th>
                        <th>VAC bans</th>
                        <th>Last ban date</th>
                        @if (Auth::check() && $list->user_id == Auth::user()->id)
                            <th>Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <th style="vertical-align: middle" scope="row">{{ $loop->iteration }}</th>
                            <td style="vertical-align: middle"><img src="{{ $account->avatar }}" /></td>
                            <td style="vertical-align: middle"><a href="https://steamcommunity.com/profiles/{{ $account->steamid }}">{{ $account->name }}</a></td>
                            <td style="vertical-align: middle">{{ $account->number_of_game_bans }}</td>
                            <td style="vertical-align: middle">{{ $account->number_of_vac_bans }}</td>
                            <td style="vertical-align: middle">{{ $account->number_of_vac_bans > 0 || $account->number_of_game_bans > 0 ? $account->last_ban_date : '—' }}</td>
                            @if (Auth::check() && $list->user_id == Auth::user()->id)
                                <td style="vertical-align: middle">
                                    <a href="{{ route('list/delete/account', ['uuid' => $list->uuid, 'steamid' => $account->steamid]) }}" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $accounts->links() }}
            @endif
        </div>
    </div>
</div>
@endsection