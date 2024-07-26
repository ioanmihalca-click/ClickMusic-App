@component('mail::message')
# Mulțumim pentru comandă!

Ai cumpărat albumul **{{ $comanda->album->titlu }}**.

Pentru a descărca albumul, te rugăm să folosești butonul de mai jos:

@component('mail::button', ['url' => $comanda->download_link])
Descarcă Albumul
@endcomponent

**Atenție: Linkul este valabil doar 24 de ore!**

Va mulțumim pentru susținere!

Cu respect,
Click

@component('mail::subcopy')
Dacă aveți probleme cu butonul de mai sus, copiați și lipiți următorul URL în browser-ul dumneavoastră: {{ $comanda->download_link }}
@endcomponent

@endcomponent