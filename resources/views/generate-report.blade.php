<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        table {
            width:100vw;
            border-collapse: collapse;
        }

        .hide {
            margin-left: 1em !important;
        }

        .footer {
            display: flex;
        }

        .footer > div {
            margin: 20px;
        }

        th, td {
            padding: 5px;
            border:1px solid #222;
        }

        @media print {
            .hide {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div style='display:flex;align-items:center;justify-content:center;'>
        <h1>
            List of {{$label}}
        </h1>
        <button class="hide" onclick="window.print()">print</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                @foreach ($columns as $c)
                    @if (! in_array($c, ['recorded_by_id']))
                        <th style="font-size:14px;">{{getFieldLabel($c)}}</th>
                    @endif
                @endforeach
                @if ($label === "Item in Inventory")
                    <th>BALANCE</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=>$f)
            <tr>
                <td>
                    {{$key + 1}}
                </td>
                @foreach ($columns as $c)
                    @if (! in_array($c, ['recorded_by_id']))
                        <td style="font-size:14px;{{!isMoney($c, get_class($f)) ?:'text-align:right;'}}">
                            {{isMoney($c, get_class($f)) ? getMoney(getFieldValue($f, $c)) :getFieldValue($f, $c)}}
                        </td>
                    @endif
                @endforeach
                @if ($label === "Item in Inventory")
                    <td>
                        {{$f->balance()}}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="footer">
        <div>
            Received by: <span class="underlined">{{auth()->user()->name}}</span>
        </div>
        <div>
            Prepared by: ___________________
        </div>
        <div>
            Reviewed by: <span class="underlined" contenteditable="true">[click me to edit]</span>
        </div>
    </div>
</body>
</html>
