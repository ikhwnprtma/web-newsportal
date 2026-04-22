@extends('admin.master')

@section('content')
    <div class="container">
        <h2>Tambah News</h2>
        <form action="{{ route('NewsStore') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea id="summernote" name="content" class="form-control">{{ old('content') }}</textarea>
            </div>

            <input type="hidden" name="image" id="image" value="{{ old('image') }}">

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection

@include('admin.news.script')
