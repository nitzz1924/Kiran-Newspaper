{{-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। || --}}
<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">THUNGA KIRAN</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                            <li class="breadcrumb-item active">All Newspapers</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($data as $value)
            <div class="col-sm-6 col-xl-3">
                    <div class="card">
                    @if ($value->papers)
                        @php
                            $imagePaths = explode(',', $value->papers);
                        @endphp
                        @if(count($imagePaths) > 0)
                            <img class="card-img-top img-fluid" src="{{ asset($imagePaths[0]) }}" alt="newspaper image">
                        @endif
                    @endif
                    <div class="card-body">
                        <h4 class="card-title mb-2 text-center">{{$value->date}}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</x-app-layout>
