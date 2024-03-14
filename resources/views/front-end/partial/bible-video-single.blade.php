 <h1 class="text-white fw-bold fs-1">{{ $bibleStudy->$title }}</h1>
 <div class="text-white">
     {!! strip_tags($bibleStudy->$caption) !!}</p>
 </div>
 <img src="{{ $bibleStudy->photo }}" class="rounded" style="max-width: 100%;" />
