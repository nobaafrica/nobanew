<?php

namespace App\Http\Livewire;

use App\Models\Partnership;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;

class DownloadAgreement extends Component
{
    public Partnership $partnership;

    public function exportPdf() {
        $data = $this->partnership;
        view()->share('partnership', $data);
        $pdf = PDF::loadView('livewire.download-agreement', $data); // <--- load your view into theDOM wrapper;
        $path = public_path('agreements'); // <--- folder to store the pdf documents into the server;
        $fileName = 'NOBAAFRICA_MOU'.time(). '.pdf' ; // <--giving the random filename,
        $pdf->save($path . '/' . $fileName);
        $generated_pdf_link = url('/agreements/'.$fileName);
        return redirect($generated_pdf_link);
    }

    public function render()
    {
        return view('livewire.download-agreement')->layout('layouts.guest');
    }
}

