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
                            <li class="breadcrumb-item active">Add Newspaper</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                    <div class="alert border-0 alert-success text-center" role="alert" id="successAlert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('failure'))
                    <div class="alert border-0 alert-danger text-center" role="alert" id="dangerAlert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="card-header align-items-center d-flex thead">
                        <h4 class="card-title mb-0 flex-grow-1">Add Newspaper</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="#"><button type="button"
                                        class="btn btn-success waves-effect waves-light addRow">+</button></a>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('createnewspaper')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body table-responsive">
                            <table class="table table-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="3"> <div class="mb-3 row col-lg-4 ms-1">
                                            <label for="JoiningdatInput" class="form-label">Newspaper Date</label>
                                            <input type="date" class="form-control" data-provider="flatpickr"
                                                id="JoiningdatInput" name="newsdate" data-date-format="d M, Y"
                                                data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                        </div></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Sequence</th>
                                        <th scope="col">Upload Newspapers</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="sequence[]" class="form-select mb-3"
                                                aria-label="Default select example" id="subcategory">
                                                @for($i =1; $i<=10; $i++) <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="file" class="form-control" id="image"
                                                    placeholder="enter color" name="papers[]">
                                            </div>
                                        </td>
                                        <td><a href="#"><button class="btn btn-outline-danger btn-sm"
                                                    id="">delete</button></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success waves-effect waves-light float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        setTimeout(function() {
            $('#successAlert').fadeOut('slow');
        }, 2000);

        setTimeout(function() {
            $('#dangerAlert').fadeOut('slow');
        }, 2000);
    </script>
    <script>
        $(document).on('click', '.addRow', function() {
        console.log("Clicked");
        var tr = `
        <tr>
            <td>
                <select name="sequence[]" class="form-select mb-3" aria-label="Default select example" id="subcategory">
                    @for($i =1; $i<=10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
            <td>
                <div>
                    <input type="file" class="form-control" id="image" placeholder=""
                                                name="papers[]">
                </div>
            </td>
            <td><a href="#"><button class="btn btn-outline-danger btn-sm deleteRow" id="sa-warning">delete</button></a></td>
        </tr>
        `;
        $('tbody').append(tr);
    });

    $(document).on('click', '.deleteRow', function() {
        $(this).closest('tr').remove();
    });
    </script>
</x-app-layout>
