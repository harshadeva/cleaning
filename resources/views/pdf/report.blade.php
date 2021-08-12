<!DOCTYPE html>
<html>

<head>
    <style>
        .flex-container {
            display: flex;
            flex-direction: row;
            align-items: start;
            background-color: #f1f1f1;
            width: 100%
        }


        .site-name>* {
            margin-top: 140px;
            left: 50%;
            position: relative;
            transform: translate(-15%, 0);

        }

        .report-table {
            padding-top: 165px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr.details {
            background-color: #dddddd;
        }

        .self-end {
            margin-left: auto;
            width: 60%;
            padding: 10px;
        }

        .print-panel>p {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .report-panel>p {
            margin-top: 0px;
            margin-bottom: 0px;
        }


    </style>
</head>

<body>

    <div class="flex-container">
        <div class="print-panel">
            <p> <b>Printed Date : </b> {{ date('Y-m-d H:i:s') }}</p>
            <p> <b>Report ID : </b>{{ $report->id }}</p>
            <p> <b>Printed By : </b>{{ Auth::user()->name }}</p>
            <br />
            <p> <b>Report Date : </b>{{ $report->date }}</p>
            <p> <b>Report Created By : </b>{{ $report->user->name }}</p>
        </div>
        <div class="logo-panel">
            <?php

            $logoUrl = base_path() . $logo->raw_path['thumbnail'];
            $arrContextOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ];
            $type = pathinfo($logoUrl, PATHINFO_EXTENSION);
            $logoData = file_get_contents($logoUrl, false, stream_context_create($arrContextOptions));
            $logoBase64Data = base64_encode($logoData);
            $logoData = 'data:image/' . $type . ';base64,' . $logoBase64Data;
            ?>
            <img style="width: 120px;height:120px;float: right;" src="{{ $logoData }}">
        </div>

        <div class="site-name">
                <h4><u>{{ $report->site->name }}</u></h4>
        </div>
        <div class="report-table">
            <table>
                <tr>
                    <th>Section</th>
                    <th>Employee</th>
                    <th>Stars</th>
                    <th>Remark</th>
                </tr>
                @foreach ($report->reportSections as $reportSection)
                    <tr class="details">
                        <td>{{ $reportSection->section->name }}</td>
                        <td>{{ $reportSection->employee->name }}</td>
                        <td>{{ $reportSection->rating }} <span style="opacity: 0.6"> /
                                {{ config('common.rating__by') }}
                            </span> </td>
                        <td>{{ $reportSection->description }}</td>
                    </tr>
                    @foreach ($reportSection->reportSectionMedias as $key => $reportSectionMedia)
                        @if ($key % 4 == 1 || $key == 0)
                            <tr>
                        @endif

                        <?php
                        $avatarUrl = base_path() . $reportSectionMedia->media->raw_path['thumbnail'];
                        $arrContextOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                            ],
                        ];
                        $type = pathinfo($avatarUrl, PATHINFO_EXTENSION);
                        $avatarData = file_get_contents($avatarUrl, false, stream_context_create($arrContextOptions));
                        $avatarBase64Data = base64_encode($avatarData);
                        $imageData = 'data:image/' . $type . ';base64,' . $avatarBase64Data;

                        ?>
                        <td>
                            <img style="width: 100px;height:100px" src="{{ $imageData }}">
                        </td>
                        @if ($key % 4 == 0 && $key != 0)
                            </tr>
                        @endif

                    @endforeach

                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
