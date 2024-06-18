@props(['url'])
<tr>
<td class="header";>
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Click Music')
<img src="https://clickmusic.ro/img/logo.png" class="logo" alt="">
@else
<img src="https://clickmusic.ro/img/logo.png" class="logo" alt="">
@endif
</a>
</td>
</tr>
