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
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="text-muted fst-italic col-md-6">Published on : {{ date('j F, Y',
                            strtotime($data->date)) }}</div>
                        <div class="col-md-4">
                            <select id="pageSelect" class="form-select rounded" aria-label="Default select example">
                                @foreach ($newspaperdata as $value)
                                <option {{ $value->sequence == 1 ? 'selected' : '' }} value="{{ asset($value->papers)
                                    }}">Page {{$value->sequence}}</option>
                                @endforeach
                            </select>


                        </div>
                        <div class="col-md-2">
                            <button id="startButton" class="btn btn-info">Cropping</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{asset($newspaperdata[0]->papers)}}" alt="" height="600px" class="img-fluid"
                        id="mainimg">
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    Create Mapping
                </div>
                <div class="card-body">
                    <canvas id="canvas"></canvas>
                    <div id="crop-box"></div>
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
        $(document).on('change', '#pageSelect', function() {
            var imgurl = $(this).val();
            document.getElementById('mainimg').src = imgurl;
            $('#mainimg').data('url', imgurl);
        });
    </script>
    <script>
        window.onload = function () {
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        const cropBox = document.getElementById("crop-box");
        const mainImg = document.getElementById("mainimg");
        let image = new Image();
        image.src = mainImg.src; // Using the source of the image from the backend

        image.onload = function () {
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.drawImage(image, 0, 0);
            ctx.globalAlpha = 0.5; // Add transparency
            ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        };

        let startX, startY, width = 100, height = 100; // Initial values for width and height

        function drawCropBox(x, y, w, h) {
            cropBox.style.width = w + "px";
            cropBox.style.height = h + "px";
            cropBox.style.left = x + "px";
            cropBox.style.top = y + "px";
        }

        document.getElementById("startButton").addEventListener("click", function() {
            canvas.addEventListener("mousedown", startDragging);
            canvas.addEventListener("mousemove", drag);
            canvas.addEventListener("mouseup", stopDragging);
        });

        function stopCropping() {
            canvas.removeEventListener("mousedown", startDragging);
            canvas.removeEventListener("mousemove", drag);
            canvas.removeEventListener("mouseup", stopDragging);
        }

        function startDragging(e) {
            startX = e.offsetX;
            startY = e.offsetY;
        }

        function drag(e) {
            const x = Math.min(startX, e.offsetX);
            const y = Math.min(startY, e.offsetY);
            width = Math.abs(startX - e.offsetX);
            height = Math.abs(startY - e.offsetY);
            drawCropBox(x, y, width, height);
        }

        function stopDragging() {
            if (width && height) {
                const croppedImage = ctx.getImageData(
                    startX,
                    startY,
                    width,
                    height
                );
                const croppedCanvas = document.createElement("canvas");
                const croppedCtx = croppedCanvas.getContext("2d");
                croppedCanvas.width = width;
                croppedCanvas.height = height;
                croppedCtx.putImageData(croppedImage, 0, 0);
                const croppedImageURL = croppedCanvas.toDataURL();
                const croppedImageElement = new Image();
                croppedImageElement.src = croppedImageURL;
                document.body.appendChild(croppedImageElement);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(image, 0, 0);
                ctx.globalAlpha = 0.5; // Add transparency
                ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                drawCropBox(0, 0, 0, 0); // Reset crop box
            }
            stopCropping();
        }
    };
    </script>
    {{-- <script>
        window.onload = function () {
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        const cropBox = document.getElementById("crop-box");
        const mainImg = document.getElementById("mainimg");
        let image = new Image();
        image.src = mainImg.src; // Using the source of the image from the backend
        image.onload = function () {
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.drawImage(image, 0, 0);
        };

        let isDragging = false;
        let startX, startY, width, height;

        canvas.addEventListener("mousedown", startDragging);
        canvas.addEventListener("mousemove", drag);
        canvas.addEventListener("mouseup", stopDragging);

        function startDragging(e) {
            isDragging = true;
            startX = e.offsetX;
            startY = e.offsetY;
        }

        function drag(e) {
            if (!isDragging) return;
            const x = Math.min(startX, e.offsetX);
            const y = Math.min(startY, e.offsetY);
            width = Math.abs(startX - e.offsetX);
            height = Math.abs(startY - e.offsetY);
            cropBox.style.width = width + "px";
            cropBox.style.height = height + "px";
            cropBox.style.left = x + "px";
            cropBox.style.top = y + "px";
        }

        function stopDragging() {
            isDragging = false;
            if (width && height) {
                const croppedImage = ctx.getImageData(
                    startX,
                    startY,
                    width,
                    height
                );
                const croppedCanvas = document.createElement("canvas");
                const croppedCtx = croppedCanvas.getContext("2d");
                croppedCanvas.width = width;
                croppedCanvas.height = height;
                croppedCtx.putImageData(croppedImage, 0, 0);
                const croppedImageURL = croppedCanvas.toDataURL();
                const croppedImageElement = new Image();
                croppedImageElement.src = croppedImageURL;
                croppedImageElement.classList.add("custom-cropped-image");
                document.body.appendChild(croppedImageElement);
            }
            cropBox.style.width = "0px";
            cropBox.style.height = "0px";
        }
    };
    </script> --}}
</x-app-layout>
