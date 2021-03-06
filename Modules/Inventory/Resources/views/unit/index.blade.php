<x-dashboard.layout>
    <x-page.title>Unit of measurements</x-page.title>
    <a href="{{route('unit.create')}}" class="btn btn-primary">
        Add New Unit of measurement.
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                <tr>
                    <th>Date</th>
                    @foreach ($columns as $c)
                        <th style="font-size:14px;">{{getFieldLabel($c)}}</th>
                    @endforeach
                    <th>Added By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $f)
                    <tr>
                        <td>{{$f->created_at}}</td>
                        @foreach ($columns as $c)
                            <td style="font-size:14px;">
                                {{getFieldValue($f, $c)}}
                            </td>
                        @endforeach
                        <th>
                            {{$f->user->name}}
                        </th>
                        <th>
                            <a class="btn btn-sm btn-primary" href="{{route('unit.edit', ['unit' => $f->id])}}">EDIT</a>
                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$f->id}}')">ARCHIVE</button>
                            <form style="display:inline;" action="{{route('unit.delete', ['unit' => $f->id])}}" method="POST" id="formdelete{{$f->id}}">
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
                bootbox.confirm("Are you sure you want to archive this record? ", (result) => !result ?'':$('#' + id).submit());
            }
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endpush
</x-dashboard.layout>
