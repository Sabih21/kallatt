<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">
            <div class="container mt-5">
                <h1 class="mb-4">Categories</h1>
            
                <!-- Button to trigger create company modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCompanyModal">
                    Add Category
                </button>
                @error('name')
                    {{$message}}
                @enderror
                @error('image')
                {{$message}}
            @enderror
            
                <!-- Company list -->
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="mr-3" style="max-height: 70px; max-width: 120px">
                        </div>
                            {{ $category->name }}
                            <div class="btn-group" role="group">
                                <!-- Button to trigger edit company modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCompanyModal{{ $category->id }}">
                                    Edit
                                </button>
                                <!-- Form to delete company -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                </form>
                            </div>
                        </li>
            
                        <!-- Edit Company Modal -->
                        <div class="modal fade" id="editCompanyModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCompanyModalLabel{{ $category->id }}">Edit Company</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form to edit company -->
                                        <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="editCompanyName{{ $category->id }}">Category Name:</label>
                                                <input type="text" class="form-control" id="editCompanyName{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editCompanyImage{{ $category->id }}">Image:</label>
                                                <input type="file" class="form-control-file" id="editCompanyImage{{ $category->id }}" name="image">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            
                <!-- Create Company Modal -->
                <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCompanyModalLabel">Add Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form to add a new company -->
                                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="addCompanyName">Category Name:</label>
                                        <input type="text" class="form-control" id="addCompanyName" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addCompanyImage">Image:</label>
                                        <input type="file" class="form-control-file" id="addCompanyImage" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
@include('admin.footer')
@include('admin.scripts')
</body>
</html>
