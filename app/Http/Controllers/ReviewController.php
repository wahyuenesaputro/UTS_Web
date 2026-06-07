<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();
        $userId = Auth::id();

        // Optional check: Did user ever book this court?
        $hasBooked = Booking::where('user_id', $userId)
            ->where('field_id', $validated['field_id'])
            ->whereIn('status', ['selesai', 'disetujui'])
            ->exists();

        if (!$hasBooked) {
            return back()->with('error', 'Anda hanya dapat memberikan ulasan pada lapangan yang pernah Anda pesan sebelumnya.');
        }

        // Check if user already reviewed this court
        $alreadyReviewed = Review::where('user_id', $userId)
            ->where('field_id', $validated['field_id'])
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk lapangan ini.');
        }

        Review::create([
            'user_id' => $userId,
            'field_id' => $validated['field_id'],
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
        ]);

        return back()->with('success', 'Ulasan Anda berhasil dikirim.');
    }

    /**
     * Admin: Display all reviews.
     */
    public function adminIndex(Request $request)
    {
        $reviews = Review::with(['user', 'field'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Admin: Delete a review.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}
