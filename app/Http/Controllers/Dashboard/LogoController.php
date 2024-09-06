<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DestinationDisk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JourneyLogo;
use App\Models\JourneySection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class LogoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $data['keyword'] = $request->keyword ?? null;
        $type = $data['type'] = $params['type'] = $request->type ?? 'plan';
        $logos = JourneyLogo::with(['hasPage', 'hasSection']);
        $perPage = $request->perPage ?? 10;

        if ($type == 'plan') {
            $logos = $logos->where('page_id', 1);
        } elseif ($type == 'launch') {
            $logos = $logos->where('page_id', 2);
        } elseif ($type == 'growth') {
            $logos = $logos->where('page_id', 3);
        }

        if ($keyword) {
            $params['keyword'] = $keyword;
            $logos->where(function($query) use($keyword) {
                $query->where('logo_name', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('website', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasSection', function($sections) use($keyword) {
                    $sections->where('section_name', 'LIKE', '%'.$keyword.'%');
                });
            });
        }
        
        $data['logos'] = $logos->latest()->paginate($perPage)->setPath(route('dashboard.logos.index', $params));
        return view('dashboard.logos.index', $data);
    }

    public function create(Request $request)
    {
        $type = $data['type'] = $params['type'] = $request->type ?? 'plan';
        $sections = JourneySection::all();

        if ($type == 'plan') {
            $sections = $sections->where('page_id', 1);
        } elseif ($type == 'launch') {
            $sections = $sections->where('page_id', 2);
        } elseif ($type == 'growth') {
            $sections = $sections->where('page_id', 3);
        }
    
        $data['sections'] = $sections;
        return view('dashboard.logos.create', $data);
    }

    public function store(Request $request)
    {
        try {
            // input validation
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'website' => 'required|max:255',
                'section_id' => 'required|exists:journey_sections,id',
                'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
                'status' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['status']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }
            
            $section = JourneySection::where('id', $request->section_id)->first();
            DB::beginTransaction();
            $dataLogo = [
                'logo_name' => $request->title,
                'website' => $request->website,
                'section_id' => $request->section_id,
                'page_id' => $section->page_id,
                'status' => $request->status,
                'url_logo' => '',
            ];
           
            
            $saveLogo = JourneyLogo::create($dataLogo);

            if ($request->hasFile('logo')) {
                $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs(DestinationDisk::COMMUNITIES . "/{$saveLogo->id}", $fileName, 'public');
                $logoStorage = '/storage/' . $filePath;
                $logo = JourneyLogo::find($saveLogo->id);
                $logo->update(['url_logo' => $logoStorage]);
            }

            DB::commit();

            // Tampilkan pesan sukses
            Alert::success('Sukses', 'Logo telah berhasil ditambahkan.');

            return redirect()->route('dashboard.logos.index');
        } catch (\Exception $e) {
            DB::rollBack();

            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back();
        }
    }

    public function edit($id)
    {
       $sections  = JourneySection::all();
       $logos  = JourneyLogo::find($id);
        if ($logos->page_id == 1) {
            $sections = $sections->where('page_id', 1);
        } elseif ($logos->page_id == 2) {
            $sections = $sections->where('page_id', 2);
        } elseif ($logos->page_id == 3) {
            $sections = $sections->where('page_id', 3);
        }
        $data['logos'] = $logos;    
        $data['sections'] = $sections;
        return view('dashboard.logos.edit', $data);
    }

    public function update(Request $request, $id)
{
    try {
        // input validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'website' => 'required|max:255',
            'section_id' => 'required|exists:journey_sections,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:8192',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Search logo based on ID
        $logo = JourneyLogo::find($id);

        if (!$logo) {
            return redirect()->route('dashboard.logos.index')->with('error', 'Logo tidak ditemukan');
        }
        DB::beginTransaction();
        // Update data logo
        $logo->logo_name = $request->input('title');
        $logo->website = $request->input('website');
        $logo->status = $request->input('status');
        $logo->section_id = $request->input('section_id');

        // Image upload
        if ($request->hasFile('logo')) {
            if (Storage::exists($logo->logo_url)) {
                Storage::delete($logo->logo_url);
            }
            $fileName = time() .'_'.$request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs(DestinationDisk::COMMUNITIES . "/{$logo->id}", $fileName, 'public');
            $logoStorage = '/storage/' . $filePath;
            $logo = JourneyLogo::find($logo->id);
            $logo->update(['url_logo' => $logoStorage]);
        }
        // Save
        $logo->save();

        DB::commit();

        // Success Message
        Alert::success('Sukses', 'Logo telah berhasil diperbarui.');

        return redirect()->route('dashboard.logos.index');
    } catch (\Exception $e) {
        DB::rollBack();

        if (App::environment('production')) {
            errorLog(basename(__FILE__), __LINE__, $e->getMessage());
        }

        Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
        return back();
    }
}

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $currentLogo = JourneyLogo::find($id);
            if ($currentLogo->delete()) {
                $disk = Storage::disk('public');
                $disk->deleteDirectory(DestinationDisk::COMMUNITIES . "/{$currentLogo->id}");
            }
            DB::commit();
            Alert::success('Sukses', 'Data berhasil dihapus');
            return redirect(route('dashboard.logos.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis. silakan kontak customer service kami.');
            return back();
        }
    }
}
