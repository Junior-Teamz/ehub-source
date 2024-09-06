<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['umkm'] = collect([
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Binford Ltd.',
                'description' => 'Pengembangan wirausaha indonesia akan menyebar ke berbagai kota di Seluruh Indonesia',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Tami Riyanti',
                    'location' => 'Jakarta'
                ]
            ],
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Bluth Company',
                'description' => 'Jasa layanan panggilan untuk pembersihan dan sterilisasi hewan kesayangan anda dan berbagai macam atribut yang digunakannya',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Nasab Hakim',
                    'location' => 'Jakarta'
                ]
            ],
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Soylent Corp',
                'description' => 'Jasa layanan panggilan untuk pembersihan dan sterilisasi hewan kesayangan anda dan berbagai macam atribut yang digunakannya',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Hadi Winarno S.Pt',
                    'location' => 'Sragen'
                ]
            ],
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Initech',
                'description' => 'Jasa layanan panggilan untuk pembersihan dan sterilisasi hewan kesayangan anda dan berbagai macam atribut yang digunakannya',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Luhung Murti Jailani S.E.',
                    'location' => 'Surabaya'
                ]
            ],
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Globex Corporation',
                'description' => 'Jasa layanan panggilan untuk pembersihan dan sterilisasi hewan kesayangan anda dan berbagai macam atribut yang digunakannya',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Yuni Mulyani S.E.I',
                    'location' => 'Pekalongan'
                ]
            ],
            (object) [
                'image' => 'https://www.linkpicture.com/q/Rectangle-46.png',
                'title' => 'Stark Industries',
                'description' => 'Jasa layanan panggilan untuk pembersihan dan sterilisasi hewan kesayangan anda dan berbagai macam atribut yang digunakannya',
                'umkm'  => (object) [
                    'logo' => 'https://gcdnb.pbrd.co/images/j0nuCXGx2uwe.png?o=1',
                    'name' => 'Amalia Rahmi Widiastuti S.Gz',
                    'location' => 'Solo'
                ]
            ],
        ]);
        return view('landing.courses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
