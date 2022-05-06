<x-dashboard.layout>
    <x-page.title>Machineries And Equipments</x-page.title>
    <a href="{{route('mae.create')}}" class="btn btn-primary">
        Add New Record
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                @foreach ($columns as $c)
                    <th style="font-size:10px;">{{getFieldLabel($c)}}</th>
                @endforeach
                <th></th>
            </thead>
            <tbody>
                @foreach ($maes as $f)
                    <tr>
                        @foreach ($columns as $c)
                            <td style="font-size:10px;">
                                {{getFieldValue($f, $c)}}
                            </td>
                        @endforeach
                        <th>
                            <a class="btn btn-sm btn-primary" href="{{route('mae.edit', ['mae' => $f->id])}}">EDIT</a>
                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$f->id}}')">DELETE</button>
                            <form style="display:inline;" action="{{route('mae.delete', ['mae' => $f->id])}}" method="POST" id="formdelete{{$f->id}}">
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
