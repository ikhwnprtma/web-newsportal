@extends('admin.master')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Berita</h3>
            <a href="{{ route('NewsCreate') }}" class="btn btn-primary float-end">Tambah Berita</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">Hapus</button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection

<script>
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            if (confirm("Yakin ingin menghapus berita ini?")) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    });
</script>

