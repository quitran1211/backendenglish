<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VocabularyController extends Controller
{
    /**
     * ===============================
     * DANH SÁCH TỪ VỰNG
     * ===============================
     */
    public function index(Request $request)
    {
        $query = Vocabulary::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('word', 'like', '%'.$request->keyword.'%')
                    ->orWhere('meaning_vi', 'like', '%'.$request->keyword.'%')
                    ->orWhere('meaning_en', 'like', '%'.$request->keyword.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $vocabularies = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.vocabularies.index', compact('vocabularies'));
    }

    public function showImportForm()
    {
        return view('admin.vocabularies.importExcel'); // tạo view import.blade.php
    }

    /**
     * ===============================
     * FORM TẠO TỪ MỚI
     * ===============================
     */
    public function create()
    {
        return view('admin.vocabularies.create');
    }

    /**
     * ===============================
     * LƯU TỪ MỚI
     * ===============================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'word' => 'required|string|max:255|unique:vocabulary,word',
            'pronunciation' => 'nullable|string|max:255',
            'word_type' => 'nullable|string|max:50',
            'meaning_vi' => 'required|string',
            'meaning_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Vocabulary::create($data);

        return redirect()
            ->route('vocabularies.index')
            ->with('success', 'Thêm từ vựng thành công');
    }

    /**
     * ===============================
     * FORM CHỈNH SỬA
     * ===============================
     */
    public function edit(Vocabulary $vocabulary)
    {
        return view('admin.vocabularies.edit', compact('vocabulary'));
    }

    /**
     * ===============================
     * CẬP NHẬT
     * ===============================
     */
    public function update(Request $request, Vocabulary $vocabulary)
    {
        $data = $request->validate([
            'word' => 'required|string|max:255|unique:vocabularies,word,'.$vocabulary->id,
            'pronunciation' => 'nullable|string|max:255',
            'word_type' => 'nullable|string|max:50',
            'meaning_vi' => 'required|string',
            'meaning_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $vocabulary->update($data);

        return redirect()
            ->route('vocabularies.index')
            ->with('success', 'Cập nhật từ vựng thành công');
    }

    public function show(string $id)
    {
        $vocabulary = Vocabulary::find($id);

        return view('admin.vocabularies.show', compact('vocabulary'));
    }

    /**
     * ===============================
     * XOÁ (SOFT DELETE)
     * ===============================
     */
    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->delete();

        return back()->with('success', 'Đã xoá từ vựng');
    }

    /**
     * ===============================
     * IMPORT EXCEL (GLOBAL)
     * ===============================
     * File gồm các cột:
     * word | pronunciation | word_type | meaning_vi | meaning_en
     */
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:xlsx,xls,csv',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $spreadsheet = IOFactory::load($request->file('file')->getPathname());
    //         $rows = $spreadsheet->getActiveSheet()->toArray();

    //         // Bỏ header
    //         unset($rows[0]);

    //         $inserted = 0;

    //         foreach ($rows as $row) {
    //             [
    //                 $word,
    //                 $pronunciation,
    //                 $wordType,
    //                 $meaningVi,
    //                 $meaningEn
    //             ] = array_pad($row, 5, null);

    //             if (! $word || ! $meaningVi) {
    //                 continue;
    //             }

    //             Vocabulary::firstOrCreate(
    //                 ['word' => trim($word)],
    //                 [
    //                     'pronunciation' => $pronunciation,
    //                     'word_type' => $wordType,
    //                     'meaning_vi' => $meaningVi,
    //                     'meaning_en' => $meaningEn,
    //                     'is_active' => true,
    //                 ]
    //             );

    //             $inserted++;
    //         }

    //         DB::commit();

    //         return redirect()
    //             ->route('vocabularies.index')
    //             ->with('success', "Import thành công {$inserted} từ vựng");

    //     } catch (\Throwable $e) {
    //         DB::rollBack();

    //         return back()->withErrors([
    //             'file' => 'Lỗi import: '.$e->getMessage(),
    //         ]);
    //     }
    // }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        DB::beginTransaction();

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            if (count($rows) === 0) {
                throw new \Exception('File Excel trống');
            }

            /* ================= VALIDATE HEADER ================= */
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            if (count($rows) < 2) {
                throw new \Exception('File Excel không có dữ liệu');
            }

            /* ================= VALIDATE HEADER ================= */
            $expectedHeader = ['word', 'pronunciation', 'word_type', 'meaning_vi', 'meaning_en'];

            // Chuẩn hóa header từ Excel
            $header = array_map(fn ($cell) => strtolower(trim((string) $cell)), $rows[0]);

            // Kiểm tra từng cột
            foreach ($expectedHeader as $i => $col) {
                if (! isset($header[$i]) || $header[$i] !== $col) {
                    throw new \Exception(
                        'File Excel không đúng định dạng cột ở cột '.($i + 1).
                        '. Thứ tự đúng: '.implode(', ', $expectedHeader)
                    );
                }
            }

            // Bỏ header
            array_shift($rows);

            $inserted = 0;
            $duplicates = [];

            foreach ($rows as $index => $row) {
                // Đảm bảo đủ 5 cột
                [$word, $pronunciation, $wordType, $meaningVi, $meaningEn] = array_pad($row, 5, null);

                // Bỏ qua dòng trống
                if (! $word || ! $meaningVi) {
                    continue;
                }

                $word = trim($word);

                // Kiểm tra trùng lặp
                if (Vocabulary::where('word', $word)->exists()) {
                    $duplicates[] = $word;

                    continue;
                }

                Vocabulary::create([
                    'word' => $word,
                    'pronunciation' => $pronunciation,
                    'word_type' => $wordType,
                    'meaning_vi' => $meaningVi,
                    'meaning_en' => $meaningEn,
                    'is_active' => true,
                ]);

                $inserted++;
            }

            DB::commit();

            // Chuẩn bị thông báo
            $message = "Import thành công {$inserted} từ vựng.";
            if (count($duplicates) > 0) {
                $message .= ' Các từ trùng lặp không được thêm: '.implode(', ', $duplicates);
            }

            return redirect()
                ->route('vocabularies.index')
                ->with('success', $message);

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->withErrors([
                'file' => 'Lỗi import: '.$e->getMessage(),
            ]);
        }
    }

    /**
     * ===============================
     * BẬT / TẮT TRẠNG THÁI
     * ===============================
     */
    public function toggleStatus(Vocabulary $vocabulary)
    {
        $vocabulary->update([
            'is_active' => ! $vocabulary->is_active,
        ]);

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * ===============================
     * THÙNG RÁC
     * ===============================
     */
    public function trash()
    {
        $vocabularies = Vocabulary::onlyTrashed()
            ->latest('deleted_at')
            ->paginate(15);

        return view('admin.vocabularies.trash', compact('vocabularies'));
    }

    /**
     * ===============================
     * KHÔI PHỤC
     * ===============================
     */
    public function restore($id)
    {
        Vocabulary::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return back()->with('success', 'Khôi phục từ vựng thành công');
    }

    /**
     * ===============================
     * XOÁ VĨNH VIỄN
     * ===============================
     */
    public function forceDelete($id)
    {
        Vocabulary::onlyTrashed()
            ->findOrFail($id)
            ->forceDelete();

        return back()->with('success', 'Đã xoá vĩnh viễn');
    }
}
