<div class="form-group">
    <label for="{{ $prefix }}title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="{{ $prefix }}title" name="title" value="{{ old('title', $blog->title ?? '') }}" required>
    @error('title')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="{{ $prefix }}slug">Slug (optional — auto-generated if empty)</label>
    <input type="text" class="form-control" id="{{ $prefix }}slug" name="slug" value="{{ old('slug', $blog->slug ?? '') }}">
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="{{ $prefix }}date">Date (display text)</label>
            <input type="text" class="form-control" id="{{ $prefix }}date" name="date" placeholder="e.g. Aug 02, 2026" value="{{ old('date', $blog->date ?? '') }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="{{ $prefix }}read_time">Read Time</label>
            <input type="text" class="form-control" id="{{ $prefix }}read_time" name="read_time" placeholder="e.g. 5 min read" value="{{ old('read_time', $blog->read_time ?? '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="{{ $prefix }}author">Author</label>
    <input type="text" class="form-control" id="{{ $prefix }}author" name="author" value="{{ old('author', $blog->author ?? '') }}">
</div>

<div class="form-group">
    <label for="{{ $prefix }}image">Image Upload</label>
    <input type="file" class="form-control-file" id="{{ $prefix }}image" name="image" accept="image/*">
    @if (!empty($blog->image ?? ''))
        <img src="{{ $blog->image }}" alt="Current image" class="mt-2 border rounded" style="max-height: 90px;">
    @endif
    <img id="{{ $prefix }}image_preview" src="" alt="Preview" class="mt-2 border rounded d-none {{ $prefix === 'edit_' ? '' : '' }}" style="max-height: 90px;">
    <small class="text-muted">JPG, PNG, WEBP, GIF or SVG — max 4MB. Leave empty to keep the current image.</small>
    @error('image')
        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="{{ $prefix }}tags">Tags (one per line or comma-separated)</label>
    <textarea class="form-control" id="{{ $prefix }}tags" name="tags" rows="2">{{ old('tags', $blog->tags ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="{{ $prefix }}excerpt">Excerpt</label>
    <textarea class="form-control @error('excerpt') is-invalid @enderror" id="{{ $prefix }}excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
    @error('excerpt')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="{{ $prefix }}content">Content (HTML allowed)</label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="{{ $prefix }}content" name="content" rows="12">{{ old('content', $blog->content ?? '') }}</textarea>
    @error('content')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
