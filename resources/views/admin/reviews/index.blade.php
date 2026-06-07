<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Kelola Ulasan Pelanggan</h1>
        <p class="text-slate-400 text-sm mt-1">Daftar masukan dan rating yang diberikan oleh customer untuk setiap lapangan.</p>
    </div>

    <!-- Reviews Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Lapangan</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4">Komentar</th>
                        <th class="px-6 py-4">Tanggal Ulasan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($reviews as $review)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-200">{{ $review->user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $review->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-300">
                                {{ $review->field->nama_lapangan }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-amber-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-700' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                    <span class="ml-1.5 text-xs font-semibold text-slate-400">({{ $review->rating }}/5)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300 max-w-sm">
                                <div class="text-sm line-clamp-2" title="{{ $review->komentar }}">{{ $review->komentar }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $review->created_at->translatedFormat('d F Y H:i') }} WIB
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-rose-950 text-rose-400 hover:bg-rose-900 border border-rose-900 rounded-lg transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Belum ada ulasan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($reviews->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
