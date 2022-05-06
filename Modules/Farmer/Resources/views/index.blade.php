<x-dashboard.layout>
    <x-page.title>Farmers</x-page.title>
    <a href="{{route('farmer.create')}}" class="btn btn-primary">
        Add New Farmer
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                @foreach ($columns as $c)
                    <th style="font-size:14px;">{{Str::upper(implode(' ', explode('_', $c)))}}</th>
                @endforeach
                {{-- <th></th> --}}
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($farmers as $f)
                    <tr>
                        @foreach ($columns as $c)
                            <td style="font-size:14px;">
                                {{$f[$c]}}
                            </td>
                        @endforeach
                        {{-- <td>
                            <a class="btn btn-sm btn-success" href="{{route('farmer.print', ['farmer' => $f->id])}}">Generate Printable</a>
                        </td> --}}
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('farmer.edit', ['farmer' => $f->id])}}">EDIT</a>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="submitDeleteForm('formdelete{{$f->id}}')">DELETE</button>
                            <form style="display:inline;" action="{{route('farmer.delete', ['farmer' => $f->id])}}" method="POST" id="formdelete{{$f->id}}">
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
