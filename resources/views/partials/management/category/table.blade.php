{{--    How many elements are in a page. --}}
    <span style="display: none" id="perPage">{{$categories->perPage()}}</span>

    <div class="table-entries">
        Showing {{$categories->perpage() * ($categories->currentpage()-1) + 1}} 
            to {{$categories->perpage() * ($categories->currentpage()-1) + $categories->count()}} 
            of {{$categories->total()}} entries
    </div>
    <table class="table table-hover align-middle w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ Request::is('admin/categories/tags') ? 'Tag' : 'Course'}}</th>
                <th scope="col">Number of uses</th>
                <th scope="col">Date</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$loop->index + 1 + $categories->perpage() * ($categories->currentpage()-1)}}</th>
                    <td class="category-name">{{ $category->name }} </td>
                    <td>{{ sizeof($category->questions) }}</td>
                    <td>{{ date('d-m-Y', strtotime($category->getAttribute('creation_date'))) }}</td>
                    <td>
                        <button class="btn btn-outline-primary management-action-btn" type="submit">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>

    @if($categories->isEmpty())
        <span>Nothing found</span>
    @endif 

    <!-- Pagination -->
    {{$categories->links()}}
