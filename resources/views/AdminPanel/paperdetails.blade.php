{{-- || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। || --}}
<x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">
    <style>
        #preview {
            width: 100%;
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
                        <img id="preview" src="" width="100%" alt="Selected Image to Crop">
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
                                <input type="text" class="form-control" name="xaxis" id="xaxis" value="" readonly>

                                <label for="FormSelectSizing" class="form-label text-muted">Y-Axis</label>
                                <input type="text" class="form-control" name="yaxis" id="yaxis" value="" readonly>

                                <label for="FormSelectSizing" class="form-label text-muted">Bottom X-Axis</label>
                                <input type="text" class="form-control" name="bxaxis" id="bxaxis" value="" readonly>

                                <label for="FormSelectSizing" class="form-label text-muted">Bottom Y-Axis</label>
                                <input type="text" class="form-control" name="byaxis" id="byaxis" value="" readonly>

                                <input type="hidden" name="newspaperid" value="{{ $newspaperdata[0]->newsid }}">
                                <input type="hidden" name="pageid" id="pageid" value="">
                                <input type="hidden" id="cropimghid" name="cropimghid" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                var selectedOption = $(this).find(':selected');
                var selectedImage = selectedOption.val();

                // Get the 'data-id' attribute value
                var dataId = selectedOption.data('id');
                console.log('Data ID:', dataId);
                console.log('Image Path:', selectedImage);
                // var selectedImage = $(this).val();
                // console.log(selectedImage);
                document.getElementById('preview').src = selectedImage;
                document.getElementById('pageid').value = dataId;
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
                    croppedImage
                ); // You can do anything with the cropped image here, like displaying it, saving it, etc.

                // Get crop box data
                var cropBoxData = imageCropper.getCropBoxData();
                var x = cropBoxData.left;
                var y = cropBoxData.top;




                var width = cropBoxData.width;
                var height = cropBoxData.height;
                // Calculate coordinates of all four corners
                var topLeftX = x;
                var topLeftY = y;
                var bottomRightX = x + width;
                var bottomRightY = y + height;

                console.log('Top-left:', topLeftX, topLeftY);
                console.log('Bottom-right:', bottomRightX, bottomRightY);
                var topxaxis = document.getElementById("xaxis").value = topLeftX;
                var topyaxis = document.getElementById("yaxis").value = topLeftY;
                var bottomxaxis = document.getElementById("bxaxis").value = bottomRightX;
                var bottomyaxis = document.getElementById("byaxis").value = bottomRightY;

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
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Mapping has been successfully added!',
                    });
                },
                error: function() {
                        alert("An error occurred while adding the mapping.");
                    }
            });
        });
    </script>
</x-app-layout>
