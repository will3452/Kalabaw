<x-dashboard.layout>
    <x-page.title>Barangay</x-page.title>
    <a href="{{route('barangay.create')}}" class="btn btn-primary">
        Add New Barangay
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                @foreach ($columns as $c)
                    <th >{{Str::upper(implode(' ', explode('_', $c)))}}</th>
                @endforeach
                <th></th>
            </thead>
            <tbody>
                @foreach ($barangays as $b)
                   <tr>
                        @foreach ($columns as $c)
                            <td>
                                {{$b[$c]}}
                            </td>
                        @endforeach
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('barangay.edit', ['barangay' => $b->id])}}">EDIT</a>
                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$b->id}}')">DELETE</button>
                            <form style="display:inline;" action="{{route('barangay.delete', ['barangay' => $b->id])}}" method="POST" id="formdelete{{$b->id}}">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    </x-panel>
    @push('head-script')
        <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
    @endpush
    @push('body-script')
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            function submitDeleteForm (id) {
                bootbox.confirm("Are you sure you want to delete this record ?", (result) => !result ?'':$('#' + id).submit());
            }
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endpush
</x-dashboard.layout>
