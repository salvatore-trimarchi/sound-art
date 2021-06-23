<h2>TESTACODICE #2</h2>
{{-- ///////////////////////////////////////////// --}}



{{------------------------------------------------------------------
	DASHBOARD ADMIN

	si vede

		pulsante: 
			vedi/modifica tuo profilo > [ProfileController@show]
			crea profilo > [Admin/ProfileController@create]

		pulsante:
			fai la sponsorship > [sponsorship.blade.php]

		vedi i messaggi > [MessageController@index]

		vedi i review > [ReviewController@index]

		vedi le statistiche

	altre funzioni quali?

	DISPONIBILE IN PAGINA:
			$my_user 	= Auth::user();
			$my_profile = Auth::user()->profile;

------------------------------------------------------------------}}
@extends('layouts.dashboard')

@section('title','dashboard')


@section('content')

{{-- <h1>{{ Auth::user()->name }}'s Dashboard</h1> --}}


{{-- FEEDBACK MESSAGES --}}
<div class="d-flex justify-content-between align-items-center alert_box">	
	{{-- redirect with() [success] --}}
	@if (session()->has('status'))
	{{-- ALERT RICHIUDIBILE DI BOOTSTRAP DA PROVARE --}}
	{{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Holy guacamole!</strong> You should check in on some of those fields below.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> --}}
	<div class="alert alert-success col-md-4 offset-md-1">
		{{ session()->get('status') }}
	</div>
	@endif
	{{-- transaction result with() [success] --}}
	@if (session()->has('transaction_feedbak'))
		<div class="alert alert-success col-md-4 offset-md-1">
			{{ session()->get('transaction_feedbak') }}
		</div>
	@endif
	{{-- redirect withErrors() [errors] --}}
	@if(count($errors) > 0)
		<div class="alert alert-danger col-md-4 offset-md-1">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>



{{-- dati user autenticato --}}
{{-- ##### QUESTA PARTE DI CALCOLI È CAMBIATA >> SOSTITUIRE IL BLOCCO ##### --}}
@php
	date_default_timezone_set('Europe/Rome');
	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_any_contract = (!$my_contracts->isEmpty());
	$is_active_sponsorship = false;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
		}
	}
@endphp



<div class="row dashboard_home">
	<div class="{{-- col-md-4 offset-md-1 --}}">
		@if ($my_profile)
			{{-- EDIT --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your Profile</a>
			{{-- DELETE --}}
			<form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
			</form>
		@else
			{{-- CREATE --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		{{-- ##### PULSANTE PER FARE SPONSORSHIP (se non ne hai nessuna attiva) ##### --}}
		@if (!$is_active_sponsorship && $my_profile)
			{{-- SPONSOR YOUR PROFILE --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@endif

		{{-- ##### PULSANTE PER VEDERE I CONTRATTI PASSATI (se ce ne sono) ##### --}}
		@if ($is_any_contract)
			{{-- CHECK YOUR SPONSORSHIPS --}}
			<a class="btn btn-primary btn-block" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
		@endif
		
	</div>
</div>



@endsection






{{-- ///////////////////////////////////////////// --}}

{{-- 
@extends('layouts.dashboard')
@section('title','dashboard')
@section('content')

@php
	date_default_timezone_set('Europe/Rome');
	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_active_sponsorship = false;
	$is_any_contract = false;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
			$is_any_contract = true;
		}
	}
@endphp



@if (!$is_active_sponsorship)
<a class="btn btn-primary" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
@endif

@if ($is_any_contract)
<a class="btn btn-primary" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
@endif

@endsection --}}


{{-- ///////////////////////////////////////////// --}}
{{-- ///////// qua sopra scrivi in blade ///////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
////////// qua sotto scrivi in php //////////
/////////////////////////////////////////////



// date_default_timezone_set('Europe/Rome');

// $hours = 3;

// echo 'dateTime (tutte le funzioni php):';
// $date = new DateTime();
// @dump($date);

// echo 'da dateTime a created_at (per il db):';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);

// echo 'da created_at a dateTime (tutte le funzioni php):';
// $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
// @dump($date); 

// echo 'aggiungo 3 ore a dateTime:';
// // $date->add(new DateInterval("PT{$hours}H"));
// date_add($date, date_interval_create_from_date_string($hours.' hours'));
// @dump($date);

// echo 'e dopo ritorno a created_at:';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);




// use App\User;
// use App\Sponsorship;
// use App\Contract;

// $fraction_of_users_with_contract = 0.3;

// $users = User::all();
// foreach ($users as $user) $user_ids[] = $user->id;
// $number_of_contracts = round($fraction_of_users_with_contract*count($users));
		
// 		$sponsosrships = Sponsorship::all();
// 		foreach ($sponsosrships as $sponsosrship) $sponsosrship_ids[] = $sponsosrship->id;

// 		$sel_user_ids =[];
// 		while (count($sel_user_ids) < $number_of_contracts) {
// 			$sel_user_id = $user_ids[random_int(0,count($user_ids)-1)];
// 			if (!in_array($sel_user_id,$sel_user_ids)) $sel_user_ids[] = $sel_user_id;
// 		}
		
// 		for ($i=0; $i<$number_of_contracts; $i++) {

// 			$new_contract = new Contract;
// 			$new_contract['user_id'] = $sel_user_ids[$i];
// 			$new_contract['sponsorship_id'] = $sponsosrship_ids[random_int(0,count($sponsosrship_ids)-1)];

// 			$date = new DateTime();
// 			date_add($date, date_interval_create_from_date_string(($i).' minutes'));
// 			$date_start = date_format($date, 'Y-m-d H:i:s');
// 			date_add($date, date_interval_create_from_date_string((15+$i).' hours'));
// 			$date_end = date_format($date, 'Y-m-d H:i:s');
// 			$new_contract['date_start'] = $date_start;
// 			$new_contract['date_end'] 	= $date_end;
			
// 			$new_contract['transaction_status'] = 'submitted_for_settlement';

// 			// $new_contract->save(); // ! DB writing here ! 
// 			@dump($new_contract);
// 		}


/////////////////////////////////////////////


	// 	use App\Profile;

	// 	// DB starting source
	// 	$profiles = Profile::all();

	// 	// building $iper_profiles, array of $iper_profile 
	// 	foreach ($profiles as $profile) {

	// 		// starting properties 
	// 		$iper_profile = $profile->toArray(); // array, NOT laravel collection!

	// 		// adding name, surname >>> strings
	// 		$iper_profile['name'] 	 = $profile->user->name;
	// 		$iper_profile['surname'] = $profile->user->surname;

	// 		// warning: these are lravel collections!
	// 		$profile_categories = $profile->user->categories;
	// 		$profile_genres		= $profile->user->genres;
	// 		$profile_offers 	= $profile->user->offers;
	// 		// $profile_messages 	= $profile->user->messages;
	// 		$profile_reviews 	= $profile->user->reviews;
	// 		// $profile_contracts 	= $profile->user->contracts;
	// 		$profile_contracts 	= $profile->user->contracts;

	// 		// adding categories, genres, offers >>> array of strings
	// 		foreach ($profile_categories as $category)	$iper_profile['categories'][]	= $category->name;
	// 		foreach ($profile_genres as $genre)			$iper_profile['genres'][]		= $genre->name;
	// 		foreach ($profile_offers as $offer)			$iper_profile['offers'][] 		= $offer->name;

	// 		// adding messages >>> array of array of strings [NO!]
	// 		// foreach ($profile_messages as $message)		$iper_profile['messages'][]		= $message->toArray(); // array, NOT laravel collection!

	// 		// adding reviews >>> array of array of strings [NO!]
	// 		// adding average_vote, rev_count >>> strings
	// 		if ($profile_reviews->isNotEmpty()) {
	// 			$total_vote = 0;
	// 			foreach ($profile_reviews as $review) {
	// 				// $iper_profile['reviews'][] = $review->toArray(); // array, NOT laravel collection!
	// 				$total_vote += $review['rev_vote'];
	// 			}
	// 			$iper_profile['average_vote'] = $total_vote/count($profile_reviews); // ! voto obbligatorio per ogni review (testo facoltativo)
	// 		} else {
	// 			$iper_profile['average_vote'] = 0;
	// 		}
	// 		$iper_profile['rev_count'] = count($profile_reviews);

	// 		// sponsorship flags
	// 		date_default_timezone_set('Europe/Rome');
	// 		$is_active_sponsorship = false;
	// 		$active_contract_id = null;
	// 		foreach ($profile_contracts as $contract) {
	// 			$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_start);
	// 			$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_end);
	// 			$now 		= new DateTime();
	// 			if ($date_start < $now && $date_end >= $now) {
	// 				$is_active_sponsorship = true;
	// 				$active_contract_id = $contract->id;
	// 			}
	// 		}
	// 		$iper_profile['is_active_sponsorship'] = $is_active_sponsorship;
	// 		$iper_profile['active_contract_id'] = $active_contract_id;

	// 		// less transmitted properties
	// 		$unset_properties = [
	// 			'work_address','work_address_gps','phone',
	// 			'bio_text1','bio_text2','bio_text3','video_url','audio_url','public',
	// 			'created_at','updated_at'
	// 		];
	// 		foreach ($unset_properties as $unset_property) {
	// 			unset($iper_profile[$unset_property]);
	// 		}

	// 		// a new iper_profile is born!
	// 		$iper_profiles[] = $iper_profile;
	// 	}

	// 	// query parameters 1: user's filters from axios query url
	// 	$category 	= null;
	// 	$genre		= null;
	// 	$offer		= null;
	// 	$vote		= null;
	// 	$rev_count	= null;

	// 	// query parameters 2: only profiles with sponsorship in response
	// 	$only_sponsorship = false; // true / false

	// 	// building filter set (only not null values)
	// 	$filters = [];
	// 	// ! these keys must be equal to $iper_profile's keys!
	// 	if ($category)	$filters['categories']		= $category;
	// 	if ($genre)		$filters['genres']			= $genre;
	// 	if ($offer)		$filters['offers']			= $offer;
	// 	if ($vote)		$filters['average_vote']	= $vote;
	// 	if ($rev_count)	$filters['rev_count']		= $rev_count;

	// 	// filtering iteration on user's filter set 
	// 	$filtered_iper_profiles = $iper_profiles;
	// 	$tmp_iper_profiles = $filtered_iper_profiles;
	// 	foreach ($filters as $key => $value) {
	// 		$mode = is_numeric($value) ?  'greater' : 'contains';
	// 		$filtered_iper_profiles = getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
	// 		$tmp_iper_profiles = $filtered_iper_profiles;
	// 	}

	// 	// filtered iper profile array shuffle
	// 	shuffle($filtered_iper_profiles);

	// 	echo 'TUTTE selezionate dall\'utente';
	// 	@dump($filtered_iper_profiles);

	// 	// # SPLIT BY SPONSORSHIP # 

	// 	// ! after shuffle !

	// 	$spons_f_i_profiles = [];
	// 	$no_spons_f_i_profiles = [];
	// 	foreach ($filtered_iper_profiles as $f_i_profile) {
	// 		if ($f_i_profile['is_active_sponsorship'])
	// 			$spons_f_i_profiles[] = $f_i_profile;
	// 		else 
	// 			$no_spons_f_i_profiles[] = $f_i_profile;
	// 	}

	// 	echo 'gruppo sponsorship';
	// 	@dump($spons_f_i_profiles);

	// 	echo 'gruppo NO sponsorship';
	// 	@dump($no_spons_f_i_profiles);

	// 	echo 'la somma delle due';
	// 	@dump([...$spons_f_i_profiles, ...$no_spons_f_i_profiles]);	

	// 	// # FILTER 2: ONLY PROFILES WITH SPONSORSHIP # 

	// 	if ($only_sponsorship) { // ! home page
	// 		$filtered_iper_profiles = $spons_f_i_profiles;
	// 	} else { 				// ! no home page
	// 		$filtered_iper_profiles = [...$spons_f_i_profiles, ...$no_spons_f_i_profiles];
	// 	}

	// 	// @dump($only_sponsorship);
	// 	// echo 'finale con $only_sponsorship = '.$only_sponsorship;
	// 	// @dump($filtered_iper_profiles);

	// function getFilteredProfiles($_array,$_key,$_value,$_mode) {
	// 	$filtered_array = [];
	// 	foreach ($_array as $item) {
	// 		if (array_key_exists($_key,$item)) {
	// 			if ($_mode == 'contains') $condition = (in_array($_value,$item[$_key]));
	// 			if ($_mode == 'greater')  $condition = ($item[$_key] >= $_value);
	// 			if ($condition) $filtered_array[] = $item;
	// 		}
	// 	}
	// 	return $filtered_array;
	// }

/////////////////////////////////////////////














// date_default_timezone_set('Europe/Rome');

// $hours = 3;

// echo 'dateTime (tutte le funzioni php):';
// $date = new DateTime();
// @dump($date);

// echo 'da dateTime a created_at (per il db):';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);

// echo 'da created_at a dateTime (tutte le funzioni php):';
// $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
// @dump($date); 

// echo 'aggiungo 3 ore a dateTime:';
// // $date->add(new DateInterval("PT{$hours}H"));
// date_add($date, date_interval_create_from_date_string($hours.' hours'));
// @dump($date);

// echo 'e dopo ritorno a created_at:';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);




// $date->add(new DateInterval('P10D'));
// echo $date->format('Y-m-d') . "\n";







/////////////////////////////////////////////
/////////////////////////////////////////////
/////////////////////////////////////////////
@endphp


