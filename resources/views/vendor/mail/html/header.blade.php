@props(['url'])
<tr>
<td class="header">
<a href="https://clickmusic.ro/" style="display: inline-block;">
@if (trim($slot) === 'Click Music')
<img src="" class="logo" alt="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
