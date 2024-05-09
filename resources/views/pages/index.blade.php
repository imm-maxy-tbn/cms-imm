    @extends('layouts.admin')

    @section('main-content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Pages</h1>

            <!-- Create Button -->
            <a href="{{ route('pages.create') }}" class="btn btn-primary mb-3">Create New Page</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pages List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>Images</th>
                                    <th>Actions</th> <!-- New column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td>{{ $page->name }}</td>
                                        <td>{{ $page->content }}</td>
                                        <td>
                                            @if ($page->img)
                                                @foreach (explode(';', $page->img) as $image)
                                                    <img src="{{ asset(str_replace('public/', 'storage/', $image)) }}"
                                                        alt="Image" style="max-width: 100px; max-height: 100px;">
                                                @endforeach
                                            @else
                                                No images
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    @endsection