<x-dashboard.layout>
    <x-page.title>Announcement</x-page.title>
    <a href="{{route('announcement.create')}}" class="btn btn-primary">
        Create Announcement
    </a>
    <br/>
    <x-panel title="List">
        <table id="myTable">
            <thead>
                <th>Date</th>
                @foreach ($columns as $c)
                    <th style="font-size:14px;">{{getFieldLabel($c)}}</th>
                @endforeach
                <th>Author</th>
            </thead>
            <tbody>
                @foreach ($announcements as $f)
                    <tr>
                        <td>{{$f->created_at}}</td>
                        @foreach ($columns as $c)
                            <td style="font-size:14px;">
                                {{getFieldValue($f, $c)}}
                            </td>
                        @endforeach
                        <td>{{$f->user->name}}</td>
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
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endpush
</x-dashboard.layout>
