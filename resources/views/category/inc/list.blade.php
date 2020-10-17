
@foreach ($categories as $key => $row)
    <tr>
        <td>{{ ++$key }}</td>
        <td><img src="{{ asset('upload/categories/'.$row->image) }}" alt="" width="40px" height="40px"></td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->created_at }}</td>
        <td>
            <a href="" class="btn btn-info btn-sm edit" data-id="{{ $row->id }}">
                <i class="fa  fa-edit"></i>
            </a> |
            <a href="" class="btn btn-danger btn-sm delete" data-id="{{ $row->id }}">
                <i class="fa fa-trash-o"></i>
            </a>
        </td>
    </tr>
@endforeach
