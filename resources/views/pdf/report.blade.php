<!DOCTYPE html>
<html>

<head>
    <style>
        .flex-container {
            /* background-color: #f1f1f1; */
            width: 100%
        }

        .logo-panel {
            margin-top: -105px;
        }

        .site-name>* {
            margin-top: 150px;
            left: 50%;
            position: relative;
            transform: translate(-15%, 0);

        }

        .report-table {
            padding-top: 5px;
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
            /* background-color: #dddddd; */
        }

        th {
            background-color: #dddddd;
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
    <?php
    $imageDefaultWidth = '100px';
    $imageDefaultHeight = '100px';
    $imageTopMargin = '15px';
    ?>

    <div class="flex-container">
        <div class="print-panel">
            <h2 style="margin-bottom:5px;">Site Supervisor Report</h2>
            <p style="color:rgb(66, 66, 66)"> <b>Printed Date : </b> {{ date('Y-m-d H:i:s') }}</p>
            <p style="color:rgb(66, 66, 66)"> <b>Report ID : </b>{{ $report->id }}</p>
            <p style="color:rgb(66, 66, 66)"> <b>Printed By : </b>{{ Auth::user()->name }}</p>
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
            <img style="width: 120px;height:100px;float: right;" src="{{ $logoData }}">
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
                    <tr>
                        <td colspan="4">
                            @foreach ($reportSection->reportSectionMedias as $key => $reportSectionMedia)


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

                                <img style="margin-top: {{ $imageTopMargin }};" height="{{ $imageDefaultHeight }}"
                                    width="{{ $imageDefaultWidth }}" src="{{ $imageData }}">



                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
            <br />
            <br />
            <br />
            <table width="100%">
                @if( $report->site_admin_comment != null)
                <tr>
                    <td colspan>
                        <h5 style="display: inline">Site Admin Comment : </h5>
                        <span>{{ $report->site_admin_comment }}</span>
                    </td>
                </tr>
                @endif
                @if ($report->siteAdminMedias->count() > 0)
                    <tr>
                        <td>
                            @foreach ($report->siteAdminMedias as $key => $siteAdminMedias)

                                <?php
                                $siteAdminImageUrl = base_path() . $siteAdminMedias->media->raw_path['thumbnail'];
                                $arrContextOptions = [
                                    'ssl' => [
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                    ],
                                ];
                                $type = pathinfo($siteAdminImageUrl, PATHINFO_EXTENSION);
                                $siteAdminImageData = file_get_contents($siteAdminImageUrl, false, stream_context_create($arrContextOptions));
                                $siteAdminImageBase64Data = base64_encode($siteAdminImageData);
                                $adminCommentData = 'data:image/' . $type . ';base64,' . $siteAdminImageBase64Data;

                                ?>

                                <img style="margin-top: {{ $imageTopMargin }};" height="{{ $imageDefaultHeight }}"
                                    width="{{ $imageDefaultWidth }}" src="{{ $adminCommentData }}">


                            @endforeach
                        </td>
                    </tr>
                @endif

            </table>

            <br />
            <br />
            <br />
            <table width="100%">
                <tr>
                    <td colspan="2">
                        <h5>Overrall Rating :
                            {{ round($report->reportSections->sum('rating') / $report->reportSections->count()) }} /
                            {{ config('common.rating__by') }}
                        </h5>
                        <h5>Created Date :
                            {{ $report->date }}
                        </h5>
                        <h5>Created By :
                            {{ $report->user->name }}
                        </h5>
                    </td>
                    <td style="text-align: left" colspan="2">
                        <h5>Signature : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

                        <?php
                        $signatureUrl = base_path() . $report->signature->raw_path['thumbnail'];
                        $arrContextOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                            ],
                        ];
                        $type = pathinfo($signatureUrl, PATHINFO_EXTENSION);
                        $signatureData = file_get_contents($signatureUrl, false, stream_context_create($arrContextOptions));
                        $signatureBase64Data = base64_encode($signatureData);
                        $signatureImageData = 'data:image/' . $type . ';base64,' . $signatureBase64Data;

                        ?>

                        <img height="80px" width="350px" src="{{ $signatureImageData }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
