<x-dashboard.layout>
    <x-page.title>Fishermens</x-page.title>
    <a href="{{route('fishermen.create')}}" class="btn btn-primary">
        Add New Fishermen
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                <tr>
                    @foreach ($columns as $c)
                    <th style="font-size:14px;">{{getFieldLabel($c)}}</th>
                @endforeach
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fishermens as $f)
                    <tr>
                        @foreach ($columns as $c)
                            <td style="font-size:14px;">
                                {{$f[$c]}}
                            </td>
                        @endforeach
                        <td>
                            <a href="{{route('area.create', ['fishermen' => $f->id])}}" class="btn btn-sm btn-warning">ADD AREA</a>
                        </td>
                        <td>
                            <a href="{{route('fishermen.show', ['fishermen' => $f->id])}}" class="btn btn-success btn-sm">VIEW</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('fishermen.edit', ['fishermen' => $f->id])}}">EDIT</a>
                        </td>
                        <th>

                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$f->id}}')">DELETE</button>
                            <form style="display:inline;" action="{{route('fishermen.delete', ['fishermen' => $f->id])}}" method="POST" id="formdelete{{$f->id}}">
                                @csrf @method('DELETE')
                            </form>
                        </th>
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
