<x-dashboard.layout>
    <x-page.title>Archive</x-page.title>
    <x-panel>
        <form action="">
            <select name="type" id="">
                @foreach ($types as $key=>$type)
                    <option value="{{$key}}" {{ $key !== request()->type?:'selected' }} >
                        {{ $type['label'] }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary">Load</button>
        </form>
        <table id="myTable">
            <thead>
                @foreach ($columns as $c)
                    @if (! in_array($c, ['recorded_by_id']))
                        <th style="font-size:14px;">{{getFieldLabel($c)}}</th>
                    @endif
                @endforeach
                <th></th>
            </thead>
            <tbody>
                @foreach ($data as $f)
                    <tr>
                        @foreach ($columns as $c)
                            @if (! in_array($c, ['recorded_by_id']))
                                <td style="font-size:14px;">
                                    {{getFieldValue($f, $c)}}
                                </td>
                            @endif
                        @endforeach
                        <th>
                            <form action="{{route('bin.restore')}}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="{{$modelType}}" />
                                <input type="hidden" name="id" value="{{$f->id}}" />
                                @if (in_array($modelType, ['Fishermen', 'Farmer']))
                                    @if ($f->status != 'Deceased')
                                        <button class="btn btn-primary">Restore</button>
                                    @endif
                                @else
                                    <button class="btn btn-primary">Restore</button>
                                @endif

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
