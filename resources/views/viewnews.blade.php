<!-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||-->
<x-guest-layout>
    <div class="container mt-3">
        <style>
            // style zoom trigger

            .zoom-trigger {
                cursor: pointer;
            }

            // hide zoomed image

            .image-container-zoom {
                display: none;

                .zoomed & {
                    display: block;
                }
            }

            .zoomed .image-container {
                display: none;
            }

            // .modal-xl

            @media (min-width: 992px) {
                .modal-xl {
                    width: 900px;
                }
            }

            @media (min-width: 1200px) {
                .modal-xl {
                    width: 1170px;
                }
            }

            // animate width

            .modal.fade .modal-dialog {
                transition: all .3s ease-out;
            }

            // misc

            body {
                margin: 20px 0;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <div class="row g-2 d-flex align-items-center">
                    <div class="col-lg-auto">
                        <select id="pageSelect" class="form-select rounded-pill" aria-label="Default select example">
                            @foreach ($newspaperdata as $value)
                            <option {{ $value->sequence == 1 ? 'selected' : '' }} value="{{ asset($value->papers)
                                }}">Page {{$value->sequence}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto ms-sm-auto">
                        <div>
                            <?php
                                $urlDate = $data->date ?? null;
                                if ($urlDate) {
                                    $formattedDate = date('Y-m-d', strtotime($urlDate));
                                } else {
                                    $formattedDate = date('Y-m-d');
                                }
                                ?>
                            <input type="date" class="form-control rounded-pill" id="exampleInputdate"
                                value="<?= $formattedDate ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-2 col-lg-4" style="height: 800px; overflow-y: scroll;">
                <div class="card">
                    <div class="accordion accordion-flush filter-accordion">
                        <div class="row">
                            @foreach ($newspaperdata as $value)
                            <div class="col-sm-12 col-xl-12">
                                <a href="#" class="text-decoration-none" data-url="{{ asset($value->papers) }}"
                                    id="urldynamic">
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
                        <div class="text-muted fst-italic">Published on : {{ date('j-M-Y', strtotime($data->date)) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                            <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px" class="img-fluid"
                                id="mainimg" data-url="{{ asset($newspaperdata[0]->papers) }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="image-container">
                        <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px"
                            class="img-responsive center-block zoom-trigger" id="firstimg">
                    </div>
                    <div class="image-container-zoom">
                        <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px"
                            class="img-responsive center-block zoom-trigger" id="secimg">
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
        $('#mainimg').attr('src', url);
        $('#mainimg').data('url', url);
        // document.getElementById('firstimg').src = url;
        // document.getElementById('secimg').src = url;
    });
        $(document).on('click', '#mainimg', function() {
        var urla = $(this).data('url');
        console.log("urla",urla);
        document.getElementById('firstimg').src = urla;
        document.getElementById('secimg').src = urla;
    });
    $(document).on('change', '#pageSelect', function() {
       var imgurl =  $(this).val();
        console.log(imgurl);
        document.getElementById('mainimg').src = imgurl;
        $('#mainimg').data('url', imgurl);
    });
    </script>
    <script>
        $('.zoom-trigger').click(function() {
        $('#myModal .modal-dialog').toggleClass('modal-xl');
        $('#myModal .modal-body').toggleClass('zoomed');
        });

        // revert modal class on close
        $('#myModal').on('hidden.bs.modal', function (e) {
        $(this).find('.modal-dialog').removeClass('modal-xl');
        $(this).find('.modal-body').removeClass('zoomed');
        })
    </script>
</x-guest-layout>
