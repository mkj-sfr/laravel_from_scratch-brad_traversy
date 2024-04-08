@extends('layout')
@section('content')
    <a href="/" class="inline-block text-black ml-4 mb-4"
    ><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
            <x-listing-card-single :listing="$listing"/>
    </div>
@endsection
