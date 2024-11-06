@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">
    @foreach($v_service_sub_category as $v_sub_category)
    <div class="col-lg-12">
        <div class="card">
            <div class="row g-0 align-items-center">
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title">{{ $v_sub_category->service_sub_category }}</h3>

                        <table class="table">
                            <tr>
                                <td><b>Parent Category:</b></td>
                                <td>{{ $v_sub_category->service_sub_category_parent }}</td>
                            </tr>

                            <tr>
                                <td><b>Status:</b></td>
                                <td>
                                    @if($v_sub_category->service_sub_category_status == 'Active')
                                    <span class="badge bg-primary">{{ $v_sub_category->service_sub_category_status
                                        }}</span>
                                    @elseif($v_sub_category->service_sub_category_status == 'Disabled')
                                    <span class="badge bg-danger">{{ $v_sub_category->service_sub_category_status
                                        }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Available Online:</b></td>
                                <td>
                                    @if($v_sub_category->sub_category_available_online == '1')
                                    <span class="badge bg-primary">Yes</span>
                                    @elseif($v_sub_category->sub_category_available_online == '0')
                                    <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>View in Index Page:</b></td>
                                <td>
                                    @if($v_sub_category->sub_category_view_index_page == '1')
                                    <span class="badge bg-primary">Yes</span>
                                    @elseif($v_sub_category->sub_category_view_index_page == '0')
                                    <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td><b>Icon:</b></td>
                                <td><i class="{{ $v_sub_category->sub_category_icon_class ?? '' }}"></i></td>
                            </tr>
                            <tr>
                                <td><b>Created At:</b></td>
                                <td>{{ $v_sub_category->created_at }}</td>
                            </tr>
                        </table>






                    </div> <!-- end card-body -->
                </div> <!-- end col -->
                <div class="col-md-6 p-4">
                    <img src="{{ asset($v_sub_category->service_sub_category_image) }}"
                        class="img-fluid rounded-end w-100" alt="{{ $v_sub_category->service_sub_category_image }}">
                </div> <!-- end col -->
            </div> <!-- end row-->




            <table class="table m-4 p-4">
                @foreach($v_service_sub_category as $sub_category)
                @foreach($sub_category->questions as $question)
               
                <tr>
                <td><b>Question </b><br> {{ $question->question }}</td>
                    <td>
                   
                        <b>Answers</b><br>
                        @foreach($question->answers as $answer)
                        {{ $answer->answer }} <br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
                @endforeach
            </table>

        </div> <!-- end card -->
    </div> <!-- end col-->

    @endforeach

</div> <!-- content -->

@endsection