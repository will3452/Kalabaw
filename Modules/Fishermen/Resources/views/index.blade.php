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

                <th>No</th>
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
                @foreach ($fishermens as $index=>$f)
                    <tr>
                        <td></td>
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
                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$f->id}}')">ARCHIVE</button>
                            <form style="display:inline;" action="{{route('fishermen.delete', ['fishermen' => $f->id])}}" method="POST" id="formdelete{{$f->id}}">
                                @csrf @method('DELETE')
                                <input type="hidden" name="status" class="status">
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
        <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
        <script>
            function submitDeleteForm (id) {
                bootbox.prompt({
                    title: "Are you sure you want to archive this record? ",
                    message: '<p>Status</p>',
                    inputType: 'radio',
                    inputOptions: [
                    {
                        text: 'Deceased',
                        value: 'Deceased',
                    },
                    {
                        text: 'Inactive',
                        value: 'Inactive',
                    },
                    ],
                    callback:  function (result) {
                        if (result) {
                            $('.status').val(result);
                            $('#' + id).submit()
                        }
                    }
                });
            }
            $(document).ready( function () {
                let table = $('#myTable').DataTable({
                        scrollY:        "300px",
                        scrollX:        true,
                        scrollCollapse: true,
                        paging:         false,
                        columnDefs: [ {
                            sortable: false,
                            "class": "index",
                            targets: 0
                        } ],
                        order: [[ 1, 'asc' ]],
                        fixedColumns: true
                    });
                    table.on( 'order.dt search.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        } );
                    } ).draw();
            } );
        </script>
    @endpush
</x-dashboard.layout>
