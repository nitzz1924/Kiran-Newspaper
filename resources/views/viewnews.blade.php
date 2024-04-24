<!-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||-->
@extends('layouts.guest')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-xl-2 col-lg-4" style="height: 800px; overflow-y: scroll;">
            <div class="card">
                <div class="accordion accordion-flush filter-accordion">
                    <div class="row">
                        @foreach ($newspaperdata as $value)
                        <div class="col-sm-12 col-xl-12">
                            <a href="#" class="text-decoration-none" data-url="{{ asset($value->papers) }}" id="urldynamic">
                                <div class="card border m-3">
                                    <img src="{{ asset($value->papers) }}" class="" alt="...">
                                    <div class="">
                                        <div class="text-muted text-center p-1">Page No. {{$value->sequence}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-10 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="text-muted fst-italic">Published on : {{ date('j F, Y', strtotime($data->date)) }}
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px" class="img-fluid"
                        id="mainimg">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).on('click', '#urldynamic', function() {
        var url = $(this).data('url');
        console.log(url);
        document.getElementById('mainimg').src = url;
    });
</script>
@endsection
