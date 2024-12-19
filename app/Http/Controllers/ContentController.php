<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Content::with('likes') adalah mengambil jumlah like dari konten tersebut
        // where('id_users', Auth::id()) adalah mengambil konten yang hanya di buat oleh pengguna 
        // latest() adalah untuk mengurutkan konten berdasarkan waktu konten di buat

        // $contents = Content::with('likes')->where('id_users', Auth::id())->latest()->paginate(10);
        // return view('profile.index', compact('contents'));

        //mengambil id user dan akan di jadikan data username
        $contents = Content::with(['likes', 'user', 'comments'])->where('id_users', Auth::id())->latest()->get();
        return view('profile.index',['title' => 'Profil - Web Media'], compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create'); // Assuming you have a create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
            'id_users' => 'nullable',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/contents', $image->hashName());
        
        // jika di tambah maka all akan ada di databases tapi kalo kosong all juga bakal ada
        $kategori = $request->kategori ? 'all ' . $request->kategori : 'all';

        Content::create([
            'image' => $image->hashName(),
            'tanggal' => $request->tanggal ?? now(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $kategori,
            'id_users' => Auth::id(),
        ]);

        return redirect()->route('profile.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $content = Content::findOrFail($id);
        $content = Content::with('likes.user')->findOrFail($id);
        return view('profile.index', compact('contents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content = Content::findOrFail($id);
        return view('profile.edit',['title' => 'Edit Content - Web Media'], compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
        ]);

        $content = Content::findOrFail($id);

        $kategori = $request->kategori ? 'all ' . $request->kategori : 'all';
        
        $content->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $kategori,
        ]);

        return redirect()->route('profile.index')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content = Content::findOrFail($id);
        Storage::delete('public/contents/'. $content->image);
        $content->delete();
        return redirect()->route('profile.index')->with(['success' => 'Content Berhasil Dihapus!']);
    }

    /**
     * Like or unlike a content.
     */


    // ini function likenya 
    public function like($contentId)
    {
        //membuat var baru
        //dan Like ini di ambil dari models / table like
        $like = Like::where('id_contents', $contentId) //where(dimana) mengambil data dari tabel like / models(like) di mana kolom id_contents sama dengan $contentId
            ->where('id_users', Auth::id()) //mengambil data dari table like dimana kolom id_users sama dengan id pengguna yang sedang login
            ->first(); //  Mengambil record pertama yang ditemukan. Jika tidak ada record yang ditemukan, maka variabel $like akan bernilai null

        if (!$like) { //  Memeriksa apakah variabel $like bernilai null, yang berarti pengguna tersebut belum memberi like pada konten tersebut.
            Like::create([ // Like adalah nama model Like::create adalah akan membuat like dengan
                'id_contents' => $contentId, // id content tersebut
                'id_users' => Auth::id(), // id pengguna tersebut
                'tanggal' => now(), // waktu saat ini
            ]);
            return redirect()->back()->with('success', 'Like Berhasil'); // Setelah menyimpan like, pengguna dialihkan ke halaman home dengan pesan sukses bahwa like berhasil dilakukan.
        } else {
            $like->delete(); // $like->delete(): Menghapus record like yang ditemukan dari tabel likes.
            return redirect()->back()->with('success', 'Di dislike Berhasil');
        }
    }

    public function comment(Request $request, $contentId)
    {
        $request->validate([
            'komentar' => 'required|string',
        ]);

        Comment::create([
            'komentar' => $request->komentar,
            'tanggal' => now(),
            'id_contents' => $contentId,
            'id_users' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->id_users == Auth::id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }

    public function deleteCommentall($id)
    {
        $comment = Comment::findOrFail($id);
    
        // Periksa apakah pengguna adalah pembuat komentar atau pembuat konten
        if ($comment->id_users == Auth::id() || $comment->content->user->id == Auth::id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
        }
    
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }

    // melihat profil pengguna lain
    public function showprofile(string $username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Ambil konten yang dimiliki user
        $contents = $user->contents()->latest()->get();

        // Return view dengan data user dan konten
        return view('profile.user.profile',['title' => 'Profil - Web Media'], compact('user', 'contents'));
    }
    
}
