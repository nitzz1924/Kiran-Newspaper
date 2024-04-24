<!-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||-->
@extends('layouts.guest')
@section('main-content')
<section class="page-section bg-white mt-5" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Lastest News</h2>
            <h3 class="section-subheading text-muted">Your Source for Trusted News</h3>
        </div>
        <div class="row">
            @foreach ($data as $value)
            <div class="col-sm-6 col-xl-3">
                <a href="/viewnews/{{ $value->id }}" class="text-decoration-none">
                    <div class="card">
                        <div
                            style="background: url('{{ asset($value->coverimage) }}'); height: 250px; background-position: top; background-repeat: no-repeat; background-size: cover;">
                        </div>
                        {{-- <img class="card-img-top img-fluid " src="{{ asset($value->coverimage) }}"
                            alt="newspaper image"> --}}
                        <div class="card-body">
                            <div class="mb-2  text-muted text-center">E Newspaper {{$value->date}}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
