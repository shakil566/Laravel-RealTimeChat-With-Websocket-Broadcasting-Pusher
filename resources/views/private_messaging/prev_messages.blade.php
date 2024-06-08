@if(!empty($messageInfo))
@foreach($messageInfo as $message)
@php

$datetime = Carbon\Carbon::parse($message->created_at);
$formattedDatetime = $datetime->format('n/j/Y, g:i:s A');
@endphp
@if(($message->sender_id == Auth::user()->id) && ($message->receiver_id == $receiverInfo->id))
<div class='message-right'>
    <span class='msg'>{{ $message->message }}</span>
    <br>
    <span class='msg-time'>{{ $formattedDatetime }}</span>
</div>
@elseif(($message->sender_id == $receiverInfo->id) && ($message->receiver_id == Auth::user()->id))
<div class='message-left'>
    <span class='msg'>{{ $message->message }}</span>
    <br><span class='msg-time'>{{ $formattedDatetime }}</span>
</div>
@endif
@endforeach
@endif