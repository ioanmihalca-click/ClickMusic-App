@props(['url'])
<tr>
<td class="header" style="background-color: #ffffff";>
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Click Music')
<img src="https://clickmusic.ro/img/logo.png" class="logo" alt="Logo">
@else
<img src="https://clickmusic.ro/img/logo.png" class="logo" alt="Logo">
@endif
</a>
</td>
</tr>
