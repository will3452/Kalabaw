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

        th, td {
            padding: 1em;
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
    <div style='display:flex;align-items:center;'>
        <h1>
            {{$label}}
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
                        <td style="font-size:14px;">
                            {{getFieldValue($f, $c)}}
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
</body>
</html>
