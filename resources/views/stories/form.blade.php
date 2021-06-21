@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $story->title ?? old('title') }}">
</div>
<div class="md-form">
  <label>サブタイトル</label>
  <input type="text" name="sub_title" class="form-control" required value="{{ $story->sub_title ?? old('sub_title') }}">
</div>
<div class="form-group">
  <story-tags-input
    :initial-tags='@json($tagNames ?? [])'
    :autocomplete-items='@json($allTagNames ?? [])'
  >
  </story-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ $story->body ?? old('body') }}</textarea>
</div>