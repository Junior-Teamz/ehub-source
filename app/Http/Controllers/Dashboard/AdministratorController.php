<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $data['keyword'] = $params['keyword'] = $request->keyword ?? null;
        $administrators = User::whereHas('roles', function($query) {
            return $query->whereIn('name', ['institution', 'collaborator']);
        });
        $perPage = $request->perPage ?? 10;

        if (!Auth::user()->hasRole('admin')) {
            $administrators->where('created_by', Auth::user()->id);
        }

        if ($keyword) {
            $administrators->where( function($query) use($keyword) {
                $query->where('fullname', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('email', 'LIKE', '%'.$keyword.'%');
                $query->orWhere('phone', 'LIKE', '%'.$keyword.'%');
                $query->orWhereHas('hasCollaborator', function($collaborator) use($keyword) {
                    $collaborator->where('name', 'LIKE', '%'.$keyword.'%');
                });
            });
        }

        $data['administrators'] = $administrators->latest()->paginate($perPage)->setPath(route('dashboard.administrators.index', $params));
        return view('dashboard.administrators.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['collaborators'] = Collaborator::all();
        
        return view('dashboard.administrators.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'phone_number' => 'required',
                'fullname' => 'required',
                'role_name' => 'required',
                'collaborator_id' => 'required',
            ]);

            if ($validator->fails()) {
                $inputWithoutStatus = $request->input();
                unset($inputWithoutStatus['is_active']);
                return back()->withErrors($validator)->withInput($inputWithoutStatus);
            }

            DB::beginTransaction();
            $collaborator = Collaborator::find($request->collaborator_id);
            $dataUser = [
                'email' => $request->email,
                'fullname' => $request->fullname,
                'username' => $request->email,
                'phone' => $request->phone_number,
                'password' => bcrypt('EHUB-'.$request->phone_number),
                'created_by' => $collaborator->user_id,
                'is_active' => $request->is_active ?? false,
            ];
            $saveUser = User::create($dataUser);
            $saveUser->assignRole($request->role_name);

            DB::commit();
            Alert::success('Sukses', 'Data berhasil disimpan!');
            return redirect(route('dashboard.administrators.index'));
        } catch(\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['collaborators'] = Collaborator::all();

        return view('dashboard.administrators.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'phone_number' => 'required',
                'fullname' => 'required',
                'role_name' => 'required',
                'collaborator_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            $user = User::find($id);
            $collaborator = Collaborator::find($request->collaborator_id);
            $dataUser = [
                'email' => $request->email,
                'fullname' => $request->fullname,
                'username' => $request->email,
                'phone' => $request->phone_number,
                'is_active' => $request->is_active ?? false,
                'created_by' => $collaborator->user_id,
            ];
            $user->update($dataUser);
            $user->assignRole($request->role_name);

            DB::commit();
            Alert::success('Sukses', 'Data berhasil diperbarui!');
            return redirect(route('dashboard.administrators.index'));
        } catch(\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatePassword($id) 
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $password = Str::random(10);
            if (!$user->update(['password' => bcrypt($password)])) {
                return sendApiResponse(false, 'Password gagal diperbarui', [], 200);
            }
            DB::commit();
            return sendApiResponse(true, 'Password berhasil diperbarui.', ['password' => $password, 'email' => $user->email], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            Alert::error('Error', 'Terjadi kesalahan teknis, silakan kontak customer service kami');
            return sendApiResponse(false, 'Terjadi kesalahan teknis, silakan kontak customer service kami', null, 500);
        }
    }
}
