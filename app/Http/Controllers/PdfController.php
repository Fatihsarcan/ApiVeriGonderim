<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PdfController extends Controller
{
    public function sendPdf(Request $request)
    {   
        // Dosya doğrulama
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:5120', // Maksimum dosya boyutu 5MB
            'sertifikaNo' => 'required|string',
            'isim' => 'required|string',
            'soyisim' => 'required|string',
        ]); 

        // Dosyayı al
        $pdfFile = $request->file('pdf');
        $sertifikaNo = $request->input('sertifikaNo');
        $isim = $request->input('isim');
        $soyisim = $request->input('soyisim');
        // Dosyayı API'ye gönder
        $response = Http::attach(
            'file', file_get_contents($pdfFile->getPathname()), $pdfFile->getClientOriginalName()
        )->post('http://127.0.0.1:8000/api/upload',[
            'sertifikaNo' => $sertifikaNo,
            'isim' => $isim,
            'soyisim' => $soyisim,
        ] );


        \Log::info($response->body());

        // API yanıtını kontrol et
        if ($response->successful()) {
            return response()->json(['succes'=>'başarili']);
        } else {
            return response()->json(['succes'=>'başarisiz']);
        }
      
    }
       
}