@props(['url'])
<tr>
<td class="header">
<a href="https://clickmusic.ro/" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://clickmusic.ro/img/logo.png" class="logo" alt="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
