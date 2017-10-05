@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 style="margin-top: 0">My subscribed lists</h2>

                @if ($lists->isEmpty())
                    <b>Sowwy, it looks like you didn't subscribe to any list.</b>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Privacy</th>
                            <th>Users</th>
                            <th>Creation date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lists as $list)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="{{ route('list/show', ['uuid' => $list->uuid]) }}">{{ $list->name }}</a></td>
                                <td>{{ App\UserList::$listPrivacyTypes[$list->privacy] }}</td>
                                <td>{{ $list->accounts->count() }}</td>
                                <td>{{ Carbon\Carbon::parse($list->created_at)->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('list/unsubscribe', ['uuid' => $list->uuid]) }}" class="btn btn-xs btn-danger">Unsubscribe</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection