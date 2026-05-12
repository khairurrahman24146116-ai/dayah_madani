@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-4 sm:px-6 py-4 bg-emerald-600">
        <h1 class="text-lg sm:text-xl font-bold text-white">Input Nilai - {{ $kelas->nama }} - {{ $mapel->nama }}</h1>
    </div>
    <div class="p-4 sm:p-6">
        <form action="{{ route('guru.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
            <div class="table-responsive">
                <table class="w-full table-auto border-collapse table-card">
                    <thead>
                        <tr class="bg-emerald-600 text-white">
                            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">NIS</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama Santri</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Tugas</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Nilai UTS</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Nilai UAS</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Akhir</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Predikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($santris as $i => $santri)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700" data-label="No">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700" data-label="NIS">{{ $santri->nis }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700" data-label="Nama">{{ $santri->nama_lengkap }}</td>
                            <td class="px-4 py-3 text-sm text-center" data-label="N. Tugas">
                                @php $nilaiExisting = $santri->nilai->first(); @endphp
                                <input type="number" name="nilai[{{ $santri->id }}][nilai_tugas]" value="{{ old('nilai.' . $santri->id . '.nilai_tugas', $nilaiExisting->nilai_tugas ?? '') }}" min="0" max="100" class="w-full sm:w-20 border border-gray-300 rounded-lg p-2 sm:p-1.5 text-center text-base sm:text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            </td>
                            <td class="px-4 py-3 text-sm text-center" data-label="N. UTS">
                                <input type="number" name="nilai[{{ $santri->id }}][nilai_uts]" value="{{ old('nilai.' . $santri->id . '.nilai_uts', $nilaiExisting->nilai_uts ?? '') }}" min="0" max="100" class="w-full sm:w-20 border border-gray-300 rounded-lg p-2 sm:p-1.5 text-center text-base sm:text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            </td>
                            <td class="px-4 py-3 text-sm text-center" data-label="N. UAS">
                                <input type="number" name="nilai[{{ $santri->id }}][nilai_uas]" value="{{ old('nilai.' . $santri->id . '.nilai_uas', $nilaiExisting->nilai_uas ?? '') }}" min="0" max="100" class="w-full sm:w-20 border border-gray-300 rounded-lg p-2 sm:p-1.5 text-center text-base sm:text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            </td>
                            <td class="px-4 py-3 text-sm text-center font-medium text-gray-800" data-label="N. Akhir">
                                @php
                                    $tugas = old('nilai.' . $santri->id . '.nilai_tugas', $nilaiExisting->nilai_tugas ?? 0);
                                    $uts = old('nilai.' . $santri->id . '.nilai_uts', $nilaiExisting->nilai_uts ?? 0);
                                    $uas = old('nilai.' . $santri->id . '.nilai_uas', $nilaiExisting->nilai_uas ?? 0);
                                    $akhir = ($tugas + $uts + $uas) / 3;
                                @endphp
                                {{ number_format($akhir, 0) }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center font-medium" data-label="Predikat">
                                @php
                                    if ($akhir >= 85) $pred = 'A';
                                    elseif ($akhir >= 75) $pred = 'B';
                                    elseif ($akhir >= 60) $pred = 'C';
                                    elseif ($akhir >= 50) $pred = 'D';
                                    else $pred = 'E';
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs font-semibold
                                    @if($pred == 'A') bg-green-100 text-green-800
                                    @elseif($pred == 'B') bg-blue-100 text-blue-800
                                    @elseif($pred == 'C') bg-yellow-100 text-yellow-800
                                    @elseif($pred == 'D') bg-orange-100 text-orange-800
                                    @else bg-red-100 text-red-800 @endif
                                ">{{ $pred }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500 empty-card">Tidak ada santri di kelas ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(count($santris) > 0)
            <div class="mt-6 mobile-stack">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition w-full sm:w-auto">Simpan Semua Nilai</button>
                <a href="{{ route('guru.nilai.print', [$kelas->id, $mapel->id]) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition text-center w-full sm:w-auto">Cetak PDF</a>
                <a href="{{ route('guru.nilai.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition text-center w-full sm:w-auto">Kembali</a>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) this.value = 0;
            if (this.value > 100) this.value = 100;
        });
    });
</script>
@endpush
