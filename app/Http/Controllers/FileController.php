<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function editFilesView()
    {
        $studentId = auth()->id();
        $file = File::where('student_id', $studentId)->first();

        $pdfTextPath = $file ? Storage::url('pdf_texts/' . $file->pdf_text) : null; // cesta k PDF
        return view('editFiles', ['pdfTextPath' => $pdfTextPath]);
    }

    public function editPdfText(Request $request)
    {
        $studentId = auth()->id();
        $file = $request->file('pdf_text');

        $filePath = $file->storeAs('pdf_texts', $studentId . '_pdf_text.pdf'); // súbor na sa ulozi

        File::where('student_id', $studentId)->update([ // ulozi sa odkaz do DB
            'pdf_text' => $filePath,
        ]);

        return redirect()->route('editFiles')->with('success', 'PDF Text bol úspešne aktualizovaný.');
    }

    public function downloadPdfText($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->pdf_text &&  Storage::exists($file->pdf_text)) {
            return Storage::download($file->pdf_text);
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function deletePdfText($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->pdf_text &&  Storage::exists($file->pdf_text)) {
            Storage::delete($file->pdf_text);
            File::where('student_id', $studentId)->update([
                'pdf_text' => null,
            ]);
            return redirect()->route('editFiles')->with('success', 'PDF Text bol úspešne odstránený.');
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function editZipPrilohy(Request $request)
    {
        $studentId = auth()->id();
        $file = $request->file('zip_prilohy');
        $filePath = $file->storeAs('zip_prilohy', $studentId . '_zip_prilohy.zip');

        File::where('student_id', $studentId)->update([
            'zip_prilohy' => $filePath,
        ]);

        return redirect()->route('editFiles')->with('success', 'Zip Prilohy boli úspešne aktualizovane.');
    }

    public function downloadZipPrilohy($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->zip_prilohy &&  Storage::exists($file->zip_prilohy)) {
            return Storage::download($file->zip_prilohy);
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function deleteZipPrilohy($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->zip_prilohy &&  Storage::exists($file->zip_prilohy)) {
            Storage::delete($file->zip_prilohy);
            File::where('student_id', $studentId)->update([
                'zip_prilohy' => null,
            ]);

            return redirect()->route('editFiles')->with('success', 'Zip Prilohy boli úspešne odstránene.');
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function editPdfOriginalita(Request $request)
    {
        $studentId = auth()->id();
        $file = $request->file('pdf_originalita');
        $filePath = $file->storeAs('pdf_originalita', $studentId . '_pdf_originalita.pdf');

        File::where('student_id', $studentId)->update([
            'pdf_originalita' => $filePath,
        ]);

        return redirect()->route('editFiles')->with('success', 'PDF Text bol úspešne aktualizovaný.');
    }

    public function downloadPdfOriginalita($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->pdf_originalita &&  Storage::exists($file->pdf_originalita)) {
            return Storage::download($file->pdf_originalita);
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function deletePdfOriginalita($id)
    {
        if ($id){$studentId = $id;}
        else {$studentId = auth()->id();}
        $file = File::where('student_id', $studentId)->first();

        if ($file && $file->pdf_originalita &&  Storage::exists($file->pdf_originalita)) {
            Storage::delete($file->pdf_originalita);

            File::where('student_id', $studentId)->update([
                'pdf_originalita' => null,
            ]);

            return redirect()->route('editFiles')->with('success', 'PDF Text bol úspešne odstránený.');
        } else {
            return redirect()->route('editFiles')->with('failure', 'Súbor neexistuje.');
        }
    }

    public function showFiles()
    {
        $files = File::all();

        return view('adminFiles', compact('files'));
    }
}