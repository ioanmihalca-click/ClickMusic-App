@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Click Music')
<img src="https://clickmusic.ro/img/logo-mail.webp" class="logo" alt="Logo">
@else
<img src="https://clickmusic.ro/img/logo-mail.webp" class="logo" alt="Logo">
@endif
</a>
</td>
</tr>
