@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">
    @foreach($v_service_category as $v_category)
        <div class="col-lg-12">
            <div class="card">
                <div class="row g-0 align-items-center">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-title">{{ $v_category->service_category }}</h3>

                            <table class="table">
                                <tr>
                                    <td><b>Status:</b></td>
                                    <td>
                                        @if($v_category->service_category_status == 'Active')
                                        <span class="badge bg-primary">{{ $v_category->service_category_status }}</span>
                                        @elseif($v_category->service_category_status == 'Disabled')
                                        <span class="badge bg-danger">{{ $v_category->service_category_status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Available Online:</b></td>
                                    <td>
                                        @if($v_category->available_online == '1')
                                        <span class="badge bg-primary">Yes</span>
                                        @elseif($v_category->available_online == '0')
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>View in Swipper:</b></td>
                                    <td>
                                        @if($v_category->view_swipper == '1')
                                        <span class="badge bg-primary">Yes</span>
                                        @elseif($v_category->view_swipper == '0')
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>View in Icon Line:</b></td>
                                    <td>
                                        @if($v_category->view_icon_line == '1')
                                        <span class="badge bg-primary">Yes</span>
                                        @elseif($v_category->view_icon_line == '0')
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Icon Class:</b></td>
                                    <td>{{ $v_category->icon_class }}</td>
                                </tr>
                                <tr>
                                    <td><b>Created At:</b></td>
                                    <td>{{ $v_category->created_at }}</td>
                                </tr>
                            </table>


                        </div> <!-- end card-body -->
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <img src="{{ asset($v_category->service_category_image) }}" class="img-fluid rounded-end w-100"
                            alt="{{ $v_category->service_category }}">
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end card -->
        </div> <!-- end col-->

    @endforeach

</div> <!-- content -->

@endsection