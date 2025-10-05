@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Luxury Chauffeur</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Blog!</li>
                    </ol>
                </div>
                <h4 class="page-title">Blog!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $key=>$blogsData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$blogsData->title}}</td>
                            <td>
                                <img src="{{asset('images/blog/'. $blogsData->image )}}" alt="Current Image" style="max-width: 50px;">
                            </td>
                            <td>{{$blogsData->status=='active'? 'Active':'Inactive'}}</td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$blogsData->id}}">Edit</button>
                                    <a href="{{route('blog.destroy',$blogsData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$blogsData->id}}">Delete</a>
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$blogsData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$blogsData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$blogsData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('blog.update', $blogsData->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Important for update -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" id="title" name="title"
                                                                   class="form-control" placeholder="Enter title" value="{{ $blogsData->title }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="total_bag" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="active" {{ $blogsData->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                <option value="inactive" {{ $blogsData->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" name="image" id="image" class="form-control">
                                                            @if($blogsData->image)
                                                                <img src="{{ asset('images/blog/'.$blogsData->image) }}" alt="Fleet Image" class="mt-2" style="max-width: 50px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Short Details</label>
                                                            <input type="text" name="short_details" value="{{$blogsData->short_details}}" class="form-control">
                                                        </div>
                                                    </div>


                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label>Details</label>
                                                            <textarea id="summernoteEdit{{ $blogsData->id }}" name="details">{{ $blogsData->details }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$blogsData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$blogsData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$blogsData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('blog.destroy',$blogsData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="name" name="title"
                                           class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Details</label>
                                        <input type="text" name="short_details"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label> Details </label>
                                        <textarea id="summernote" name="details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
