{{-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। || --}}
<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">
    <style>
        #preview {
            width: 100%;
            max-width: 400px;
            height: auto;
        }
    </style>
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="text-muted fst-italic col-md-6">Published on :
                            {{ date('j F, Y', strtotime($data->date)) }}</div>
                        <div class="col-md-4">
                            <select id="pageSelect" class="form-select rounded " aria-label="Default select example">
                                <option value="0">Select Image</option>
                                @foreach ($newspaperdata as $value)
                                    <option data-id="{{ $value->id }}" value="{{ asset($value->papers) }}">Page
                                        {{ $value->sequence }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button id="getCroppedImage" class="btn btn-info btn-sm">Get Cropped Image</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <img id="preview" src="" alt="Selected Image to Crop">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <form id="mappingform">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-start">All Mappings</h4>
                            <button type="submit" class="btn btn-success btn-sm">Save Mapping</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <img id="cropimg" src="{{ asset('assets/images/defaultimageplaceholder.jpg') }}"
                                    height="150px" width="100%" name="croppedimg">
                            </div>
                            <div class="col-lg-6">
                                <label for="FormSelectSizing" class="form-label text-muted">X-Axis</label>
                                <input type="text" class="form-control" name="xaxis" id="xaxis" value=""
                                    readonly>

                                <label for="FormSelectSizing" class="form-label text-muted">Y-Axis</label>
                                <input type="text" class="form-control" name="yaxis" id="yaxis" value=""
                                    readonly>

                                <input type="hidden" name="newspaperid" value="{{ $newspaperdata[0]->newsid }}">
                                <input type="hidden" name="pageid" value="{{ $value->id }}">
                                <input type="hidden" id="cropimghid" name="cropimghid" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 30%">S.No</th>
                                <th scope="col" style="width: 30%">Mapped Image</th>
                                <th scope="col" style="width: 20%">X-Axis</th>
                                <th scope="col" style="width: 20%">Y-Axis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mappingdata as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $data->croppedimg }}" class="avatar-xs rounded-circle me-2" />
                                    </td>
                                    <td>{{ $data->xaxis }}</td>
                                    <td>{{ $data->yaxis }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var imageCropper;

            function initializeCropper(imagePath, aspectRatio) {
                var image = document.getElementById('preview');
                image.src = imagePath;
                // Destroy previous Cropper instance if exists
                if (imageCropper) {
                    imageCropper.destroy();
                }
                // Create new Cropper instance
                imageCropper = new Cropper(image, {
                    aspectRatio: aspectRatio,
                    viewMode: 2
                });
            }

            // // Event listener for dropdown change
            $('#pageSelect').change(function() {
                var selectedImage = $(this).val();
                console.log(selectedImage);
                document.getElementById('preview').src = selectedImage;
                initializeCropper(selectedImage, 'NaN');
            });

            // Event listener for button click to get cropped image and crop box data
            $('#getCroppedImage').click(function() {
                var croppedCanvas = imageCropper.getCroppedCanvas();
                if (croppedCanvas === null) {
                    alert('No selection was made. Please select an area to crop.');
                    return;
                }
                var croppedImage = croppedCanvas.toDataURL();
                console.log(
                croppedImage); // You can do anything with the cropped image here, like displaying it, saving it, etc.

                // Get crop box data
                var cropBoxData = imageCropper.getCropBoxData();
                var x = cropBoxData.left;
                var y = cropBoxData.top;
                console.log('X Axis:', x);
                console.log('Y Axis:', y);
                var xaxis = document.getElementById("xaxis").value = x;
                var yaxis = document.getElementById("yaxis").value = y;
                var cropimg = document.getElementById('cropimg').src = croppedImage;
                var cropimghid = document.getElementById('cropimghid').value = croppedImage;
            });
        });
    </script>
    <script>
        jQuery('#mappingform').submit(function(e) {
            e.preventDefault();
            jQuery.ajax({
                url: "{{ url('addmapping') }}",
                data: jQuery('#mappingform').serialize(),
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
</x-app-layout>
