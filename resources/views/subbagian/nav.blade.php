<li><a href="{{ route('modul.index') }}"><i class="fa fa-home"></i> Modul</a></li>
<li><a href="{{ route('bagian.index', $modul->id) }}">Bagian</a></li>
<li><a href="{{ route('subbagian.index', $bagian->id) }}">Sub Bagian</a></li>