<a href="{{ route('attributes.show', $attribute->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title=""
  data-original-title="see detail"><i class="fas fa-info-circle"></i></a>
<a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
<form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST" style="display:inline;">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-icon btn-warning" onclick="return confirm('Are you sure you want to delete this attribute?');">
    <i class="fas fa-trash"></i>
  </button>
</form>
