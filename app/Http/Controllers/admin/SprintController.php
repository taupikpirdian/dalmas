<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sprint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DocumentationSprint;
use Illuminate\Support\Facades\Auth;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sprint.index');
    }

    public function datatable(Request $request)
    {
        if (request()->ajax()) {
            $role = Auth::user()->roles[0]->name;

            /**
             * column shown in the table
             */
            // check from model Report
            $columns = [
                'nomor',
                'start_date',
                'end_date',
                'nrp',
                'users.name',
                'jabatan',
                'satuan',
                'created_at',
                'created_by',
            ];

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $posts = Sprint::select([
                'sprints.*',
            ])->orderBy('created_at', 'desc');

            if ($request->search['value']) {
                $posts = $posts->where('users.name', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('nomor', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('nrp', 'like', '%' . $request->search['value'] . '%');
            }

            $totalData = $posts->count();
            $posts = $posts->skip($start)->take($limit)->orderBy($order, $dir)->get();
            $data = array();
            if (!empty($posts)) {
                foreach ($posts as $key => $post) {
                    $button = '';
                    $button .= '<a href="' . route('dashboard.sprint.show', $post->id) . '" type="button" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>';

                    $button .= '<a href="' . route('dashboard.sprint.edit', $post->id) . '" type="button" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                    // $button .= '<a href="' . route('dashboard.perkaras.tindakLanjut', $post->id) . '" type="button" class="btn btn-sm btn-primary" title="Tindak Lanjut">
                    //         <i class="fas fa-book"></i>
                    //     </a>';

                    // $button .= '<a href="' . route('dashboard.sprint.cetak', $post->id) . '" type="button" class="btn btn-sm btn-warning" title="Download PDF">
                    //     <i class="fas fa-download"></i>
                    // </a>';

                    $button .= '<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteData(' . $post->id . ')">
                                <i class="fas fa-trash"></i>
                            </button>';

                    $htmlButton = '<div class="btn-group" role="group">
                            ' . $button . '
                        </div>';

                    $nestedData['nomor'] = $post->nomor;
                    $nestedData['nrp'] = $post->nrp;
                    $nestedData['name'] = $post->nama;
                    $nestedData['jabatan'] = $post->jabatan;
                    $nestedData['satuan'] = $post->satuan;
                    $nestedData['start_date'] = $post->start_date;
                    $nestedData['end_date'] = $post->end_date;

                    $status = "-";
                    if ($post->status == "process") {
                        $status = '<span class="badge bg-info">Berlangsung</span>';
                    } else if ($post->status == "selesai") {
                        $status = '<span class="badge bg-success">Selesai</span>';
                    }

                    $nestedData['created_at'] = Carbon::parse($post->created_at)->format('d/m/Y H:i');
                    $nestedData['created_by'] = $post->user->name ?? "-";
                    $nestedData['status'] = $status;
                    $nestedData['action'] = $htmlButton;
                    $nestedData['DT_RowIndex'] = ($key + 1) + $start;

                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data"            => $data
            );

            return response()->json($json_data);
        }
    }

    public function datatablePublic(Request $request)
    {
        if (request()->ajax()) {
            /**
             * column shown in the table
             */
            // check from model Report
            $columns = [
                'nomor',
                'start_date',
                'end_date',
                'nrp',
                'users.name',
                'jabatan',
                'satuan',
                'created_at',
                'created_by',
            ];

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $posts = Sprint::select([
                'sprints.*',
            ])->orderBy('created_at', 'desc');

            if ($request->search['value']) {
                $posts = $posts->where('users.name', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('nomor', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('nrp', 'like', '%' . $request->search['value'] . '%');
            }

            $totalData = $posts->count();
            $posts = $posts->skip($start)->take($limit)->orderBy($order, $dir)->get();
            $data = array();
            if (!empty($posts)) {
                foreach ($posts as $key => $post) {
                    $nestedData['nomor'] = $post->nomor;
                    $nestedData['nrp'] = $post->nrp;
                    $nestedData['name'] = $post->nama;
                    $nestedData['jabatan'] = $post->jabatan;
                    $nestedData['start_date'] = $post->start_date;
                    $nestedData['end_date'] = $post->end_date;

                    $status = "-";
                    if ($post->status == "process") {
                        $status = '<span class="badge bg-info">Berlangsung</span>';
                    } else if ($post->status == "selesai") {
                        $status = '<span class="badge bg-success">Selesai</span>';
                    }
                    $nestedData['status'] = $status;
                    $nestedData['DT_RowIndex'] = ($key + 1) + $start;

                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data"            => $data
            );

            return response()->json($json_data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_edit = false;
        $data = null;
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'personil');
        })->orderBy('name', 'asc')->get();

        return view('admin.sprint.create', compact('is_edit', 'data', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'nama' => ['required'],
            'jenis_tugas' => ['required'],
            'pangkat' => ['required'],
            'nrp' => ['required'],
            'jabatan' => ['required'],
        ], [
            'nomor.required' => 'nomor wajib diisi.',
            'start_date.required' => 'tanggal mulai wajib diisi.',
            'end_date.required' => 'tanggal selesai wajib diisi.',
            'nama.required' => 'nama wajib diisi.',
            'jenis_tugas.required' => 'jenis tugas wajib diisi.',
            'pangkat.required' => 'pangkat wajib diisi.',
            'nrp.required' => 'nrp wajib diisi.',
            'jabatan.required' => 'jabatan wajib diisi.',
        ]);
        try {
            DB::beginTransaction();
            // Parse tanggal
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate   = Carbon::parse($request->end_date)->endOfDay();

            // Validasi NRP dengan date range yang overlap
            $exists = Sprint::where('nrp', $request->nrp)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'NRP sudah terdaftar pada periode yang sama.');
            }
            /**
             * validasi
             * jika ada nrp terdaftar di db dengan date range yang sama, balikan error
             */
            // Create user
            Sprint::create([
                'user_id' => $request->user_id,
                'nomor' => $request->nomor,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'nama' => $request->nama,
                'pangkat' => $request->pangkat,
                'nrp' => $request->nrp,
                'jabatan' => $request->jabatan,
                'satuan' => $request->satuan,
                'pertimbangan' => $request->pertimbangan,
                'dasar' => $request->dasar,
                'jenis_tugas' => $request->jenis_tugas,
                'tugas' => $request->tugas,
                'tembusan' => $request->tembusan,
                'created_by' => Auth::user()->id
            ]);

            DB::commit();
            return redirect()->route('dashboard.sprint.index')
                ->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Sprint::with('files')->where('id', $id)->first();
        return view('admin.sprint.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $is_edit = true;
        $data = Sprint::where('id', $id)->first();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'personil');
        })->orderBy('name', 'asc')->get();

        return view('admin.sprint.create', compact('is_edit', 'data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nomor' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'nama' => ['required'],
            'jenis_tugas' => ['required'],
            'pangkat' => ['required'],
            'nrp' => ['required'],
            'jabatan' => ['required'],
        ], [
            'nomor.required' => 'nomor wajib diisi.',
            'start_date.required' => 'tanggal mulai wajib diisi.',
            'end_date.required' => 'tanggal selesai wajib diisi.',
            'nama.required' => 'nama wajib diisi.',
            'jenis_tugas.required' => 'jenis tugas wajib diisi.',
            'pangkat.required' => 'pangkat wajib diisi.',
            'nrp.required' => 'nrp wajib diisi.',
            'jabatan.required' => 'jabatan wajib diisi.',
        ]);
        try {
            DB::beginTransaction();
            $sprint = Sprint::findOrFail($id);
            // Parse tanggal
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate   = Carbon::parse($request->end_date)->endOfDay();

            // Validasi NRP dengan date range yang overlap, kecuali id ini
            $exists = Sprint::where('nrp', $request->nrp)
                ->where('id', '!=', $id)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'NRP sudah terdaftar pada periode yang sama.');
            }

            $sprint->update([
                'nama' => $request->nama,
                'user_id'     => $request->user_id,
                'nomor'       => $request->nomor,
                'start_date'   => $startDate,
                'end_date'     => $endDate,
                'pangkat'     => $request->pangkat,
                'nrp'         => $request->nrp,
                'jabatan'     => $request->jabatan,
                'satuan'      => $request->satuan,
                'pertimbangan' => $request->pertimbangan,
                'dasar'       => $request->dasar,
                'tugas'       => $request->tugas,
                'tembusan'    => $request->tembusan,
                'jenis_tugas'    => $request->jenis_tugas,
            ]);

            DB::commit();
            return redirect()->route('dashboard.sprint.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $data = Sprint::findOrFail($id);
            $data->delete();
            DB::commit();
            return redirect()->route('dashboard.sprint.index')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function penugasanUpload()
    {
        return view('public.upload');
    }

    public function aksesUpload(Request $request)
    {
        $token = (string) Str::uuid();
        $nrp = $request->nrp;
        $nomor = $request->nomor;

        $sprint = Sprint::where('nomor', $nomor)->where('nrp', $nrp)->where('status', "process")->first();
        if (!$sprint) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Periksa kembali nomor dan nrp Anda.');
        }

        if (empty($sprint->token) || $sprint->expires_at < now()) {
            $sprint->token = $token;
            $sprint->expires_at = now()->addMinute(10);
            $sprint->save();
        } else {
            $token = $sprint->token;
        }

        return redirect()->route('public.sprint.upload-page', $sprint->id)->with('success', 'Berhasil akses');
    }

    public function uploadPage(Request $request, $id)
    {
        $sprint = Sprint::where('id', $id)->first();
        if (!$sprint) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Periksa kembali nomor dan nrp Anda.');
        }
        if (empty($sprint->token) || $sprint->expires_at < now()) {
            return redirect()->route('public.sprint.upload')->with('error', 'Akses habis');
        }

        $token = $sprint->token;
        $nrp = $sprint->nrp;
        $nomor = $sprint->nomor;

        return view('public.upload-akses', [
            'token' => $token,
            'nrp' => $nrp,
            'nomor' => $nomor,
            'expires_at' => $sprint->expires_at,
            'id' => $id
        ]);
    }

    public function uploadPageStore(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $sprint = Sprint::findOrFail($id);

            // 1. Validasi
            $request->validate([
                'files' => 'required|array',
                'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // hanya gambar max 2MB
                'token' => 'required|string',
            ]);

            // cek token dan expired
            if (!$sprint->token || $sprint->token !== $request->token || !$sprint->expires_at || now()->greaterThan($sprint->expires_at)) {
                return back()->withErrors(['token' => 'Token tidak valid atau sudah expired.']);
            }

            // 2. Simpan multiple file ke storage
            foreach ($request->file('files') as $file) {
                $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('sprints/' . $sprint->id, $filename, 'public');

                // 3. Masukkan metadata ke table DocumentationSprint
                DocumentationSprint::create([
                    'sprint_id'      => $sprint->id,
                    'name'           => $filename,
                    'path'           => $path,
                    'original_name'  => $file->getClientOriginalName(),
                ]);
            }

            // 4. Remove token setelah submit
            $sprint->token = null;
            $sprint->expires_at = null;
            $sprint->status = "selesai";
            $sprint->save();

            // 5. Redirect ke home
            DB::commit();
            return redirect()->route('welcome.index')->with('success', 'Upload berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
