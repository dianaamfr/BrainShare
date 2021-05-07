{{--    How many elements are in a page. --}}
    <span style="display: none" id="perPage">{{$categories->perPage()}}</span>

    <div class="table-entries">Showing {{sizeof($categories)}} of {{$categories->total()}} entries</div>
    <table class="table table-hover align-middle w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><i class="fas fa-sort"></i>{{ Request::is('admin/categories/tags') ? 'Tag' : 'Course'}}</th>
                <th scope="col"><i class="fas fa-sort"></i>Number of uses</th>
                <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row"> {{ $category->id }}</th>
                    <td>{{ $category->name }} </td>
                    <td>{{ sizeof($category->questions) }}</td>
                    <td>{{ date('d-m-Y', strtotime($category->getAttribute('creation_date'))) }}</td>
                    <td>
                        <button class="icon-hover" type="submit">
                            <i class="far fa-trash-alt"></i>
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>
    <!-- Pagination -->
    {{$categories->links()}}
