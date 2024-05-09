{{-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। || --}}
<x-app-layout>
    <style>
        #canvas-container {
            position: relative;
        }

        #canvas {
            border: 2px solid black;
        }

        #crop-box {
            border: 2px dashed black;
            position: absolute;
            pointer-events: none;
        }

        img.custom-cropped-image {
            position: absolute;
            left: 28%;
        }
    </style>
    <style>
        #canvas-container {
            position: relative;
        }

        #canvas {
            border: 2px solid black;
        }

        #crop-box {
            border: 2px dashed rgba(0, 0, 0, 0.5);
            position: absolute;
            pointer-events: none;
        }
    </style>
    <link href="{{asset('assets/css/crop.css')}}" rel="stylesheet" />
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="text-muted fst-italic col-md-6">Published on :
                            {{ date('j F, Y', strtotime($data->date)) }}</div>
                        <div class="col-md-4">
                            <select id="pageSelect" class="form-select rounded" aria-label="Default select example">
                                @foreach ($newspaperdata as $value)
                                <option {{ $value->sequence == 1 ? 'selected' : '' }}
                                    value="{{ asset($value->papers) }}">Page {{ $value->sequence }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button id="startButton" class="btn btn-info">Cropping</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a class="open-modal l but lrg w3-button w3-green w3-margin">Open Image Cropper</a>
                    <div class="w3-modal cropper">
                        <div class="w3-modal-content">
                            <span class="w3-button w3-black w3-hover-red w3-display-topright w3-theme close-modal">&times;</span>
                            <h2 class="w3-black w3-center w3-padding"><strong>Image Cropper</strong></h2>
                            <div class="w3-container w3-white">
                                <p>Press the button below to upload and crop an image.</p>
                                <div id="ic-main" class="ibox">
                                    <div class="ic-btns clearfix">
                                        <div id="ic-upload-btn" class="l but lrg file-button w3-button w3-blue">
                                            <span id="ic-upload-btn-label" style="font-family: inherit;font-size: inherit;">Upload
                                                Image</span>
                                            <input class="file-input" type="file" value="{{$newspaperdata[0]->papers}}" />
                                        </div>
                                    </div>
                                    <div id="ic-cropper-wrap"></div>
                                    <div class="ic-hidden ic-crop-btn-wrap"><br />
                                        <div id="ic-rotate-btn" class="l but lrg w3-button w3-grey">
                                            <svg x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50"
                                                enable-background="new 0 0 50 50" xml:space="preserve">
                                                <path
                                                    d="M41.038,24.1l-7.152,9.342L26.734,24.1H31.4c-0.452-4.397-4.179-7.842-8.696-7.842c-4.82,0-8.742,3.922-8.742,8.742 s3.922,8.742,8.742,8.742c1.381,0,2.5,1.119,2.5,2.5s-1.119,2.5-2.5,2.5c-7.576,0-13.742-6.165-13.742-13.742 s6.166-13.742,13.742-13.742c7.274,0,13.23,5.686,13.697,12.842H41.038z" />
                                            </svg>
                                            Rotate
                                        </div>
                                        <div id="ic-flip-btn" class="l but lrg w3-button w3-grey">Flip</div> <a id="ic-crop-btn"
                                            class="l but lrg w3-button w3-grey">Crop</a>
                                    </div>
                                    <div id="ic-result-wrap" class="ic-hidden ic-result-wrap" style="margin-top: 20px;">
                                        <div class="result-container"
                                            style="position: relative;width: fit-content;block-size: fit-content;padding: 0px;z-index: 1;">
                                            <div class="theresult"
                                                style="position: relative;width: fit-content;block-size: block;padding: 0px;margin: 0px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ic-download-wrap" class="ic-hidden ic-download-wrap">
                                        <div class="select">
                                            <select class="w3-select" id="ic-download-type" style="width: 100px; display:inline-block;">
                                                <option value="image/jpeg">jpeg</option>
                                                <option value="image/png">png</option>
                                            </select> <a id="ic-download-btn" class="l but lrg w3-button w3-grey">Download</a>
                                        </div>
                                        <hr />
                                        Size: <span id="ic-info"></span>
                                    </div>
                                </div>
                                <br /><br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 h-50">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset($newspaperdata[0]->papers) }}" alt="" height="600px" class="img-fluid"id="mainimg">
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/crop.js')}}"></script>
    <script>
         $(document).on('change', '#pageSelect', function() {
            var imgurl = $(this).val();
            document.getElementById('mainimg').src = imgurl;
            $('#mainimg').data('url', imgurl);
        });
    </script>
</x-app-layout>
