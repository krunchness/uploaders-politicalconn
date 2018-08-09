@extends('layouts.main-dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <h3 class="title-5">Files List Table</h3>
                <!-- div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Properties</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button> -->
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small add-item-btn">
                    <i class="zmdi zmdi-plus"></i>Upload File</button>
                <!-- <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div> -->
            </div>
        </div>

        <input type="hidden" class="hidden-inputs" data-path="{{ asset('files/') }}">
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2" id="filesTable">
                <thead>
                    <tr>
                        <th>
                            <label class="au-checkbox">
                                <input type="checkbox">
                                <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>Created Date</th>
                        <th width="25%">Title</th>
                        <th>description</th>
                        <th>uploaded By</th>
                        <th>File Name</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($files_list as $file)
                    <tr class="tr-shadow">
                        <td>
                            <label class="au-checkbox">
                                <input type="checkbox">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td>{{ $file->created_at }}</td>
                        <td>
                            <span class="block-email">{{ $file->title }}</span>
                        </td>
                        <td class="desc">{{ $file->file_desc }}</td>
                        <td>{{ $file->uploaded_by }}</td>
                        <td>
                            <span class="status--process">{{ $file->filename }}</span>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item download-file" data-file="{{ $file->filename }}" data-toggle="tooltip" data-placement="top" title="Download">
                                    <i class="zmdi zmdi-cloud-download"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>

<div data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="remodal-container">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Upload New Document</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Document Title</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="title" placeholder="Text" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="file_desc" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="file-input" class=" form-control-label">File input</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="file-input" name="file_input" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <span class="modal-submit-spaces"></span>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>



@endsection

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ asset( 'vendor/remodal/remodal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'vendor/remodal/remodal-default-theme.css') }}">
@endsection
@section('custom-script')
    <script src="{{ asset( 'vendor/remodal/remodal.min.js') }}"></script>
    <script>
        var inst = $('[data-remodal-id=modal]').remodal();

        $('.add-item-btn').on('click',function(){
            inst.open();
        });


        
        $('.download-file').on('click', function(){
            var filename = $(this).attr('data-file');
            // alert(filename);
            var path = $('.hidden-inputs').attr('data-path');
            window.location.href = path + '/' + filename;
        });
        

    </script>
@endsection