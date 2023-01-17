<x-dashboard.layout>
    <!-- OVERVIEW -->
    <style>
        .icons {
            width:50px !important;
            height: 50px !important;
            margin-right: 10px;
        }
        .metric {
            display: flex;
            justify-content: space-between;
            background: #38B6FF;
        }
    </style>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
            <p class="panel-subtitle">Date Today: {{now()->format('m-d-y')}}</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Accounts.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\App\Models\User::count()}}</span>
                            <span class="title">Accounts</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Farmer.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Farmer\Entities\Farmer::count()}}</span>
                            <span class="title">Farmers</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Fisherman.png" alt="" class="icons">
                        <p>
                            <span class="number">{{ \Modules\Fishermen\Entities\Fishermen::count() }}</span>
                            <span class="title">Fishermen</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Inventory.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Inventory\Entities\Item::whereHas('inventories')->count()}}</span>
                            <span class="title" style="font-size:16px;">Inventory Items</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Announcement.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Announcement\Entities\Announcement::count()}}</span>
                            <span class="title">Announcments</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Barangay.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Barangay\Entities\Barangay::count()}}</span>
                            <span class="title">Barangay</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Farm.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Farmer\Entities\Crop::count()}}</span>
                            <span class="title">Farms</span>
                        </p>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Trees.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Farmer\Entities\Tree::count()}}</span>
                            <span class="title">Trees</span>
                        </p>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Livestock.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Farmer\Entities\LivestockOrPoultry::count()}}</span>
                            <span class="title" style="font-size:9px;">Livestock/Poultry</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Machinery.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Farmer\Entities\MachineAndEquipment::count()}}</span>
                            <span class="title" style="font-size:9px;">Machineries/Equipment</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <img src="/icons/Area.png" alt="" class="icons">
                        <p>
                            <span class="number">{{\Modules\Fishermen\Entities\Area::count()}}</span>
                            <span class="title">Area</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('body-script')
        <script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="/assets/vendor/chartist/js/chartist.min.js"></script>
        <script>
        $(function() {
            var data, options;

            // headline charts
            data = {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                series: [
                    [23, 29, 24, 40, 25, 24, 35],
                    [14, 25, 18, 34, 29, 38, 44],
                ]
            };

            options = {
                height: 300,
                showArea: true,
                showLine: false,
                showPoint: false,
                fullWidth: true,
                axisX: {
                    showGrid: false
                },
                lineSmooth: false,
            };

            new Chartist.Line('#headline-chart', data, options);


            // visits trend charts
            data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [{
                    name: 'series-real',
                    data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
                }, {
                    name: 'series-projection',
                    data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
                }]
            };

            options = {
                fullWidth: true,
                lineSmooth: false,
                height: "270px",
                low: 0,
                high: 'auto',
                series: {
                    'series-projection': {
                        showArea: true,
                        showPoint: false,
                        showLine: false
                    },
                },
                axisX: {
                    showGrid: false,

                },
                axisY: {
                    showGrid: false,
                    onlyInteger: true,
                    offset: 0,
                },
                chartPadding: {
                    left: 20,
                    right: 20
                }
            };

            new Chartist.Line('#visits-trends-chart', data, options);


            // visits chart
            data = {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                series: [
                    [6384, 6342, 5437, 2764, 3958, 5068, 7654]
                ]
            };

            options = {
                height: 300,
                axisX: {
                    showGrid: false
                },
            };

            new Chartist.Bar('#visits-chart', data, options);


            // real-time pie chart
            var sysLoad = $('#system-load').easyPieChart({
                size: 130,
                barColor: function(percent) {
                    return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
                },
                trackColor: 'rgba(245, 245, 245, 0.8)',
                scaleColor: false,
                lineWidth: 5,
                lineCap: "square",
                animate: 800
            });

            var updateInterval = 3000; // in milliseconds

            setInterval(function() {
                var randomVal;
                randomVal = getRandomInt(0, 100);

                sysLoad.data('easyPieChart').update(randomVal);
                sysLoad.find('.percent').text(randomVal);
            }, updateInterval);

            function getRandomInt(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

        });
        </script>
    @endpush
</x-dashboard.layout>
