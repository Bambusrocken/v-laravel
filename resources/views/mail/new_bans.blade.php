@component('mail::message')
# Hello!

You are receiving this email because someone just got banned from list 〜 @escape_markdown($list->name)!

@component('mail::table')
| Avatar                          | Name                                                                                            | Game bans                           | VAC bans                           |
|:-------------------------------:| ----------------------------------------------------------------------------------------------- |:-----------------------------------:|:----------------------------------:|
@foreach ($accounts as $account)
| ![avatar]({{$account->avatar}}) | [@escape_markdown($account->name)](https://steamcommunity.com/profiles/{{ $account->steamid }}) | {{ $account->number_of_game_bans }} | {{ $account->number_of_vac_bans }}
@endforeach
@endcomponent
@endcomponent