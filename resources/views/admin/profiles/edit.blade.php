{{------------------------------------------------------------------
	EDIT PROFILE ADMIN

	vedo tutti i dettagli in form autocompilato

	
	
------------------------------------------------------------------}}
<h2>MODEL: Profile, CRUD: edit, AREA: admin - FORM COMPIALTO EDIT PROFILO - SOLO SE STESSO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/profiles/{slug}/edit (get)</p>
<h5>SINGOLO PROFILO PASSATO</h5>
<p>profile->id = @php echo $profile->id @endphp</p>
<p>profile->slug = @php echo $profile->slug @endphp</p>
<p>dump($profile) = @dump($profile)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>