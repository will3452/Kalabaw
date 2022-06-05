<x-dashboard.layout>
    <x-page.title>Reports</x-page.title>
    <form action="/generate-report">
        <div class="row d-flex"  style="align-items: end;">
            <div class="col-md-4">
                <select name="type" id="" class="form-control" required>
                    <option value="" selected default disabled>Select data</option>
                    @foreach ($types as $key=>$type)
                        <option value="{{$key}}">{{$type['label']}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">generate</button>
        </div>
    </form>
</x-dashboard.layout>
