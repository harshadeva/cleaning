<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Report;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function print(Request $request)
    {
        // $this->dom();
        return $this->loadView($request['report_id']);

    }

    private function loadView($reportId){
        $report = Report::find($reportId);
        $logo = $report->site->company->logo_path;
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.report', ['logo'=> $logo,'report' => $report]);
        // return $pdf->download('report.pdf');
        return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
    }

    private function dom(){
        $path =  Media::latest()->first()->path['thumbnail'];

        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setisRemoteEnabled(true);
        $options->set('defaultFont', 'Courier');

        $dompdf = new Dompdf();
        $html = '<h4>hello world</h4>';

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $avatarData = file_get_contents($path, false, stream_context_create($arrContextOptions));
        $avatarBase64Data = base64_encode($avatarData);
        $imageData = 'data:image/' . $type . ';base64,' . $avatarBase64Data;

        $html .= '<img src=' . $imageData . '/>';


        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
