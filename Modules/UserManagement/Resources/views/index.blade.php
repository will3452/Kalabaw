<x-dashboard.layout>
    <div >
        <x-page.title>Users</x-page.title>
        <a href="{{route('usermanagement.create')}}" class="btn btn-primary">
            Create New User
        </a>
    </div>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                <tr>
                    <th>
                        No.
                    </th>
                    <th>
                        Account type
                    </th>
                    <th>
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Assigned Barangay
                    </th>
                    <td>
                        Date Approved
                    </td>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key=>$user)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$user->type ?? '--'}}
                    </td>
                    <td>
                        {{$user->first_name}}
                    </td>
                    <td>
                        {{$user->last_name != '' ?  $user->last_name : '--'}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->barangay ? $user->barangay->name: 'All'}}
                    </td>
                    <td>
                        {{$user->approved_at ?? '--'}}
                    </td>
                    <td >

                        @if ($user->wasApproved())
                            <span style="font-style: italic; margin-right:10px;">Approved</span>
                        @else
                            <button class="btn btn-sm btn-success" onclick="submitApproveForm('formapprove{{$user->id}}')">Approve</button>
                        @endif
                        <a class="btn btn-sm btn-primary" href="{{route('usermanagement.edit', ['user' => $user->id])}}">Edit</a>
                        <form style="display:inline;" action="{{route('usermanagement.approve', ['user' => $user->id])}}" method="POST" id="formapprove{{$user->id}}">
                            @csrf
                        </form>
                        <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$user->id}}')">Delete</button>
                        <form style="display:inline;" action="{{route('usermanagement.delete', ['user' => $user->id])}}" method="POST" id="formdelete{{$user->id}}">
                            @csrf @method('DELETE')
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-panel>
    @push('body-script')
        <script>
            function submitDeleteForm (id) {
                bootbox.confirm("Are you sure you want to delete this user ?", (result) => !result ?'':$('#' + id).submit());
            }

            function submitApproveForm(id) {
                bootbox.confirm('Are you sure want to run this action?', (result) => !result ?'':$('#' + id).submit())
            }
        </script>
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endpush
    @push('head-script')
        <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
    @endpush
</x-dashboard.layout>
