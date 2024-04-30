<!-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||-->
<x-guest-layout>
    <div class="container mt-3">
        <style>
            .image-container {
                width: 100%;
                overflow: hidden;
            }

            .zoomable-image {
                width: 100%;
                transition: transform 0.2s ease;
                cursor: zoom-in;
            }

            .zoomed-in {
                transform: scale(2);
                cursor: zoom-out;
            }
        </style>
        <style>
            .social {
                width: 100%;
                max-width: 960px;
                margin: 0 auto;
                text-align: center;
            }

            .social a {
                color: transparent;
            }

            ul.no-list {
                padding-left: 0;
            }

            ul.no-list li {
                display: inline-block;
                list-style: none;
            }

            .social i {
                color: #fff;
                font-size: 18px;
            }

            .social li {
                width: 40px;
                height: 40px;
                margin: 0 5px 0;
                line-height: 40px;
                text-align: center;
                border-radius: 0%;
                transition: background 0.3s linear;
            }

            .social .facebook {
                background: #3b5998;
            }

            .social .twitter {
                background: #00aced;
            }

            .social .pinterest {
                background: #cb2027;
            }

            .social .google-plus {
                background: #dd4b39;
            }

            .social .instagram {
                background: #e4405f;
            }

            .social .tumblr {
                background: #30cf00;
            }

            .social .youtube {
                background: #cd201f;
            }

            .social .envelope {
                background: #ff8c00;
            }

            .social .envelope1 {
                background: #575757;
            }

            .social li:hover {
                background: #fff;
            }

            .social .facebook:hover i {
                color: #3b5998;
            }

            .social .twitter:hover i {
                color: #00aced;
            }

            .social .pinterest:hover i {
                color: #cb2027;
            }

            .social .google-plus:hover i {
                color: #dd4b39;
            }

            .social .instagram:hover i {
                color: #e4405f;
            }

            .social .tumblr:hover i {
                color: #30cf00;
            }

            .social .youtube:hover i {
                color: #cd201f;
            }

            .social .envelope:hover i {
                color: #ff8c00;
            }

            .social .envelope1:hover i {
                color: #747373;
            }

            @media (max-width: 520px) {
                #newsthumb {
                    display: none;
                }

                .customsocial {
                    margin-top: 30px;
                }
            }

            .fixed-call-button {
                position: fixed;
                bottom: 20px;
                left: 20px;
                z-index: 1000;
            }

            .fixed-call-button .btn {
                font-size: 16px;
                padding: 10px 20px;
                border-radius: 30px;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <div class="row g-2 d-flex align-items-center">
                    <div class="col-6 col-md-2">
                        <select id="pageSelect" class="form-select rounded" aria-label="Default select example">
                            @foreach ($newspaperdata as $value)
                            <option {{ $value->sequence == 1 ? 'selected' : '' }} value="{{ asset($value->papers)
                                }}">Page {{$value->sequence}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-sm-auto col-6 col-md-2">
                        <div>
                            <?php
                                $urlDate = $data->date ?? null;
                                if ($urlDate) {
                                    $formattedDate = date('Y-m-d', strtotime($urlDate));
                                } else {
                                    $formattedDate = date('Y-m-d');
                                }
                                ?>
                            <input type="date" class="form-control rounded" id="newsdate" value="<?= $formattedDate ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-0 p-3">
            <div class="social">
                <ul class="no-list">
                    <a href="https://www.facebook.com/Tungakiranakannadanewspaper?mibextid=ZbWKWL/viewnews/{{$data->id}}/{{$formattedDate}}"
                        target="_blank">
                        <li class="facebook"><i class="bi bi-facebook"></i></li>
                    </a>
                    <a href="https://telegram.me/share/url?url=https://epaper.thungakiran.in/viewnews/{{$data->id}}/{{$formattedDate}}&text=Your%20message%20here&to=+919986873183" target="_blank">
                        <li class="twitter"><i class="bi bi-telegram"></i></li>
                    </a>
                    <a href="https://api.whatsapp.com/send?text=Your%20message%20here%20https://epaper.thungakiran.in/viewnews/{{$data->id}}/{{$formattedDate}}&phone=+919986873183"  target="_blank" class="">
                        <li class="tumblr"><i class="bi bi-whatsapp"></i></li>
                    </a>
                    <a href="#"  target="_blank" class="">
                        <li class="youtube"><i class="bi bi-youtube"></i></li>
                    </a>
                    <button onclick="printDiv()">
                        <li class="envelope1"><i class="bi bi-printer"></i></li>
                    </button>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-2 col-lg-4" style="height: 800px; overflow-y: scroll;" id="newsthumb">
                <div class="card">
                    <div class="accordion accordion-flush filter-accordion">
                        <div class="row" id="sideimages-container">
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
                        <div class="text-muted fst-italic" id="published-date">Published on : {{ date('j-M-Y',
                            strtotime($data->date)) }}
                        </div>
                    </div>
                    <div class="card-body image-container" id="printableDiv">
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
                    <div class="image-container overflow-auto">
                        <img src="{{asset($newspaperdata[0]->papers)}}" alt=""
                            class="img-responsive center-block zoomable-image" id="firstimg">
                    </div>
                    {{-- <div class="image-container-zoom">
                        <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px"
                            class="img-responsive center-block" id="secimg">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-call-button">
        <a href="tel:+919986873183" class="btn btn-primary"><i class="bi bi-telephone-fill"></i> Call Us</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function printDiv() {
            var printableArea = document.getElementById('printableDiv').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printableArea;

            window.print();

            document.body.innerHTML = originalContents;
        }

    </script>
    <script>
        $(document).on('change', '#newsdate', function() {
            var selectedDate = $(this).val();
            console.log(selectedDate);
            $.ajax({
                type: 'GET'
                , url: '/daterecords/' + selectedDate
                , success: function(response) {
                    console.log(response[0].id);
                    var baseUrl = window.location.protocol + "//" + window.location.hostname;
                    if (window.location.port) {
                        baseUrl += ":" + window.location.port;
                    }
                    window.location.href = baseUrl + '/viewnews/' + response[0].id + '/' + selectedDate;
                    console.log(baseUrl);
                }
            });
        });

    </script>
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
            console.log("urla", urla);
            document.getElementById('firstimg').src = urla;
            document.getElementById('secimg').src = urla;
        });
        $(document).on('change', '#pageSelect', function() {
            var imgurl = $(this).val();
            console.log(imgurl);
            document.getElementById('mainimg').src = imgurl;
            $('#mainimg').data('url', imgurl);
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const zoomableImage = document.getElementById('firstimg');

        zoomableImage.addEventListener('dblclick', function (e) {
            e.preventDefault();
            this.classList.toggle('zoomed-in');
        });
    });
    </script>

</x-guest-layout>
