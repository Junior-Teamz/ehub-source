<?php

namespace App\Imports;

use App\Models\User;
use App\Models\ParticipantUser;
use App\Models\ParticipantBusiness;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToCollection, WithHeadingRow, WithChunkReading, WithValidation, WithMultipleSheets, WithBatchInserts, ShouldQueue
{
    protected $createdBy;

    public function __construct($createdBy) {
        $this->createdBy = $createdBy;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $filteredRows = $rows->reject(function ($row) {
            return $row->isEmpty();
        });

        try {
            DB::beginTransaction();
            foreach ($filteredRows as $row)
            {
                if (in_array($row['nama'], [null, ''])) {
                    continue;
                }

                $dateValue = $row['tanggal_lahir'];
                $dateValue = preg_replace('/\s+/', '', $dateValue);
                $dateValue = preg_replace('/\D/', '/', $dateValue);
                $formattedDate = $dateValue != null ? Date::excelToDateTimeObject((float)$dateValue)->format('Y-m-d') : null;

                $email = $row['email'] != null ? $row['email'] : 'ehub_' . Str::random(4) . mt_rand(100, 999) . '@gmail.com';
                $phone = $row['no_whatsapp'] != null ? $row['no_whatsapp'] : '08' . mt_rand(1000000000, 9999999999);

                // User model
                $dataUser = [
                    'fullname' => $row['nama'],
                    'email' => $email,
                    'phone' => $phone,
                    'password' => bcrypt('Ehub-' . Str::random(10) . mt_rand(100, 999)),
                    'born_place' => $row['tempat_lahir'],
                    'born_date' => $formattedDate,
                    'gender' => $row['jenis_kelamin'] === '' ? NULL : $row['jenis_kelamin'],
                    'state' => $row['kode_provinsi'] === '' ? NULL : $row['kode_provinsi'],
                    'city' => $row['kode_kabkota'] === '' ? NULL : $row['kode_kabkota'],
                    'sector' => $row['kode_kecamatan'] === '' ? NULL : $row['kode_kecamatan'],
                    'village' => $row['kode_kelurahan'] === '' ? NULL : $row['kode_kelurahan'],
                    'created_by' => $this->createdBy
                ];
                $user = User::updateOrCreate(['email' => $email], $dataUser);
                $user->assignRole('entrepreneur');

                // Participant user model
                $dataParticipantUser = [
                    'user_id' => $user->id,
                    'fullname' => $row['nama'],
                    'phone_number' => $phone,
                    'born_place' => $row['tempat_lahir'],
                    'born_date' => $formattedDate,
                    'gender' => $row['jenis_kelamin'] === '' ? NULL : $row['jenis_kelamin'],
                    'state_code' => $row['kode_provinsi'] === '' ? NULL : $row['kode_provinsi'],
                    'city_code' => $row['kode_kabkota'] === '' ? NULL : $row['kode_kabkota'],
                    'sector_code' => $row['kode_kecamatan'] === '' ? NULL : $row['kode_kecamatan'],
                    'village_code' => $row['kode_kelurahan'] === '' ? NULL : $row['kode_kelurahan'],
                ];
                $participantUser = ParticipantUser::updateOrCreate(['phone_number' => $phone], $dataParticipantUser);

                $userPlatforms = strtolower($row['platform']);
                $arrayUserPlatforms = explode(',', $userPlatforms);
                $availablePlatform = ['tokopedia', 'shopee', 'blibli', 'lazada', 'bukalapak', 'gojek', 'grab', 'lainnya'];
                if (!empty($arrayUserPlatforms)) {
                    for ($i = 0; $i < count($arrayUserPlatforms); $i++) {
                        if (!in_array($arrayUserPlatforms[$i], $availablePlatform)) {
                            $userPlatforms = $userPlatforms .',lainnya';
                            break;
                        }
                    }
                }
                // Participant business model
                $dataParticipantBusiness = [
                    'participant_id' => $participantUser->id,
                    'business_type_id' => $row['kode_jenis_usaha'],
                    'name' => $row['nama_bisnis'],
                    'address' => $row['alamat_usaha'],
                    'nib' => $row['nib'],
                    'nib_created_at' => $row['tahun_pembuatan_nib'],
                    'business_site' => $row['situs_usaha'],
                    'community' => $row['komunitas_usaha'],
                    'platforms' => $userPlatforms,
                    'ig_account' => $row['akun_ig'],
                    'fb_account' => $row['akun_fb'],
                    'tiktok_account' => $row['akun_tiktok'],
                ];
                $participantBusiness = ParticipantBusiness::updateOrCreate(['participant_id' => $participantUser->id], $dataParticipantBusiness);
            }
            DB::commit();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            DB::rollBack();
            $failures = $e->failures();
            return redirect()->back()->withErrors($failures);
        }
    }

    public function rules(): array
    {
        return [
            'nama' => 'nullable|min:5',
            'email' => 'nullable|email|min:5',
            'no_whatsapp' => 'nullable|min:10|max:15',
            'tanggal_lahir' => 'nullable',
            'nib' => 'nullable',
            'tahun_pembuatan_nib' => 'nullable|numeric',
            'jenis_kelamin' => 'nullable|in:male,female',
            'kode_provinsi' => 'nullable|numeric|exists:states,state_code',
            'kode_kabkota' => 'nullable|numeric|exists:cities,city_code',
            'kode_kecamatan' => 'nullable|numeric|exists:sectors,sector_code',
            'kode_kelurahan' => 'nullable|numeric|exists:villages,village_code',
            'kode_jenis_usaha' => 'nullable|numeric|exists:business_types,id',
        ];
    }

    public function batchSize(): int
    {
        return 250;
    }
    
    public function chunkSize(): int
    {
        return 10;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.min' => 'kolom Nama berisi minimal 5 karakter',
            'email.min' => 'kolom Email berisi minimal 5 karakter',
            'email.email' => 'kolom Email harus berisi email yang valid',
            'no_whatsapp.min' => 'kolom Nomor WhatsApp minimal 10 karakter',
            'no_whatsapp.max' => 'kolom Nomor WhatsApp maksimal 15 karakter',
            'no_whatsapp.unique' => 'kolom Nomor WhatsApp telah terdaftar sebelumnya.',
            'email.unique' => 'kolom Email telah terdaftar sebelumnya.',
            'jenis_kelamin.in' => 'kolom Jenis kelamin harus berisi data "male" atau "female".',
            'tahun_pembuatan_nib.numeric' => 'kolom tahun pembuatan NIB harus diisi dengan angka',
            'kode_provinsi.numeric' => 'kolom kode provinsi harus diisi dengan angka',
            'kode_kabkota.numeric' => 'kolom kode kota / kabupaten harus diisi dengan angka',
            'kode_kecamatan.numeric' => 'kolom kode kecamatan harus diisi dengan angka',
            'kode_kelurahan.numeric' => 'kolom kode kelurahan / desa harus diisi dengan angka',
            'kode_jenis_usaha.numeric' => 'kolom kode jenis usaha harus diisi dengan angka',
            'kode_provinsi.exists' => 'kolom kode provinsi tidak terdaftar di dalam daftar database',
            'kode_kabkota.exists' => 'kolom kode kota / kabupaten tidak terdaftar di dalam daftar database',
            'kode_kecamatan.exists' => 'kolom kode kecamatan tidak terdaftar di dalam daftar database',
            'kode_kelurahan.exists' => 'kolom kode kelurahan / desa tidak terdaftar di dalam daftar database',
            'kode_jenis_usaha.exists' => 'kolom kode jenis usaha tidak terdaftar di dalam daftar database',
        ];
    }
}
